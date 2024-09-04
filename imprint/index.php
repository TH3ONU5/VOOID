<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOOID | Imprint</title>
    <link rel="icon/image" href="">
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" integrity="sha384-..." crossorigin="anonymous">
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

<body x-data="{ page: 'impressum', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

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
                    Imprint
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="../index.html"> Homepage </a></li>
                    <li class="font-medium">/ Imprint</li>
                </ul>
            </div>
        </section>

        <section class="relative overflow-hidden pb-17.5 lg:pb-22.5 xl:pb-27.5 pt-20 lg:pt-25" id="faq">

            <div class="about-divider-gradient max-w-[1170px] w-full h-[1px] absolute top-0 left-1/2 -translate-x-1/2">
            </div>
            <div class="max-w-[770px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="max-w-[870px] mx-auto">
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        Contact
                    </h3>
                    <p class="font-medium mb-6">
                        vooid@web.de
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        Welcome!
                    </h3>
                    <p class="font-medium mb-6 word-break">
                        Thank you for visiting our website. We appreciate your interest in our services. Please note that our website is currently under construction. We are working hard to improve it and provide you with a great experience. However, we are fully operational and ready to help you! Feel free to contact us to discuss your web design needs and hire us to build your custom website. Get in touch with us today to learn more and get your project off the ground! Thank you for your understanding and patience.
                    </p>
                    <div class="flex items-center gap-4">
                        <p class="font-medium">-- Team VOOID --</p>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="cta-box-gradient bg-dark rounded-[30px] relative overflow-hidden px-4 py-20 lg:py-25 z-999">

                    <span class="absolute bottom-0 left-0 -z-1"><img src="../images/grid.svg" alt="grid"></span>
                    <div class="absolute -z-10 pointer-events-none inset-0 overflow-hidden">
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-22.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-23.svg" alt="blur" class="max-w-none">
                        </span>
                        <span class="absolute left-1/2 bottom-0 -translate-x-1/2 -z-1">
                            <img src="../images/blur-24.svg" alt="blur" class="max-w-none">
                        </span>
                    </div>

                    <div class="max-w-[482px] w-full h-60 overflow-hidden absolute -z-1 -bottom-25 left-1/2 -translate-x-1/2">
                        <div class="stars"></div>
                        <div class="stars2"></div>
                    </div>
                    <div class="wow fadeInUp text-center" style="visibility: visible;">
                        <span class="hero-subtitle-gradient relative mb-4 font-medium text-sm inline-flex items-center gap-2 py-2 px-4.5 rounded-full">
                            <img src="../images/icon-title.svg" alt="icon">
                            <span class="hero-subtitle-text">
                                Let us create a website now
                            </span>
                        </span>
                        <h2 class="text-white mb-4.5 text-2xl font-extrabold sm:text-4xl xl:text-heading-2">
                            What are you waiting for?
                        </h2>
                        <p class="max-w-[714px] mx-auto font-medium mb-9">
                            Whether you're an individual, a small business, or a large corporation, we understand the impact of a poorly designed website. We're here to transform it into a powerful tool that truly represents you and connects with your audience.
                        </p>
                        <a href="../homepage/#prices" class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80">
                            Get started now
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <button class="hidden items-center justify-center w-10 h-10 rounded-[4px] shadow-solid-5 bg-purple hover:opacity-70 fixed bottom-8 right-8 z-999" @click="window.scrollTo({top: 0, behavior: 'smooth'})" @scroll.window="scrollTop = (window.pageYOffset &gt; 50) ? true : false" :class="{ '!flex' : scrollTop }">
        <svg class="fill-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z">
            </path>
        </svg>
    </button>

    <?php
    require_once('../footer.php');
    ?>

    <script defer="defer" src="../bundle.js"></script>
    <script defer="defer" src="../v84a3a4012de94ce1a686ba8c167c359c1696973893317.es" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon="{&quot;rayId&quot;:&quot;8674aa38aa149252&quot;,&quot;r&quot;:1,&quot;version&quot;:&quot;2024.3.0&quot;,&quot;token&quot;:&quot;9a6015d415bb4773a0bff22543062d3b&quot;}" crossorigin="anonymous"></script>
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