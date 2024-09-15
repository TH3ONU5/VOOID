<?php
session_start();
session_regenerate_id(true);

require_once('../db.php');

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

    $sql = "UPDATE contact SET display =? WHERE id =?";
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

if (isset($_POST['set_done'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    $done = "Done";

    $sql = "UPDATE contact SET status =? WHERE id =?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $done, $user_id);

    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Status of the data with the id " . $user_id . " successfully changed</span></div>";
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

if (isset($_POST['set_inProgress'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    $progress = "In progress";

    $sql = "UPDATE contact SET status =? WHERE id =?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $progress, $user_id);

    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Status of the data with the id " . $user_id . " successfully changed</span></div>";
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

if (isset($_POST['payed'])) {
    $user_id = htmlspecialchars(trim($_POST['user_id']));

    $sql_select = "SELECT paid FROM contact WHERE id =?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $user_id);
    $stmt_select->execute();
    $stmt_select->bind_result($current_status);
    $stmt_select->fetch();
    $stmt_select->close();

    $new_status = ($current_status == "green") ? "red" : "green";

    $sql = "UPDATE contact SET paid =? WHERE id =?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $new_status, $user_id);

    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Pay Status of the data with the id " . $user_id . " successfully changed</span></div>";
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
                            <h5 class="mb-0">Kunde</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Phone number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th style="width: 15% !important;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_GET['user_id'])) {

                                        $user_id = stripslashes(trim(htmlspecialchars($_GET['user_id'])));

                                        $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, phone, email, message, status, paid FROM contact WHERE id = ? AND display = 'show'");
                                        $stmt->bind_param("i", $user_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $firstname_letter = substr($row["firstname"], 0, 1);
                                            $lastname_letter = substr($row["lastname"], 0, 1);
                                            $company_letter = substr($row["company"], 0, 1);

                                            echo '
        <tr id="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
            <td>
                <div class="avatar avatar-sm rounded-circle me-2 bg-soft-warning text-fav">' . stripslashes(trim(htmlspecialchars($firstname_letter))) . stripslashes(trim(htmlspecialchars($lastname_letter))) . '</div>
                <span class="text-heading font-semibold">' . stripslashes(trim(htmlspecialchars($row['firstname']))) . " " . stripslashes(trim(htmlspecialchars($row['lastname']))) . '</span>
            </td>
            <td>' . stripslashes(trim(htmlspecialchars($row['send']))) . '</td>
            <td>
                <div class="avatar avatar-xs rounded-circle me-2 bg-soft-warning text-fav">' . stripslashes(trim(htmlspecialchars($company_letter))) . '</div>
                <span class="text-heading font-semibold">' . stripslashes(trim(htmlspecialchars($row['company']))) . '</span>
            </td>
            <td>
                <span class="text-heading font-semibold">' . strip_tags(stripslashes(trim(htmlspecialchars($row['phone'])))) . '</span>
            </td>
            <td>
                <span class="text-heading font-semibold">' . stripslashes(trim(htmlspecialchars($row['email']))) . '</span>
            </td>
            <td>
                <span class="badge badge-lg badge-dot">' . stripslashes(trim(htmlspecialchars($row['status']))) . '</span>
            </td>
            <td class="text-end float-end d-flex gap-8px">
                <form action="" method="post" class="w-fit-content">
                    <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                    <button type="submit" name="set_done" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-check-circle"></i></button>
                </form>
                <form action="" method="post" class="w-fit-content">
                    <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                    <button type="submit" name="set_inProgress" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-alarm"></i></button>
                </form>
                <form action="" method="post" class="w-fit-content">
                    <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                    <button type="submit" name="payed" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-cash"></i></button>
                </form>
                <form action="" method="post" class="w-fit-content">
                    <input type="hidden" name="user_id" value="' . stripslashes(trim(htmlspecialchars($row['id']))) . '">
                    <button type="submit" name="delete" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></button>
                </form>
                <span class="badge badge-lg badge-dot ms-10px"><i style="background:' . stripslashes(trim(htmlspecialchars($row['paid']))) . ';"></i></span>
            </td>
        </tr>';
                                        }

                                        $stmt->close();
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer border-0 py-5">
                            <?php
                            if (isset($_GET['user_id'])) {
                                $server = "localhost";
                                $servername = "root";
                                $serverpassword = "";
                                $dbname = "agencyDB";

                                $user_id = stripcslashes(trim(htmlspecialchars($_GET['user_id'])));

                                $stmt = $conn->prepare("SELECT id, lastname, firstname, send, company, phone, email, message, status, paid FROM contact WHERE id = '$user_id' AND display = 'show'");
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    echo ($row['message']);
                                }
                                $stmt->close();
                            }
                            ?>
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