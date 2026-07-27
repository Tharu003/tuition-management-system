

<?php include "st_home.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sigma Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


  <style>

   .main-content {
        margin-left: 0;
        margin-top: 60px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .sidebar.active ~ .main-content {
    margin-left: 250px;
    }
.image-container {
  position: relative;
  width: 100%;
  height: 600px;
  overflow: hidden;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.overlay-text {
  position: absolute;
  bottom: 120px; 
  left: 32%;
  transform: translateX(-50%);
  color: white;
  font-size: 36px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
}
.overlay-text h1 {
   font-size:60px;
   font-family:Cooper Black;
}
.overlay-text h2{
    font-family:Arial Black;
}
.overlay-text p{
    font-size:20px;
}
body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
  background: #fff;
 
}

.about-section {
  display: flex;
  align-items: center;
  justify-content: center;

  padding: 50px 30px;
  flex-wrap: wrap;
  gap: 60px;
 
}

.image-area {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.diamond {
  width: 250px;
  height: 250px;
  transform: rotate(45deg);
  overflow: hidden;
  position: relative;
  border-radius: 20px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  flex-shrink: 0;
  background-color:rgb(255, 255, 255);
}

.diamond img {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 140%;
  height: 140%;
  object-fit: cover;
  transform: translate(-50%, -50%) rotate(-45deg);
  
}


.diamond.main {
  width: 250px;
  height: 250px;
}

.text-area {
  max-width: 600px;
  background: linear-gradient(to right, #0c0c64, #731c1c);
  color: #fff;
  padding: 30px;
  border-radius: 100px 0 100px 0;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.text-area h2 {
  font-size: 32px;
  margin-bottom: 15px;
}

.text-area p {
  font-size: 16px;
  line-height: 1.6;
}

.read-more {
  display: inline-block;
  margin-top: 20px;
  padding: 10px 20px;
  background: #fff;
  color: #e53935;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  transition: background 0.3s;
}

.read-more:hover {
  background: #e53935;
  color: #fff;
}
.stats-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 60px;
  background-color:rgb(228, 236, 238);
  border-radius: 20px;
  margin: 40px auto;
  max-width: 1200px;
  gap: 40px;
  flex-wrap: wrap;
}

.stats-text {
  flex: 1;
  min-width: 300px;
}

.stats-text h2 {
  font-size: 50px;
  margin-bottom: 15px;
  color:rgb(5, 37, 77);
  font-weight: bold;
  font-family:Harlow Solid Italic;
}

.stats-text p {
  font-size: 20px;
  line-height: 1.6;
  color: #333;
}

.counter-container {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
  flex: 1;
  min-width: 300px;
}

.counter-card {
  background: #ffffff;
  border-radius: 15px;
  box-shadow: 6px 6px 20px rgba(0, 0, 0, 0.08);
  width: 200px;
  height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.counter-icon {
  font-size: 40px;
  color: #0077aa;
  margin-bottom: 10px;
}

.counter-number {
  font-size: 36px;
  font-weight: bold;
  color: #005577;
}

.counter-label {
  font-size: 18px;
  color:rgb(161, 24, 24);
}


.icon {
  font-size: 48px;
  color:rgb(7, 2, 31);
  margin-bottom: 15px;
}

.count {
  font-size: 36px;
  font-weight: 700;
  color:rgb(15, 39, 150);
}

.label {
  font-size: 18px;
  color:rgb(228, 50, 50);
  margin-top: 5px;
   font-weight: bold;
}
.anim-body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 50vh;
  /* background: linear-gradient(150deg, rgb(125, 151, 175), rgb(189, 175, 190)); */
  padding: 60px 0;
   position: relative; 
  z-index: 1;
  overflow: hidden;
  transform-style: flat;
}

.container {
  position: relative;
  width: 150px;
  height: 180px;
  transform-style: preserve-3d;
  animation: animate 20s linear infinite;
   z-index: 2;
}

.container:hover {
  animation-play-state: paused;
}

@keyframes animate {
  0% {
    transform: perspective(1000px) rotateY(0deg);
  }
  100% {
    transform: perspective(1000px) rotateY(360deg);
  }
}

.container span {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transform-origin: center;
  transform-style: preserve-3d;
  transform: rotateY(calc(var(--i) * 22.5deg)) translateZ(400px);
  -webkit-box-reflect: below 2px linear-gradient(transparent, transparent, rgba(4, 4, 4, 0.267));
}

.container span img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 15px;
  border: 4px double #000;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease;
}

.container span img:hover {
  transform: scale(1.05);
}


.abc h1{
  color:black;
  text-align: center;
  font-size: 50px;
  font-family: Snap ITC;
}

  </style>
</head>
<body>

  <div class="main-content" id="mainContent">
    <div class="image-container">
    <img src="images/st_dash2.jpg" width="100%"height="600px">
   <div class="overlay-text">
    <h1>Welcome To Sigma</h1>
    <h2>Best Education Expertise</h2>
    <p>At sigma,we are committed to shaping the future of our students <br>through high quality education and a holistic learning environment</p>
    
</div>
</div>
<section class="about-section">
    <div class="image-area">
      <div class="diamond"><img src="images/IMG14.jpg"width="20%" alt="Image 1"></div>
      
    </div>

    <div class="text-area">
      <h2>About Us</h2>
      <p>
        "Sigma Institute was established with a profound mission to be a guiding light for students throughout Sri Lanka.
        From its inception, the institute aimed to transcend traditional education by offering exceptional learning experiences
        that not only educate but also inspire and uplift the nation's youth, creating pathways…
      </p>
      <a href="about.php" class="read-more">READ MORE</a>
    </div>
  </section>
  <div class="stats-section">
  <div class="stats-text">
    <h2>Our Achievements</h2>
    <p>We are proud of our journey. With over a decade of experience, hundreds of staff, and dozens of partner institutions, Sigma is shaping the future of students across the nation.</p>
  </div>
 
  <div class="counter-container">
  <div class="counter-card">
    <div class="icon"><i class="bi bi-clock"></i></div>
    <div class="count" data-target="1000">0</div>
    <div class="label">Students</div>
  </div>

  <div class="counter-card">
    <div class="icon"><i class="bi bi-person-badge"></i></div>
    <div class="count" data-target="100">0</div>
    <div class="label">Teachers</div>
  </div>

  <div class="counter-card">
    <div class="icon"><i class="bi bi-award"></i></div>
    <div class="count" data-target="10">0</div>
    <div class="label">Experience</div>
  </div>
</div>
</div>
  <script>
    const counters = document.querySelectorAll('.count');
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = Math.ceil(target / 50);

        if (count < target) {
          counter.innerText = count + increment;
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target + "+";
        }
      };
      updateCount();
    });
  </script>
  <div class="abc">
  <h1>Gallery Page</h1>
  </div>
  <br>
<div class="anim-body">
  
  <div class="container">
    <span style="--i:1"><img src="images/IMG1.jpg"></span>
    <span style="--i:2"><img src="images/IMG2.jpg"></span>
    <span style="--i:3"><img src="images/IMG3.jpg"></span>
    <span style="--i:4"><img src="images/IMG4.jpg"></span>
    <span style="--i:5"><img src="images/IMG6.jpg"></span>
    <span style="--i:6"><img src="images/IMG7.jpg"></span>
    <span style="--i:7"><img src="images/IMG8.jpg"></span>
    <span style="--i:8"><img src="images/IMG9.jpg"></span>
    <span style="--i:9"><img src="images/IMG10.jpg"></span>
    <span style="--i:10"><img src="images/IMG18.jpg"></span>
    <span style="--i:11"><img src="images/IMG12.jpg"></span>
    <span style="--i:12"><img src="images/IMG13.jpg"></span>
    <span style="--i:13"><img src="images/IMG14.jpg"></span>
    <span style="--i:14"><img src="images/IMG15.jpg"></span>
    <span style="--i:15"><img src="images/IMG16.jpg"></span>
    <span style="--i:16"><img src="images/IMG17.jpg"></span>
  </div>
</div>
<br>
<br>
 
  <script>
    const counters = document.querySelectorAll('.count');
    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = Math.ceil(target / 50);

        if (count < target) {
          counter.innerText = count + increment;
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = target + "+";
        }
      };
      updateCount();
    });
  </script>
  </div>
 <?php include 'footer.php';
 ?>

</body>
</html>
