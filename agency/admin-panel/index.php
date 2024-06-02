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

    // Überprüfe, ob der Benutzer authentifiziert ist
    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $session_id) {
        // Leite zur Login-Seite weiter, wenn der Benutzer nicht authentifiziert ist
        header("Location: ./login/");
        exit;
    }
}

// Schließe das Statement für die Abfrage der Session-ID
$stmt->close();

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

    // Zerstöre die Session
    session_destroy();
    session_unset();

    // Leite den Benutzer nach dem Logout zur Startseite weiter
    header("Location: ../");
    exit;
}

// Verarbeite die Anfrage zum Löschen von Daten
if (isset($_POST['delete'])) {
    // Bereinige und validiere die Benutzer-ID
    $user_id = intval($_POST['user_id']);

    // Stelle die Datenbankverbindung erneut her
    $conn = new mysqli($server, $username, $password, $dbname);

    // Überprüfe, ob die erneute Verbindung erfolgreich ist
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    // Setze den Anzeigestatus für das Löschen
    $displayn = "Dont display";

    // Bereite die SQL-Anweisung zum Löschen der Daten vor
    $sql = "UPDATE contact SET display = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Überprüfe, ob die Vorbereitung der SQL-Anweisung erfolgreich war
    if ($stmt === false) {
        die("Fehler bei der Vorbereitung der Abfrage: " . $conn->error);
    }

    // Binde Parameter und führe die SQL-Anweisung aus
    $stmt->bind_param("si", $displayn, $user_id);

    // Überprüfe, ob die Ausführung erfolgreich war
    if ($stmt->execute()) {
        // Zeige eine Erfolgsmeldung an
        echo "<div id='success'>";
        echo "<div id=''><span>Daten mit der ID " . $user_id . " erfolgreich gelöscht</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';}, 3500);</script>";
    } else {
        // Zeige eine Fehlermeldung an
        echo "<div id='error'>";
        echo "<div id=''><span>Es ist ein Fehler aufgetreten!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('error').style.display='none';}, 3500);</script>";
    }

    // Schließe das Statement zum Löschen der Daten
    $stmt->close();
    // Schließe die Datenbankverbindung
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
                            <a class="nav-link" href="#">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="undefined.php">
                                <i class="bi bi-chat"></i> Undefined
                                <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">
                                    <?php
                                    // Database connection details
                                    $server = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "agencyDB";

                                    // Establish database connection
                                    $conn = new mysqli($server, $username, $password, $dbname);

                                    // Prepare SQL query to count Undefined
                                    $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status = 'New' AND display = 'show' AND starter = '.' AND premium = '.' AND vip = '.' AND contact = '.' AND admin = '.'";
                                    $stmt = $conn->prepare($sql);

                                    // Execute SQL query
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Fetch row and get the count of Undefined
                                    $row = $result->fetch_assoc();
                                    $num_rows = $row['num_rows'];

                                    echo $num_rows;

                                    // Close prepared statement and database connection
                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php">
                                <i class="bi bi-plus"></i> Add Manually
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="navbar-divider my-5 opacity-20">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                                Undefined
                                <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-4">
                                    <?php echo $num_rows; ?>
                                </span>
                            </div>
                        </li>
                        <?php
                        // Establish database connection
                        $conn = new mysqli($server, $username, $password, $dbname);

                        // Prepare SQL query to select latest Undefined
                        $sql = "SELECT * FROM contact WHERE status = 'New' AND display = 'show' AND starter = '.' AND premium = '.' AND vip = '.' AND contact = '.' AND admin = '.' ORDER BY send DESC LIMIT 5";

                        $stmt = $conn->prepare($sql);

                        // Execute SQL query
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Loop through each result and display message details
                        while ($row = $result->fetch_assoc()) {
                            $firstname_letter = substr($row["firstname"], 0, 1);
                            $lastname_letter = substr($row["lastname"], 0, 1);
                            $user_id = $row['id'];
                        ?>
                            <li>
                                <a href="messages.php#<?php echo $user_id; ?>" class="nav-link d-flex align-items-center">
                                    <div class="me-4">
                                        <div class="position-relative d-inline-block text-white">
                                            <span class="avatar bg-soft-warning text-fav rounded-circle"><?php echo $firstname_letter . $lastname_letter; ?></span>
                                            <span class="position-absolute bottom-2 end-2 transform translate-x-1/2 translate-y-1/2 border-2 border-solid border-current w-3 h-3 bg-success rounded-circle"></span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="d-block text-sm font-semibold">
                                            <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
                                        </span>
                                        <span class="d-block text-xs text-muted font-regular">
                                            Costumer
                                        </span>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="bi bi-chat"></i>
                                    </div>
                                </a>
                            </li>
                        <?php
                        }
                        // Close prepared statement and database connection
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
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Undefined</span>
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
                                                progress</span>
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
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Completed
                                                Projects</span>
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
                            <h5 class="mb-0">Website VIP</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND vip = 'yes' AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr>
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
                                        <td class="text-end">
                                            <form action="" method="post">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '" class="btn btn-sm btn-neutral">View</a>
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
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
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Website Premium</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND premium = 'yes' AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr>
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
                                        <td class="text-end">
                                            <form action="" method="post">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '" class="btn btn-sm btn-neutral">View</a>
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
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
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Website Starter</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND starter = 'yes' AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr>
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
                                        <td class="text-end">
                                            <form action="" method="post">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '" class="btn btn-sm btn-neutral">View</a>
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
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
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Administration Service</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND admin = 'yes' AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr>
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
                                        <td class="text-end">
                                            <form action="" method="post">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '" class="btn btn-sm btn-neutral">View</a>
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
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
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Contact</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND contact = 'yes' AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr>
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
                                        <td class="text-end">
                                            <form action="" method="post">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '" class="btn btn-sm btn-neutral">View</a>
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
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