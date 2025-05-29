<?php 
session_start(); 
include('includes/config.php');

if (empty($_SESSION['authentication'])) {
    header('Location: ../index.php');
    exit();
}

// Session Timeout
$timeoutMinutes = 30;
$timeoutSeconds = $timeoutMinutes * 60;

if (isset($_SESSION['start_time']) && (time() - $_SESSION['start_time']) >= $timeoutSeconds) {
    session_destroy();
    echo "<script>alert('Session Ended!'); window.location = '../index.php';</script>";
    exit();
}
$_SESSION['start_time'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php"; ?>
<body>
<div class="hk-wrapper hk-vertical-nav">
    <?php include "includes/topnav.php"; ?>
    <?php include "includes/sidenav.php"; ?>

    <div class="hk-pg-wrapper">
        <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
            <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Trainee Clustering Report</h5>
                <div class="row mt-5">
                    <!-- Chart Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6>Trainee Clusters Overview</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="clusterChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Cluster Labels Section -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6>Cluster Details</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                $labels = [
                                    0 => "Fast Learners",
                                    1 => "Average Learners",
                                    2 => "Needs Attention"
                                ];

                                $result = mysqli_query($conn, "SELECT cluster, COUNT(*) as count FROM customer WHERE cust_type='Trainee' GROUP BY cluster");

                                if ($result && mysqli_num_rows($result) > 0) {
                                    echo "<ul class='list-group'>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $label = isset($labels[$row['cluster']]) ? $labels[$row['cluster']] : "Cluster {$row['cluster']}";
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                                        echo $label;
                                        echo "<span class='badge badge-primary badge-pill'>{$row['count']}</span>";
                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "<p>No cluster data found.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include "includes/footer.php"; ?>
    </div>
</div>

<!-- Vendor Scripts -->
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const clusterData = <?php
        $result = mysqli_query($conn, "SELECT cluster, COUNT(*) as count FROM customer WHERE cust_type='Trainee' GROUP BY cluster");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    ?>;

    const labelsMap = {
        0: "Fast Learners",
        1: "Average Learners",
        2: "Needs Attention"
    };

    const labels = clusterData.map(d => labelsMap[d.cluster] || "Cluster " + d.cluster);
    const counts = clusterData.map(d => d.count);

    new Chart(document.getElementById('clusterChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: ['#4caf50', '#2196f3', '#f44336'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
</body>
</html>
