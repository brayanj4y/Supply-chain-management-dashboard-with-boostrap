<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FlowSync - Sign Up</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
     		<p class="success"><?php echo $_GET['success']; ?></p>
     	<?php } ?>

     	<label>User Name</label>
     	<?php if (isset($_GET['name'])) { ?>
     		<input type="text"
     		 name="name"
     		 placeholder="Name"
     		 value="<?php echo $_GET['name']; ?>"><br>
     	<?php }else{ ?>
     	     <input type="text" 
     	      name="name" 
     	      placeholder="Name"><br>
          <?php }?> 

          <label>Name</label>
          <?php if (isset($_GET['uname'])) { ?>
     		<input type="text"
     		 name="name"
     		 placeholder="User Name"
     		 value="<?php echo $_GET['uname']; ?>"><br>
     	<?php }else{ ?>
     	     <input type="text" 
     	      name="username" 
     	      placeholder="User Name"><br>
          <?php }?>

     
     	<label>Password</label>
     	<input type="password" 
     	       name="password" 
     	       placeholder="Password"><br>
     	<label>Confirm Password</label>
     	<input type="password" 
     	       name="Confirm password" 
     	       placeholder="Confirm Password"><br>

     	<button type="submit">Login</button>
     	<a href="loginmain.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>