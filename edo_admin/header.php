<?php
// // Check if session is not already started
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// // Check if session login_info is set
// if (!isset($_SESSION['login_info'])) {
//     header('Location: login.php');
//     exit;
// } else {
//     $json = $_SESSION['login_info'];
// }

// // Check for inactivity
// if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) { //  2000 seconds = 33 minutes
//     session_unset(); // Unset all session variables
//     session_destroy(); // Destroy the session
//     header('Location: login.php'); // Redirect to login.php
//     exit;
// }
// // Update last activity time
// $_SESSION['last_activity'] = time();
?>
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="images/admin_logo.png" alt="User Avatar">
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link"><i class="fa fa- user"></i><?php echo $json['firstname_EN']; ?></a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>