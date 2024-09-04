<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="./index.php">
            <img class="h-40px" src="../images/logo.png">
        </a>
        <div class="navbar-user d-lg-none">
            <div class="dropdown">
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./new.php">
                        <i class="bi bi-chat"></i> New orders
                        <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">
                            <?php
                            $server = "localhost";
                            $servername = "root";
                            $serverpassword = "";
                            $dbname = "agencyDB";

                            $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                            $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show'";
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
                        <i class="bi bi-plus"></i> Add Manuel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./search.php">
                        <i class="bi bi-search"></i> Search
                    </a>
                </li>
            </ul>
            <hr class="navbar-divider my-5 opacity-20">
            <ul class="navbar-nav mb-md-4">
                <li>
                    <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="./messages.php">
                        New orders
                        <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-4">
                            <?php
                            $server = "localhost";
                            $servername = "root";
                            $serverpassword = "";
                            $dbname = "agencyDB";

                            $conn = new mysqli($server, $servername, $serverpassword, $dbname);

                            $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show'";
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

                $sql = "SELECT * FROM contact WHERE status IN ('New') AND display = 'show' ORDER BY send DESC LIMIT 5";

                $stmt = $conn->prepare($sql);

                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $firstname_letter = substr($row["firstname"], 0, 1);
                    $lastname_letter = substr($row["lastname"], 0, 1);
                    $user_id = $row['id'];
                    echo '
                        <li>
                            <a href="new.php#' . $user_id . '" class="nav-link d-flex align-items-center">
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
            <div class="mt-auto"></div>
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