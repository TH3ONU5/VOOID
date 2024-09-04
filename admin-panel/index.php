<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['admin'])) {
    session_destroy();
    session_unset();
    header("Location: ./login/");
    exit;
}

$server = "localhost";
$username = "root";
$password = "";
$dbname = "agencyDB";

$conn = new mysqli($server, $username, $password, $dbname);

if (isset($_POST["logout"])) {
    session_destroy();
    session_unset();
    header("Location: ./login/");
    exit;
}

if (isset($_POST['delete'])) {
    $user_id = intval($_POST['user_id']);

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    $displayn = "Dont display";

    $sql = "UPDATE contact SET display = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Fehler bei der Vorbereitung der Abfrage: " . $conn->error);
    }

    $stmt->bind_param("si", $displayn, $user_id);

    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Daten mit der ID " . $user_id . " erfolgreich gelöscht</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';}, 3500);</script>";
    } else {
        echo "<div id='error'>";
        echo "<div id=''><span>Es ist ein Fehler aufgetreten!</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('error').style.display='none';}, 3500);</script>";
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND matter = 'vip' AND display = 'show'");
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
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No customer requests</td></tr>';
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND matter = 'premium' AND display = 'show'");
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
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No customer requests</td></tr>';
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND matter = 'starter' AND display = 'show'");
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
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No customer requests</td></tr>';
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND matter = 'admin' AND display = 'show'");
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
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No customer requests</td></tr>';
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
                            <h5 class="mb-0">Kontaktiert</h5>
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

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid FROM contact WHERE status IN ('Done', 'In progress', 'Not started', 'New') AND matter = 'contact' AND display = 'show'");
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
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No customer requests</td></tr>';
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