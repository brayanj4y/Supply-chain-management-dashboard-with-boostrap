<?php
include 'dbconnection.php';

// Get today's date
$today = date('Y-m-d');

// Fetch sales for today
$sql = "SELECT COUNT(*) AS total_sales FROM sales WHERE sale_date = '$today'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the total sales for today
    $row = $result->fetch_assoc();
    $total_sales_today = $row['total_sales'];
} else {
    $total_sales_today = 0;
}

// For percentage calculation, let's assume you compare with yesterday's sales
$yesterday = date('Y-m-d', strtotime('-1 day'));
$sql_yesterday = "SELECT COUNT(*) AS total_sales_yesterday FROM sales WHERE sale_date = '$yesterday'";
$result_yesterday = $conn->query($sql_yesterday);

if ($result_yesterday->num_rows > 0) {
    $row_yesterday = $result_yesterday->fetch_assoc();
    $total_sales_yesterday = $row_yesterday['total_sales_yesterday'];
} else {
    $total_sales_yesterday = 0;
}

// Calculate percentage increase/decrease
if ($total_sales_yesterday > 0) {
    $percentage_change = (($total_sales_today - $total_sales_yesterday) / $total_sales_yesterday) * 100;
    $change_direction = $percentage_change >= 0 ? 'increase' : 'decrease';
    $text_color = $percentage_change >= 0 ? 'text-success' : 'text-danger';
} else {
    $percentage_change = 0;
    $change_direction = 'no change';
    $text_color = 'text-muted';
}
?>