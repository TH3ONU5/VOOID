<?php
session_start();
session_regenerate_id(true);

require_once('../db.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

if (isset($_POST['delete'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    $displayn = "Dont display";

    $sql = "UPDATE contact SET display = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $displayn, $user_id);

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

    $stmt->close();
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
                            <h5 class="mb-0">New orders</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Datum</th>
                                        <th scope="col">Unternehmen</th>
                                        <th scope="col">Status</th>
                                        <th style="width: 0% !important;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, status, paid, message FROM contact WHERE status IN ('New') AND display = 'show'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);
                                            echo '
                                            <tr id="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
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
                                            <span class="badge badge-lg badge-dot">'
                                                . stripslashes(trim(htmlspecialchars($row['status']))) .
                                                '</span>
                                        </td>
                                        <td class="text-end float-end d-flex gap-8px">
                                            <div class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <a href="view_user.php?user_id=' . stripslashes(trim(htmlspecialchars($row['id']))) . '"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover" target="_blank">
                                            <i class="bi bi-eye"></i>
                                            </a>
                                            </div>                                          
                                            <form action="" method="post" class="w-fit-content">
                                            <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                                            <button type="submit" name="delete"
                                                class="btn btn-sm btn-square btn-neutral text-danger-hover"title="Löschen">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </form>
                                             <span class="badge badge-lg badge-dot ms-10px">
                                            <i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i>
                                            </span>
                                        </td>
                                    </tr>
                                            ';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No new orders</td></tr>';
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
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php
    $conn->close();
    ?>

    <script src="main.js"></script>
</body>

</html>