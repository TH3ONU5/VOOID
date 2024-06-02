<!DOCTYPE html>
<html lang="de">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOOID - Wir erstellen Ihre Website!</title>
    <link rel="icon/image" href="">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha384-..." crossorigin="anonymous">
</head>

<body x-data="{ page: 'home', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

    <header
        class="fixed left-0 top-0 w-full z-9999 py-7 lg:py-0 bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border"
        :class="{ 'bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border' : stickyMenu }"
        @scroll.window="stickyMenu = (window.scrollY > 0) ? true : false">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 lg:flex items-center justify-between relative">
            <div class="w-full lg:w-1/4 flex items-center justify-between">
                <a href="index.php">
                    <img src="images/VOOID.png" alt="Logo" class="h-38px">
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
                            <a href="#startseite"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient !text-white nav-gradient"
                                :class="{'!text-white nav-gradient' :page === 'home'}">Startseite</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="#warum-wir"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Warum
                                wir</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="#preise"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Preise</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="#support"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Kontaktieren</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href="./team-services"
                                class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Team
                                & Services</a>
                        </li>
                    </ul>
                </nav>
                <div class="flex items-center gap-6 mt-7 lg:mt-0">
                    <a href="./ki-assistent"
                        class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">KI-Assistent</a>
                </div>
            </div>
        </div>
    </header>

    <main>

        <section id="startseite" class="relative overflow-hidden z-10 pt-35 md:pt-40 xl:pt-45">

            <div class="max-w-7xl mx-auto">
                <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden -mx-28">
                    <div
                        class="absolute -z-1 -top-[128%] sm:-top-[107%] xl:-top-[73%] left-1/2 -translate-x-1/2 -u-z-10 hero-circle-gradient w-full h-[1282px] rounded-full max-w-[1282px]">
                    </div>
                    <div
                        class="absolute -z-1 -top-[112%] sm:-top-[93%] xl:-top-[62%] left-1/2 -translate-x-1/2 -u-z-10 hero-circle-gradient w-full h-[1046px] rounded-full max-w-[1046px]">
                    </div>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -u-z-10">
                        <img src="images/blur-02.svg" alt="blur" class="max-w-none">
                    </div>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -u-z-10">
                        <img src="images/blur-01.svg" alt="blur" class="max-w-none">
                    </div>
                </div>
            </div>

            <div class="mx-auto max-w-[900px] px-4 sm:px-8 xl:px-0 relative z-1">
                <div class="text-center">
                    <span
                        class="hero-subtitle-gradient hover:hero-subtitle-hover relative mb-5 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                        <img src="images/icon-title.svg" alt="icon">
                        <span class="hero-subtitle-text">
                            Ihr ultimativer Website-Ersteller!
                        </span>
                    </span>
                    <h1 class="text-white mb-6 text-3xl font-extrabold sm:text-5xl xl:text-heading-1">
                        Bringen Sie Ihre Online-Präsenz auf das nächste Level!
                    </h1>
                    <p class="max-w-[500px] mx-auto mb-9 font-medium md:text-lg">
                        Suchen Sie nach einer Website? Dann sind Sie hier genau richtig! Wir erstellen Ihre
                        Traum-Website zu einem unglaublichen Preis!
                    </p>
                    <a href="#preise"
                        class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                        Jetzt starten
                    </a>
                </div>
            </div>
            <div class="mt-17" data-wow-delay="0.1s">
                <img class="mx-auto" src="images/hero.svg" alt="hero">
            </div>
        </section>


        <section id="warum-wir" class="overflow-hidden pt-17.5 lg:pt-22.5 xl:pt-27.5 scroll-mt-17" id="warum-wir">
            <div class="max-w-[1222px] mx-auto px-4 sm:px-8 xl:px-0">

                <div class="wow fadeInUp text-center" style="visibility: visible;">
                    <span
                        class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                        <img src="images/icon-title.svg" alt="icon">
                        <span class="hero-subtitle-text"> Warum wir </span>
                    </span>
                    <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                        Deswegen eine Website von uns
                    </h2>
                    <p class="max-w-[714px] mx-auto mb-5 font-medium">
                        Hier sind sechs überzeugende Gründe, warum Sie unsere Dienstleistungen in Anspruch nehmen
                        sollten.
                    </p>
                </div>
                <div class="relative">
                    <div
                        class="features-row-border rotate-90 w-1/2 h-[1px] absolute top-1/2 left-1/2 -translate-y-1/2 lg:-translate-x-1/3 lg:left-1/4 hidden lg:block">
                    </div>
                    <div
                        class="features-row-border rotate-90 w-1/2 h-[1px] absolute top-1/2 right-1/2 -translate-y-1/2 lg:right-[8.3%] hidden lg:block">
                    </div>

                    <div class="flex flex-wrap justify-center">

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    Responsive
                                </h4>
                                <p class="font-medium">
                                    Unabhängig davon, ob es sich um ein Mobiltelefon, ein Tablet oder einen PC handelt -
                                    Ihre Website passt sich immer an.
                                </p>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    SEO
                                </h4>
                                <p class="font-medium">
                                    Mit unserer umfangreichen Expertise und der Unterstützung von KI optimieren wir das
                                    SEO Ihrer Website.
                                </p>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    Intuitiv
                                </h4>
                                <p class="font-medium">
                                    Eine einfache und moderne Website, die sowohl für Sie als auch für Ihre
                                    Website-Besucher einfach zu verwenden ist.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="features-row-border w-full h-[1px]"></div>

                    <div class="flex flex-wrap justify-center">

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1 rotate-180"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    Administration
                                </h4>
                                <p class="font-medium">
                                    Wir kümmern uns von Anfang bis Ende um Ihre Website, einschließlich Server-, Domain-
                                    und SSL-Zertifikatsverwaltung.
                                </p>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1 rotate-180"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    Auswahl
                                </h4>
                                <p class="font-medium">
                                    Wir bieten eine große Auswahl an Designs und Themen, die perfekt zu Ihren
                                    Bedürfnissen passen. </p>
                            </div>
                        </div>

                        <div class="w-full sm:w-1/2 lg:w-1/3">
                            <div
                                class="group relative overflow-hidden text-center py-8 sm:py-10 xl:py-15 px-4 lg:px-8 xl:px-13 h-100">
                                <span
                                    class="group-hover:opacity-100 opacity-0 features-bg absolute w-full h-full left-0 top-0 -z-1 rotate-180"></span>
                                <span
                                    class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-8 mx-auto">
                                    <img src="images/icon-07.svg" alt="icon">
                                </span>
                                <h4 class="font-semibold text-lg text-white mb-4">
                                    Sicherheit
                                </h4>
                                <p class="font-medium">
                                    Regelmäßige Sicherheitsupdates & automatische Backups
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="pt-12.5">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="grid sm:grid-cols-12 gap-7.5" data-highlighter="">

                    <div class="sm:col-span-12" style="--mouse-x: 272px; --mouse-y: 2px;">
                        <div class="relative rounded-3xl features-box-border">
                            <div class="relative overflow-hidden rounded-3xl p-10 xl:p-15 box-hover">
                                <div class="flex items-center justify-between relative z-20">
                                    <div class="max-w-[477px] w-full">
                                        <span
                                            class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                                            <img src="images/icon-title.svg" alt="icon">
                                            <span class="hero-subtitle-text">
                                                Individuellen Website-Themas
                                            </span>
                                        </span>
                                        <h3 class="text-white mb-4.5 font-bold text-heading-4">
                                            Entwicklung eines individuellen Website-Themas </h3>
                                        <p class="font-medium mb-10">
                                            Bei VOOID verlassen wir uns nicht nur auf vorgefertigte Vorlagen. Wenn
                                            unsere Kunden eine Vorstellung
                                            davon haben, wie ihre Website aussehen soll, gestalten wir ein vollkommen
                                            einzigartiges Design, das ihrer Vision entspricht.
                                        </p>
                                        <a href="#support"
                                            class="features-button-gradient relative inline-flex items-center gap-1.5 rounded-full py-3 px-6 text-white text-sm ease-in duration-300 hover:shadow-button">
                                            Jetzt Kontaktieren
                                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.3992 5.60002L8.22422 0.350024C7.99922 0.125024 7.64922 0.125024 7.42422 0.350024C7.19922 0.575024 7.19922 0.925025 7.42422 1.15002L11.6242 5.42503H0.999219C0.699219 5.42503 0.449219 5.67502 0.449219 5.97502C0.449219 6.27502 0.699219 6.55003 0.999219 6.55003H11.6742L7.42422 10.875C7.19922 11.1 7.19922 11.45 7.42422 11.675C7.52422 11.775 7.67422 11.825 7.82422 11.825C7.97422 11.825 8.12422 11.775 8.22422 11.65L13.3992 6.40002C13.6242 6.17502 13.6242 5.82502 13.3992 5.60002Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="max-w-[428px] w-full hidden sm:block">
                                        <img src="images/big-icon.svg" alt="icon" class="h-300px float-end">
                                    </div>
                                </div>

                                <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden -mx-28">
                                    <span class="absolute right-0 bottom-0"><img src="images/shape-01.png"
                                            alt="shape"></span>
                                    <span class="absolute left-0 top-0"><img src="images/shape-02.svg"
                                            alt="shape"></span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="images/blur-03.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="images/blur-04.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                        <img src="images/blur-05.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute right-0 top-0">
                                        <img src="images/shape-03.svg" alt="shape" class="max-w-none">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-7" style="--mouse-x: 195px; --mouse-y: 4px;">
                        <div class="relative rounded-3xl features-box-border">
                            <div
                                class="relative overflow-hidden rounded-3xl px-11 pt-12.5 pb-14 box-hover box-hover-small">
                                <div class="relative z-20">
                                    <span
                                        class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-13.5 mx-auto">
                                        <img src="images/icon-05.svg" alt="icon">
                                    </span>
                                    <h3 class="text-white mb-4.5 font-semibold text-heading-6">
                                        Kundensupport
                                    </h3>
                                    <p class="font-medium">
                                        Unabhängig von der Art Ihres Anliegens, ob es sich nur um eine Frage oder um
                                        eine umfassende Beratung handelt, sind wir rund um die Uhr für Sie da.
                                    </p>
                                </div>

                                <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                                    <span class="absolute left-0 bottom-0">
                                        <img src="images/blur-06.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute right-0 top-0">
                                        <img src="images/blur-07.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute right-[16%] top-[16%]"><img src="images/shape-04.svg"
                                            alt="shape"></span>
                                    <span class="absolute left-0 bottom-0">
                                        <img src="images/blur-08.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute left-0 bottom-0">
                                        <img src="images/blur-09.svg" alt="blur" class="max-w-none">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-5" style="--mouse-x: -428px; --mouse-y: -576px;">
                        <div class="relative rounded-3xl features-box-border">
                            <div
                                class="relative overflow-hidden rounded-3xl px-11 pt-12.5 pb-14 box-hover box-hover-small">
                                <div class="relative z-20">
                                    <span
                                        class="icon-border relative max-w-[80px] w-full h-20 rounded-full inline-flex items-center justify-center mb-13.5 mx-auto">
                                        <img src="images/icon-03.svg" alt="icon">
                                    </span>
                                    <h3 class="text-white mb-4.5 font-semibold text-heading-6">
                                        Sicherheit
                                    </h3>
                                    <p class="font-medium">
                                        Wir überprüfen unsere Websites vor der Veröffentlichung auf Schwachstellen.
                                    </p>
                                </div>

                                <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                                    <span class="absolute right-[14%] top-[17%]"><img src="images/shape-05.svg"
                                            alt="shape"></span>
                                    <span class="absolute left-0 bottom-0">
                                        <img src="images/blur-10.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute top-0 right-0">
                                        <img src="images/blur-11.svg" alt="blur" class="max-w-none">
                                    </span>
                                    <span class="absolute top-0 right-0">
                                        <img src="images/blur-12.svg" alt="blur" class="max-w-none">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="preise" class="relative z-20 overflow-hidden pt-22.5 lg:pt-27.5 xl:pt-32.5 scroll-mt-17 mb-17">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">

                <div class="relative top-18">
                    <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden -my-55">
                        <div class="absolute left-1/2 -translate-x-1/2 top-0">
                            <img src="images/blur-13.svg" alt="blur" class="max-w-none">
                        </div>
                        <div class="absolute left-1/2 -translate-x-1/2 top-0">
                            <img src="images/blur-14.svg" alt="blur" class="max-w-none">
                        </div>
                        <div class="absolute left-1/2 -translate-x-1/2 top-0">
                            <img src="images/blur-15.svg" alt="blur" class="max-w-none">
                        </div>
                    </div>
                    <div
                        class="max-w-[830px] w-full h-[830px] rounded-full bg-dark absolute left-1/2 -translate-x-1/2 top-0 pricing-circle">
                    </div>
                    <div
                        class="max-w-[482px] w-full h-60 overflow-hidden absolute -z-1 -top-30 left-1/2 -translate-x-1/2">
                        <div class="stars"></div>
                        <div class="stars2"></div>
                    </div>
                </div>

                <div class="flex justify-center gap-7.5 relative -z-1">
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                    <div class="max-w-[50px] w-full h-[250px] relative pricing-grid pricing-grid-border"></div>
                </div>

                <div class="wow fadeInUp mb-17.5 -mt-24 text-center z-10 relative" style="visibility: visible;"
                    id="pricing">
                    <span
                        class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                        <img src="images/icon-title.svg" alt="icon">
                        <span class="hero-subtitle-text"> Erhalten Sie Ihre Website </span>
                    </span>
                    <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                        Unser Preisplan
                    </h2>
                    <p class="max-w-[714px] mx-auto font-medium">
                        Hier sehen Sie die verschiedenen Website-Servicepakete, aus denen Sie wählen können.
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7.5">

                    <div class="wow fadeInUp rounded-3xl bg-dark relative z-20 overflow-hidden pt-12.5 pb-10 px-8 xl:px-10 pricing-item-border"
                        style="visibility: visible;">
                        <span class="absolute right-9 top-9"><img src="images/pricing-icon-01.svg" alt="icon"></span>
                        <h2 class="font-bold fs-45px lh-nr pricing-gradient-text">
                            Starter
                        </h2>
                        <div class="flex items-center gap-3.5">
                            <h1 class="font-bold text-custom-1 pricing-gradient-text">
                                149 - 249€
                            </h1>
                            <p class="font-medium">
                                /Einzahlung <br>
                                einmalig
                            </p>
                        </div>
                        <div class="my-10 w-full h-[1px] pricing-gradient-divider"></div>
                        <ul class="flex flex-col gap-4">
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Attraktives design</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Easy navigation</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Responsive</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Funktion => 1</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">2 Monate Hosting</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Schnelle Ladezeiten</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">and more ...</span>
                            </li>
                        </ul>
                        <a href="./website/starter/"
                            class="mt-11 flex items-center justify-center gap-1.5 font-medium text-white p-3 rounded-lg transition-all ease-in-out duration-300 relative pricing-button-gradient hover:shadow-button">
                            Mehr anzeigen
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.8992 7.5999L9.72422 2.3499C9.49922 2.1249 9.14922 2.1249 8.92422 2.3499C8.69922 2.5749 8.69922 2.9249 8.92422 3.1499L13.1242 7.4249H2.49922C2.19922 7.4249 1.94922 7.6749 1.94922 7.9749C1.94922 8.2749 2.19922 8.5499 2.49922 8.5499H13.1742L8.92422 12.8749C8.69922 13.0999 8.69922 13.4499 8.92422 13.6749C9.02422 13.7749 9.17422 13.8249 9.32422 13.8249C9.47422 13.8249 9.62422 13.7749 9.72422 13.6499L14.8992 8.3999C15.1242 8.1749 15.1242 7.8249 14.8992 7.5999Z"
                                    fill="white"></path>
                            </svg>
                        </a>
                        <p class="mt-4 text-sm text-center">
                            Keine zusätzlichen versteckten Gebühren
                        </p>

                        <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                            <span class="absolute left-0 bottom-0 -z-1">
                                <img src="images/blur-16.svg" alt="blur" class="max-w-none">
                            </span>
                            <span class="absolute left-0 top-0 -z-1">
                                <img src="images/blur-17.svg" alt="blur" class="max-w-none">
                            </span>
                        </div>
                    </div>

                    <div class="wow fadeInUp rounded-3xl bg-dark relative z-20 overflow-hidden pt-12.5 pb-10 px-8 xl:px-10 pricing-item-border border-buy"
                        style="visibility: visible;">
                        <span class="absolute right-9 top-9"><img src="images/pricing-icon-01.svg" alt="icon"></span>
                        <h2 class="font-bold fs-45px lh-nr pricing-gradient-text">
                            Premium
                        </h2>
                        <div class="flex items-center gap-3.5">
                            <h1 class="font-bold text-custom-1 pricing-gradient-text">
                                269 - 379€
                            </h1>
                            <p class="font-medium">
                                /Einzahlung <br>
                                einmalig
                            </p>
                        </div>
                        <div class="my-10 w-full h-[1px] pricing-gradient-divider"></div>
                        <ul class="flex flex-col gap-4">
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">CMS</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Ansprechendes Design</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">SEO</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Responsive</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Funktionen => 3</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">5 Monate Hosting</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">and more ...</span>
                            </li>
                        </ul>
                        <a href="./website/premium/"
                            class="mt-11 flex items-center justify-center gap-1.5 font-medium text-white p-3 rounded-lg transition-all ease-in-out duration-300 relative pricing-button-gradient hover:shadow-button">
                            Mehr anzeigen
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.8992 7.5999L9.72422 2.3499C9.49922 2.1249 9.14922 2.1249 8.92422 2.3499C8.69922 2.5749 8.69922 2.9249 8.92422 3.1499L13.1242 7.4249H2.49922C2.19922 7.4249 1.94922 7.6749 1.94922 7.9749C1.94922 8.2749 2.19922 8.5499 2.49922 8.5499H13.1742L8.92422 12.8749C8.69922 13.0999 8.69922 13.4499 8.92422 13.6749C9.02422 13.7749 9.17422 13.8249 9.32422 13.8249C9.47422 13.8249 9.62422 13.7749 9.72422 13.6499L14.8992 8.3999C15.1242 8.1749 15.1242 7.8249 14.8992 7.5999Z"
                                    fill="white"></path>
                            </svg>
                        </a>
                        <p class="mt-4 text-sm text-center">
                            Keine zusätzlichen versteckten Gebühren
                        </p>

                        <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                            <span class="absolute left-0 bottom-0 -z-1">
                                <img src="images/blur-16.svg" alt="blur" class="max-w-none">
                            </span>
                            <span class="absolute left-0 top-0 -z-1">
                                <img src="images/blur-17.svg" alt="blur" class="max-w-none">
                            </span>
                        </div>
                    </div>

                    <div class="wow fadeInUp rounded-3xl bg-dark relative z-20 overflow-hidden pt-12.5 pb-10 px-8 xl:px-10 pricing-item-border"
                        style="visibility: visible;">
                        <span class="absolute right-9 top-9"><img src="images/pricing-icon-01.svg" alt="icon"></span>
                        <h2 class="font-bold fs-45px lh-nr pricing-gradient-text">
                            VIP
                        </h2>
                        <div class="flex items-center gap-3.5">
                            <h1 class="font-bold text-custom-1 pricing-gradient-text">
                                589 - 859€
                            </h1>
                            <p class="font-medium">
                                /Einzahlung <br>
                                einmalig
                            </p>
                        </div>
                        <div class="my-10 w-full h-[1px] pricing-gradient-divider"></div>
                        <ul class="flex flex-col gap-4">
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Stilvolles Layout</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Extra SEO</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">KI Chatbot</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">Funktion => 5</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">9 Monate Hosting</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">12 Unterseiten</span>
                            </li>
                            <li class="flex items-center gap-5">
                                <img src="images/pricing-icon-04.svg" alt="icon">
                                <span class="font-medium">and more ...</span>
                            </li>
                        </ul>
                        <a href="./website/vip/"
                            class="mt-11 flex items-center justify-center gap-1.5 font-medium text-white p-3 rounded-lg transition-all ease-in-out duration-300 relative pricing-button-gradient hover:shadow-button">
                            Mehr anzeigen
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.8992 7.5999L9.72422 2.3499C9.49922 2.1249 9.14922 2.1249 8.92422 2.3499C8.69922 2.5749 8.69922 2.9249 8.92422 3.1499L13.1242 7.4249H2.49922C2.19922 7.4249 1.94922 7.6749 1.94922 7.9749C1.94922 8.2749 2.19922 8.5499 2.49922 8.5499H13.1742L8.92422 12.8749C8.69922 13.0999 8.69922 13.4499 8.92422 13.6749C9.02422 13.7749 9.17422 13.8249 9.32422 13.8249C9.47422 13.8249 9.62422 13.7749 9.72422 13.6499L14.8992 8.3999C15.1242 8.1749 15.1242 7.8249 14.8992 7.5999Z"
                                    fill="white"></path>
                            </svg>
                        </a>
                        <p class="mt-4 text-sm text-center">
                            Keine zusätzlichen versteckten Gebühren
                        </p>

                        <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                            <span class="absolute left-0 bottom-0 -z-1">
                                <img src="images/blur-16.svg" alt="blur" class="max-w-none">
                            </span>
                            <span class="absolute left-0 top-0 -z-1">
                                <img src="images/blur-17.svg" alt="blur" class="max-w-none">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="pb-12.5">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="grid sm:grid-cols-12 gap-7.5" data-highlighter="">

                    <div class="sm:col-span-12 relative rounded-3xl features-box-border"
                        style="--mouse-x: 272px; --mouse-y: 2px;">
                        <div class="relative overflow-hidden rounded-3xl p-10 xl:p-15 box-hover">
                            <div class="flex items-center justify-between relative z-20">
                                <div class="max-w-[477px] w-full">
                                    <span
                                        class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                                        <img src="images/icon-title.svg" alt="icon">
                                        <span class="hero-subtitle-text">
                                            Extra Service
                                        </span>
                                    </span>
                                    <h3 class="text-white mb-4.5 font-bold text-heading-4">
                                        Website Administration
                                    </h3>
                                    <p class="font-medium mb-15">
                                        Als zusätzlichen Service bieten wir ein Administrationspaket an und übernehmen
                                        dabei folgende Aufgaben:
                                    </p>
                                    <ul class="mb-15">
                                        <li class="flex items-center gap-5">
                                            <img src="images/pricing-icon-04.svg" alt="icon">
                                            <span class="font-medium">Serverkonfiguration</span>
                                        </li>
                                        <li class="flex items-center gap-5">
                                            <img src="images/pricing-icon-04.svg" alt="icon">
                                            <span class="font-medium">Domain configuration</span>
                                        </li>
                                        <li class="flex items-center gap-5">
                                            <img src="images/pricing-icon-04.svg" alt="icon">
                                            <span class="font-medium">SSL certificate</span>
                                        </li>
                                        <li class="flex items-center gap-5">
                                            <img src="images/pricing-icon-04.svg" alt="icon">
                                            <span class="font-medium">Sicherheitsanalyse &amp; updates</span>
                                        </li>
                                        <li class="flex items-center gap-5">
                                            <img src="images/pricing-icon-04.svg" alt="icon">
                                            <span class="font-medium">Backups</span>
                                        </li>
                                    </ul>
                                    <a href="./website/administration/"
                                        class="features-button-gradient relative inline-flex items-center gap-1.5 rounded-full py-3 px-6 text-white text-sm ease-in duration-300 hover:shadow-button">
                                        Finden Sie mehr heraus
                                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.3992 5.60002L8.22422 0.350024C7.99922 0.125024 7.64922 0.125024 7.42422 0.350024C7.19922 0.575024 7.19922 0.925025 7.42422 1.15002L11.6242 5.42503H0.999219C0.699219 5.42503 0.449219 5.67502 0.449219 5.97502C0.449219 6.27502 0.699219 6.55003 0.999219 6.55003H11.6742L7.42422 10.875C7.19922 11.1 7.19922 11.45 7.42422 11.675C7.52422 11.775 7.67422 11.825 7.82422 11.825C7.97422 11.825 8.12422 11.775 8.22422 11.65L13.3992 6.40002C13.6242 6.17502 13.6242 5.82502 13.3992 5.60002Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="max-w-[428px] w-full hidden sm:block">
                                    <img src="images/price.png" alt="icon" class="h-300px float-end">
                                </div>
                            </div>

                            <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden -mx-28">
                                <span class="absolute right-0 bottom-0"><img src="images/shape-01.png"
                                        alt="shape"></span>
                                <span class="absolute left-0 top-0"><img src="images/shape-02.svg" alt="shape"></span>
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                    <img src="images/blur-03.svg" alt="blur" class="max-w-none">
                                </span>
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                    <img src="images/blur-04.svg" alt="blur" class="max-w-none">
                                </span>
                                <span class="absolute left-1/2 -translate-x-1/2 bottom-0">
                                    <img src="images/blur-05.svg" alt="blur" class="max-w-none">
                                </span>
                                <span class="absolute right-0 top-0">
                                    <img src="images/shape-03.svg" alt="shape" class="max-w-none">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        <section id="kontaktieren" class="scroll-mt-17">
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
                            <img src="images/blur-19.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="images/blur-20.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 top-0 -translate-x-1/2 -z-1">
                            <img src="images/blur-21.svg" alt="blur" class="max-w-none">
                        </span>
                    </div>

                    <div class="wow fadeInUp mb-16 text-center relative z-999" style="visibility: visible;">
                        <span
                            class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                            <img src="images/icon-title.svg" alt="icon">
                            <span class="hero-subtitle-text"> Kontaktieren Sie uns! </span>
                        </span>
                        <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                            Nehmen Sie Kontakt mit uns auf
                        </h2>
                        <p class="max-w-[714px] mx-auto font-medium">
                            "Wir freuen uns, dass Sie sich an uns wenden. Bitte füllen Sie das Formular aus und senden
                            Sie es ab. Wir werden uns so schnell wie möglich bei Ihnen melden."
                        </p>
                    </div>


                    <div class="form-box-gradient relative overflow-hidden rounded-[25px] bg-dark p-6 sm:p-8 xl:p-15"
                        id="support">
                        <form action="#support" method="post" class="relative z-10">
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
                                            Ich habe die <a href="./datenschutzrichtlinie" target="_blank"
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


        <section class="py-20 lg:py-25">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">

                <div class="wow fadeInUp mb-16 text-center" style="visibility: visible;">
                    <span
                        class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                        <img src="images/icon-title.svg" alt="icon">
                        <span class="hero-subtitle-text"> Website-Vorlage </span>
                    </span>
                    <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                        Beispielvorlagen für Ihre Website
                    </h2>
                </div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7.5 d-flex justify-center align-items-center">
                    <div class="wow fadeInUp group" style="visibility: visible;">
                        <div style="position: relative; width: 100%; height: 0; padding-top: 100.0000%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
                            <iframe loading="lazy"
                                style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                                src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGE6vVxNU8&#x2F;vA3W6RtUmKx9f2NOR9c1uA&#x2F;view?embed"
                                allowfullscreen="allowfullscreen" allow="fullscreen">
                            </iframe>
                        </div>
                        <a href="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGE6vVxNU8&#x2F;vA3W6RtUmKx9f2NOR9c1uA&#x2F;view?utm_content=DAGE6vVxNU8&amp;utm_campaign=designshare&amp;utm_medium=embeds&amp;utm_source=link"
                            class="fs-italic fw-bold" target="_blank" rel="noopener">"Ideal für Restaurants und Cafés:
                            Ein frisches, modernes, und ansprechendes Layout, das Ihre Website hervorhebt."</a>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="cta-box-gradient bg-dark rounded-[30px] relative overflow-hidden px-4 py-20 lg:py-25 z-999">

                    <span class="absolute bottom-0 left-0 -z-1"><img src="images/grid.svg" alt="grid"></span>
                    <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="images/blur-22.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="images/blur-23.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="images/blur-24.svg" alt="blur" class="max-w-none">
                        </span>
                    </div>

                    <div
                        class="max-w-[482px] w-full h-60 overflow-hidden absolute -z-1 -bottom-25 left-1/2 -translate-x-1/2">
                        <div class="stars"></div>
                        <div class="stars2"></div>
                    </div>
                    <div class="wow fadeInUp text-center" style="visibility: visible;">
                        <span
                            class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                            <img src="images/icon-title.svg" alt="icon">
                            <span class="hero-subtitle-text">
                                Lassen Sie uns jetzt eine Website erstellen
                            </span>
                        </span>
                        <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                            Worauf warten Sie noch?
                        </h2>
                        <p class="max-w-[714px] mx-auto font-medium mb-9">
                            Wir erstellen Ihre Traum-Website, damit Sie im Internet besser sichtbar werden und eine
                            stärkere Präsenz zeigen können.
                        </p>
                        <a href="#preise"
                            class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                            Jetzt loslegen
                        </a>
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
                    <a class="mb-8.5 inline-block" href="index.php">
                        <img src="images/VOOID.png" alt="Logo" class="h-35px">
                    </a>
                    <p class="mb-12 xl:w-4/5">
                        Wir bringen Ihre Online-Präsenz auf das nächste Level.
                    </p>
                    <div class="flex items-center gap-5">
                        <a href="https://www.instagram.com/vooid_official/" target="_blank"
                            class="hover:text-white ease-in duration-300">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://www.tiktok.com/@vooid.official" target="_blank"
                            class="hover:text-white ease-in duration-300">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a href="https://github.com/vooidOFFICIAL/" target="_blank"
                            class="hover:text-white ease-in duration-300">
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
                            <h5 class="font-semibold text-white mb-5">Produkte</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="./ki-assistent/"
                                        class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href="#preise"
                                        class="font-medium ease-in duration-300 hover:text-white">Preise</a>
                                </li>
                                <li>
                                    <a href="#warum-wir" class="font-medium ease-in duration-300 hover:text-white">Warum
                                        wir</a>
                                </li>
                                <li>
                                    <a href="#kontaktieren"
                                        class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Unternehmen</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="#startseite"
                                        class="font-medium ease-in duration-300 hover:text-white">Startseite</a>
                                </li>
                                <li>
                                    <a href="./impressum/"
                                        class="font-medium ease-in duration-300 hover:text-white">Impressum</a>
                                </li>
                                <li>
                                    <a href="./team-services/"
                                        class="font-medium ease-in duration-300 hover:text-white">Team & Services</a>
                                </li>
                                <li>
                                    <a href="./datenschutz/"
                                        class="font-medium ease-in duration-300 hover:text-white">Datenschutzbedingungen</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Support</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href="./ki-assistent"
                                        class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href="#support"
                                        class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
                                </li>
                                <li>
                                    <a href="mailto:vooid@web.de"
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

    <script defer="defer" src="bundle.js"></script>
    <script defer="defer" src="v84a3a4012de94ce1a686ba8c167c359c1696973893317.es"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon="{&quot;rayId&quot;:&quot;8674aa38aa149252&quot;,&quot;r&quot;:1,&quot;version&quot;:&quot;2024.3.0&quot;,&quot;token&quot;:&quot;9a6015d415bb4773a0bff22543062d3b&quot;}"
        crossorigin="anonymous"></script>

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

        $sql = "INSERT INTO contact (firstname, lastname, company, phone, email, message, send, status, contact)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $firstname, $lastname, $company, $phone, $email, $message, $date, $new_client, $yes);
        if ($stmt->execute()) {
            echo "<div id='success'>Form submitted successfully!</div>";
            echo "<script>setTimeout(() => { success.style.display = 'none'; }, 3000);</script>";
        } else {
            echo "<div id='success'>Something went wrong. Please try again!</div>";
            echo "<script>setTimeout(() => { success.style.display = 'none'; }, 3000);</script>";
        }
    } else {
        echo "<div id='success'>";
        foreach ($errors as $error) {
            echo "<div id=''><span>$error</span></div>";
        }
        echo "</div>";
        echo "<script>setTimeout(() => { success.style.display = 'none'; }, 3500);</script>";
    }
}

$conn->close();
$stmt->close();

?>