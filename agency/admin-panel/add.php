<?php
// Starte eine Session und generiere eine neue Session-ID aus Sicherheitsgründen
session_start();
session_regenerate_id(true);

// Datenbankverbindungsdetails
$server = "localhost";
$username = "root";
$password = "";
$dbname = "agencyDB";

// Stelle eine Verbindung zur Datenbank her
$conn = new mysqli($server, $username, $password, $dbname);

// Überprüfe, ob die Verbindung erfolgreich hergestellt wurde
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Bereite eine SQL-Abfrage vor, um die Session-ID aus der Datenbank abzurufen
$sql = "SELECT sessionID FROM admin";
$stmt = $conn->prepare($sql);

// Überprüfe, ob die Vorbereitung der SQL-Abfrage erfolgreich war
if ($stmt === false) {
    die("Fehler bei der Vorbereitung der Abfrage: " . $conn->error);
}

// Führe die SQL-Abfrage aus
$stmt->execute();
$result = $stmt->get_result();

// Wenn Zeilen von der Abfrage zurückgegeben werden
if ($result->num_rows > 0) {
    // Rufe die Zeile ab
    $row = $result->fetch_assoc();
    $session_id = $row['sessionID'];

    // Überprüfe, ob die Session-Variable gesetzt ist und mit dem Datenbankwert übereinstimmt
    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $session_id) {
        // Leite zur Login-Seite weiter, wenn der Benutzer nicht authentifiziert ist
        header("Location: ./login/");
        exit;
    }
}

// Schließe das Statement für die Abfrage der Session-ID und die Datenbankverbindung
$stmt->close();
$conn->close();

// Verarbeite die Logout-Anfrage
if (isset($_POST["logout"])) {
    // Lösche alle Session-Variablen
    $_SESSION = array();

    // Lösche das Session-Cookie, falls verwendet
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy(); // Zerstöre die Session

    header("Location: ../"); // Leite den Benutzer zur Startseite weiter
    exit;
}

// Verarbeite die Formularübermittlung
if (isset($_POST["submit"])) {
    // Verbindungsdaten für die Datenbank
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agencyDB";

    // Stelle eine Verbindung zur Datenbank her
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Überprüfe, ob die Verbindung erfolgreich hergestellt wurde
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Bereinige die Benutzereingaben
    $userIP = $_SERVER['REMOTE_ADDR'];
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $company = trim($_POST['company']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $date = date("Y-m-d H:i:s");

    $errors = [];

    $new_client = "New";

    // Datenvalidierung
    if (strlen($firstname) > 50 || strlen($firstname) === 0) {
        $errors[] = "First name is required and should be maximum 50 characters long.";
    }

    // Weitere Validierungen für Nachname, Firma, Telefon, E-Mail usw. hier einfügen...

    if (empty($errors)) {
        // Bereite eine SQL-Abfrage zur Einfügung der Daten vor
        $sql = "INSERT INTO contact (firstname, lastname, company, phone, email, message, send, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Binde die Parameter an die Abfrage und führe sie aus
        $stmt->bind_param("ssssssss", $firstname, $lastname, $company, $phone, $email, $message, $date, $new_client);
        if ($stmt->execute()) {
            echo "<div id='success'>Form submitted successfully!</div>";
            echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
        } else {
            echo "<div id='success'>Something went wrong. Please try again!</div>";
            echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3000);</script>";
        }
        $stmt->close();
    } else {
        // Zeige die Fehlermeldungen an
        echo "<div id='success'>";
        foreach ($errors as $error) {
            echo "<div id=''><span>$error</span></div>";
        }
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';},3500);</script>";
    }
    $conn->close();
}
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

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="./index.php">
                    <img class="h-40px" src="../images/logo.png">
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                    </div>
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./unbekannt.php">
                                <i class="bi bi-chat"></i> Unbekannt
                                <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">
                                    <?php
                                    $server = "localhost";
                                    $servername = "root";
                                    $serverpassword = "";
                                    $dbname = "agencyDB";

                                    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                    $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.'";
                                    $stmt = $conn->prepare($sql);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $row = $result->fetch_assoc();
                                    $num_rows = $row['num_rows'];

                                    echo ($num_rows);

                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./add.php">
                                <i class="bi bi-plus"></i> Manuel Hinzufügen
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="navbar-divider my-5 opacity-20">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="./messages.php">
                                Unbekannt
                                <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-4">
                                    <?php
                                    $server = "localhost";
                                    $servername = "root";
                                    $serverpassword = "";
                                    $dbname = "agencyDB";

                                    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                    $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.'";
                                    $stmt = $conn->prepare($sql);

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    $row = $result->fetch_assoc();
                                    $num_rows = $row['num_rows'];

                                    echo ($num_rows);

                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </span>
                            </div>
                        </li>

                        <?php
                        $server = "localhost";
                        $servername = "root";
                        $serverpassword = "";
                        $dbname = "agencyDB";

                        $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                        $sql = "SELECT * FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.' ORDER BY send DESC LIMIT 10";

                        $stmt = $conn->prepare($sql);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $firstname_letter = substr($row["firstname"], 0, 1);
                            $lastname_letter = substr($row["lastname"], 0, 1);
                            $user_id = $row['id'];
                            echo '
                        <li>
                            <a href="unbekannt.php#' . $user_id . '" class="nav-link d-flex align-items-center">
                                <div class="me-4">
                                    <div class="position-relative d-inline-block text-white">
                                        <span class="avatar bg-soft-warning text-fav rounded-circle">' . $firstname_letter . $lastname_letter . '</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="d-block text-sm font-semibold">'
                                . $row['firstname'] . ' ' . $row['lastname'] .
                                '</span>
                                    <span class="d-block text-xs text-muted font-regular">
                                        Costumer
                                    </span>
                                </div>
                                <div class="ms-auto">
                                    <i class="bi bi-chat"></i>
                                </div>
                            </a>
                        </li>
                            ';
                        }
                        $stmt->close();
                        $conn->close();
                        ?>
                    </ul>
                    <!-- Push content down -->
                    <div class="mt-auto"></div>
                    <!-- User (md) -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="../" method="post">
                                <button type="submit" name="logout" class="nav-link border-logout bg-soft-warning">
                                    <i class="bi bi-box-arrow-left"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">VOOID</h1>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="#" class="nav-link active">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Unbekannt</span>
                                            <span class="h3 font-bold mb-0">
                                                <?php
                                                $server = "localhost";
                                                $servername = "root";
                                                $serverpassword = "";
                                                $dbname = "agencyDB";

                                                $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                                $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.'";
                                                $stmt = $conn->prepare($sql);

                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                $row = $result->fetch_assoc();
                                                $num_rows = $row['num_rows'];

                                                echo ($num_rows);

                                                $stmt->close();
                                                $conn->close();
                                                ?>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">In bearbeitung</span>
                                            <span class="h3 font-bold mb-0">
                                                <?php
                                                $server = "localhost";
                                                $servername = "root";
                                                $serverpassword = "";
                                                $dbname = "agencyDB";

                                                $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                                $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status = 'In progress'";
                                                $stmt = $conn->prepare($sql);

                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                $row = $result->fetch_assoc();
                                                $num_rows = $row['num_rows'];

                                                echo ($num_rows);

                                                $stmt->close();
                                                $conn->close();
                                                ?>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Fertige Projekte</span>
                                            <span class="h3 font-bold mb-0">
                                                <?php
                                                $server = "localhost";
                                                $servername = "root";
                                                $serverpassword = "";
                                                $dbname = "agencyDB";

                                                $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                                $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status = 'Done'";
                                                $stmt = $conn->prepare($sql);

                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                $row = $result->fetch_assoc();
                                                $num_rows = $row['num_rows'];

                                                echo ($num_rows);

                                                $stmt->close();
                                                $conn->close();
                                                ?>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-dark-blue text-white text-lg rounded-circle">
                                                <i class="bi bi-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-grid justify-content-center">
                                            <p class="text-center" id="date"></p>
                                            <p class="fs-35px" id="time"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Neue Kunde</h5>
                        </div>
                        <form action="" method="post" class="relative z-10">
                            <div class="-mx-4 xl:-mx-10 flex flex-wrap">
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="firstname" class="text-white mb-2.5 block font-medium">
                                            Vorname
                                        </label>
                                        <input id="firstname" type="text" name="firstname" placeholder="Costumers Firstname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="lastname" class="text-white mb-2.5 block font-medium">
                                            Nachname
                                        </label>
                                        <input id="lastname" type="text" name="lastname" placeholder="Costumers Lastname" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-9.5">
                                        <label for="company" class="text-white mb-2.5 block font-medium">
                                            Unternehmen
                                        </label>
                                        <input type="text" id="company" name="company" placeholder="Type Costumers (company) name" rows="6" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="phone" class="text-white mb-2.5 block font-medium">
                                            Telefon
                                        </label>
                                        <input id="phone" type="tel" name="phone" placeholder="Enter Costumers Phone number" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5 md:w-1/2">
                                    <div class="mb-9.5">
                                        <label for="email" class="text-white mb-2.5 block font-medium">
                                            Email
                                        </label>
                                        <input id="email" type="text" name="email" placeholder="Enter Costumers Email" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-3 px-6 outline-none" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="mb-10">
                                        <label for="message" class="text-white mb-2.5 block font-medium">
                                            Nachricht
                                        </label>
                                        <textarea id="message" name="message" placeholder="Type Costumers message" rows="6" class="rounded-lg border border-white/[0.12] bg-white/[0.05] focus:border-purple w-full py-5 px-6 outline-none" required></textarea>
                                    </div>
                                </div>
                                <div class="w-full px-4 xl:px-5">
                                    <div class="text-center mb-2em">
                                        <button type="submit" name="submit" class="hero-button-gradient inline-flex rounded-lg py-3 px-7 text-white font-medium ease-in duration-300 hover:opacity-80 w-100 bg-blue-strong">
                                            Sichern
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