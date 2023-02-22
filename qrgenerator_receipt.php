<!doctype html>
<html lang="en">

<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 mx-auto">
                    <form class="custom-form donate-form">
                       
                    </form>
                </div>

                

                    <form id="form1">
                        <div class="row">
                            <?Php
                            require_once("libcache/PromptPayQR.php");
                            require_once("connection.php");
                            $stmt = $conn->query("SELECT * FROM receipt ORDER BY id DESC LIMIT 1");
                            $row = $stmt->fetch();
                            $amount = $row['rec_money'];

                            $PromptPayQR = new PromptPayQR(); // new object
                            $PromptPayQR->size = 7; // Set QR code size to 8
                            $PromptPayQR->id = '5665690444'; // PromptPay ID
                            $PromptPayQR->amount = $amount; // Set amount (not necessary)
                            echo '<img src="' . $PromptPayQR->generate() . '" />';
                            ?>
                        </div>
                    </form>
           
                </div>
            </div>
        </div>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="service/province.service.js" type="text/javascript"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // show/hide forms based on selected radio button
            $('input[type="radio"][name="DonationFrequency"]').change(function() {
                if ($(this).attr('id') == 'cancel') {
                    $('#form1').show();
                    $('#form2').hide();
                } else if ($(this).attr('id') == 'take') {
                    $('#form2').show();
                    $('#form1').hide(); // hide form1
                }
            });

            // pre-select the "cancel" button
            $('#cancel').prop('checked', true);
        });
    </script>

    <script>
        function showInput(selectElement) {
            var inputElement = document.getElementById("name_Title_other");
            if (selectElement.value === "other") {
                inputElement.style.display = "block";
                inputElement.setAttribute("required", true);
            } else {
                inputElement.style.display = "none";
                inputElement.removeAttribute("required");
            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="service/province.service.js" type="text/javascript"></script>

</body>

</html>