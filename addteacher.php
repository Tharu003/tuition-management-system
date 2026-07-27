<?php include "ad_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>add teacher</title>
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
  <h2>Add Teacher</h2>
  <p>Home / Teachers / Add Teachers </p>
  <div class="card">
    
   <form action="save_teacher.php" method="POST" id="teacherForm"enctype="multipart/form-data">

      <div class="form-group">
        <label for="teacherName">Name:</label>
        <input type="text" id="teacherName" name="teacherName" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacherEmail">Email:</label>
        <input type="email" id="teacherEmail" name="teacherEmail" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacherContact">Contact Number:</label>
        <input type="text" id="teacherContact" name="teacherContact" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacherdob">Date Of Birth:</label>
        <input type="date" id="teacherdob" name="teacherdob" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacheradd">Address:</label>
        <input type="text area" id="teacheradd" name="teacheradd" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacherpword">Password:</label>
        <input type="password" id="teacherpword" name="teacherpword" required>
      </div>
      <br>
      <div class="form-group">
        <label for="teacherQualification">Higher Qualification:</label>
        <input type="text" id="teacherQualification" name="teacherQualification" required>
      </div>
      <br>
      <div class="form-group">
  <label for="teacherPhoto">Upload Photo:</label>
  <input type="file" id="teacherPhoto" name="teacherPhoto" accept="image/*" required>
</div>
      <br>
      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="clear-btn">Clear</button>
      </div>
    </form>
  </div>
</div>
</div>

</body>
</html>
