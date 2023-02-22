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