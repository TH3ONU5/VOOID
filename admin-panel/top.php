<div class="row g-6 mb-6">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">New orders</span>
                        <span class="h3 font-bold mb-0">
                            <?php
                            $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status IN ('New') AND display = 'show'";
                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            $result = $stmt->get_result();

                            $row = $result->fetch_assoc();
                            $num_rows = $row['num_rows'];

                            echo ($num_rows);

                            $stmt->close();
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
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">In progress</span>
                        <span class="h3 font-bold mb-0">
                            <?php
                            $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status = 'In progress'";
                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            $result = $stmt->get_result();

                            $row = $result->fetch_assoc();
                            $num_rows = $row['num_rows'];

                            echo ($num_rows);

                            $stmt->close();
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
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Finished orders</span>
                        <span class="h3 font-bold mb-0">
                            <?php
                            $sql = "SELECT COUNT(*) AS num_rows FROM contact WHERE status = 'Done'";
                            $stmt = $conn->prepare($sql);

                            $stmt->execute();
                            $result = $stmt->get_result();

                            $row = $result->fetch_assoc();
                            $num_rows = $row['num_rows'];

                            echo ($num_rows);

                            $stmt->close();
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