<?php
include 'dbconnection.php';

// Get the current year
$current_year = date('Y');

// Fetch total customers for this year
$sql = "SELECT COUNT(*) AS total_customers_this_year FROM customer WHERE YEAR(registration_date) = '$current_year'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_customers_this_year = $row['total_customers_this_year'];
} else {
    $total_customers_this_year = 0;
}

// Fetch total customers for last year
$last_year = date('Y', strtotime('-1 year'));
$sql_last_year = "SELECT COUNT(*) AS total_customers_last_year FROM customer WHERE YEAR(registration_date) = '$last_year'";
$result_last_year = $conn->query($sql_last_year);

if ($result_last_year->num_rows > 0) {
    $row_last_year = $result_last_year->fetch_assoc();
    $total_customers_last_year = $row_last_year['total_customers_last_year'];
} else {
    $total_customers_last_year = 0;
}

// Calculate percentage increase or decrease
if ($total_customers_last_year > 0) {
    $percentage_change = (($total_customers_this_year - $total_customers_last_year) / $total_customers_last_year) * 100;
    $change_direction = $percentage_change >= 0 ? 'increase' : 'decrease';
    $text_color = $percentage_change >= 0 ? 'text-success' : 'text-danger';
} else {
    $percentage_change = 0;
    $change_direction = 'no change';
    $text_color = 'text-muted';
}
?>