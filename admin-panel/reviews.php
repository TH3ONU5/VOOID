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

function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

if (isset($_POST['delete'])) {
    $delete = cleanInput($_POST['delete']);

    $stmt = $conn->prepare("DELETE FROM rating WHERE id = ?");
    $stmt->bind_param("i", $delete);
    if ($stmt->execute()) {
        echo "<div id='success'>";
        echo "<div id=''><span>Rating with the id " . $delete . " deleted successfully.</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';}, 3500);</script>";
    } else {
        echo "<div id='success'>";
        echo "<div id=''><span>Somthing went wrong. Try again.I</span></div>";
        echo "</div>";
        echo "<script>setTimeout(() => {document.getElementById('success').style.display='none';}, 3500);</script>";
    }
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }

        .review-card {
            background-color: #ffffff;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 20px;
            max-width: 100%;
            margin-bottom: 1em !important;
            margin: 0 auto;
        }

        .delete {
            border-radius: 5px;
            font-size: 15px;
            background: red;
            color: white;
            font-weight: bold;
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #d8d8d8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #ffffff;
            margin-right: 10px;
        }

        .review-header .name {
            font-weight: bold;
        }

        .review-header .details {
            color: #666666;
            font-size: 14px;
        }

        .review-header .details i {
            margin-right: 5px;
        }

        .review-rating {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-rating .stars {
            margin-right: 10px;
        }

        .review-rating .invitation {
            color: #666666;
            font-size: 14px;
        }

        .review-rating .time {
            margin-left: auto;
            color: #666666;
            font-size: 14px;
        }

        .review-content {
            margin-bottom: 10px;
        }

        .review-content .title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .review-content .text {
            color: #333333;
            font-size: 14px;
        }

        .review-footer {
            color: #666666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .review-actions {
            display: flex;
            align-items: center;
            color: #666666;
            font-size: 14px;
        }

        .review-actions i {
            margin-right: 5px;
        }

        .review-actions .flag {
            margin-left: auto;
        }
    </style>
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
                    <?php

                    function generateStars($rating)
                    {

                        if ($rating == 1) {
                            $ratingCOL = 'red';
                        }

                        if ($rating == 2) {
                            $ratingCOL = 'orange';
                        }

                        if ($rating == 3) {
                            $ratingCOL = 'yellow';
                        }

                        if ($rating == 4) {
                            $ratingCOL = 'green';
                        }

                        if ($rating == 5) {
                            $ratingCOL = 'green';
                        }

                        $maxStars = 5;
                        $starHTML = '<div class="flex items-center">';
                        for ($i = 1; $i <= $maxStars; $i++) {
                            if ($i <= $rating) {
                                $starHTML .= '<i class="fas fa-star text-' . $ratingCOL . '-500"></i>';
                            } else {
                                $starHTML .= '<i class="fas fa-star text-gray"></i>';
                            }
                        }
                        $starHTML .= '</div>';
                        return $starHTML;
                    }

                    $stmt = $conn->prepare("SELECT * FROM rating");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = cleanInput($row['id']);
                            $firstname = cleanInput($row['firstname']);
                            $lastname = cleanInput($row['lastname']);
                            $titel = cleanInput(htmlspecialchars_decode($row['titel']));
                            $email = cleanInput($row['email']);
                            $feedback = cleanInput(htmlspecialchars_decode($row['feedback']));
                            $rating = (int)cleanInput($row['rating']);
                            $date = cleanInput($row['date']);

                            $namef = substr($row["firstname"], 0, 1);
                            $namel = substr($row["lastname"], 0, 1);

                            if ($rating == 1) {
                                $ratingNUM = '1.0';
                            }

                            if ($rating == 2) {
                                $ratingNUM = '2.0';
                            }

                            if ($rating == 3) {
                                $ratingNUM = '3.0';
                            }

                            if ($rating == 4) {
                                $ratingNUM = '4.0';
                            }

                            if ($rating == 5) {
                                $ratingNUM = '5.0';
                            }

                            if ($rating == 1) {
                                $ratingCOL = 'red';
                            }

                            if ($rating == 2) {
                                $ratingCOL = 'orange';
                            }

                            if ($rating == 3) {
                                $ratingCOL = 'yellow';
                            }

                            if ($rating == 4) {
                                $ratingCOL = 'green';
                            }

                            if ($rating == 5) {
                                $ratingCOL = 'green';
                            }

                            $stars = generateStars($rating);

                            echo '
  <div class="review-card">
   <div class="review-header">
    <div class="avatar">
     <div height="40" width="40" class="avatar bg-soft-warning text-fav rounded-circle">
     ' . $namef . $namel . '
     </div>
    </div>
    <div>
     <div class="name ms-10px">
      ' . $firstname . ' ' . $namel . '.
     </div>
    </div>
   </div>
   <div class="review-rating">
    <div class="stars">
  ' . $stars . '
    </div>
    <div class="ml-2 text-' . $ratingCOL . '-500 font-bold">' . $ratingNUM . '</div>
    <div class="time">
     ' . $date . '
    </div>
   </div>
   <div class="review-content">
    <div class="title">
     ' . $titel . '
    </div>
    <div class="text">
     ' . $feedback . '
    </div>
   </div>
   <p>
   Email: ' . $email . '
   </p>
   <div class="review-actions">  
    <form action="" method="post" class="flag">
     <button type="submit" name="delete" class="delete" value="' . $id . '">Delete</button>
     </i>
    </form>
   </div>
  </div>
';
                        }
                    } else {
                        echo 'No reviews have been provided at this time.';
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </main>
        </div>
    </div>

    <script src="main.js"></script>
</body>

</html>