<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flowsync";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    // Basic validation: Check if fields are not empty
    if (empty($user) || empty($pass)) {
        echo "<div class='alert alert-danger'>Both fields are required!</div>";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Username already exists
            echo "<div class='alert alert-danger'>Username already taken. Please choose another.</div>";
        } else {
            // Insert the new user with plain-text password (for demo purposes)
            $stmt->close();

            // Prepare the insert query
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $user, $pass); // Directly inserting the plain password

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Signup successful! You can now log in.</div>";
            } else {
                echo "<div class='alert alert-danger'>Signup failed. Please try again later.</div>";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register - FlowSync</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h3>Create an Account</h3>
          </div>
          <div class="card-body">
            <p class="text-center">Enter your details to create an account</p>

            <!-- Form Start -->
            <form action="pages-register.php" method="post">
              <div class="form-group mb-3">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
              </div>
              <div class="form-group mb-3">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
              </div>
              <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="form-group mb-4">
                <label for="shippo_token">Shippo Token (Optional)</label>
                <input type="text" class="form-control" id="shippo_token" name="shippo_token" placeholder="Shippo Token">
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign Up</button>
              </div>
            </form>
            <!-- Form End -->

          </div>
          <div class="card-footer text-center">
            <p>Already have an account? <a href="pages-login.php">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
