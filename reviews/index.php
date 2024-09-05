<?php
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

if (isset($_POST['feedback_form'])) {
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
    $email = cleanInput($_POST['email']);
    $titel = cleanInput($_POST['titel']);
    $feedback = cleanInput($_POST['feedback']);
    $rating = cleanInput($_POST['rating']);
    $userIP = $_SERVER['REMOTE_ADDR'];

    $error = '';

    if (empty($firstname)) {
        $error = "Please enter your first name.";
    }

    if (empty($lastname)) {
        $error = "Please enter your last name.";
    }

    if (empty($terms)) {
        $error = "Please accept the terms.";
    }

    if (empty($email)) {
        $error = "Please enter your email.";
    }

    if (empty($titel)) {
        $error = "Please enter a feedback titel.";
    }

    if (strlen($firstname) > 15) {
        $error = "First name should not be more than 50 characters.";
    }

    if (strlen($lastname) > 15) {
        $error = "Last name should not be more than 50 characters.";
    }

    if (strlen($email) > 50) {
        $error = "Email name should not be more than 50 characters.";
    }

    if (strlen($titel) > 50) {
        $error = "Feedback titel should not be more than 50 characters.";
    }

    if (strlen($feedback) > 2000) {
        $error = "Feedback should not be more than 3000 characters.";
    }

    if ($rating == null) {
        $error = "Select your rating stars.";
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
                echo "<div id='success'>Feedback submitted successfully!</div>";
                echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VOOID | AI-Assistent</title>
    <link rel="icon" href="favicon.ico">
    <link href=".././style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-..." crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
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
            color: gold;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: gold;
        }

        @media (max-width: 600px) {
            .popup-box {
                width: 95%;
            }
        }
    </style>
</head>

<body x-data="{ page: 'ki-assistent', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

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
                    <a href=".././ai-assistent" class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">AI-Assistent</a>
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
                <h1 class="font-extrabold text-heading-2 text-white mb-5.5">
                    Reviews & Evaluate service
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="index.php">Homepage</a></li>
                    <li class="font-medium">/ Reviews & Evaluate service</li>
                </ul>
            </div>
        </section>

        <section class="overflow-hidden">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 relative">
                <div class="absolute bottom-0 left-0 w-full h-[1px] about-divider-gradient"></div>
                <div class="flex">
                    <div class="wow fadeInLeft max-w-[570px] w-full mb-1em">
                        <!-- HIER -->
                    </div>
                    <div class="wow fadeInLeft max-w-[570px] w-full mb-1em text-right-webkit">
                        <button id="showPopupButton" class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">Evaluate service</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-17.5 lg:pt-22.5 xl:pt-27.5 pb-20 lg:pb-25 xl:pb-30 2xl:pb-[150px]">
            <div class="wow fadeInUp mx-auto w-full max-w-1150px text-center px-4 sm:px-8 lg:px-0" data-wow-delay="0.1s">

                <?php

                function generateStars($rating)
                {

                    if ($rating == 1) {
                        $ratingCOL = 'red';
                    }

                    if ($rating == 2) {
                        $ratingCOL = 'orange';
                    }

                    if ($rating == 3) {
                        $ratingCOL = 'yellow';
                    }

                    if ($rating == 4) {
                        $ratingCOL = 'green';
                    }

                    if ($rating == 5) {
                        $ratingCOL = 'green';
                    }

                    $maxStars = 5;
                    $starHTML = '<div class="flex items-center">';
                    for ($i = 1; $i <= $maxStars; $i++) {
                        if ($i <= $rating) {
                            $starHTML .= '<i class="fas fa-star text-' . $ratingCOL . '-500"></i>';
                        } else {
                            $starHTML .= '<i class="fas fa-star text-gray"></i>';
                        }
                    }
                    $starHTML .= '</div>';
                    return $starHTML;
                }

                $stmt = $conn->prepare("SELECT * FROM rating");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = cleanInput($row['id']);
                        $firstname = cleanInput($row['firstname']);
                        $lastname = cleanInput($row['lastname']);
                        $titel = cleanInput(htmlspecialchars_decode($row['titel']));
                        $feedback = cleanInput(htmlspecialchars_decode($row['feedback']));
                        $rating = (int)cleanInput($row['rating']);
                        $date = cleanInput($row['date']);

                        $namef = substr($row["firstname"], 0, 1);
                        $namel = substr($row["lastname"], 0, 1);

                        if (strlen($feedback) > 250) {
                            $shortFeedback = substr($feedback, 0, 250) . " ...";
                        } else {
                            $shortFeedback = $feedback;
                        }

                        if (strlen($titel) > 35) {
                            $shortTitel = substr($titel, 0, 35) . " ...";
                        } else {
                            $shortTitel = $titel;
                        }

                        if ($rating == 1) {
                            $ratingNUM = '1.0';
                        }

                        if ($rating == 2) {
                            $ratingNUM = '2.0';
                        }

                        if ($rating == 3) {
                            $ratingNUM = '3.0';
                        }

                        if ($rating == 4) {
                            $ratingNUM = '4.0';
                        }

                        if ($rating == 5) {
                            $ratingNUM = '5.0';
                        }

                        if ($rating == 1) {
                            $ratingCOL = 'red';
                        }

                        if ($rating == 2) {
                            $ratingCOL = 'orange';
                        }

                        if ($rating == 3) {
                            $ratingCOL = 'yellow';
                        }

                        if ($rating == 4) {
                            $ratingCOL = 'green';
                        }

                        if ($rating == 5) {
                            $ratingCOL = 'green';
                        }

                        $stars = generateStars($rating);

                        echo '
        <div class="relative rounded-3xl features-box-border p-6 rounded-lg shadow-md w-full mb-1em">
            <div class="flex items-center mb-4">
                <div class="bg-purpil text-white rounded-full w-12 h-12 flex items-center justify-center text-xl font-bold">' . $namef . $namel . '</div>
                <div class="ml-4">
                    <div class="font-bold text-left">' . $firstname . ' ' . $namel . '.</div>
                </div>
                <div class="ml-auto text-gray-500">' . $date . '</div>
            </div>
            <div class="flex items-center mb-4">
                        <div class="flex items-center">
                            ' . $stars . '
                        </div>
                        <div class="ml-2 text-' . $ratingCOL . '-500 font-bold">' . $ratingNUM . '</div>
                    </div>
            <div class="mb-4">
                <div class="font-bold text-lg text-left">' . $shortTitel . '</div>
                <p class="text-gray-700 mt-2 text-white text-left">' . $shortFeedback . '</p>
            </div>
            <div class="flex items-center text-gray-500">
                <div class="flex items-center mr-4 cursor-pointer">
                    <i class="far fa-thumbs-up"></i>
                    <span class="ml-1">nützlich</span>
                </div>
                <div class="flex items-center cursor-pointer">
                    <i class="fas fa-share"></i>
                    <span class="ml-1">Teilen</span>
                </div>
            </div>
        </div>
        ';
                    }
                } else {
                    echo 'No reviews have been provided at this time.';
                }
                ?>

            </div>
        </section>

    </main>


    <!-- popup -->
    <div id="popupContainer" class="popup-wrapper">
        <div class="popup-box">
            <span id="hidePopupButton" class="close-popup-btn">&times;</span>
            <p class="fs-2em text-white fw-bold mb-0.5em">Evaluation form</p>
            <form id="feedbackForm" class="form-layout" action="" method="post">
                <label for="inputName">Firstname:</label>
                <input type="text" id="inputName" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="15" autocomplete="off" placeholder="firstname..." name="firstname" required>

                <label for="inputName">Lastname:</label>
                <input type="text" id="inputName" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="15" autocomplete="off" placeholder="lastname..." name="lastname" required>

                <label for="inputEmail">E-Mail:</label>
                <input type="email" id="inputEmail" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="50" autocomplete="off" placeholder="email..." name="email" required>

                <label for="titel">Feedback titel:</label>
                <input type="text" id="titel" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" maxlength="50" autocomplete="off" placeholder="feedback titel..." name="titel" required>

                <label for="inputFeedback">Feedback:</label>
                <textarea id="inputFeedback" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" name="feedback" rows="4" maxlength="2000" placeholder="feedback..." required></textarea>

                <label class="mb-0" for="stars">Stars:</label>
                <div class="rating text-end mb-15px" id="stars">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"><i class="bi bi-star-fill"></i></label>
                </div>

                <div class="mb-1em d-flex align-items-baseline gap-10px">
                    <input type="checkbox" id="therms" class="fav-accent" name="terms" required>
                    <label for="therms" class="text-white mb-2.5 block font-medium">
                        I have read the <a href="../privacy_policy" target="_blank" class="underline-dashed fs-italic"> privacy policy </a> and agree with it.
                    </label>
                </div>

                <button type="submit" class="hero-button-gradient text-center rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80" name="feedback_form">Submit feedback</button>
            </form>
        </div>
    </div>
    <!-- popup -->

    <?php
    require_once('../footer.php');
    ?>

    <button class="hidden items-center justify-center w-10 h-10 rounded-[4px] shadow-solid-5 bg-purple hover:opacity-70 fixed bottom-8 right-8 z-999" @click="window.scrollTo({top: 0, behavior: 'smooth'})" @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false" :class="{ '!flex' : scrollTop }">
        <svg class="fill-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const showPopupButton = document.getElementById('showPopupButton');
            const hidePopupButton = document.getElementById('hidePopupButton');
            const popupContainer = document.getElementById('popupContainer');

            showPopupButton.addEventListener('click', () => {
                popupContainer.style.display = 'flex';
            });

            hidePopupButton.addEventListener('click', () => {
                popupContainer.style.display = 'none';
            });

            window.addEventListener('click', (event) => {
                if (event.target === popupContainer) {
                    popupContainer.style.display = 'none';
                }
            });
        });
    </script>

    <script defer src="../bundle.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"86807032ba419287","r":1,"version":"2024.3.0","token":"9a6015d415bb4773a0bff22543062d3b"}' crossorigin="anonymous"></script>
</body>

</html>