<?php include "ad_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>add Subject</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }
    .main-content {
        margin-left: 80px;
        margin-top: 60px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }
.sidebar.active ~ .main-content {
        margin-left: 250px;
    }
    .main-content h2{
      font-size: 30px;
      margin-left:auto;
      color:rgb(22, 8, 87);
    }
    .card {
      background-color:rgb(255, 255, 255);
      max-width: auto;
      height:auto;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: px 8px 8px 8px rgba(189, 182, 182, 0.1);
    }

    .card h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
   
    }

   .form-group input {
  width: 100%;
  padding: 6px 10px;
  box-sizing: border-box;
  border-radius: 12px;
  background-color: rgb(235, 226, 237);
  outline: none;
  border: 1px solid #ccc; 
  box-shadow: none;  
  height:40px;    
}

.form-group input:focus {
  outline: none;
  box-shadow: none;
  border-color: rgb(91, 174, 243);
}


   .button-group {
  display: flex;
  justify-content: left;
  gap: 15px;             
  margin-top: 20px;
}

.button-group button {
  width: 100px;           
  padding: 8px;
  font-size: 14px;
  border: none;
  border-radius: 10px;
  color: white;
  cursor: pointer;
}

.submit-btn {
  background-color: rgb(7, 125, 13);
}

.clear-btn {
  background-color: rgb(239, 16, 31);
}

    .button-group button:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
    
 <div class="main-content" id="mainContent">
  <form method="POST" action="save_sub.php">

  <h2>Add Subject</h2>
  <p>Home / Subjects / Add Subject </p>
  <div class="card">
    
    
      <div class="form-group">
        <label for="subid">Subject Id:</label>
        <input type="text" id="subid" name="subid" required>
      </div>
      <br>
      <div class="form-group">
        <label for="subname">Subject Name:</label>
        <input type="text" id="subname" name="subname" required>
      </div>
      <br>
     
      <br>
      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="clear-btn">Clear</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
