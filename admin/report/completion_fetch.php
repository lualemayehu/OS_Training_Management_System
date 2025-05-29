<?php
include('../includes/config.php');

// Define cluster labels
$labels = [
    0 => "Fast Learners",
    1 => "Average Learners",
    2 => "Needs Attention"
];

$query = "SELECT cluster, COUNT(*) as count FROM customer WHERE cust_type='Trainee' GROUP BY cluster";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<ul class='list-group'>";
    while ($row = mysqli_fetch_assoc($result)) {
        $label = isset($labels[$row['cluster']]) ? $labels[$row['cluster']] : "Cluster " . $row['cluster'];
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
        echo $label;
        echo "<span class='badge badge-primary badge-pill'>{$row['count']}</span>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No clustering data found.</p>";
}
?>
