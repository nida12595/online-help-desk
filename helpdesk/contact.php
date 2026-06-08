<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Contact Portal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #ffffff; 
      margin: 0;
      padding: 0;
    }

    header {
      text-align: center;
      background: #b674ec; 
      color: white;
      padding: 20px;
    }

    header h1 {
      margin: 0;
      font-size: 28px;
    }

    .search-container {
      text-align: center;
      margin: 20px;
    }

    .search-container input {
      padding: 10px;
      width: 60%;
      max-width: 400px;
      border-radius: 20px;
      border: 1px solid #b674ec; 
      font-size: 16px;
    }

    .faculty-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
      max-width: 1200px;
      margin: auto;
      color: #502c4d;
    }

    .faculty-card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      text-align: center;
      padding: 20px;
      transition: transform 0.2s;
    }

    .faculty-card:hover {
      transform: translateY(-5px);
    }

    .faculty-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
    }

    .faculty-card h3 {
      margin: 10px 0 5px;
      font-size: 20px;
      color: #502c4d;
    }

    .faculty-card p {
      margin: 5px 0;
      font-size: 14px;
      color: #555;
    }

    .faculty-card a {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 15px;
      background: #b674ec; 
      color: white;
      text-decoration: none;
      border-radius: 20px;
      font-size: 14px;
      transition: background 0.3s;
    }

    .faculty-card a:hover {
      background: #8c4ecb; 
    }

    @media(max-width: 600px) {
      .search-container input {
        width: 90%;
      }
    }
    header {
  position: relative;
}

.back-btn {
  position: absolute;
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
  background: white;
  color: #b674ec;
  border: none;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 14px;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
}

.back-btn:hover {
  background: #f2e6fb;
}
  </style>
</head>
<body>

  <header>
  <button onclick="goBack()" class="back-btn">
    ← Back
  </button>
  <h1>Department of Artificial Intelligence</h1>
</header>

  <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by name or subject..." onkeyup="searchFaculty()">
  </div>

  <div class="faculty-grid" id="facultyGrid">
    
    <div class="faculty-card">
      <h3>Dr.P Suman Prakash</h3>
      <p>Subject: Operating Systems</p>
      <p>Email: suman@college.edu</p>
      <p>Phone: +91 94938 69760</p>
      <a href="mailto:suman@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Dr.M.Janardhan</h3>
      <p>Subject: Database Management System and PL/SQL</p>
      <p>Email: janardhan@college.edu</p>
      <p>Phone: +91 97014 28654</p>
      <a href="mailto:janardhan@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof A.David Donald</h3>
      <p>Subject: Python Programming</p>
      <p>Email: david@college.edu</p>
      <p>Phone: +91 87129 70221</p>
      <a href="mailto:david@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof Mahendra</h3>
      <p>Subject: JavaScript, HTML&CSS </p>
      <p>Email: mahendra@college.edu</p>
      <p>Phone: +91 79891 55341</p>
      <a href="mailto:mahendra@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof K.Sandhya Rani</h3>
      <p>Subject: AI </p>
      <p>Email: sandhya@college.edu</p>
      <p>Phone: +91 87122 51292</p>
      <a href="mailto:sandhya@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof Swarajya Lakshmi</h3>
      <p>Subject: Machine Learning </p>
      <p>Email: swarajya@college.edu</p>
      <p>Phone: +91 81069 39478</p>
      <a href="mailto:swarajya@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof K.Vinod Kumar Reddy</h3>
      <p>Subject: Java, ADSA, C Language  </p>
      <p>Email: vinod@college.edu</p>
      <p>Phone: +91 99667 50995</p>
      <a href="mailto:vinod@college.edu">Contact</a>
    </div>

    <div class="faculty-card">
      <h3>Prof Jaya Babu</h3>
      <p>Subject: OOPS(Java) </p>
      <p>Email: jaya@college.edu</p>
      <p>Phone: +91 77998 08808</p>
      <a href="mailto:jaya@college.edu">Contact</a>
    </div>
  </div>
<script>
function goBack() {
  window.history.back();
}
</script>
  <script>
    function searchFaculty() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let cards = document.getElementsByClassName("faculty-card");

      for (let i = 0; i < cards.length; i++) {
        let cardText = cards[i].innerText.toLowerCase();
        if (cardText.includes(input)) {
          cards[i].style.display = "block";
        } else {
          cards[i].style.display = "none";
        }
      }
    }
  </script>

</body>
</html>