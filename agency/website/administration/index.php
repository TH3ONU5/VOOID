<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOOID | Administrationsservice</title>
    <link rel="icon/image" href="">
    <link rel="stylesheet" href="../../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha384-..." crossorigin="anonymous">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700&display=swap");

        .accordion {
            display: flex;
            flex-direction: column;
            max-width: 991px;
            min-width: 320px;
        }

        .accordion-item {
            margin-top: 16px;
            border-radius: 6px;
            background: transparent;
        }

        .accordion-item .accordion-item-title {
            position: relative;
            margin: 0;
            display: flex;
            width: 100%;
            font-size: 22px;
            cursor: pointer;
            justify-content: space-between;
            flex-direction: row-reverse;
            box-sizing: border-box;
            align-items: center;
        }

        .accordion-item .accordion-item-desc {
            display: none;
            font-size: 14px;
            line-height: 22px;
            color: #918ea0;
            padding: 15px 0 15px 0;
            box-sizing: border-box;
        }

        .accordion-item input[type="checkbox"] {
            position: absolute;
            height: 0;
            width: 0;
            opacity: 0;
        }

        .accordion-item input[type="checkbox"]:checked~.accordion-item-desc {
            display: block;
        }

        .accordion-item input[type="checkbox"]:checked~.accordion-item-title .icon:after {
            content: "-";
            font-size: 40px;
            position: relative;
            top: -3px;
        }

        .accordion-item input[type="checkbox"]:checked~.accordion-item-title {
            color: white !important;
        }

        .accordion-item input[type="checkbox"]~.accordion-item-title .icon:after {
            content: "+";
            font-size: 40px;
        }

        .accordion-item:first-child {
            margin-top: 0;
        }

        .accordion-item .icon {
            margin-left: 14px;
        }

        @media screen and (max-width: 767px) {
            .accordion-item-title {
                font-size: 17px !important;
            }
        }
    </style>
</head>

<body x-data="{ page: '', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

    <header
        class="fixed left-0 top-0 w-full z-9999 py-7 lg:py-0 bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border"
        :class="{ 'bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border' : stickyMenu }"
        @scroll.window="stickyMenu = (window.scrollY > 0) ? true : false">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 lg:flex items-center justify-between relative">
            <div class="w-full lg:w-1/4 flex items-center justify-between">
                <a href="../../index.php">
                    <img src="../../images/VOOID.png" alt="Logo" class="h-38px">
                </a>

                <button class="lg:hidden block" @click="navigationOpen = !navigationOpen">
                    <span class="block relative cursor-pointer w-5.5 h-5.5">
                        <span class="du-block absolute right-0 w-full h-full">
                            <span
                                class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-[0] !w-full delay-300"
                                :class="{ '!w-full delay-300': !navigationOpen }"></span>
                            <span
                                class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-150 !w-full delay-400"
                                :class="{ '!w-full delay-400': !navigationOpen }"></span>
                            <span
                                class="block relative top-0 left-0 bg-white rounded-sm w-0 h-0.5 my-1 ease-in-out duration-200 delay-200 !w-full delay-500"
                                :class="{ '!w-full delay-500': !navigationOpen }"></span>
                        </span>
                        <span class="du-block absolute right-0 w-full h-full rotate-45">
                            <span
                                class="block bg-white rounded-sm ease-in-out duration-200 delay-300 absolute left-2.5 top-0 w-0.5 h-full !h-0 delay-[0]"
                                :class="{ '!h-0 delay-[0]': !navigationOpen }"></span>
                            <span
                                class="block bg-white rounded-sm ease-in-out duration-200 delay-400 absolute left-0 top-2.5 w-full h-0.5 !h-0 dealy-200"
                                :class="{ '!h-0 dealy-200': !navigationOpen }"></span>
                        </span>
                    </span>
                </button>

            </div>
            <div class="w-full lg:w-3/4 h-0 lg:h-auto invisible lg:visible lg:flex items-center justify-between"
                :class="{ '!visible bg-dark shadow-lgrelative !h-auto max-h-[400px] overflow-y-scroll rounded-md mt-4 p-7.5': navigationOpen }">
                <nav>
                    <ul class="flex lg:items-center flex-col lg:flex-row gap-5 lg:gap-2">
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././#startseite"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient !text-white nav-gradient"
                                :class="{'!text-white nav-gradient' :page === 'home'}">Startseite</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././#warum-wir"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Warum
                                wir</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././#preise"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Preise</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././#kontaktieren"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Kontaktieren</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="../.././team-services"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Team
                                & Services</a>
                        </li>
                    </ul>
                </nav>
                <div class="flex items-center gap-6 mt-7 lg:mt-0">
                    <a href="../.././ki-assistent"
                        class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">
                        KI-Assistent
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
                    Administrationsservice
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="../../index.html">Startseite</a></li>
                    <li class="font-medium">/ Administrationsservice</li>
                </ul>
            </div>
        </section>

        <section class="mb-425">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="grid sm:grid-cols-12 gap-7.5" data-highlighter="">
                    <div class="sm:col-span-12" style="--mouse-x: 230px; --mouse-y: 486px;">
                        <div class="relative rounded-3xl features-box-border">
                            <div class="relative overflow-hidden rounded-3xl p-10 xl:p-15 box-hover">
                                <div class="flex items-center justify-between relative z-20">
                                    <div class="w-full">
                                        <span
                                            class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-1-357 mx-auto">
                                            <img src="../../images/icon-07.svg" alt="icon">
                                        </span>
                                        <h3 class="text-white mb-4.5 font-bold text-heading-4">
                                            Information
                                        </h3>
                                        <p class="font-medium mb-10">
                                            Ihre Website ist startklar, aber Sie wissen nicht, wie Sie sie online
                                            bringen sollen. Server gegen Angriffe zu wappnen, Domains zu erwerben und
                                            SSL-Zertifikate einzurichten, kann komplex sein. Doch keine Sorge! Wir
                                            kümmern uns darum und nehmen Ihnen alle Sorgen ab. Unser Rundum-Service
                                            umfasst die Absicherung Ihrer Server, rund um die Uhr Schutz vor Gefahren
                                            und das Sichern Ihrer Daten. Mit uns an Ihrer Seite können Sie sich
                                            entspannt auf Ihr Kerngeschäft konzentrieren, während Ihre Online-Präsenz in
                                            besten Händen ist.
                                        </p>
                                        <a href="#book"
                                            class="features-button-gradient relative inline-flex items-center gap-1.5 rounded-full py-3 px-6 text-white text-sm ease-in duration-300 hover:shadow-button">
                                            Jetzt Buchen
                                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.3992 5.60002L8.22422 0.350024C7.99922 0.125024 7.64922 0.125024 7.42422 0.350024C7.19922 0.575024 7.19922 0.925025 7.42422 1.15002L11.6242 5.42503H0.999219C0.699219 5.42503 0.449219 5.67502 0.449219 5.97502C0.449219 6.27502 0.699219 6.55003 0.999219 6.55003H11.6742L7.42422 10.875C7.19922 11.1 7.19922 11.45 7.42422 11.675C7.52422 11.775 7.67422 11.825 7.82422 11.825C7.97422 11.825 8.12422 11.775 8.22422 11.65L13.3992 6.40002C13.6242 6.17502 13.6242 5.82502 13.3992 5.60002Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden -mx-28">
                                    <span class="absolute right-0 bottom-0"><img src="../../images/shape-01.png"
                                            alt="shape"></span>
                                    <span class="absolute left-0 top-0"><img src="../../images/shape-02.svg"
                                            alt="shape"></span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="../../images/blur-03.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="../../images/blur-04.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="../../images/blur-05.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute right-0 top-0">
                                        <img src="../../images/shape-03.svg" alt="shape" class="max-w-none">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="book" class="scroll-mt-17 lg:pt-27.5">
            <div class="max-w-[1104px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="relative z-999 overflow-hidden rounded-[30px] bg-dark pt-25 px-4 sm:px-20 lg:px-27.5">

                    <div
                        class="flex justify-center gap-7.5 absolute left-1/2 -translate-x-1/2 -top-[16%] max-w-[690px] w-full -z-1 opacity-40">
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

                    <div
                        class="max-w-[482px] w-full h-60 overflow-hidden absolute -z-1 -top-30 left-1/2 -translate-x-1/2">
                        <div class="stars"></div>
                        <div class="stars2"></div>
                    </div>

                    <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../../images/blur-19.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../../images/blur-20.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="../../images/blur-21.svg" alt="blur" class="max-w-none">
                        </span>
                    </div>

                    <div class="wow fadeInUp mb-16 text-center relative z-999" id="" style="visibility: visible;">
                        <span
                            class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                            <img src="../../images/icon-title.svg" alt="icon">
                            <span class="hero-subtitle-text"> Buchen sie Jetzt! </span>
                        </span>
                        <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                            Website Administration
                        </h2>
                        <p class="max-w-[714px] mx-auto font-medium">

                        </p>
                    </div>

                    <div class="form-box-gradient relative overflow-hidden rounded-[25px] bg-dark p-6 sm:p-8 xl:p-15">
                        <form action="#book" method="post" class="relative z-10">
                            <div class="-mx-4 xl:-mx-10 flex flex-wrap">
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="firstname" class="text-white mb-2.5 block font-medium">
                                            Vorname
                                        </label>
                                        <input id="firstname" type="text" name="firstname"
                                            placeholder="Vorname eingeben"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="lastname" class="text-white mb-2.5 block font-medium">
                                            Nachname
                                        </label>
                                        <input id="lastname" type="text" name="lastname" placeholder="Nachname eingeben"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-9.5">
                                        <label for="company" class="text-white mb-2.5 block font-medium">
                                            Unternehmen
                                        </label>
                                        <input type="text" id="company" name="company"
                                            placeholder="Geben Sie den Namen Ihrer Firma ein." rows="6"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="phone" class="text-white mb-2.5 block font-medium">
                                            Telefonnummer
                                        </label>
                                        <input id="phone" type="tel" name="phone" placeholder="Telefonnummer eingeben"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="email" class="text-white mb-2.5 block font-medium">
                                            Email
                                        </label>
                                        <input id="email" type="text" name="email" placeholder="E-Mail-Adresse eingeben"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10">
                                        <label for="message" class="text-white mb-2.5 block font-medium">
                                            Nachricht
                                        </label>
                                        <textarea id="message" name="message" placeholder="Nachricht eingeben" rows="6"
                                            class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-5 px-6 outline-none"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10 d-flex align-items-baseline gap-10px">
                                        <input type="checkbox" id="therms" class="fav-accent" name="terms" required>
                                        <label for="therms" class="text-white mb-2.5 block font-medium">
                                            Ich habe die <a href="../.././datenschutzrichtlinien/" target="_blank"
                                                class="underline-dashed fs-italic">Datenschutzrichtlinien</a> gelesen
                                            und akzeptiere sie.
                                        </label>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="text-center">
                                        <button type="submit" name="submit"
                                            class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                                            Nachricht senden
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                        Wir bringen Ihre Online-Präsenz auf das nächste Level.
                    </p>
                    <div class="flex items-center gap-5">
                        <a href="../https://www.instagram.com/vooid_official/" target="_blank"
                            class="hover:text-white ease-in duration-300">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="../https://www.tiktok.com/@vooid.official" target="_blank"
                            class="hover:text-white ease-in duration-300">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a href="../https://github.com/vooidOFFICIAL/" target="_blank"
                            class="hover:text-white ease-in duration-300">
                            <i class="bi bi-github fs-4"></i>
                        </a>
                    </div>
                    <p class="font-medium mt-5.5">
                        <a href="../https://github.com/TH3ONU5" target="_blank"><strong>Created by TH3ONU5</strong></a>
                    </p>
                </div>
                <div class="max-w-[571px] w-full">
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-10">
                        <div>
                            <h5 class="font-semibold text-white mb-5">Produkte</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../.././ki-assistent/"
                                        class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href="../.././#preise"
                                        class="font-medium ease-in duration-300 hover:text-white">Preise</a>
                                </li>
                                <li>
                                    <a href="../.././#warum-wir"
                                        class="font-medium ease-in duration-300 hover:text-white">Warum
                                        wir</a>
                                </li>
                                <li>
                                    <a href="../.././#kontaktieren"
                                        class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Unternehmen</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../.././#startseite"
                                        class="font-medium ease-in duration-300 hover:text-white">Startseite</a>
                                </li>
                                <li>
                                    <a href="../.././impressum/"
                                        class="font-medium ease-in duration-300 hover:text-white">Impressum</a>
                                </li>
                                <li>
                                    <a href="../.././team-services/"
                                        class="font-medium ease-in duration-300 hover:text-white">Team & Services</a>
                                </li>
                                <li>
                                    <a href="../.././datenschutzrichtlinien/"
                                        class="font-medium ease-in duration-300 hover:text-white">Datenschutzbedingungen</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Support</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="../.././ki-assistent/"
                                        class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href="../.././#kontaktieren"
                                        class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
                                </li>
                                <li>
                                    <a href="../mailto:vooid@web.de"
                                        class="font-medium ease-in duration-300 hover:text-white">vooid@web.de</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <button
        class="hidden items-center justify-center w-10 h-10 rounded-[4px] shadow-solid-5 bg-purple hover:opacity-70 fixed bottom-8 right-8 z-999"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset &gt; 50) ? true : false" :class="{ '!flex' : scrollTop }">
        <svg class="fill-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
                d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z">
            </path>
        </svg>
    </button>

    <script defer="defer" src="../../bundle.js"></script>
    <script defer="defer" src="../../v84a3a4012de94ce1a686ba8c167c359c1696973893317.es"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon="{&quot;rayId&quot;:&quot;8674aa38aa149252&quot;,&quot;r&quot;:1,&quot;version&quot;:&quot;2024.3.0&quot;,&quot;token&quot;:&quot;9a6015d415bb4773a0bff22543062d3b&quot;}"
        crossorigin="anonymous"></script>
    <script>
        // Selektiere das Element
        var element = document.getElementById('faq-items');

        // Füge ein Event-Listener hinzu, um Änderungen zu überwachen
        element.addEventListener('transitionend', function (event) {
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

    <script>
        // slide show 1
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides1");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "flex";
        }
    </script>

    <script>
        // slide show 1
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs2(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides2");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "flex";
        }
    </script>

    <script>
        // Imgae big

        const modal = document.getElementById("modal");
        const modalImg = document.getElementById("modal-img");
        const images = document.querySelectorAll(".gallery-image");
        const closeModal = document.getElementById("close");

        images.forEach(image => {
            image.addEventListener("click", () => {
                modal.style.display = "flex";
                modalImg.src = image.src;
            });
        });

        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>

</body>

</html>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agencyDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function checkSubmissionLimit($conn, $ip)
{
    $today = date("Y-m-d");
    $sql = "SELECT COUNT(*) as count FROM form_submissions WHERE ip_address = ? AND submission_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["count"] >= 3) {
            return false; // Sendelimit überschritten
        }
    }

    return true; // Sendelimit nicht überschritten oder IP-Adresse ist neu
}

function saveSubmissionCount($conn, $ip)
{
    $today = date("Y-m-d");
    $sql = "INSERT INTO form_submissions (ip_address, submission_date) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ip, $today);
    $stmt->execute();
}

if (isset($_POST['submit'])) {
    $userIP = $_SERVER['REMOTE_ADDR'];
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $company = trim($_POST['company']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $terms = trim($_POST['terms']);


    $date = date("Y-m-d H:i:s");

    $errors = [];

    if (strlen($firstname) > 50) {
        $errors[] = "First name is too long. Max 50 characters!";
    }

    if (strlen($lastname) > 50) {
        $errors[] = "Last name is too long. Max 50 characters!";
    }

    if (strlen($company) > 100) {
        $errors[] = "Company name is too long. Max 100 characters!";
    }

    if (strlen($phone) > 20 || !preg_match("/^\+?\d+$/", $phone)) {
        $errors[] = "Invalid phone number!";
    }

    if (strlen($phone) < 9 || !preg_match("/^\+?\d+$/", $phone)) {
        $errors[] = "Invalid phone number!";
    }

    if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address!";
    }

    if ($terms == null) {
        $errors[] = "Please Accept the Therms to coninue!";
    }

    if (!checkSubmissionLimit($conn, $userIP)) {
        $errors[] = "Max submissions reached for today!";
    }

    $new_client = "New";
    $yes = "yes";

    if (empty($errors)) {
        saveSubmissionCount($conn, $userIP);

        $sql = "INSERT INTO contact (firstname, lastname, company, phone, email, message, send, status, admin)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $firstname, $lastname, $company, $phone, $email, $message, $date, $new_client, $yes);
        if ($stmt->execute()) {
            echo "<div id='success'>Form submitted successfully!</div>";
            echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
        } else {
            echo "<div id='success'>Something went wrong. Please try again!</div>";
            echo "<script>setTimeout(() => {success.style.display='none';},3000);</script>";
        }
    } else {
        echo "<div id='success'>";
        foreach ($errors as $error) {
            echo "<div id=''><span>$error</span></div>";
        }
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }
}

$conn->close();
$stmt->close();

?>