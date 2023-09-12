<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="display: flex; align-items: center;">
            <img src="images/logo.png" alt="" style="width: 90px; height: 90px;">
            <span>
                <h4 style="margin-left: 10px;">E-Donation</h4>
                <h5 style="margin-left: 10px;">NurseCMU</h5>
            </span>
        </a>
        <button class="navbar-toggler" type="button" id="navbarToggleBtn" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const navbarToggleBtn = document.getElementById("navbarToggleBtn");
                const navbarNav = document.getElementById("navbarNav");

                navbarToggleBtn.addEventListener("click", function() {
                    if (navbarNav.classList.contains("show")) {
                        navbarNav.classList.remove("show");
                    } else {
                        navbarNav.classList.add("show");
                    }
                });
            });
        </script>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php">หน้าหลัก</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php#section_2">บริจาค</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php#section_4">คู่มือการบริจาค</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="invoice.php">รายนามผู้บริจาค</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link " href="service.php">สิทธิประโยชน์</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php#section_4">ติดต่อเรา</a>
                </li>

            </ul>
        </div>
    </div>
</nav>