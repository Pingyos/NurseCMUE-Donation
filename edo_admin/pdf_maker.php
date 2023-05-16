<?php
require '../database_connection.php';
include_once('../TCPDF/tcpdf.php');

// Thai month names
$thai_months = array(
	"01" => "มกราคม",
	"02" => "กุมภาพันธ์",
	"03" => "มีนาคม",
	"04" => "เมษายน",
	"05" => "พฤษภาคม",
	"06" => "มิถุนายน",
	"07" => "กรกฎาคม",
	"08" => "สิงหาคม",
	"09" => "กันยายน",
	"10" => "ตุลาคม",
	"11" => "พฤศจิกายน",
	"12" => "ธันวาคม"
);
$english_months = array(
	"01" => "January",
	"02" => "February",
	"03" => "March",
	"04" => "April",
	"05" => "May",
	"06" => "June",
	"07" => "July",
	"08" => "August",
	"09" => "September",
	"10" => "October",
	"11" => "November",
	"12" => "December"
);

function convertToThaiBaht($amount)
{
	$number = floatval(str_replace(',', '', $amount));
	$number = number_format($number, 2, '.', '');

	$txtnum1 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
	$txtnum2 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
	$txtnum3 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');

	$number = str_replace(',', '', $number);
	$number = explode('.', $number);
	$strlen = strlen($number[0]);
	$result = '';
	for ($i = 0; $i < $strlen; $i++) {
		$n = substr($number[0], $i, 1);
		if ($n != 0) {
			if (($i == ($strlen - 1)) && ($n == 1)) {
				$result .= 'เอ็ด';
			} elseif (($i == ($strlen - 2)) && ($n == 2)) {
				$result .= 'ยี่';
			} elseif (($i == ($strlen - 2)) && ($n == 1)) {
				$result .= '';
			} else {
				$result .= $txtnum1[$n];
			}
			$result .= $txtnum3[($strlen - $i - 1)];
		}
	}
	$result .= 'บาท';

	if (isset($number[1])) {
		$strlen = strlen($number[1]);
		for ($i = 0; $i < $strlen; $i++) {
			$n = substr($number[1], $i, 1);
			if ($n != 0) {
				if (($i == ($strlen - 1)) && ($n == 1)) {
					$result .= 'เอ็ด';
				} elseif (($i == ($strlen - 2)) && ($n == 2)) {
					$result .= 'ยี่';
				} elseif (($i == ($strlen - 2)) && ($n == 1)) {
					$result .= '';
				} else {
					$result .= $txtnum2[$n];
				}
				$result .= $txtnum3[($strlen - $i - 1) + 6];
			}
		}
		$result .= 'ถ้วน';
	} else {
		$result .= 'ถ้วน';
	}
	return $result;
}

$id = $_GET['id'];

$inv_mst_query = "SELECT T1.id, T1.rec_out, T1.rec_out_oj, T1.name_Title, T1.name_Title_other, T1.edo_pro_id,T1.rec_date, T1.rec_fullname,T1.rec_money,T1.address FROM receipt T1 WHERE T1.id='" . $id . "' ";
$inv_mst_results = mysqli_query($con, $inv_mst_query);
$count = mysqli_num_rows($inv_mst_results);
if ($count > 0) {
	$inv_mst_data_row = mysqli_fetch_array($inv_mst_results, MYSQLI_ASSOC);

	// Get the Thai date and month name from the database
	$rec_date = $inv_mst_data_row['rec_date'];
	$rec_day = date("d", strtotime($rec_date));
	$rec_month = $thai_months[date("m", strtotime($rec_date))];
	$rec_monen = $english_months[date("m", strtotime($rec_date))];
	$rec_yearen = date("Y", strtotime($rec_date));
	$rec_yearth = date('Y') + 543;

	$amount = $inv_mst_data_row['rec_money']; // assuming the column name for the amount is 'rec_money'
	$thaiBaht = convertToThaiBaht($amount);



	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
	$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont('thsarabunnew');
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetMargins(PDF_MARGIN_LEFT, '1', PDF_MARGIN_RIGHT);
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetAutoPageBreak(TRUE, 10);
	$pdf->SetFont('thsarabunnew', '', 14);
	$pdf->SetMargins(8, 8, 8);
	$pdf->AddPage(); //default A4

	// 
	date_default_timezone_set('Asia/Bangkok');
	$year = date('Y') + 543;
	$datetime_be = str_replace(date('Y'), $year, date('Y'));
	// 


	// 
	$content = '';

	$content .= '
<table>
	<tr>
		<td  >
			มหาวิทยาลัยเชียงใหม่
		</td>
		<td align="right"  >
			ใบเสร็จรับเงิน
		</td>
	</tr>

	<tr>
	<td>
		Chiang Mai University
	</td>
	<td align="right">
		ต้นฉบับ
	</td>
	</tr>

	<tr>
	<td>239 ถนนห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td>
	<td align="right">คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</td>
	</tr>

	<tr>
	<td>239 Huaykaew Road, Muang District, Chiang Mai, 50200</td>
	<td align="right">Faculty of Nursing, CMU</td>
	</tr>

	<tr>
	<td>เบอร์โทร 053-949075</td>
	<td align="right">110/406 ถนนอินทวโรรส ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td>
	</tr>

	<tr>
	<td>เลขประจำตัวผู้เสียภาษีอากร/Taxpayer identification Number </td>
	<td align="right">110/406 Inthawaroros Road, Suthep, Chiang Mai 50200</td>
	</tr>

	<tr>
	<td>099 4 00042317 9</td>
	<td align="right">เบอร์โทร 053-949075</td>
	</tr>

	<tr>
	<br>
		<td><b>ชื่อ/Name : </b>' . $inv_mst_data_row['name_Title'] . ' ' . $inv_mst_data_row['name_Title_other'] . ' ' . $inv_mst_data_row['rec_fullname'] . ' </td>
		<td align="right"><b>เลขที่ใบเสร็จ/Receipt : </b>' . $datetime_be . '-' . $inv_mst_data_row['edo_pro_id'] . '-00' . $inv_mst_data_row['id'] . '</td>
	</tr>

	<tr>
		<td><b>ที่อยู่/Address : </b>' . $inv_mst_data_row['address'] . ' </td>
		<td align="right"><b>วันที่เอกสาร/Date : </b>' . $rec_day . ' ' . $rec_month . ' ' . $rec_yearth . ' / ' . $rec_day . ' ' . $rec_monen . ' ' . $rec_yearen . '</td>
	</tr>
	

	<tr>
		<td><b>รายละเอียดโครงการ/Description</b><br>' . $inv_mst_data_row['rec_out'] . ' </td>
		<td align="right"><b>จำนวนเงิน/Amount</b><br>' . $inv_mst_data_row['rec_money'] . ' บาท</td>
	</tr>

	<tr>
		<td align="right" colspan="2" ><b>จำนวนเงินรวม/Total : </b>' . $inv_mst_data_row['rec_money'] . ' บาท (' . convertToThaiBaht($inv_mst_data_row['rec_money']) . ')</td>
	</tr>

	<tr>
		<td colspan="2" ><b>รวมทั้งหมด : </b>' . $inv_mst_data_row['rec_money'] . ' บาท</td>
	</tr>

	<tr>
		<td colspan="2" ><b>ชำระจำนวนเงิน : </b>' . $inv_mst_data_row['rec_money'] . ' บาท </td>
	</tr>
		<tr>
	<td>
		<b>ชำระด้วย/By : </b>' . $inv_mst_data_row[''] . ' </td>
	</tr>

	<tr>
		<td></td>
		<td align="right">(นางสาวชนิดา ต้นพิพัฒน์)<br>เจ้าหน้าที่ผู้รับเงิน<br>วันที่ : ' . $rec_day . ' ' . $rec_month . ' ' . $rec_yearth . '</td>
	</tr>
	<tr>
		<td colspan="2" ><b>หมายเหตุ :ใบเสร็จรับเงินจะมีผลสมบูรณ์ต่อเมื่อได้รับชำระเงินเรียบร้อยแล้วและมีลายเซ็นของผู้รับเงินครบถ้วน<br>The receipt will be valid with payment and the signature of the collector</b></td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom: solid black 1px;"></td>
	</tr>

	<br>

	<tr>
		<td colspan="2" style="text-align: center; font-size: 18px;"><b>อนุโมทนาบัตร</b></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><b>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</b></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">ได้รับเงินบริจาคเป็นจำนวนเงิน ' . $inv_mst_data_row['rec_money'] . ' บาท (' . convertToThaiBaht($inv_mst_data_row['rec_money']) . ')</td>
	</tr>
	<br>
	<tr>
		<td><b>จาก : </b>' . $inv_mst_data_row['name_Title'] . ' ' . $inv_mst_data_row['name_Title_other'] . ' ' . $inv_mst_data_row['rec_fullname'] . ' </td>
	</tr>
	<tr>
		<td colspan="2" ><b>วัตถุประสงค์  </b><br>' . $inv_mst_data_row['rec_out_oj'] . ' </td>
	</tr>
	<br>
	<tr>
		<td colspan="2" style="text-align: center;">ขอให้กุศลผลบุญจากการบริจาคของท่านในครั้งนี้<br>โปรดดลบันดาลให้ท่านประสบแต่ความสุขสวัสดี ปราศจากทุกข์โศกโรคภัย<br>ปราถนาสิ่งใดให้สำเร็จสมดังประสงค์ทุกประการ<br>ให้ไว้ ณ วันที่  ' . $rec_day . ' ' . $rec_month . ' ' . $rec_yearth . '</td>
	</tr>
	<br>
	<br>
	<tr>
		<td colspan="2" style="text-align: center;"><b>(ผู้ช่วยศาสตราจารย์ ดร.ธานี แก้วธรรมานุกูล)<br>คณบดีคณะพยาบาลศาสตร์</b></td>
	</tr>
	<tr>
	<td><b>เลยที่ใบเสร็จ : </b>' . $datetime_be . '-' . $inv_mst_data_row['edo_pro_id'] . '-' . $inv_mst_data_row['id'] . ' </td>
	<td align="right"><b>ลำดับเอกสาร : </b>' . $inv_mst_data_row['id'] . '</td>
</tr>
</table>

	';

	$pdf->writeHTML($content);

	$file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
	//$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server
	// set timezone to Bangkok
	date_default_timezone_set('Asia/Bangkok');

	$year = date('Y') + 543;

	$datetime = date('Y');
	$datetime_be = str_replace(date('Y'), $year, $datetime);
	$file_name = "NurseCMU_" . $datetime_be . "-" . $inv_mst_data_row['edo_pro_id'] . "-" . $inv_mst_data_row['id'] . ".pdf";
	ob_end_clean();

	if ($_GET['ACTION'] == 'VIEW') {
		$pdf->Output($file_name, 'I'); // I means Inline view
	} else if ($_GET['ACTION'] == 'DOWNLOAD') {
		$pdf->Output($file_name, 'D'); // D means download
	} else if ($_GET['ACTION'] == 'UPLOAD') {
		$pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
		echo "Upload successfully!!";
	}

	//----- End Code for generate pdf

} else {
	echo 'Record not found for PDF.';
}
