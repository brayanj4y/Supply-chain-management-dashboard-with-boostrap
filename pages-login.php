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
    // Get user input and trim whitespace
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    // Basic validation: Check if fields are not empty
    if (empty($user) || empty($pass)) {
        echo "<div class='alert alert-danger'>Both fields are required!</div>";
    } else {
        // Prepare and bind statement to check for username
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Username exists, now fetch the password
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Check if the entered password matches the stored password
            if ($pass === $hashed_password) { // Directly comparing plain passwords
                // Successful login
                echo "<div class='alert alert-success'>Login successful! Redirecting...</div>";
                
                // Redirect to another page (uncomment the next line for redirection)
              header('Location: index.php');
                // exit();
            } else {
                // Invalid password
                echo "<div class='alert alert-danger'>Invalid password. Please try again.</div>";
            }
        } else {
            // Invalid username
            echo "<div class='alert alert-danger'>Username not found. Please check your username.</div>";
        }

        $stmt->close();
    }
}

$conn->close();
?>


<!-- Display the message (if any) -->
<?php if (!empty($message)) echo $message; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - FlowSync</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .login-container {
      max-width: 400px;
      margin: 5% auto;
      padding: 40px;
      background-color: #fff;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .logo img {
      width: 64px;
      height: 64px;
      margin-bottom: 20px;
    }

    button[type="submit"] {
      width: 100%;
      margin-top: 15px;
    }

    .alert {
      margin-top: 10px;
    }
  </style>

</head>

<body>

  <main>
    <div class="login-container text-center">
      <h2 class="mb-3">Login to Your Account</h2>
      <p class="mb-4">Enter your username & password to login</p>
      
      <!-- Display the message (success or error) -->
      <?php if(!empty($message)) { echo $message; } ?>

      <form action="pages-login.php" method="post">
        <div class="form-group mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="remember" name="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
      
      <p class="mt-3">Don't have an account? <a href="pages-register.php">Create an account</a></p>
      <footer class="mt-4">
          <p>Made By Byte Phantoms.</p>
      </footer>
    </div>
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>
