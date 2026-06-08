<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Help Desk Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet">
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
    body { display:flex; min-height:100vh; background:#f5f5f5; color:#333; }

    /* Sidebar */
    .sidebar { width:240px; background:linear-gradient(180deg,#b674ec,#ab56cc,#ca74ec); color:#fff; display:flex; flex-direction:column; justify-content:space-between; padding:20px 0; }
    .logo { text-align:center; margin-bottom:30px; }
    .logo i { font-size:2rem; }
    .logo-text { display:block; margin-top:10px; font-size:1.3rem; font-weight:bold; }
    .sidebar ul { list-style:none; padding:0; }
    .sidebar-link {
      display:flex; align-items:center; color:#fff; padding:12px 25px; text-decoration:none; border-radius:8px;
      transition:background 0.3s ease, transform 0.2s, color 0.3s ease;
    }
    .sidebar-link i { margin-right:15px; transition: color 0.3s ease; }
    .sidebar-link:hover {
      background-color:#fff;
      color:#ab56cc;
      transform:translateX(4px);
    }
    .sidebar-link:hover i { color:#ab56cc; }


    /* Logout */
    .logout {
      display:flex; align-items:center; justify-content:center; padding:15px; background-color:#fff; color:#ab56cc;
      cursor:pointer; border-radius:8px; transition: transform 0.3s ease, box-shadow 0.3s ease; margin:10px; font-weight:600;
    }
    .logout i { margin-right:10px; }
    .logout:hover { transform:translateY(-3px); box-shadow:0 6px 16px rgba(171,86,204,0.4); }

    /* Main Content */
    .main { flex:1; padding:40px; overflow-y:auto; }
    header { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; }
    header h1 { font-size:2rem; color:#ab56cc; }
    .search-profile { display:flex; align-items:center; gap:15px; }
    .search-profile input {
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 20px;
      outline: none;
      font-size: 0.9rem;
      background-color: #fff;
      color: #333;
    }
    .search-profile input:focus {
      border-color: #888;
      box-shadow: none;
    }

    /* Profile picture circle */
    .profile-pic {
      width: 40px;
      height: 40px;
      border-radius: 50%; /* makes it circular */
      object-fit: cover;  /* fills the circle nicely */
      border: 2px solid #ab56cc; /* optional border */
    }
    .role { font-weight:600; color:#ab56cc; }

    /* Action Tabs */
    .actions { display:flex; gap:30px; margin-top:50px; flex-wrap:wrap; }
    .action-tab { flex:1 1 400px; padding:30px 40px; border-radius:16px; color:#fff; text-align:left; cursor:pointer; transition:transform 0.3s ease, box-shadow 0.3s ease; font-size:1.4rem; font-weight:700; display:flex; flex-direction:column; justify-content:center; min-height:120px; }
    .action-tab i { margin-bottom:10px; font-size:2rem; }
    .action-tab p { font-size:0.95rem; font-weight:400; margin-top:5px; }
    .action-tab:hover { transform:translateY(-5px); box-shadow:0 8px 20px rgba(0,0,0,0.2); }

    /* Action Tab Colors */
    .theme { background:linear-gradient(135deg,#b674ec,#ab56cc); }
    .skyblue { background-color:#3498db; }
    .green { background-color:#2ecc71; }
    .darkpurple { background-color:#5a2d82; }

    @media (max-width:900px) { 
      .actions { flex-direction:column; gap:20px; } 
      header { flex-direction:column; gap:15px; } 
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <i class="fa-solid fa-user-shield"></i>
      <span class="logo-text">Admin Panel</span>
    </div>
    <ul>
      <li><a href="manage-dashboard.html" class="sidebar-link"><i class="fa-solid fa-users"></i> Manage Users</a>
      <li><a href="admin-complain.html" class="sidebar-link"><i class="fa-solid fa-file-circle-exclamation"></i> Complaints</a></li>
      <li><a href="#" class="sidebar-link"><i class="fa-solid fa-user-lock"></i> Roles & Permissions</a></li>
      <li><a href="#" class="sidebar-link"><i class="fa-solid fa-file-lines"></i> System Logs</a></li>
    </ul>
    <a href="logout_admin.php" class="logout">
    <i class="fa-solid fa-right-from-bracket"></i>
      Logout
  </a>

  </aside>

  <div class="main">
    <header>
      <h1>HELP DESK ADMIN</h1>
      <div class="search-profile">
        <input type="text" placeholder="Search...">
        <img src="profile.png" alt="Admin" class="profile-pic">
        <span class="role">Admin</span>
      </div>
    </header>

    <!-- Action Tabs -->
    <section class="actions">
      <div class="action-tab theme">
        <i class="fa-solid fa-users"></i>
        Manage Users
        <p>Control and organize all user accounts</p>
      </div>
      <div class="action-tab skyblue">
        <i class="fa-solid fa-file-circle-exclamation"></i>
        Complaints
        <p>Review and resolve student complaints</p>
      </div>
      <div class="action-tab green">
        <i class="fa-solid fa-user-lock"></i>
        Roles & Permissions
        <p>Control who can access what in the system</p>
      </div>
      <div class="action-tab darkpurple">
        <i class="fa-solid fa-file-lines"></i>
        System Logs
        <p>Monitor system activity and changes</p>
      </div>
    </section>
  </div>
</body>
</html>
