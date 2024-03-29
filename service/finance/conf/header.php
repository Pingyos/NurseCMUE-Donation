<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        $firstname_EN = $loginInfo['firstname_EN'];
                        $imageFileName = "../assets/images/profile/" . $firstname_EN . ".jpg";
                        if (file_exists($imageFileName)) {
                            echo '<img src="' . $imageFileName . '" alt width="35" height="35" class="rounded-circle">';
                        } else {
                            echo '<img src="../assets/images/profile/default.jpg" alt width="35" height="35" class="rounded-circle">';
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                <?php
                                $firstname_EN = $loginInfo['firstname_EN'];
                                $imageFileName = "../assets/images/profile/" . $firstname_EN . ".jpg";
                                if (file_exists($imageFileName)) {
                                    echo '<img src="' . $imageFileName . '" alt width="100" height="100" class="rounded-circle">';
                                } else {
                                    echo '<img src="../assets/images/profile/default.jpg" alt width="100" height="100" class="rounded-circle">';
                                }
                                ?> <div class="ms-3">
                                    <h5 class="mb-1 fs-3"><?php echo $loginInfo['prename_id'] . " " . $loginInfo['firstname_EN'] . " " . $loginInfo['lastname_EN'] . "<br>"; ?></h5>
                                    <span class="mb-1 d-block"><?php echo $loginInfo['organization_name_EN']; ?></span>
                                    <p class="mb-0 d-flex align-items-center gap-2">
                                        <i class="ti ti-mail fs-4"></i> <?php echo $loginInfo['cmuitaccount']; ?>
                                    </p>
                                </div>
                            </div>
                            <a href="user_view.php" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">ข้อมูลส่วนตัว</p>
                            </a>

                            <a href="../finance/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>