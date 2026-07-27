<?php include"st_home.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGMA Institute</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      color: #333;
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

    h2, h3, h5 {
      color: #4B0082;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    .section {
      margin-bottom: 40px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      background: white;
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(75, 0, 130, 0.3);
    }

    .logo-box {
      width: 100px;
      height: 100px;
      margin: 0 auto 15px;
      background-color: #4B0082;
      border-radius: 50%;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .logo-box:hover::after {
      content: url('images/logo.png'); 
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .social-icons a {
      color: #4B0082;
      margin-right: 10px;
      font-size: 20px;
    }

    .text-content p {
      line-height: 1.6;
      margin-bottom: 10px;
    }
    .inception-card {
  margin: 40px 0;
  display: flex;
  justify-content: center;
}

.inception-box {
  display: flex;
  flex-wrap: wrap;
  background-color: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  max-width: 1100px;
  width: 100%;
}

.inception-image {
  flex: 1 1 350px;
  max-height: 100%;
  overflow: hidden;
}

.inception-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.inception-text {
  flex: 2 1 600px;
  padding: 30px;
  background-color: #ffffff;
}

.inception-text h2 {
  color: #4B0082;
  margin-bottom: 20px;
  font-size: 26px;
}

.inception-text p {
  line-height: 1.7;
  color: #333;
  font-size: 16px;
}
.hover-reveal {
  position: relative;
  height: 250px;
  background-color:rgb(10, 14, 39);
  border-radius: 12px;
  color: white;
  text-align: center;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  font-weight: bold;
}

.hover-reveal .card-front,
.hover-reveal .card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  padding: 20px;
  transition: opacity 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.hover-reveal .card-front {
  z-index: 2;
  font-size:50px;
  font-family: Harlow Solid Italic;
}

.hover-reveal .card-back {
  opacity: 0;
  z-index: 1;
  font-size: 20px;
}

.hover-reveal:hover .card-front {
  opacity: 0;
}

.hover-reveal:hover .card-back {
  opacity: 1;
}

.hover-reveal img {
  width: 60px;
  margin-bottom: 10px;
}
.logo-card .card-back {
  background-color: transparent; 
  padding: 0;
}

.logo-card .card-back img {
  width: 100%;
  height: 100%;
  object-fit: contain; 
  border-radius: 12px;
}
.facilities-cards {
  margin-top: 40px;
}

.facility-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  text-align: center;
}

.facility-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(75, 0, 130, 0.3);
}

.facility-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.facility-card h5 {
  color: #4B0082;
  margin: 15px 0 5px;
  font-size: 18px;
}

.facility-card p {
  font-size: 14px;
  padding: 0 10px 15px;
  color: #444;
}
.fac{
    font-size: 30px;
    text-align: center;
}
footer {
      background-color:rgb(3, 3, 29);
      color: #ffffff;
      text-align: center;
      padding: 30px 20px;
      font-size: 16px;
      position: relative;
      z-index: 999; 
      transform: none !important;
      perspective: none !important;
      transform-style: flat !important;
      isolation: isolate;
    }

    footer .footer-links a {
      color: #ffffff;
      margin: 0 15px;
      text-decoration: none;
      font-weight: 500;
    }

    footer .footer-links a:hover {
      text-decoration: underline;
    }


  </style>
</head>
<body>
    <div class="main-content" id="mainContent">

  <div class="container">
  <section class="inception-card">
  <div class="inception-box">
    <div class="inception-image">
      <img src="images/about1.jpg" alt="Sigma Institute Founder">
    </div>
    <div class="inception-text">
      <h2>Inception of Sigma Institute</h2>
      <p>
        My SIGMA institute was founded in 2015. As a result of the opportunities faced by the times,
        the SIGMA institute was created as a result of continuous dedication and courage. The main 
        objectives are to provide the best services for the education of children with maximum facilities
        and a better environment, with the participation of a group of talented teachers. <br><br>

        I express my heartfelt gratitude to our staff and faculty who provide constant support to maintain
        discipline and excellence, ensuring Sigma is number one in student development.<br><br>

        If we have unintentionally offended you in this short journey with us, please forgive us. Point out our 
        shortcomings. Tell us your suggestions.<br><br>

        Thank you,<br>
        <strong>I am Sanjeewa</strong><br>
        Managing Director and Founder<br>
        Sigma Education Institute.
      </p>
    </div>
  </div>
</section>


   <section class="card-grid">
  <!-- LOGO -->
 <div class="box hover-reveal logo-card">
  <div class="card-front">OUR LOGO</div>
  <div class="card-back">
    <img src="images/logo1.png" alt="Logo Fullscreen">
  </div>
</div>


  <!-- MISSION -->
  <div class="box hover-reveal">
    <div class="card-front">OUR MISSION</div>
    <div class="card-back">
      <p>Create a generation of well-disciplined and good people through practical education.</p>
    </div>
  </div>

  <!-- VISION -->
  <div class="box hover-reveal">
    <div class="card-front">OUR VISION</div>
    <div class="card-back">
      <p>To build a good and intelligent society.</p>
    </div>
  </div>
</section>
<br>
<br>
<div class="fac">
<h1>Our Facilities</h1></div>
   <br>
   <br>
<section class="card-grid facilities-cards">
  <div class="facility-card">
    <img src="images/cctv.jpg" alt="CCTV Surveillance">
    <h5>CCTV Surveillance</h5>
    <p> CCTV cameras monitor all activities.
    Outsiders are not allowed, ensuring a safe, secure space for
   children to learn freely and confidently.</p>
  </div>
 
  <div class="facility-card">
    <img src="images/teachers.jpg" alt="Trusted, experienced, renowned teaching staff">
    <h5>Expert Teachers</h5>
    <p>The institute has experienced, well-known teachers islandwide,
   giving both parents and students full confidence in the teaching
  and learning process..</p>
  </div>
  <div class="facility-card">
    <img src="images/emegency.jpg" alt="Strict access and emergency safety measures">
    <h5>Emergency Measures</h5>
    <p>Students cannot leave before class ends. In emergencies like a fire,
   they may leave only with teacher permission or a call home, ensuring 
   safe, uninterrupted learning..</p>
  </div>
  <div class="facility-card">
    <img src="images/room3.jpg" alt="A/C Lecture Halls">
    <h5>A/C Lecture Halls</h5>
    <p>Our institute provides A/C 
    lecture halls to ensure a cool, comfortable environment for students,
    helping them focus better and enjoy a pleasant, distraction-free 
    learning experience throughout the day.</p>
  </div>
   <div class="facility-card">
    <img src="images/medical7.jpg" alt="Medical and hygiene facilities available">
    <h5>Medical and hygiene facilities available</h5>
    <p>The institution provides clean cafeterias, sanitary facilities, 
    and first aid, so children stay safely inside without needing
    to leave the premises..</p>
  </div>
   <div class="facility-card">
    <img src="images/project.jpg" alt="Expert Teachers">
    <h5>Projector and multimedia</h5>
    <p>Projector and multimedia equipment help make visual and audio 
      learning activities clearer and more effective..</p>
  </div>
</section>
  </div>
    </div>
<br>
<br>
 <footer>
    <div class="footer-links mb-2">
      <a href="index.php">Home</a> |
      <a href="about.php">About</a> |
      <a href="contact.php">Contact</a> |
      <a href="privacy.php">Privacy</a>
    </div>
    <div>&copy; <?= date("Y") ?> Sigma Institute. All rights reserved.</div>
  </footer>
</body>
</html>