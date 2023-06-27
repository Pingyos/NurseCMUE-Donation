<style>
    table.wrap-box {
        width: 100%;
        text-align: left;
        line-height: 97%;
    }

    table.wrap-top {
        width: 100%;
        text-align: left;
        line-height: 97%;
    }

    table.wrap-content,
    table.wrap-total {
        width: 100%;
        text-align: left;
        line-height: 97%;
    }

    table.wrap-content tr th {
        font-weight: bold;
        text-align: center;
        background-color: #eee;
    }

    table.wrap-content tr td {
        border-bottom-color: #ddd;
        border-bottom-style: solid;
        border-bottom-width: 0.5px;
    }

    table.wrap-total tr td {
        text-align: right;
    }

    .line-top {
        border-top: 1px solid #ccc;
    }

    .line-bottom {
        border-bottom: 1px solid #ccc;
    }

    .line-left {
        border-left: 1px solid #ccc;
    }

    .line-right {
        border-right: 1px solid #ccc;
    }

    .header-title {
        font-size: 22px;
        font-weight: bold;
    }
</style>
<table class="wrap-box" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width: 60%;"><span><?= $company['company_name'] ?></span>
            <br /> Chiang Mai Universty
            <br /> 239 ถนนห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200
            <br /> 239 HuayKaew Road, Muang District, Chiang Mai, 50200
            <br /> โทรศัพท์/Tel 053-943130
            <br /> เลขที่ประจำตัวผู้เสียภาษี/Taxpayer identification Number 0994000423179
        </td>
        <td style="text-align: right;width: 40%;"><span>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</span>
            <br /> Faculty of Nurseing, CMU
            <br />110/406 คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ ถนนอินทวโรรส ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200
            <br />110/406 Inthawaroros Road, Suthep, Chiang Mai 50200
            <br /> โทรศัพท์/Tel 053-949075
        </td>
    </tr>
</table>
<div class="line"></div>
<table class="wrap-box line-top" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:70%;">
            <table class="wrap-top" cellpadding="3" cellspacing="0">
                <tr>
                    <td style="width:20%;"><b>ชื่อ/Name</b></td>
                    <td><?= $document['company_name'] ?></td>
                </tr>
                <tr>
                    <td style="width:20%;"><b>ที่อยู่/Address</b></td>
                    <td><?= nl2br($document['contact_address']) ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="wrap-top" cellpadding="3" cellspacing="0">
                <tr>
                    <td style="width:25%;"><b>เลขที่เอกสาร</b></td>
                    <td style="width:75%;"><?= $document['doc_no'] ?></td>
                </tr>
                <tr>
                    <td style="width:20%;"><b>วันที่</b></td>
                    <td style="width:75%;"><?php
                                            function toDateThai($d)
                                            {
                                                $m = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                                $e = explode("/", $d);
                                                $r = $e[0] . " " . $m[(int)$e[1]] . " " . ($e[2] + 543);
                                                return $r;
                                            }
                                            $date_today = date("d/m/Y");
                                            echo "" . toDateThai($date_today);
                                            ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="wrap-box" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:70%;">
            <table class="wrap-box" cellpadding="3" cellspacing="0">
                <tr>
                    <td style="width:90%;"><b>รายละเอียด</b></td>
                </tr>
                <?php for ($i = $start_page; $i < $last_page; $i++) : ?>
                    <tr>
                        <td><?= $document['products'][$i]['name'] ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        </td>
        <td>
            <table class="wrap-top" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:35%;"><b>จำนวนเงิน/Amount</b></td>
                </tr>
                <tr>
                    <td style="width:75%;"><?php echo number_format($document['grand_total'], 2); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="wrap-total" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width: 47%; font-weight: bold;"> จำนวนเงินรวม/Total</td>
        <td style="width: 30%;"><?php echo number_format($document['grand_total'], 2); ?> </td>
    </tr>
</table>
<table class="wrap-box " cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:100%;">
            <table class="wrap-box" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:100%;"><b>รวมทั้งหมด <?php echo number_format($document['grand_total'], 2); ?> บาท (<?= $grand_total_text ?>)/Tatal Amouunt Received <?php echo number_format($document['grand_total'], 2); ?> Baht (<?= $grand_total_text ?>)</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="wrap-box " cellpadding="0" cellspacing="0">
    <tr>
        <td style="width:100%;">
            <table class="wrap-box" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:100%;"><b>ชำระเงินจำนวน <?php echo number_format($document['grand_total'], 2); ?> บาท (<?= $grand_total_text ?>)/Tatal Amouunt Received <?php echo number_format($document['grand_total'], 2); ?> Baht (<?= $grand_total_text ?>)</b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<table class="wrap-box" cellpadding="0" cellspacing="0">
    <tr>
        <td style="width: 75%;">
            <table class="wrap-signature" cellpadding="0" cellspacing="0">
                <tr>
                    <th style="width:20%; font-weight: bold;">ชำระด้วย/by</th>
                    <td style="width:20%;"><?= nl2br($document['payment_type']) ?></td>
                </tr>
            </table>
        </td>
        <td style="width:30%;">
            <table class="wrap-signature" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="line-signature" colspan="2" style="line-height: 100%;"></td>
                </tr>
                <tr>
                    <td colspan="2">(นางสาวชนิดา ต้นพิพัฒน์)</td>
                </tr>
                <tr>
                    <td colspan="2">เจ้าหน้าที่ผู้รับเงิน/Collector</td>
                </tr>
                <tr>
                    <td style="width: 20%;">วันที่</td>
                    <td><?php
                        function toDateThai1($d)
                        {
                            $m = array(  
                                "",
                                "มกราคม",
                                "กุมภาพันธ์",
                                "มีนาคม",
                                "เมษายน",
                                "พฤษภาคม",
                                "กรกฎาคม",
                                "สิงหาคม",
                                "กันยายน",
                                "ตุลาคม",
                                "พฤศจิกายน",
                                "ธันวาคม"
                            );
                            $e = explode("/", $d);
                            $r = $e[0] . " " . $m[(int)$e[1]] . " " . ($e[2] + 543);
                            return $r;
                        }

                        $date_today = date("d/m/Y");
                        echo "" . toDateThai1($date_today);
                        ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>




<?php if ($count == $curr_page) : ?>

    <?php if (!empty($document['remark'])) : ?>
        <table class="wrap-box" cellpadding="0" cellspacing="0">
            <tr>
                <td><b>หมายเหตุ</b><br />
                    <?php echo nl2br($document['remark']); ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>

<?php endif; ?>