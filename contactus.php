<?php include "st_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .main-content {
        margin-left: 0;
        margin-top: 60px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }
     .sidebar.active ~ .main-content {
    margin-left: 250px;
    }
    .form-container {
      background-color: rgba(209, 218, 188, 0.53);
      border: 1px solid rgba(0, 0, 0, 0.2);
      box-shadow: 0 30px 30px rgba(0, 0, 0, 0.5);
      padding: 40px;
      border-radius: 12px;
      max-width: 700px;
      margin: 40px auto;
      height:600px;
    }
    .form-control:focus {
      border-color:rgb(228, 15, 25);
      box-shadow: 0 0 0 0.1rem rgba(226, 175, 218, 0.25);
    }
    .btn-primary {
      background-color:rgb(57, 40, 215);
      border: none;
      padding: 10px 30px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 30px;
      transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
      background-color:rgb(24, 187, 216);
    }
    .form-container h1 {
      text-align: center;
      font-size: 3rem;
      color: rgb(13, 3, 54);
      font-family: Arial, sans-serif;
      margin-bottom: 30px;
    }
    .form-control {
      border-radius: 8px;
      padding: 10px 12px;
      font-size: 14px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #495057;
    }
    .form-container2 {
      max-width: 700px;
      margin: 40px auto;
    }
    .form-container2 iframe {
      width: 100%;
      height: 600px;
      border: 0;
      border-radius: 12px;
    }
    
  </style>
</head>
<body>
  <div class="main-content" id="mainContent">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="form-container">
            <h1><b>Contact Us</b></h1>
            <form method="post" action="save_contact.php">
              <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter your Name" required>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter your Email" required>
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>
              <div class="mb-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Your Message" required></textarea>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </form>
          </div>
        </div>
        <!-- Google Map -->
        <div class="col-md-6">
          <div class="form-container2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.041522586274!2d80.15592047485386!3d6.12511469386161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae17758112ee961%3A0xa67ea12ff768839f!2sMawadawila%20Playground!5e0!3m2!1sen!2slk!4v1748326404097!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php';?>
 </body>
 </html>
