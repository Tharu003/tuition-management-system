<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Teacher Registration</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background-image: url(images/tea_reg.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Inter', sans-serif;
    }

    .form-container {
    
      background-color: rgba(168, 172, 172, 0.53); 
      border: 1px solid rgba(0, 0, 0, 0.2);      
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); 
      padding: 60px;
      border-radius: 12px;
      max-width: 700px; 
      margin: 50px auto; 
      


    }

    .form-title {
      color:rgb(5, 5, 5);
      font-weight: 600;
      margin-bottom: 25px;
      font-size: 26px;
      text-align: center;
    }

    .form-group label {
      font-weight: 500;
      color: black;
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin-bottom: 5px;
    }

    .form-control {
      background-color:rgb(247, 238, 238); 
      color:rgb(15, 15, 15);         
      border-radius: 8px;
      padding: 10px 12px;
      font-size: 14px;
      border: 1px solid #ccc;
      box-shadow: none;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color:rgb(228, 15, 25);
      box-shadow: 0 0 0 0.1rem rgba(226, 175, 218, 0.25);
    }

    .btn-secondary {
      background-color:rgb(40, 4, 46);
      border: none;
      padding: 10px 30px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 30px;
      transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
      background-color:rgb(31, 145, 165);
    }

    .text-center a {
      color:black;
      font-size: 14px;
      
    }

    .text-center a:hover {
      text-decoration: underline;
    }

    @media (max-width: 576px) {
      .form-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-container">
        <h1 class="form-title">Teacher Registration Form</h1>
        <form method="post" id="form">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" id="tname" placeholder="Enter full name">
          </div>

          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" id="tadd" placeholder="Enter address">
          </div>

          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" id="tdob">
          </div>

          <div class="form-group">
            <label>Contact Number</label>
            <input type="tel" class="form-control" id="tcn" placeholder="Enter phone number">
          </div>

          <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" id="temail" placeholder="Enter Email Address">
          </div>
          <div class="form-group">
            <label>Higher Qualification</label>
            <input type="text" class="form-control" id="thq" placeholder="Enter higher qualification">
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" id="pword" placeholder="Enter Your Password">
          </div>


          <div class="text-center mt-4">
            <button type="submit" class="btn btn-secondary px-4">Submit</button>
          </div>

          <div class="text-center mt-3">
            <a href="login.php">Back to Login</a>
          </div>
        </form>

        <div id="mdata" class="mt-4"></div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
