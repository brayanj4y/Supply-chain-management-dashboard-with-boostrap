<?php

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'souopsilvain@gmail.com';

  // Correct the path to the PHP Email Form library
  $php_email_form_path = '../assets/vendor/php-email-form/php-email-form.php';
  
  if( file_exists($php_email_form_path )) {
    include( $php_email_form_path );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  // Create a new instance of PHP_Email_Form
  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // Set the email details
  $contact->to = $receiving_email_address;

  // Validate the incoming POST data
  if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
    
    $contact->from_name = htmlspecialchars($_POST['name']); // Sanitize input
    $contact->from_email = htmlspecialchars($_POST['email']);
    $contact->subject = htmlspecialchars($_POST['subject']);

    // Add the form messages
    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    // Optionally enable SMTP by uncommenting the following section and configuring the details
    /*
    $contact->smtp = array(
      'host' => 'smtp.example.com',   // Replace with your SMTP host
      'username' => 'your_username',  // Replace with your SMTP username
      'password' => 'your_password',  // Replace with your SMTP password
      'port' => '587',                // Usually port 587 for TLS, or 465 for SSL
      'encryption' => 'tls'           // 'tls' or 'ssl'
    );
    */

    // Send the email and handle success/failure
    echo $contact->send() ? 'Message sent successfully' : 'Failed to send message';

  } else {
    // If required fields are missing, display an error
    echo 'Please fill in all the required fields.';
  }
?>
