<?php
include 'dbconnection.php';

// Get the current date for filtering
$current_date = date('Y-m-d');

// Fetch sales data
$sql_sales = "SELECT amount, sale_date FROM sales WHERE sale_date = '$current_date'";
$result_sales = $conn->query($sql_sales);
$sales_data = [];
while ($row = $result_sales->fetch_assoc()) {
    $sales_data[] = $row['amount'];
}

// Fetch revenue data
$sql_revenue = "SELECT amount, revenue_date FROM revenue WHERE revenue_date = '$current_date'";
$result_revenue = $conn->query($sql_revenue);
$revenue_data = [];
while ($row = $result_revenue->fetch_assoc()) {
    $revenue_data[] = $row['amount'];
}

// Fetch customer data (we assume each entry represents a new customer on that date)
$sql_customers = "SELECT COUNT(*) as customer_count FROM customer WHERE registration_date = '$current_date'";
$result_customers = $conn->query($sql_customers);
$customers_data = $result_customers->fetch_assoc()['customer_count'];

// Prepare data arrays for the chart (if no data for today, use zeros)
if (empty($sales_data)) {
    $sales_data = [0];
}
if (empty($revenue_data)) {
    $revenue_data = [0];
}
if (empty($customers_data)) {
    $customers_data = [0];
}
?>