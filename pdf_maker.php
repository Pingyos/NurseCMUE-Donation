<?php
require 'database_connection.php';
include_once('TCPDF/tcpdf.php');

$id = $_GET['id'];

$inv_mst_query = "SELECT T1.id, T1.edo_name, T1.edo_pro_id, T1.rec_fullname,T1.rec_money,T1.address FROM receipt T1 WHERE T1.id='" . $id . "' ";
$inv_mst_results = mysqli_query($con, $inv_mst_query);
$count = mysqli_num_rows($inv_mst_results);
if ($count > 0) {
	$inv_mst_data_row = mysqli_fetch_array($inv_mst_results, MYSQLI_ASSOC);

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
	$pdf->SetFont('thsarabunnew', '', 11.8);
	$pdf->SetMargins(10, 3, 10);
	$pdf->AddPage(); //default A4

	//$pdf->AddPage('P','A5'); //when you require custome page size 

	$content = '';

	$content .= '
	<style type="text/css">
	body{
	font-size:12px;
	line-height:24px;
	font-family:"thsarabunnew", "thsarabunnew", thsarabunnew;
	color:#000;
	}
	</style>    
<table>
  <tr>
    <td colspan="2"></td>
  </tr>
</table>
	<tr><td><b>มหาวิทยาลัยเชียงใหม่</b></td>
	<td align="right"><b>ใบเสร็จรับเงิน</b></td></tr>
	<tr><td><b>Chiang Mai University</b></td>
	<td align="right"><b>ต้นฉบับ</b></td></tr>
	<tr><td>239 ถนนห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td>
	<td align="right">คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</td></tr>
	<tr><td>239 Huaykaew Road, Muang District, Chiang Mai, 50200</td>
	<td align="right">Faculty of Nursing, CMU</td></tr>
	<tr><td>เบอร์โทร 053-949075</td>
	<td align="right">110/406 ถนนอินทวโรรส ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td></tr>
	<tr><td>เลขประจำตัวผู้เสียภาษีอากร/Taxpayer identification Number 099 4 00042317 9</td>
	<td align="right">110/406 Inthawaroros Road, Suthep, Chiang Mai 50200</td></tr>

	<tr><td><b>ชื่อ : </b>' . $inv_mst_data_row['rec_fullname'] . ' </td>
	<td align="right"><b>เลขที่ใบเสร็จ: </b>' . $inv_mst_data_row['edo_pro_id'] . '</td></tr>
	<tr><td><b>ที่อยู่ : </b>' . $inv_mst_data_row['address'] . ' </td>
	<td align="right"><b>วันที่เอกสาร : </b>' . date("d-m-Y") . '</td></tr>
	<tr><td><b>รายละเอียดโครงการ</b><br>' . $inv_mst_data_row['edo_name'] . ' </td>
	<td align="right"><b>จำนวนเงิน</b><br>' . $inv_mst_data_row['rec_money'] . ' บาท</td></tr>
	<tr><td align="right"><b>จำนวนเงินรวม : </b>' . $inv_mst_data_row['rec_money'] . ' บาท</td></tr>
	<tr><td><b>รวมทั้งหมด : </b>' . $inv_mst_data_row['rec_money'] . ' </td></tr>
	<tr><td><b>ชำระจำนวนเงิน : </b>' . $inv_mst_data_row['rec_money'] . ' </td></tr>
	<tr><td><b>ชำระด้วย : </b>' . $inv_mst_data_row[''] . ' </td></tr>

	<tr><td>' . $inv_mst_data_row[''] . ' </td>
	<td align="right">(นางสาวชนิดา ต้นพิพัฒน์)<br>เจ้าหน้าที่ผู้รับเงิน</td></tr>
	<table><tr><td><b>หมายเหตู :ใบเสร็จรับเงินจะมีผลสมบูรณ์ต่อเมื่อได้รับชำระเงินเรียบร้อยแล้วและมีลายเซ็นของผู้รับเงินครบถ้วน</b></td></tr>
	</table>
	';

	$pdf->writeHTML($content);

	$file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
	//$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

	$datetime = date('dmY_hms');
	$file_name = "INV_" . $datetime . ".pdf";
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
