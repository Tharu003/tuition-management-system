
<?php
include "ad_home.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tuition Class Admin Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      background-color:rgb(249, 249, 249);
      font-family: 'Segoe UI', sans-serif;
      color: #f3f4f6;
      padding: 20px;
    }

    h1 {
      text-align: left;
      color:rgb(12, 7, 71);
      margin-bottom: 30px;
      font-family:Arial, Helvetica, sans-serif;
      font-size: 30px;
      font-weight: bold;
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
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1rem;
    }

    .card {
      background-color:rgb(2, 17, 36);
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .card h2 {
      color: #60a5fa;
      font-size: 1.5rem;
    }

    .card p {
      font-size: 0.9rem;
      color: #9ca3af;
    }

    .charts {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1rem;
      margin-top: 30px;
    }

    .chart-box {
      background-color:rgb(4, 3, 24);
      padding: 20px;
      border-radius: 12px;
    }

    .btn-download {
      float: right;
      padding: 10px 20px;
      margin-bottom: 20px;
      background-color:rgb(16, 17, 63);
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .barchart{
        height:500px;
    }
  </style>
</head>
<body>
<div class="main-content" id="mainContent">
  <button class="btn-download">Download Report</button>
  <h1> Dashboard</h1>

  <div class="cards">
    <div class="card">
      <h2>120</h2>
      <p>Total Students</p>
    </div>
    <div class="card">
      <h2>Rs. 45,000</h2>
      <p>Monthly Income</p>
    </div>
    <div class="card">
      <h2>25</h2>
      <p>New Admissions</p>
    </div>
    <div class="card">
      <h2>11</h2>
      <p>Active Classes</p>
    </div>
  </div>

  <div class="charts">
    <div class="chart-box">
      <canvas id="lineChart"></canvas>
    </div>
    <div class="chart-box">
      <canvas id="barChart"></canvas>
    </div>
    <div class="chart-box">
      <canvas id="pieChart"></canvas>
    </div>
  </div>

  <script>

    new Chart(document.getElementById('lineChart'), {
  type: 'line',
  data: {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    datasets: [{
      label: 'Attendance Trend',
      data: [100, 95, 110, 105],
      borderColor: '#3b82f6',
      fill: false,
      tension: 0.3
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false, 
    plugins: {
      legend: {
        labels: {
          color: 'white'
        }
      }
    },
    scales: {
      x: {
        ticks: {
          color: '#d1d5db'
        }
      },
      y: {
        ticks: {
          color: '#d1d5db'
        }
      }
    }
  }
});



   new Chart(document.getElementById('barChart'), {
  type: 'bar',
  data: {
    labels: ['Maths', 'Science', 'ICT', 'English', 'Sinhala','History', 'Art', 'Dancing', 'Music', 'Primary English','Schoolarship'],
    datasets: [{
      label: 'Students',
      data: [75, 68, 52, 62, 42, 70, 50, 60, 36, 48, 70],
      backgroundColor: '#10b981'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { labels: { color: 'white' } } },
    scales: {
      x: { ticks: { color: '#d1d5db' } },
      y: { ticks: { color: '#d1d5db' } }
    }
  }
});


    new Chart(document.getElementById('pieChart'), {
      type: 'doughnut',
      data: {
        labels: ['Paid', 'Pending'],
        datasets: [{
          label: 'Payment',
          data: [85, 15],
          backgroundColor: ['#3b82f6', '#ef4444']
        }]
      },
      options: {
        plugins: { legend: { labels: { color: 'white' } } }
      }
    });
  </script>
<br>
</div>

</body>
</html>
