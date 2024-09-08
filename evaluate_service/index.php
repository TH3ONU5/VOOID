<?php
session_start();
session_regenerate_id(true);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencyDB";

$conn = new mysqli($servername, $username, $password, $dbname);

function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['feedback_form'])) {
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
    $email = cleanInput($_POST['email']);
    $titel = cleanInput($_POST['titel']);
    $feedback = cleanInput($_POST['feedback']);
    $rating = cleanInput($_POST['rating']);
    $terms = cleanInput($_POST['terms']);
    $userIP = $_SERVER['REMOTE_ADDR'];

    $error = '';

    if (empty($firstname)) {
        $error = "Please enter your first name.";
    } elseif (!preg_match('/^[a-zA-Z\s\'-]+$/', $_POST['firstname'])) {
        $errors[] = "Invalid first name format.";
    }

    if (empty($lastname)) {
        $error = "Please enter your last name.";
    } elseif (!preg_match('/^[a-zA-Z\s\'-]+$/', $_POST['lastname'])) {
        $errors[] = "Invalid last name format.";
    }

    if (empty($email)) {
        $error = "Please enter your email.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }

    if (empty($terms)) {
        $error = "Please accept the terms.";
    }

    if (empty($titel)) {
        $error = "Please enter a feedback titel.";
    }

    if (strlen($firstname) > 25) {
        $error = "First name should not be more than 50 characters.";
    }

    if (strlen($lastname) > 25) {
        $error = "Last name should not be more than 50 characters.";
    }

    if (strlen($email) > 50) {
        $error = "Email name should not be more than 50 characters.";
    }

    if (strlen($titel) > 50) {
        $error = "Feedback titel should not be more than 50 characters.";
    }

    if (strlen($feedback) > 2500) {
        $error = "Feedback should not be more than 3000 characters.";
    }

    if ($rating == null) {
        $error = "Please select a rating.";
    } elseif (!in_array($_POST['rating'], range(1, 5))) {
        $error = "Invalid rating value.";
    }

    if (empty($error)) {

        $stmt = $conn->prepare("SELECT ip FROM rating WHERE ip = ?");
        $stmt->bind_param('s', $userIP);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div id='success'>You have already submitted an assessment.</div>";
            echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
            $stmt->close();
        } else {
            $stmt->close();
            $sql = "INSERT INTO rating (firstname, lastname, email, titel, feedback, rating, ip)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssis", $firstname, $lastname, $email, $titel, $feedback, $rating, $userIP);
            if ($stmt->execute()) {
                $new_id = $conn->insert_id;
                $msg = "<div id='success'>Feedback submitted successfully!</div> <script>setTimeout(() => {success.style.display='none';},3000);</script>";
                $_SESSION['msg'] = $msg;
                header('Location: ../reviews/#' . $new_id . '');
                exit();
            } else {
                echo "<div id='success'>Something went wrong. Please try again!</div>";
                echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
            }
            $stmt->close();
        }
    } else {
        echo "<div id='success'>" . $error . "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOOID | Evaluate service </title>
    <link rel="icon/image" href="">
    <link rel="stylesheet" href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-..." crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .popup-wrapper {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 100000 !important;
        }

        .popup-box {
            padding: 20px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            background: #000000;
            border: 2px solid #1C1C1C;
            border-radius: 10px;
        }

        .close-popup-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        .form-layout {
            display: flex;
            flex-direction: column;
        }

        .form-layout label {
            margin-bottom: 5px;
        }

        .form-layout input,
        .form-layout textarea {
            margin-bottom: 10px;
        }

        .rating {
            direction: rtl;
            font-size: 2rem;
            unicode-bidi: bidi-override;
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: #ddd;
            cursor: pointer;
            display: inline-block;
        }

        .rating input:checked~label {
            color: #aa00f1;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #aa00f1;
        }

        @media (max-width: 600px) {
            .popup-box {
                width: 95%;
            }
        }
    </style>
</head>

<body x-data="{ page: '', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

    <header class="fixed left-0 top-0 w-full z-9999 py-7 lg:py-0 bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border" :class="{ 'bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border' : stickyMenu }" @scroll.window="stickyMenu = (window.scrollY > 0) ? true : false">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 lg:flex items-center justify-between relative">
            <div class="w-full lg:w-1/4 flex items-center justify-between">
                <a href="../homepage/">
                    <img src="../images/VOOID.png" alt="Logo" class="h-38px">
                </a>

                <button class="lg:hidden block" @click="navigationOpen = !navigationOpen">
                    <span class="block relative cursor-pointer w-5.5 h-5.5">
                        <span class="du-block absolute right-0 w-full h-full">
                            <span class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-[0] !w-full delay-300" :class="{ '!w-full delay-300': !navigationOpen }"></span>
                            <span class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-150 !w-full delay-400" :class="{ '!w-full delay-400': !navigationOpen }"></span>
                            <span class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-200 !w-full delay-500" :class="{ '!w-full delay-500': !navigationOpen }"></span>
                        </span>
                        <span class="du-block absolute right-0 w-full h-full rotate-45">
                            <span class="block bg-white rounded-sm ease-in-out duration-200 delay-300 absolute left-2.5 top-0 w-0.5 h-full !h-0 delay-[0]" :class="{ '!h-0 delay-[0]': !navigationOpen }"></span>
                            <span class="block bg-white rounded-sm ease-in-out duration-200 delay-400 absolute left-0 top-2.5 w-full h-0.5 !h-0 dealy-200" :class="{ '!h-0 dealy-200': !navigationOpen }"></span>
                        </span>
                    </span>
                </button>

            </div>
            <div class="w-full lg:w-3/4 h-0 lg:h-auto invisible lg:visible lg:flex items-center justify-between" :class="{ '!visible bg-dark shadow-lgrelative !h-auto max-h-[400px] overflow-hidden rounded-md mt-4 p-7.5': navigationOpen }">
                <nav>
                    <ul class="flex lg:items-center flex-col lg:flex-row gap-5 lg:gap-2">
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../homepage/#homepage" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient !text-white nav-gradient" :class="{'!text-white nav-gradient' :page === 'home'}">Homepage</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../homepage/#why_we" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Why we</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../homepage/#prices" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Prices</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../homepage/#contact_us" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Contact us</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././team-services" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Team
                                & Services</a>
                        </li>
                    </ul>
                </nav>
                <div class="flex items-center gap-6 mt-7 lg:mt-0">
                    <a href=".././ai-assistent" class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">
                        AI-Assistent
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>

        <section class="relative z-10 pt-30 lg:pt-35 xl:pt-40 pb-18">

            <div class="absolute top-25 left-0 w-full flex flex-col gap-3 -z-1 opacity-50">
                <div class="w-full h-[1.24px] footer-bg-gradient"></div>
                <div class="w-full h-[2.47px] footer-bg-gradient"></div>
                <div class="w-full h-[3.71px] footer-bg-gradient"></div>
                <div class="w-full h-[4.99px] footer-bg-gradient"></div>
                <div class="w-full h-[6.19px] footer-bg-gradient"></div>
                <div class="w-full h-[7.42px] footer-bg-gradient"></div>
                <div class="w-full h-[8.66px] footer-bg-gradient"></div>
                <div class="w-full h-[9.90px] footer-bg-gradient"></div>
                <div class="w-full h-[13px] footer-bg-gradient"></div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-b from-dark/0 to-dark -z-1">
            </div>
            <div class="text-center px-4">
                <h1 class="font-extrabold text-heading-2 text-white mb-5.5 word-break">
                    Evaluate service
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="../index.html">Homepage</a></li>
                    <li class="font-medium">/ Evaluate service</li>
                </ul>
            </div>
        </section>

        <section id="book" class="scroll-mt-17 lg:pt-27.5">
            <div class="max-w-[1104px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="relative z-999 overflow-hidden rounded-[30px] bg-dark pt-25 px-4 sm:px-20 lg:px-27.5">

                    <div class="flex justify-center gap-7.5 absolute left-1/2 -translate-x-1/2 -top-[16%] max-w-[690px] w-full -z-1 opacity-40">
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-12">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-7">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-3">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-2">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-5">
                        </div>
                        <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border bottom-8">
                        </div>
                    </div>

                    <div class="max-w-[482px] w-full h-60 overflow-hidden absolute -z-1 -top-30 left-1/2 -translate-x-1/2">
                        <div class="stars"></div>
                        <div class="stars2"></div>
                    </div>

                    <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-19.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-20.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-21.svg" alt="blur" class="max-w-none">
                        </span>
                    </div>

                    <div class="wow fadeInUp mb-16 text-center relative z-999" id="" style="visibility: visible;">
                        <span class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                            <img src="../images/icon-title.svg" alt="icon">
                            <span class="hero-subtitle-text"> What did you experience? </span>
                        </span>
                        <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                            Evaluate service
                        </h2>
                        <p class="max-w-[714px] mx-auto font-medium">

                        </p>
                    </div>

                    <div class="form-box-gradient relative overflow-hidden rounded-[25px] bg-dark p-6 sm:p-8 xl:p-15">
                        <form action="" method="post" class="relative z-10">
                            <div class="-mx-4 xl:-mx-10 flex flex-wrap">
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="firstname" class="text-white mb-2.5 block font-medium">
                                            Firstname
                                        </label>
                                        <input id="firstname" type="text" name="firstname" placeholder="Please enter your Firstname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="25" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="lastname" class="text-white mb-2.5 block font-medium">
                                            Lastname
                                        </label>
                                        <input id="lastname" type="text" name="lastname" placeholder="Please enter your Lastname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="25" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-9.5">
                                        <label for="email" class="text-white mb-2.5 block font-medium">
                                            Email
                                        </label>
                                        <input id="email" type="text" name="email" placeholder="Please enter your email address" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="50" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-9.5">
                                        <label for="titel" class="text-white mb-2.5 block font-medium">
                                            Feedback titel
                                        </label>
                                        <input id="titel" type="text" name="titel" placeholder="Please enter a feedback titel" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="50" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10">
                                        <label for="feedback" class="text-white mb-2.5 block font-medium">
                                            Feedback
                                        </label>
                                        <textarea id="feedback" name="feedback" placeholder="Please enter a feedback" rows="6" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-5 px-6 outline-none" maxlength="2500" required></textarea>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10">
                                        <label for="stars" class="text-white mb-2.5 block font-medium">
                                            Stars:
                                        </label>
                                        <div class="rating" id="stars">
                                            <input type="radio" id="star5" name="rating" value="5"><label for="star5"><i class="bi bi-star-fill"></i></label>
                                            <input type="radio" id="star4" name="rating" value="4"><label for="star4"><i class="bi bi-star-fill"></i></label>
                                            <input type="radio" id="star3" name="rating" value="3"><label for="star3"><i class="bi bi-star-fill"></i></label>
                                            <input type="radio" id="star2" name="rating" value="2"><label for="star2"><i class="bi bi-star-fill"></i></label>
                                            <input type="radio" id="star1" name="rating" value="1"><label for="star1"><i class="bi bi-star-fill"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10 d-flex align-items-baseline gap-10px">
                                        <input type="checkbox" id="therms" class="fav-accent" name="terms" required>
                                        <label for="therms" class="text-white mb-2.5 block font-medium">
                                            I have read the <a href="../privacy_policy" target="_blank" class="underline-dashed fs-italic"> privacy policy </a> and agree with it.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4 xl:px-5">
                                <div class="text-center">
                                    <button type="submit" name="feedback_form" class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                                        Submit feedback
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php
    require_once('../footer.php');
    ?>

    <button class="hidden items-center justify-center w-10 h-10 rounded-[4px] shadow-solid-5 bg-purple hover:opacity-70 fixed bottom-8 right-8 z-999" @click="window.scrollTo({top: 0, behavior: 'smooth'})" @scroll.window="scrollTop = (window.pageYOffset &gt; 50) ? true : false" :class="{ '!flex' : scrollTop }">
        <svg class="fill-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z">
            </path>
        </svg>
    </button>

    <script defer="defer" src="../bundle.js"></script>
    <script defer="defer" src="../v84a3a4012de94ce1a686ba8c167c359c1696973893317.es" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon="{&quot;rayId&quot;:&quot;8674aa38aa149252&quot;,&quot;r&quot;:1,&quot;version&quot;:&quot;2024.3.0&quot;,&quot;token&quot;:&quot;9a6015d415bb4773a0bff22543062d3b&quot;}" crossorigin="anonymous"></script>

</body>

</html>