<?php include "st_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Time Table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
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

    .card-container {
      display: flex;
      gap: 20px;
      padding: 20px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      background: #f8fffd;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      width: 350px;      /* Card width */
      min-height: 250px; /* Minimum height */
      box-sizing: border-box;
      font-family: Arial, sans-serif;
      text-align: left;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .card h2 {
      margin: 0 0 15px 0;
      color: #162057;
    }

    .sub {
      font-size: 14px;
      color: #666;
      font-weight: normal;
      margin-bottom: 10px;
    }

    .label {
      font-weight: bold;
      display: inline-block;
      width: 120px;
    }

    .lecturer { color: #3f51b5; }
    .medium   { color: #009688; }
    .day      { color: #9c27b0; }
    .time     { color: #f9a825; }

    .note {
      margin-top: 10px;
      color: red;
      font-weight: bold;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 5px;
      margin-top: 20px;
      padding-bottom: 40px;
    }

    .pagination a, .pagination span {
      padding: 8px 12px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      text-decoration: none;
      color: #333;
      cursor: pointer;
      user-select: none;
    }

    .pagination .active {
      background: #007bff;
      color: white;
      border-color: #007bff;
      cursor: default;
    }
 

  </style>
</head>
<body>

  <div class="main-content" id="mainContent">
    <div class="card-container">

      <div class="card">
        <h2>Sinhala</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Suranjith Vithanage</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Monday</p>
        <p><span class="label time">⏰ Time</span> 3.00 PM - 5:00 PM</p>
        
      </div>
        <div class="card">
        <h2>English</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Ranil Gunarathne</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Tuesday</p>
        <p><span class="label time">⏰ Time</span> 3.00 PM - 5:00 PM</p>
        
      </div>
        <div class="card">
        <h2>ICT</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Thilina Nayanajith</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Wednesday</p>
        <p><span class="label time">⏰ Time</span> 3:00 PM - 5:00 PM</p>
        
      </div>
        <div class="card">
        <h2>Business Studies</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Thushara</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Thursday</p>
        <p><span class="label time">⏰ Time</span> 3:00 PM - 5:00 PM</p>
        
      </div>
        <div class="card">
        <h2>History</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Jagath Nilantha</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Friday</p>
        <p><span class="label time">⏰ Time</span> 3:00 PM - 5:00 PM</p>
       
      </div>
        <div class="card">
        <h2>Dancing</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Shashika Jayawardhana</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Saturday</p>
        <p><span class="label time">⏰ Time</span> 8:00 AM - 10:00 AM</p>
       
      </div>
        <div class="card">
        <h2>Mathematics</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Ravindu Maduranga</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Sunday</p>
        <p><span class="label time">⏰ Time</span> 8:00 AM - 10:00 AM</p>
        
      </div>
        <div class="card">
        <h2>Science</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Suranga Piyumal</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Saturday</p>
        <p><span class="label time">⏰ Time</span> 10:00 AM - 12:00 PM</p>
        
      </div>

      <div class="card">
        <h2>Arts</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Maduranga</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Sunday</p>
        <p><span class="label time">⏰ Time</span> 1:00 PM - 3:00 PM</p>
        
      </div>

      <div class="card">
        <h2>Music</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Nimal Mendis</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Saturday</p>
        <p><span class="label time">⏰ Time</span> 1:00 PM - 3:00 PM</p>
        
      </div>

      <div class="card">
        <h2>Primary English</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> Jeewan Balasooriya</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Sunday</p>
        <p><span class="label time">⏰ Time</span> 3:00 PM - 5:00 PM</p>
        
      </div>

      <div class="card">
        <h2>Schoolership</h2>
        <p class="sub">2025 | PHYSICAL </p>
        <p><span class="label lecturer">👨‍🏫 Lecturer</span> K.A.Sanjeewa</p>
        <p><span class="label medium">🌐 Medium</span> Sinhala</p>
        <p><span class="label day">📅 Day</span> Saturday</p>
        <p><span class="label time">⏰ Time</span> 5:00 PM - 7:00 PM</p>
        
      </div>

    </div>
  </div>
  
<?php include 'footer.php';?>


<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>
</html>
