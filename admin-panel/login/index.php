<?php
session_start();
session_regenerate_id(true);

// --------
function checkSubmissionLimit($conn, $ip)
{
    $today = date("Y-m-d");
    $sql = "SELECT COUNT(*) as count FROM login_admin WHERE ip_address = ? AND submission_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["count"] >= 3) {
            return false;
        }
    }

    return true;
}

function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

function saveSubmissionCount($conn, $ip)
{
    $today = date("Y-m-d");
    $sql = "INSERT INTO login_admin (ip_address, submission_date) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip, $today);
    $stmt->execute();
}

function generateRandomString($length = 16)
{
    return bin2hex(openssl_random_pseudo_bytes($length / 2));
}

// --------

if (isset($_POST["submit"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "agencyDB";

    $conn = new mysqli($servername, $username, $password, $database);

    $userIP = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");

    if (!checkSubmissionLimit($conn, $userIP)) {
        header('Location: https://www.google.com');
    }

    saveSubmissionCount($conn, $userIP);

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    $username = ($_POST['name']);
    $password = cleanInput($_POST['password']);
    $pin = cleanInput($_POST['pin']);

    $sql = "SELECT * FROM admin WHERE name = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row['password'];
        if (password_verify($password, $hash) && $pin == $row['pin']) {
            session_regenerate_id();
            $randomString = generateRandomString(16);
            $_SESSION['admin'] = $randomString;
            header("Location: .././index.php");
            exit;
        } else {
            echo "<div id='success'>Wrong Password or PIN!</div>";
            echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
        }
    } else {
        echo "<div id='success'>User not found!</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="alternate" hreflang="de" href="../">
    <link rel="alternate" hreflang="en" href="../">
    <link rel="alternate" hreflang="fr" href="../">
    <link rel="icon/image" href="../">
    <link href="../../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha384-..." crossorigin="anonymous">
</head>

<body>
    <header class="fixed left-0 top-0 w-full z-9999 py-7 lg:py-0 bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border" :class="{ 'bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border' : stickyMenu }" @scroll.window="stickyMenu = (window.scrollY > 0) ? true : false">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 lg:flex items-center justify-between relative">
            <div class="w-full lg:w-1/4 flex items-center justify-between">
                <a href="../../homepage/">
                    <img src="../../images/VOOID.png" alt="Logo" class="h-38px">
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
                            <a href="../../homepage/#homepage" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient" :class="{'!text-white nav-gradient' :page === 'admin'}">Homepage</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../../homepage/#why_we" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Why we</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../../homepage/#prices" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Prices</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../../homepage/#contact_us" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Contact us</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././team-services" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Team
                                & Services</a>
                        </li>
                    </ul>
                </nav>
                <div class="flex items-center gap-6 mt-7 lg:mt-0">
                    <a href="../.././ai-assistent" class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">
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
                <h1 class="font-extrabold text-heading-2 text-white mb-5.5">
                    Administrator
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="index.html">Homepage</a></li>
                    <li class="font-medium">/ Administrator</li>
                </ul>
            </div>
        </section>

        <section>
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="wow fadeInUp rounded-3xl bg-white/[0.05]">
                    <div class="flex">
                        <div class="hidden lg:block w-full lg:w-1/2">
                            <div class="relative py-20 pl-17.5 pr-22">
                                <div
                                    class="absolute top-0 right-0 w-[1px] h-full bg-gradient-to-b from-white/0 via-white/20 to-white/0">
                                </div>
                                <img src="../../images/sigin.svg" alt="signin">
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <div
                                class="py-8 sm:py-20 pl-8 sm:pl-21 pr-8 sm:pr-20 flex items-center justify-center h-100">
                                <form action="" method="post">
                                    <h2 class="flex items-center justify-center text-heading-2">Administrator</h2>
                                    <span class="relative block font-medium text-sm text-center my-7.5">
                                        <span
                                            class="block absolute left-0 top-1/2 h-[1px] w-22.5 bg-white/[0.12]"></span>
                                        <span
                                            class="block absolute right-0 top-1/2 h-[1px] w-22.5 bg-white/[0.12]"></span>
                                        Admin
                                    </span>
                                    <div class="mb-4 relative">
                                        <span class="absolute top-1/2 -translate-y-1/2 left-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.00039 6.92499C9.85039 6.92499 11.3504 5.47499 11.3504 3.67499C11.3504 1.87499 9.85039 0.424988 8.00039 0.424988C6.15039 0.424988 4.65039 1.87499 4.65039 3.67499C4.65039 5.47499 6.15039 6.92499 8.00039 6.92499ZM8.00039 1.57499C9.22539 1.57499 10.2254 2.52499 10.2254 3.69999C10.2254 4.87499 9.22539 5.82499 8.00039 5.82499C6.77539 5.82499 5.77539 4.87499 5.77539 3.69999C5.77539 2.52499 6.77539 1.57499 8.00039 1.57499Z"
                                                    fill="#918EA0"></path>
                                                <path
                                                    d="M9.62539 8.04999H6.37539C3.70039 8.04999 1.52539 10.25 1.52539 12.925V15C1.52539 15.3 1.77539 15.575 2.10039 15.575C2.42539 15.575 2.67539 15.325 2.67539 15V12.925C2.67539 10.875 4.35039 9.17499 6.42539 9.17499H9.65039C11.7004 9.17499 13.4004 10.85 13.4004 12.925V15C13.4004 15.3 13.6504 15.575 13.9754 15.575C14.3004 15.575 14.5504 15.325 14.5504 15V12.925C14.4754 10.25 12.3004 8.04999 9.62539 8.04999Z"
                                                    fill="#918EA0"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="name" placeholder="Enter your name"
                                            class="w-full border border-white/[0.12] bg-transparent rounded-lg focus:border-purple pl-14.5 pr-4 py-3.5 font-medium outline-none focus-visible:shadow-none"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="mb-4 relative">
                                        <span class="absolute top-1/2 -translate-y-1/2 left-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_368_6544)">
                                                    <path
                                                        d="M14.0752 1.92501C13.1252 0.975012 11.8502 0.450012 10.5002 0.450012C9.1502 0.450012 7.8502 0.975012 6.9002 1.92501C5.6252 3.20001 5.1252 5.00001 5.5752 6.75001L0.725195 11.575C0.550195 11.75 0.450195 12 0.450195 12.275V14.6C0.450195 15.125 0.875195 15.575 1.4252 15.575H3.7502C4.0002 15.575 4.2502 15.475 4.4502 15.3L5.0252 14.725C5.2252 14.525 5.3502 14.225 5.3002 13.925V13.875L5.6002 13.85C6.0752 13.8 6.4252 13.45 6.4752 12.975L6.5002 12.675H6.5502C6.8252 12.7 7.1002 12.625 7.3252 12.425C7.5252 12.25 7.6502 11.975 7.6502 11.7V11.5H7.8252C8.0752 11.5 8.3252 11.4 8.5002 11.225L9.3252 10.425C11.0502 10.85 12.8502 10.375 14.1002 9.12501C16.0502 7.12501 16.0502 3.90001 14.0752 1.92501ZM13.2752 8.30001C12.2502 9.32501 10.7252 9.70001 9.3002 9.22501C9.1002 9.15001 8.8752 9.20001 8.7252 9.35001L7.7252 10.35H7.0502C6.7502 10.35 6.4752 10.6 6.4752 10.925V11.525L6.0252 11.475C5.8752 11.45 5.7252 11.5 5.6002 11.6C5.4752 11.7 5.4002 11.825 5.4002 11.975L5.3252 12.725L4.5752 12.8C4.4252 12.825 4.2752 12.9 4.2002 13C4.1002 13.125 4.0502 13.275 4.0752 13.425L4.1502 13.975L3.6752 14.45H1.5752V12.35L6.6002 7.32501C6.7502 7.17501 6.8002 6.95001 6.7252 6.75001C6.2752 5.32501 6.6252 3.80001 7.6752 2.75001C8.4252 2.00001 9.4002 1.60001 10.4752 1.60001C11.5252 1.60001 12.5252 2.00001 13.2752 2.75001C14.8252 4.25001 14.8252 6.75001 13.2752 8.30001Z"
                                                        fill="#918EA0"></path>
                                                    <path
                                                        d="M11.3498 2.875C10.8748 2.875 10.4248 3.05 10.0748 3.4C9.3748 4.1 9.3748 5.225 10.0748 5.925C10.4248 6.275 10.8748 6.45 11.3498 6.45C11.8248 6.45 12.2748 6.275 12.6248 5.925C12.9748 5.575 13.1498 5.125 13.1498 4.65C13.1498 4.175 12.9748 3.725 12.6248 3.375C12.2748 3.05 11.8248 2.875 11.3498 2.875ZM11.8248 5.125C11.5748 5.375 11.1248 5.375 10.8748 5.125C10.6248 4.875 10.6248 4.45 10.8748 4.175C10.9998 4.05 11.1748 3.975 11.3498 3.975C11.5248 3.975 11.6998 4.05 11.8248 4.175C11.9498 4.3 12.0248 4.475 12.0248 4.65C12.0248 4.825 11.9498 5 11.8248 5.125Z"
                                                        fill="#918EA0"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_368_6544">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <input type="password" name="password" placeholder="Confirm password"
                                            class="w-full border border-white/[0.12] bg-transparent rounded-lg focus:border-purple pl-14.5 pr-4 py-3.5 font-medium outline-none focus-visible:shadow-none"
                                            autocomplete="off" required>
                                    </div>
                                    <div class="mb-5 relative">
                                        <span class="absolute top-1/2 -translate-y-1/2 left-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_368_6544)">
                                                    <path
                                                        d="M14.0752 1.92501C13.1252 0.975012 11.8502 0.450012 10.5002 0.450012C9.1502 0.450012 7.8502 0.975012 6.9002 1.92501C5.6252 3.20001 5.1252 5.00001 5.5752 6.75001L0.725195 11.575C0.550195 11.75 0.450195 12 0.450195 12.275V14.6C0.450195 15.125 0.875195 15.575 1.4252 15.575H3.7502C4.0002 15.575 4.2502 15.475 4.4502 15.3L5.0252 14.725C5.2252 14.525 5.3502 14.225 5.3002 13.925V13.875L5.6002 13.85C6.0752 13.8 6.4252 13.45 6.4752 12.975L6.5002 12.675H6.5502C6.8252 12.7 7.1002 12.625 7.3252 12.425C7.5252 12.25 7.6502 11.975 7.6502 11.7V11.5H7.8252C8.0752 11.5 8.3252 11.4 8.5002 11.225L9.3252 10.425C11.0502 10.85 12.8502 10.375 14.1002 9.12501C16.0502 7.12501 16.0502 3.90001 14.0752 1.92501ZM13.2752 8.30001C12.2502 9.32501 10.7252 9.70001 9.3002 9.22501C9.1002 9.15001 8.8752 9.20001 8.7252 9.35001L7.7252 10.35H7.0502C6.7502 10.35 6.4752 10.6 6.4752 10.925V11.525L6.0252 11.475C5.8752 11.45 5.7252 11.5 5.6002 11.6C5.4752 11.7 5.4002 11.825 5.4002 11.975L5.3252 12.725L4.5752 12.8C4.4252 12.825 4.2752 12.9 4.2002 13C4.1002 13.125 4.0502 13.275 4.0752 13.425L4.1502 13.975L3.6752 14.45H1.5752V12.35L6.6002 7.32501C6.7502 7.17501 6.8002 6.95001 6.7252 6.75001C6.2752 5.32501 6.6252 3.80001 7.6752 2.75001C8.4252 2.00001 9.4002 1.60001 10.4752 1.60001C11.5252 1.60001 12.5252 2.00001 13.2752 2.75001C14.8252 4.25001 14.8252 6.75001 13.2752 8.30001Z"
                                                        fill="#918EA0"></path>
                                                    <path
                                                        d="M11.3498 2.875C10.8748 2.875 10.4248 3.05 10.0748 3.4C9.3748 4.1 9.3748 5.225 10.0748 5.925C10.4248 6.275 10.8748 6.45 11.3498 6.45C11.8248 6.45 12.2748 6.275 12.6248 5.925C12.9748 5.575 13.1498 5.125 13.1498 4.65C13.1498 4.175 12.9748 3.725 12.6248 3.375C12.2748 3.05 11.8248 2.875 11.3498 2.875ZM11.8248 5.125C11.5748 5.375 11.1248 5.375 10.8748 5.125C10.6248 4.875 10.6248 4.45 10.8748 4.175C10.9998 4.05 11.1748 3.975 11.3498 3.975C11.5248 3.975 11.6998 4.05 11.8248 4.175C11.9498 4.3 12.0248 4.475 12.0248 4.65C12.0248 4.825 11.9498 5 11.8248 5.125Z"
                                                        fill="#918EA0"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_368_6544">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <input type="text" name="pin" placeholder="Confirm PIN"
                                            class="w-full border border-white/[0.12] bg-transparent rounded-lg focus:border-purple pl-14.5 pr-4 py-3.5 font-medium outline-none focus-visible:shadow-none"
                                            autocomplete="off" required>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="hero-button-gradient flex justify-center w-full rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                                        Enter Admin Panel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="relative z-10 pb-17.5 lg:pb-22.5 xl:pb-27.5">

        <div class="absolute bottom-0 left-0 w-full flex flex-col gap-3 -z-1 opacity-50">
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
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 relative pt-17.5">
            <div class="w-full h-[1px] footer-divider-gradient absolute top-0 left-0"></div>
            <div class="flex flex-wrap justify-between">
                <div class="mb-10 max-w-[571px] w-full">
                    <a class="mb-8.5 inline-block" href="../../index.php">
                        <img src="../../images/VOOID.png" alt="Logo" class="h-35px">
                    </a>
                    <p class="mb-12 xl:w-4/5">
                        We take your online presence to the next level.
                    </p>
                    <div class="flex items-center gap-5">
                        <a href="https://www.instagram.com/vooid_official/" target="_blank" class="hover:text-white ease-in duration-300">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://www.tiktok.com/@vooid.official" target="_blank" class="hover:text-white ease-in duration-300">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a href="https://github.com/th3onu5/" target="_blank" class="hover:text-white ease-in duration-300">
                            <i class="bi bi-github fs-4"></i>
                        </a>
                    </div>
                    <p class="font-medium mt-5.5">
                        <a href="https://github.com/TH3ONU5" target="_blank"><strong>Created by TH3ONU5</strong></a>
                    </p>
                </div>
                <div class="max-w-[571px] w-full">
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-10">
                        <div>
                            <h5 class="font-semibold text-white mb-5">Products</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../../homepage/#prices" class="font-medium ease-in duration-300 hover:text-white">Prices</a>
                                </li>
                                <li>
                                    <a href="../../homepage/#why_we" class="font-medium ease-in duration-300 hover:text-white">Why we</a>
                                </li>
                                <li>
                                    <a href="../../homepage/#contact_us" class="font-medium ease-in duration-300 hover:text-white">Contact us</a>
                                </li>
                                <li>
                                    <a href="../.././ai-assistent/" class="font-medium ease-in duration-300 hover:text-white">AI-Assistent</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Company</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../../homepage/#homepage" class="font-medium ease-in duration-300 hover:text-white">Homepage</a>
                                </li>
                                <li>
                                    <a href="../.././imprint/" class="font-medium ease-in duration-300 hover:text-white">Imprint</a>
                                </li>
                                <li>
                                    <a href="../.././team-services/" class="font-medium ease-in duration-300 hover:text-white">Team & Services</a>
                                </li>
                                <li>
                                    <a href="../.././privacy_policy/" class="font-medium ease-in duration-300 hover:text-white">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Support</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../.././ai-assistent/" class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href="../../homepage/#contact_us" class="font-medium ease-in duration-300 hover:text-white">Contact us</a>
                                </li>
                                <li>
                                    <a href="mailto:vooid@web.de" class="font-medium ease-in duration-300 hover:text-white">vooid@web.de</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Selektiere das Element
        var element = document.getElementById('faq-items');

        // Füge ein Event-Listener hinzu, um Änderungen zu überwachen
        element.addEventListener('transitionend', function(event) {
            if (event.propertyName === 'display') {
                // Wenn die Klasse 'block' auf 'none' gesetzt wird, ändere die Klasse 'hidden' zu 'block'
                if (element.style.display === 'none') {
                    element.classList.add('hidden');
                } else {
                    element.classList.remove('hidden');
                }
            }
        });
    </script>
</body>

</html>