<?php
require '../database_connection.php';
require('../TCPDF/tcpdf.php');

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

function convertToEnglish($number)
{
	$ones = array(
		0 => 'zero',
		1 => 'one',
		2 => 'two',
		3 => 'three',
		4 => 'four',
		5 => 'five',
		6 => 'six',
		7 => 'seven',
		8 => 'eight',
		9 => 'nine',
		10 => 'ten',
		11 => 'eleven',
		12 => 'twelve',
		13 => 'thirteen',
		14 => 'fourteen',
		15 => 'fifteen',
		16 => 'sixteen',
		17 => 'seventeen',
		18 => 'eighteen',
		19 => 'nineteen'
	);

	$tens = array(
		2 => 'twenty',
		3 => 'thirty',
		4 => 'forty',
		5 => 'fifty',
		6 => 'sixty',
		7 => 'seventy',
		8 => 'eighty',
		9 => 'ninety'
	);

	$number = intval($number);

	if ($number < 20) {
		return $ones[$number];
	}

	if ($number < 100) {
		$tensDigit = intval($number / 10);
		$onesDigit = $number % 10;

		$result = $tens[$tensDigit];

		if ($onesDigit > 0) {
			$result .= '-' . $ones[$onesDigit];
		}

		return $result;
	}

	if ($number < 1000) {
		$hundredsDigit = intval($number / 100);
		$remainder = $number % 100;

		$result = $ones[$hundredsDigit] . ' hundred';

		if ($remainder > 0) {
			$result .= ' ' . convertToEnglish($remainder);
		}

		return $result;
	}

	$suffixes = array(
		1000 => 'thousand',
		1000000 => 'million',
		1000000000 => 'billion',
		1000000000000 => 'trillion',
		1000000000000000 => 'quadrillion',
		1000000000000000000 => 'quintillion'
	);

	foreach (array_reverse($suffixes, true) as $suffix => $suffixText) {
		if ($number >= $suffix) {
			$quotient = intval($number / $suffix);
			$remainder = $number % $suffix;

			$result = convertToEnglish($quotient) . ' ' . $suffixText;

			if ($remainder > 0) {
				$result .= ' ' . convertToEnglish($remainder);
			}

			return $result;
		}
	}

	return 'Number out of range';
}
function generateReceiptNumber($numid)
{
	$receipt_number = str_pad($numid, 4, '0', STR_PAD_LEFT);
	return $receipt_number;
}
$numid = $inv_mst_data_row['id'];
$receipt_number = generateReceiptNumber($numid);




$id = $_GET['id'];

$inv_mst_query = "SELECT T1.id, T1.name_title, T1.rec_name, T1.rec_surname, T1.rec_tel, T1.rec_email, T1.provinces, T1.districts,T1.rec_idname,T1.address,T1.road,T1.amphures,T1.zip_code, T1.rec_date_out, T1.edo_name, T1.rec_money, T1.payby, T1.edo_pro_id, T1.edo_description, T1.edo_objective FROM receipt_offline T1 WHERE T1.id='" . $id . "' ";
$inv_mst_results = mysqli_query($con, $inv_mst_query);
$count = mysqli_num_rows($inv_mst_results);
if ($count > 0) {
	$inv_mst_data_row = mysqli_fetch_array($inv_mst_results, MYSQLI_ASSOC);

	// Get the Thai date and month name from the database
	$rec_date_out = $inv_mst_data_row['rec_date_out'];
	$rec_day = date("d", strtotime($rec_date_out));
	$rec_month = $thai_months[date("m", strtotime($rec_date_out))];
	$rec_monen = $english_months[date("m", strtotime($rec_date_out))];
	$rec_yearen = date("Y", strtotime($rec_date_out));
	$rec_yearth = date('Y') + 543;

	$amount = $inv_mst_data_row['rec_money']; // assuming the column name for the amount is 'rec_money'
	$thaiBaht = convertToThaiBaht($amount);

	$number = $inv_mst_data_row['rec_money']; // assuming the column name for the amount is 'rec_money'
	$EngBaht = convertToEnglish($number);

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
	$pdf->SetFont('thsarabunnew', '', 13);
	$pdf->SetMargins(8, 10, 8);
	$pdf->SetAutoPageBreak(true, 2); // 10 เป็นค่าขอบด้านล่างที่คุณต้องการเพิ่ม
	// คำสั่งที่ใช้สร้างเนื้อหาในเอกสาร PDF ต่อจากนี้...
	$pdf->AddPage(); //default A4
	// ลายเช็ตคณบดี
	$img = 'TCPDF/';
	$cellWidth = 200;  // กำหนดความกว้างของเซลล์
	$imageWidth = 20;  // กำหนดความกว้างของรูปภาพ

	// คำนวณตำแหน่ง X ให้รูปภาพอยู่ตรงกลางของเซลล์
	$x = $pdf->GetX() + ($cellWidth - $imageWidth) / 2;
	// คำนวณตำแหน่ง Y ให้รูปภาพอยู่ด้านบนของเซลล์
	$y = $pdf->GetY() + 240;

	$pdf->Image($img, $x, $y, $imageWidth, 15, '', '', '', false, 300, '', false, false, 0, false, false, false);
	// 

	// ลายเช็นพี่เจี๊ยบ
	$img = 'TCPDF/';
	$cellWidth = 355;  // กำหนดความกว้างของเซลล์
	$imageWidth = 30;  // กำหนดความกว้างของรูปภาพ

	// คำนวณตำแหน่ง X ให้รูปภาพอยู่ตรงกลางของเซลล์
	$x = $pdf->GetX() + ($cellWidth - $imageWidth) / 2;
	// คำนวณตำแหน่ง Y ให้รูปภาพอยู่ด้านบนของเซลล์
	$y = $pdf->GetY() + 85;

	$pdf->Image($img, $x, $y, $imageWidth, 25, '', '', '', false, 300, '', false, false, 0, false, false, false);
	// 

	// ลายน้ำ
	$img = 'TCPDF/cmulogo20.png';
	$cellWidth = 196;  // กำหนดความกว้างของเซลล์
	$imageWidth = 150;  // กำหนดความกว้างของรูปภาพ

	// คำนวณตำแหน่ง X ให้รูปภาพอยู่ตรงกลางของเซลล์
	$x = $pdf->GetX() + ($cellWidth - $imageWidth) / 2;
	// คำนวณตำแหน่ง Y ให้รูปภาพอยู่ด้านบนของเซลล์
	$y = $pdf->GetY() - 10;

	$pdf->Image($img, $x, $y, $imageWidth, 150, '', '', '', false, 300, '', false, false, 0, false, false, false);
	// 

	// logo
	$img = 'TCPDF/cmulogo.png';
	$cellWidth = 196;  // กำหนดความกว้างของเซลล์
	$imageWidth = 25;  // กำหนดความกว้างของรูปภาพ

	// คำนวณตำแหน่ง X ให้รูปภาพอยู่ตรงกลางของเซลล์
	$x = $pdf->GetX() + ($cellWidth - $imageWidth) / 2;
	// คำนวณตำแหน่ง Y ให้รูปภาพอยู่ด้านบนของเซลล์
	$y = $pdf->GetY() - 8;

	$pdf->Image($img, $x, $y, $imageWidth, 25, '', '', '', false, 300, '', false, false, 0, false, false, false);

	// 

	// logo logo
	$img = 'TCPDF/cmulogo.png';
	$cellWidth = 196;  // กำหนดความกว้างของเซลล์
	$imageWidth = 25;  // กำหนดความกว้างของรูปภาพ

	// คำนวณตำแหน่ง X ให้รูปภาพอยู่ตรงกลางของเซลล์
	$x = $pdf->GetX() + ($cellWidth - $imageWidth) / 2;
	// คำนวณตำแหน่ง Y ให้รูปภาพอยู่ด้านบนของเซลล์ โดยเพิ่มค่า Y ที่ได้จากบรรทัดก่อนหน้านี้
	$y += 160;

	$pdf->Image($img, $x, $y, $imageWidth, 25, '', '', '', false, 300, '', false, false, 0, false, false, false);

	// 



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
			ใบเสร็จรับเงิน/Receipt
		</td>
	</tr>

	<tr>
	<td>
		Chiang Mai University
	</td>
	<td align="right">
		ต้นฉบับ/Original
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
	<td>เบอร์โทร 053-943130</td>
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
		<td><b>ชื่อ/Name : </b>' . $inv_mst_data_row['name_title'] . ' ' . $inv_mst_data_row['rec_name'] . ' ' . $inv_mst_data_row['rec_surname'] . ' </td>
		<td align="right"><b>เลขที่ใบเสร็จ/Receipt : </b>' . $datetime_be . '-' . $inv_mst_data_row['edo_pro_id'] . '-E' . generateReceiptNumber($inv_mst_data_row['id']) . '</td>
	</tr>

	<tr>
		<td><b>ที่อยู่/Address : </b>' . $inv_mst_data_row['address'] . ' ' . $inv_mst_data_row['road'] . ' ' . $inv_mst_data_row['districts'] . ' ' . $inv_mst_data_row['amphures'] . ' ' . $inv_mst_data_row['provinces'] . ' </td>
		<td align="right"><b>วันที่เอกสาร/Date : </b>' . $rec_day . ' ' . $rec_month . ' ' . $rec_yearth . ' / ' . $rec_day . ' ' . $rec_monen . ' ' . $rec_yearen . '</td>
	</tr>
	
	<tr>
		<tdalign="right" colspan="2"><b>รายละเอียดโครงการ/Description</b><br>' . $inv_mst_data_row['edo_description'] . ' </tdalign=>
	</tr>

	<tr>
		<td align="right" colspan="2" ><b>จำนวนเงิน/Amount : </b>' . $inv_mst_data_row['rec_money'] . ' บาท </td>
	</tr>
	<br>
	<tr>
		<td style="text-align: right;"><b>จำนวนเงินรวม/Total</b></td>
		<td align="right">' . $inv_mst_data_row['rec_money'] . ' บาท</td>
	</tr>
	<br>
	<tr>
		<td colspan="2" ><b>ชำระจำนวนเงิน : ' . $inv_mst_data_row['rec_money'] . ' บาท (' . convertToThaiBaht($inv_mst_data_row['rec_money']) . ') / Tatal Amount Received ' . $inv_mst_data_row['rec_money'] . ' Baht (' . convertToEnglish($inv_mst_data_row['rec_money']) . ')</b></td>
	</tr>
	<tr>
		<td colspan="2" ><b>ชำระเงินจำนวน : ' . $inv_mst_data_row['rec_money'] . ' บาท (' . convertToThaiBaht($inv_mst_data_row['rec_money']) . ') / Tatal Amount Received ' . $inv_mst_data_row['rec_money'] . ' Baht (' . convertToEnglish($inv_mst_data_row['rec_money']) . ')</b></td>
	</tr>
	<br>
	<tr>
		<td>
			<b>ชำระด้วย/Pay by : </b>' . $inv_mst_data_row['payby'] . ' 
		</td>
	</tr>
	<br>
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
	<tr>

	<br>
	<br>
	<br>
	<br>
	<br>

	</tr>
	<tr>
		<td colspan="2" style="text-align: center; font-size: 18px;"><b>อนุโมทนาบัตร</b></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><b>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</b></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">ได้รับเงินบริจาคเป็นจำนวนเงิน ' . $inv_mst_data_row['rec_money'] . ' บาท (' . convertToThaiBaht($inv_mst_data_row['rec_money']) . ')</td>
	</tr>
	<tr>
		<td><b>จาก : </b>' . $inv_mst_data_row['name_title'] . ' ' . $inv_mst_data_row['rec_name'] . ' ' . $inv_mst_data_row['rec_surname'] . ' </td>
	</tr>
	<tr>
		<td colspan="2" ><b>วัตถุประสงค์  </b><br>' . $inv_mst_data_row['edo_objective'] . ' </td>
	</tr>
	<br>
	<tr>
		<td colspan="2" style="text-align: center;">ขอให้กุศลผลบุญจากการบริจาคของท่านในครั้งนี้<br>โปรดดลบันดาลให้ท่านประสบแต่ความสุขสวัสดี ปราศจากทุกข์โศกโรคภัย<br>ปราถนาสิ่งใดให้สำเร็จสมดังประสงค์ทุกประการ<br>ให้ไว้ ณ วันที่  ' . $rec_day . ' ' . $rec_month . ' ' . $rec_yearth . '</td>
	</tr>
	<br>
	<br>
	<br>
	<tr>
		<td colspan="2" style="text-align: center;"><b>(ผู้ช่วยศาสตราจารย์ ดร.ธานี แก้วธรรมานุกูล)<br>คณบดีคณะพยาบาลศาสตร์</b></td>
	</tr>
	<tr>
	<td><b>เลยที่ใบเสร็จ : </b>' . $datetime_be . '-' . $inv_mst_data_row['edo_pro_id'] . '-E' . generateReceiptNumber($inv_mst_data_row['id']) . '</td>
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
