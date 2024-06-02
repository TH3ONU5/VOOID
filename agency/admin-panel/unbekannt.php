<?php
// Starte eine Session und generiere eine neue Session-ID
session_start();
session_regenerate_id(true);

// Datenbankverbindungseinstellungen
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

// Bereite eine SQL-Abfrage vor, um die Session-ID aus der Admin-Tabelle auszuwählen
$sql = "SELECT sessionID FROM admin";
$stmt = $conn->prepare($sql);

// Überprüfe, ob die Abfragevorbereitung erfolgreich war
if ($stmt === false) {
    die("Fehler bei der Vorbereitung der Abfrage: " . $conn->error);
}

// Führe die vorbereitete Abfrage aus
$stmt->execute();
$result = $stmt->get_result();

// Überprüfe, ob Zeilen zurückgegeben wurden
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_id = $row['sessionID'];

    // Überprüfe, ob die Session-Variable gesetzt ist und mit dem Datenbankwert übereinstimmt
    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $session_id) {
        header("Location: ./login/");
        exit;
    }
}

// Schließe das Prepared Statement und die Datenbankverbindung
$stmt->close();
$conn->close();

// Logout-Funktionalität
if (isset($_POST["logout"])) {
    // Lösche alle Session-Variablen
    $_SESSION = array();

    // Lösche Session-Cookies, falls verwendet
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
    session_unset();   // Optional, um sicherzustellen, dass alle Session-Variablen entfernt werden

    header("Location: ../"); // Leite den Benutzer weiter
    exit;
}

// Löschfunktionalität
if (isset($_POST['delete'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $displayn = "Dont display";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET display = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $displayn, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Data with the id " . $user_id . " deleted successfully</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
    $conn->close();
}

// Funktionalität zum Setzen der Website auf VIP
if (isset($_POST['set_website_vip'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $yes = "yes";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET vip = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $yes, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>ID " . $user_id . " successfully added to website vip</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},2500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
    $conn->close();
}

// Funktionalität zum Setzen der Website auf Premium
if (isset($_POST['set_website_premium'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $yes = "yes";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET premium = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $yes, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>ID " . $user_id . " successfully added to website premium</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},2500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
    $conn->close();
}

// Funktionalität zum Setzen der Website auf Starter
if (isset($_POST['set_website_starter'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $yes = "yes";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET starter = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $yes, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>ID " . $user_id . " successfully added to website starter</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},2500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
    $conn->close();
}

// Funktionalität zum Setzen des Benutzers als Admin
if (isset($_POST['set_admin'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $yes = "yes";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET admin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $yes, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>ID " . $user_id . " successfully added to admin</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},2500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
    $conn->close();
}

// Funktionalität zum Setzen des Benutzers als Kontakt
if (isset($_POST['set_contact'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    // Datenbankverbindungseinstellungen
    $server = "localhost";
    $servername = "root";
    $serverpassword = "";
    $dbname = "agencyDB";

    // Stelle eine neue Verbindung zur Datenbank her
    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

    $yes = "yes";

    // Bereite eine SQL-Abfrage vor, um die Kontakttabelle zu aktualisieren
    $sql = "UPDATE contact SET contact = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Binde Parameter an die Abfrage
    $stmt->bind_param("si", $yes, $user_id);

    // Führe die Abfrage aus
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>ID " . $user_id . " successfully added to contact</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},2500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Something went wrong!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {success.style.display='none';},3500);</script>";
    }

    // Schließe das Prepared Statement und die Datenbankverbindung
    $stmt->close();
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
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="index.php">
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
                            <a class="nav-link" href="unbekannt.php">
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
                            <a class="nav-link" href="add.php">
                                <i class="bi bi-plus"></i> Manuel Hinzufügen
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="navbar-divider my-5 opacity-20">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
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

                        $sql = "SELECT * FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.' ORDER BY send DESC LIMIT 5";

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
                                        Kunde
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
                            <form action="" method="post">
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
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">In
                                                bearbeitung</span>
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
                            <h5 class="mb-0">Unbekannt</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Datum</th>
                                        <th scope="col">Unternehmen</th>
                                        <th scope="col">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $server = "localhost";
                                    $servername = "root";
                                    $serverpassword = "";
                                    $dbname = "agencyDB";

                                    $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                                    if ($conn->connect_errno) {
                                        die("Something went wrong!");
                                    }

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('New') AND display = 'show' AND starter = '.' AND premium = '.' And vip = '.' AND contact = '.' AND admin = '.'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr id"' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                        <td>
                                            <div class="avatar avatar-sm rounded-circle me-2 bg-soft-warning text-fav">'
                                                . stripslashes(trim(htmlspecialchars($firstname_letter))) . stripslashes(trim(htmlspecialchars($lastname_letter))) .
                                                '</div>
                                            <a class="text-heading font-semibold" href="#">'
                                                . stripslashes(trim(htmlspecialchars($row['firstname']))) . " " . stripslashes(trim(htmlspecialchars($row['lastname']))) .
                                                '</a>
                                        </td>
                                        <td>'
                                                . stripslashes(trim(htmlspecialchars($row['send']))) .
                                                '</td>
                                        <td>
                                            <div class="avatar avatar-xs rounded-circle me-2 bg-soft-warning text-fav">'
                                                . stripslashes(trim(htmlspecialchars($company_letter))) .
                                                '</div>
                                            <a class="text-heading font-semibold" href="#">'
                                                . stripslashes(trim(htmlspecialchars($row['company']))) .
                                                '</a>
                                        </td>
                                        <td>
                                            <span class="badge badge-lg badge-dot">
                                                <i class="' . $status_color . '"></i>'
                                                . stripslashes(trim(htmlspecialchars($row['status']))) .
                                                '</span>
                                        </td>
                                        <td class="text-end float-end d-flex gap-8px">
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="set_website_vip"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                V
                                            </button>
                                            </form>
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="set_website_premium"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                P
                                            </button>
                                            </form>
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="set_website_starter"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                S
                                            </button>
                                            </form>
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="set_admin"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                A
                                            </button>
                                            </form>
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="set_contact"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                C
                                            </button>
                                            </form>
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                            ';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">
                                <?php
                                $num_customers = $result->num_rows;
                                echo "Showing " . $num_customers . " of " . $num_customers . " customers";
                                $stmt->close();
                                $conn->close();
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="main.js"></script>
</body>

</html>