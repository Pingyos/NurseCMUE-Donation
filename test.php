<script>
                            var loopCount = 0;
                            var intervalId; // ประกาศตัวแปรเพื่อเก็บ ID ของ setInterval

                            function fetchData() {
                                if (loopCount < 50) {
                                    var id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
                                    var amount = "<?php echo isset($_GET['amount']) ? $_GET['amount'] : ''; ?>";
                                    var rec_idname = "<?php echo isset($_GET['rec_idname']) ? $_GET['rec_idname'] : ''; ?>";
                                    var ref1 = "<?php echo isset($_GET['ref1']) ? $_GET['ref1'] : ''; ?>";
                                    if (amount !== '' && rec_idname !== '' && ref1 !== '' && id !== '') {
                                        var data = {
                                            id: id,
                                            amount: amount,
                                            rec_idname: rec_idname,
                                            ref1: ref1
                                        };
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "data_check_receipt.php", true);
                                        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                console.log(response);
                                                if (response.message === 'success') {
                                                    swal({
                                                        title: "ชำระเงินเสร็จสิ้น",
                                                        text: "ระบบกำลังเปิดใบเสร็จ",
                                                        type: "success",
                                                        timer: 6000,
                                                        showConfirmButton: false
                                                    });
                                                    setTimeout(function() {
                                                        window.location.href = "invoice.php";
                                                    }, 6000);
                                                }
                                            }
                                        };
                                        xhr.send(JSON.stringify(data));
                                        loopCount++;
                                    } else {
                                        console.log('ไม่ได้รับข้อมูลที่เรียกใช้งานไป');
                                    }

                                    if (loopCount >= 50) {
                                        clearInterval(intervalId); // หยุดการวนลูปหลังจาก 5 ครั้ง
                                    }
                                }
                            }

                            fetchData();
                            intervalId = setInterval(fetchData, 5000); // เก็บ ID ของ setInterval
                        </script>