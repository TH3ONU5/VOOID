<?php
session_start();
session_regenerate_id(true);

include_once('../db.php');

function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

if (!isset($_SESSION['admin'])) {
    session_destroy();
    session_unset();
    header("Location: ./login/");
    exit;
}

if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
    header("Location: ../");
    exit;
}

if (isset($_POST["submit"])) {

    $userIP = $_SERVER['REMOTE_ADDR'];
    $firstname = cleanInput($_POST['firstname']);
    $lastname = cleanInput($_POST['lastname']);
    $company = cleanInput($_POST['company']);
    $phone = cleanInput($_POST['phone']);
    $email = cleanInput($_POST['email']);
    $message = cleanInput($_POST['message']);
    $matter = cleanInput($_POST['matter']);

    $date = date("Y-m-d H:i:s");

    $errors = [];

    $new_client = "New";

    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    }

    if (empty($matter)) {
        $errors[] = "Matter is required.";
    }

    if (empty($errors)) {
        if (empty($company)) {
            $sql = "INSERT INTO contact (firstname, lastname, phone, email, message, send, status, matter) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssssssss", $firstname, $lastname, $phone, $email, $message, $date, $new_client, $matter);
            if ($stmt->execute()) {
                echo "<div id='success'>Form submitted successfully!</div>";
                echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
            } else {
                echo "<div id='success'>Something went wrong. Please try again!</div>";
                echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
            }
            $stmt->close();
        } else {
            $sql = "INSERT INTO contact (firstname, lastname, company, phone, email, message, send, status, matter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("sssssssss", $firstname, $lastname, $company, $phone, $email, $message, $date, $new_client, $matter);
            if ($stmt->execute()) {
                echo "<div id='success'>Form submitted successfully!</div>";
                echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
            } else {
                echo "<div id='success'>Something went wrong. Please try again!</div>";
                echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
            }
            $stmt->close();
        }
    } else {
        echo "<div id='success'>";
        foreach ($errors as $error) {
            echo "<div id=''><span>$error</span></div>";
        }
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3500);</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.scss">
</head>

<body onload="startTime()">

    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php
        require_once('sidebar.php');
        ?>
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <h1 class="h2 mb-0 ls-tight">VOOID</h1>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <?php
                    require_once('top.php');
                    ?>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">New costumer</h5>
                        </div>
                        <form action="" method="post" class="relative z-10">
                            <div class="-mx-4 xl:-mx-10 flex flex-wrap">
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="firstname" class="text-white mb-2.5 block font-medium">
                                            Firstname
                                        </label>
                                        <input id="firstname" type="text" name="firstname" placeholder="Firstname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="lastname" class="text-white mb-2.5 block font-medium">
                                            Lastname
                                        </label>
                                        <input id="lastname" type="text" name="lastname" placeholder="Lastname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-9.5">
                                        <label for="company" class="text-white mb-2.5 block font-medium">
                                            Comapany
                                        </label>
                                        <input type="text" id="company" name="company" placeholder="Comapany name" rows="6" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off">
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="phone" class="text-white mb-2.5 block font-medium">
                                            Phone number
                                        </label>
                                        <input id="phone" type="tel" name="phone" placeholder="Phone number" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="email" class="text-white mb-2.5 block font-medium">
                                            Email
                                        </label>
                                        <input id="email" type="text" name="email" placeholder="Email" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10">
                                        <label for="message" class="text-white mb-2.5 block font-medium">
                                            Message
                                        </label>
                                        <textarea id="message" name="message" placeholder="Message" rows="6" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-5 px-6 outline-none" required></textarea>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10 d-grid">
                                        <p class="mb-2.5 block font-bold">
                                            What does the customer want:
                                        </p>
                                        <input type="radio" name="matter" id='starter' value="starter"><label class="ms-10px" for="starter">Website Starter-Package</label>
                                        <input type="radio" name="matter" id='premium' value="premium"><label class="ms-10px" for="premium">Website Premium-Package</label>
                                        <input type="radio" name="matter" id='vip' value="vip"><label class="ms-10px" for="vip">Website VIP-Package</label>
                                        <input type="radio" name="matter" id='admin' value="admin"><label class="ms-10px" for="admin">Website Administration</label>
                                        <input type="radio" name="matter" id='contact' value="contact"><label class="ms-10px" for="contact">Contact</label>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="text-center mb-2em">
                                        <button type="submit" name="submit" class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80 w-100 bg-blue-strong">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="main.js"></script>
</body>

</html>