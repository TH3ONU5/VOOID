<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOOID | Datenschutzrichtlinien</title>
    <link rel="icon/image" href="">
    <link rel="stylesheet" href="../style.css" rel="stylesheet">
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

<body x-data="{ page: 'faq', 'loaded': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }">

    <header class="fixed left-0 top-0 w-full z-9999 py-7 lg:py-0 bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border" :class="{ 'bg-dark/70 backdrop-blur-lg shadow !py-4 lg:!py-0 transition duration-100 before:absolute before:w-full before:h-[1px] before:bottom-0 before:left-0 before:features-row-border' : stickyMenu }" @scroll.window="stickyMenu = (window.scrollY > 0) ? true : false">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 lg:flex items-center justify-between relative">
            <div class="w-full lg:w-1/4 flex items-center justify-between">
                <a href="../index.php">
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
            <div class="w-full lg:w-3/4 h-0 lg:h-auto invisible lg:visible lg:flex items-center justify-between" :class="{ '!visible bg-dark shadow-lgrelative !h-auto max-h-[400px] overflow-y-scroll rounded-md mt-4 p-7.5': navigationOpen }">
                <nav>
                    <ul class="flex lg:items-center flex-col lg:flex-row gap-5 lg:gap-2">
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././#startseite" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient !text-white nav-gradient" :class="{'!text-white nav-gradient' :page === 'home'}">Startseite</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././#warum-wir" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Warum
                                wir</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././#preise" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Preise</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././#kontaktieren" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Kontaktieren</a>
                        </li>
                        <li class="nav__menu lg:py-7 lg:!py-4" :class="{ 'lg:!py-4' : stickyMenu }">
                            <a href=".././team-services/" class="relative text-white/80 text-sm py-1.5 px-4 border border-transparent hover:text-white hover:nav-gradient">Team & Services</a>
                        </li>
                    </ul>
                </nav>
                <div class="flex items-center gap-6 mt-7 lg:mt-0">
                    <a href=".././ki-assistent" class="button-border-gradient relative rounded-lg text-white text-sm flex items-center gap-1.5 py-2 px-4.5 shadow-button hover:button-gradient-hover hover:shadow-none">
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
                <h1 class="font-extrabold text-heading-2 text-white mb-5.5">
                    Datenschutzrichtlinien
                </h1>
                <ul class="flex items-center justify-center gap-2">
                    <li class="font-medium"><a href="../index.html">Startseite</a></li>
                    <li class="font-medium">/ Datenschutzrichtlinien</li>
                </ul>
            </div>
        </section>

        <section class="relative overflow-hidden pb-17.5 lg:pb-22.5 xl:pb-27.5 pt-20 lg:pt-25">

            <div class="about-divider-gradient max-w-[1170px] w-full h-[1px] absolute top-0 left-1/2 -translate-x-1/2">
            </div>
            <div class="max-w-[770px] mx-auto px-4 sm:px-8 xl:px-0">
                <div class="max-w-[870px] mx-auto">
                    <h1 class="font-semibold text-white text-heading-2 leading-[45px] max-w-[579px] mb-7.5">
                        Datenschutzrichtlinien
                    </h1>
                    <p class="font-medium mb-6">
                        Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Diese Datenschutzerklärung informiert Sie darüber, wie wir Ihre personenbezogenen Daten beim Ausfüllen unseres Formulars erheben, nutzen, verarbeiten und schützen.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        1. Erhebung und Nutzung personenbezogener Daten
                    </h3>
                    <p class="font-medium mb-6">
                        Wenn Sie unser Formular ausfüllen, speichern wir die von Ihnen angegebenen personenbezogenen Daten, einschließlich Ihres Namens,
                        Telefonnummer, E-Mail-Adresse und Firmenname. Wir verwenden diese Informationen ausschließlich zur Verarbeitung
                        Ihre Anfrage und kommunizieren mit Ihnen.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        2. Speicherung von IP-Adressen
                    </h3>
                    <p class="font-medium mb-6">
                        Zusätzlich zu den oben genannten Daten speichern wir beim Absenden des Formulars auch Ihre IP-Adresse.
                        Die Verwendung der IP-Adresse dient dazu, die Sicherheit unserer Website zu gewährleisten und unberechtigte Zugriffe zu erkennen bzw
                        Missbrauch und spam zu vermeiden.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        3. Offenlegung von Daten
                    </h3>
                    <p class="font-medium mb-6">
                        Wir geben Ihre personenbezogenen Daten nicht an Dritte weiter, es sei denn, dies ist zur Vertragserfüllung erforderlich
                        auf Anfrage oder gesetzlich vorgeschrieben.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        4. Datensicherheit
                    </h3>
                    <p class="font-medium mb-6">
                        Wir ergreifen geeignete technische und organisatorische Sicherheitsmaßnahmen, um Ihre Daten vor unbefugtem Zugriff, Verlust, Missbrauch oder Veränderung zu schützen.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        5. Ihre Rechte
                    </h3>
                    <p class="font-medium mb-6">
                        Sie haben das Recht, Auskunft über die von uns gespeicherten Daten zu verlangen sowie ein Recht auf Berichtigung, Löschung oder Sperrung Ihrer Daten. Bitte kontaktieren Sie uns über die in Abschnitt 6 angegebenen Kontaktdaten.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        6. Kontakt
                    </h3>
                    <p class="font-medium mb-6">
                        Wenn Sie Fragen oder Bedenken zu unseren Datenschutzpraktiken haben oder Ihre Rechte gemäß dieser Datenschutzrichtlinie ausüben möchten, kontaktieren Sie uns bitte unter <strong>vooid@web.de</strong>.
                    </p>
                    <h3 class="font-extrabold text-2xl text-white mb-6">
                        7. Änderungen der Datenschutzrichtlinie
                    </h3>
                    <p class="font-medium mb-6">
                        Diese Datenschutzrichtlinie kann gelegentlich aktualisiert werden, um Änderungen in unseren Datenschutzpraktiken widerzuspiegeln. Über wesentliche Änderungen werden wir Sie per E-Mail oder durch Veröffentlichung einer Mitteilung auf unserer Website informieren.
                    </p>
                    <p class="font-medium mb-6">
                        Durch die Nutzung unseres Formulars stimmen Sie den Bedingungen dieser Datenschutzrichtlinie zu.
                    </p>
                    <div class="flex items-center gap-4">
                        <p class="font-medium">-- Team VOOID --</p>
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
                    <a class="mb-8.5 inline-block" href="../index.php">
                        <img src="../images/VOOID.png" alt="Logo" class="h-35px">
                    </a>
                    <p class="mb-12 xl:w-4/5">
                        Wir bringen Ihre Online-Präsenz auf das nächste Level.
                    </p>
                    <div class="flex items-center gap-5">
                        <a href="https://www.instagram.com/vooid_official/" target="_blank" class="hover:text-white ease-in duration-300">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://www.tiktok.com/@vooid.official" target="_blank" class="hover:text-white ease-in duration-300">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                        <a href="https://github.com/vooidOFFICIAL/" target="_blank" class="hover:text-white ease-in duration-300">
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
                                    <a href=".././ki-assistent/" class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href=".././#preise" class="font-medium ease-in duration-300 hover:text-white">Preise</a>
                                </li>
                                <li>
                                    <a href=".././#warum-wir" class="font-medium ease-in duration-300 hover:text-white">Warum
                                        wir</a>
                                </li>
                                <li>
                                    <a href=".././#kontaktieren" class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Unternehmen</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href=".././#startseite" class="font-medium ease-in duration-300 hover:text-white">Startseite</a>
                                </li>
                                <li>
                                    <a href=".././impressum/" class="font-medium ease-in duration-300 hover:text-white">Impressum</a>
                                </li>
                                <li>
                                    <a href=".././team-services/" class="font-medium ease-in duration-300 hover:text-white">Team & Services</a>
                                </li>
                                <li>
                                    <a href=".././datenschutzrichtlinien/" class="font-medium ease-in duration-300 hover:text-white">Datenschutzbedingungen</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold text-white mb-5">Support</h5>
                            <ul class="flex flex-col gap-3.5">
                                <li>
                                    <a href=".././ki-assistent/" class="font-medium ease-in duration-300 hover:text-white">KI-Assistent</a>
                                </li>
                                <li>
                                    <a href=".././#kontaktieren" class="font-medium ease-in duration-300 hover:text-white">Kontaktieren</a>
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


    <button class="hidden items-center justify-center w-10 h-10 rounded-[4px] shadow-solid-5 bg-purple hover:opacity-70 fixed bottom-8 right-8 z-999" @click="window.scrollTo({top: 0, behavior: 'smooth'})" @scroll.window="scrollTop = (window.pageYOffset &gt; 50) ? true : false" :class="{ '!flex' : scrollTop }">
        <svg class="fill-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z">
            </path>
        </svg>
    </button>

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