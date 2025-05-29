<?php
// fetch.php

// Error handling for debugging (log instead of displaying)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'fetch_errors.log');

// Database connection
$connect = new PDO("mysql:host=localhost;dbname=aflex_tms", "root", "");

// Define columns used for ordering
$columns = [
    'cust_title', 'cust_first_name', 'cust_middle_name', 'cust_last_name',
    'cust_gender', 'cust_phone', 'cust_email', 'cust_position',
    'cust_inistitute', 'ev_tittle_subject', 'ev_start_date'
];

// Base query
$query = "
    SELECT 
        customer.cust_id,
        cust_title,
        cust_first_name,
        cust_middle_name,
        cust_last_name,
        cust_gender,
        cust_phone,
        cust_email,
        cust_position,
        cust_inistitute,
        ev_tittle_subject,
        YEAR(ev_start_date) AS ev_start_date
    FROM customer
    LEFT JOIN event ON event.ev_id = customer.fk_event
    WHERE customer.deleted = 0
";

// Filtering
if (!empty($_POST['search']['value'])) {
    $search = "%" . $_POST['search']['value'] . "%";
    $query .= " AND (
        cust_first_name LIKE :search OR
        cust_middle_name LIKE :search OR
        cust_last_name LIKE :search OR
        cust_position LIKE :search OR
        cust_gender LIKE :search OR
        cust_inistitute LIKE :search OR
        ev_tittle_subject LIKE :search OR
        ev_start_date LIKE :search
    )";
}

// Ordering
$order_sql = " ORDER BY cust_id DESC"; // default order
if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {
    $col_index = intval($_POST['order'][0]['column']);
    $dir = $_POST['order'][0]['dir'] === 'desc' ? 'DESC' : 'ASC';

    if (isset($columns[$col_index])) {
        $order_sql = " ORDER BY " . $columns[$col_index] . " " . $dir;
    }
}

$query .= $order_sql;

// Pagination
$limit_sql = "";
if (isset($_POST['start']) && isset($_POST['length']) && $_POST['length'] != -1) {
    $start = intval($_POST['start']);
    $length = intval($_POST['length']);
    $limit_sql = " LIMIT $start, $length";
}

// Prepare and execute filtered query
$statement = $connect->prepare($query);
if (!empty($search)) {
    $statement->bindValue(':search', $search, PDO::PARAM_STR);
}
$statement->execute();
$filtered_rows = $statement->rowCount();

// Fetch data with limit
$statement = $connect->prepare($query . $limit_sql);
if (!empty($search)) {
    $statement->bindValue(':search', $search, PDO::PARAM_STR);
}
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// Format data for DataTables
$data = [];
foreach ($results as $row) {
    $full_name = trim("{$row['cust_title']} {$row['cust_first_name']} {$row['cust_middle_name']} {$row['cust_last_name']}");
    $data[] = [
        '<a href="trainee_detail.php?id=' . $row['cust_id'] . '">' . htmlspecialchars($full_name) . '</a>',
        htmlspecialchars($row['cust_gender']),
        htmlspecialchars($row['cust_phone']),
        htmlspecialchars($row['cust_email']),
        htmlspecialchars($row['cust_position']),
        htmlspecialchars($row['cust_inistitute']),
        htmlspecialchars($row['ev_tittle_subject']),
        htmlspecialchars($row['ev_start_date'])
    ];
}

// Total record count (without filtering)
function count_all_data($connect) {
    $stmt = $connect->prepare("SELECT COUNT(*) FROM customer WHERE deleted = 0");
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Output JSON
$output = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => count_all_data($connect),
    "recordsFiltered" => $filtered_rows,
    "data" => $data
];

header('Content-Type: application/json');
echo json_encode($output);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('JSON encode error: ' . json_last_error_msg());
}
?>
