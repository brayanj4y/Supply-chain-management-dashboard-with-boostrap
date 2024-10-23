<?php
include 'dbconnection.php';

// Get the current month and year
$current_month = date('Y-m');
$current_year = date('Y');

// Fetch total revenue for this month
$sql = "SELECT SUM(total_revenue) AS total_revenue_this_month FROM revenue WHERE revenue_date LIKE '$current_year-$current_month%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_revenue_this_month = $row['total_revenue_this_month'] ? $row['total_revenue_this_month'] : 0;
} else {
    $total_revenue_this_month = 0;
}

// Fetch total revenue for last month
$last_month = date('Y-m', strtotime('-1 month'));
$sql_last_month = "SELECT SUM(total_revenue) AS total_revenue_last_month FROM revenue WHERE revenue_date LIKE '$last_month%'";
$result_last_month = $conn->query($sql_last_month);

if ($result_last_month->num_rows > 0) {
    $row_last_month = $result_last_month->fetch_assoc();
    $total_revenue_last_month = $row_last_month['total_revenue_last_month'] ? $row_last_month['total_revenue_last_month'] : 0;
} else {
    $total_revenue_last_month = 0;
}

// Calculate percentage increase or decrease
if ($total_revenue_last_month > 0) {
    $percentage_change = (($total_revenue_this_month - $total_revenue_last_month) / $total_revenue_last_month) * 100;
    $change_direction = $percentage_change >= 0 ? 'increase' : 'decrease';
    $text_color = $percentage_change >= 0 ? 'text-success' : 'text-danger';
} else {
    $percentage_change = 0;
    $change_direction = 'no change';
    $text_color = 'text-muted';
}
?>