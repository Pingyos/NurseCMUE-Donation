<?php require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>

    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>

        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="row">
                    <!-- Allbooking -->
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT COUNT(*) AS Allbooking FROM bookingall");
                    $stmt->execute();
                    $result = $stmt->fetch();
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="ti-server"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">
                                                <div class="stat-heading">Allbooking</div><span class="count"><?php echo $result['Allbooking']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Allbooking -->
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once 'scripts.php'; ?>

</html>