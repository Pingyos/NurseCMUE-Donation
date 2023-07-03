<?php
session_start();

// Check if session login_info is set
if (!isset($_SESSION['login_info'])) {
    header('Location: login.php');
    exit;
} else {
    $json = $_SESSION['login_info'];
}

// Check for inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 2000)) { //  2000seconds = 33 minutes
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: login.php'); // Redirect to login.php
    exit;
}

// Update last activity time
$_SESSION['last_activity'] = time();
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>

    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>

        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

            </div>
        </div>
    </div>
</body>
<?php require_once 'scripts.php'; ?>

</html>