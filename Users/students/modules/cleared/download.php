<?php  date_default_timezone_set('Asia/Manila');
include('../../../includes/connection.php');
require_once("../../../libraries/tcpdf/tcpdf.php");

$cleared = array();
$stud_id = mysqli_real_escape_string($db, trim($_GET['IDNumber']));
$reference_no = '';
$fname = '';
$lname = '';
$dateToday = '';
$semester = '';
$username = '';
$year_level = '';
$course_name = '';
$school_year = '';
$qr_image = '';

$query = "
SELECT req.*, stud.fname,stud.lname, c.course_name, stud.year_level, st.fname as st_fname, st.lname as st_lname, i.item_name, stud.username
FROM request_transaction as req
LEFT JOIN students as stud ON stud.student_id = req.student_id
LEFT JOIN staff as st ON st.staff_id = req.staff_id
LEFT JOIN course as c ON c.course_id = st.dean_course_id
LEFT JOIN items as i ON i.item_id = st.item_id
WHERE req.student_id = '".$_SESSION['student']['student_id']."'
and after_status = '1'
";

$result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);

if (mysqli_num_rows($result) > 0) {
    while(  $row = mysqli_fetch_array($result)){
     $temp_arr = array();


     $semester = "";
     if($row['sem'] == 1){
        $semester= '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">1st Semester</span>';
 
     }
     if($row['sem'] == 2){
        $semester = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">2nd Semester</span>';
 
     }
     if($row['sem'] == 3){
        $semester = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Summer</span>';
   
       }

     $fname        =  $row['fname'];
     $lname        = $row['lname'];
     $dateToday    = date("M j, Y", strtotime(date("Y-m-d")));
     $reference_no = $row['date_cleared'];
     $username     = $row['username'];
     $year_level   = $row['year_level'];
     $course_name  = $row['course_name'];
     $school_year  = $row['school_year'];
     $qr_image     = $row['qr_image'];

     $temp_arr['st_fname']  = $row['st_fname'];
     $temp_arr['st_lname']  = $row['st_lname'];
     $temp_arr['item_name'] = $row['item_name']? $row['item_name'] : '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">'.$row['course_name'].' Dean</span>';
     
     $cleared[] = $temp_arr;

    }
}


   // For the contatanation of the qr/bar code
   $q   =  substr("$reference_no",0,4);
   $w   =  substr("$reference_no",5,-12);
   $e   =  substr("$reference_no",8,-9);
   $r   =  substr("$reference_no",11,-6);
   $t   =  substr("$reference_no",14,-3);
   $y   =  substr("$reference_no",-2);

   // $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
   $concatqr = $q.$w.$e.$r.$t.$y;

// ===================== PDF =====================
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('OSA');
$pdf->SetTitle('Clearance');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15, 15, 15);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();


$d_html = '
<div>
<p style="margin: 0; padding: 0; text-align: center; line-height: 0;">
<img src="../../../assets/images/asscatlogo.png"></p><br><br>
<h1 style="margin: 0; padding: 0; text-align: center; line-height: 0;">STUDENT CLEARANCE</h1>
<p></p>

<br>
<img src="../../../faculty/modules/requests/'.$qr_image.'" style=" display: flex; margin: 0; padding: 0; line-height: 0;">
</div>
<table style="width: 50%; font-size: 12px;">
  <tr>
    <td colspan="2"><b>FILTERS:</b></td>
  </tr>
     <tr>
     <td>Name:</td>
          <td><b>'.$fname.' &nbsp;'.$lname.'</b></td>
     </tr>
     <tr>
     <td>ID Number:</td>
          <td><b>'.$username.'</b></td>
     </tr>
     <tr>
     <td>Course:</td>
     <td><b>'.$course_name.' - '.$year_level.'</b></td>
     </tr>
';

$d_html .='
     <tr>
     <td>Semester:</td>
     <td><b>'.$semester.'</b></td>
     </tr>
     <tr>
     <td>Academic Year</td>
     <td><b>'.$school_year.'</b></td>
     </tr>
</table>

<br><br>
  <table border="1" style=" padding: 5px;">
        <tr style="border: 1px solid black;">
            <th style="font-size: 15px; padding: 10%; text-align: center;  font-weight: bold;"><b>Designation</b></th>
            <th style="font-size: 15px;  padding: 10%; text-align: center;  font-weight: bold;"><b>Faculty Name</b></th>
            <th style="font-size: 15px;  padding: 10%; text-align: center;  font-weight: bold;"><b>Status</b></th>
        </tr>

';

if ($cleared) {
    foreach ($cleared as $cl) {

$d_html .= '
<tr>
<td style="font-size: 15px; text-align: center;  padding: 10%;  font-weight: bold;">'.$cl['item_name'].'</td>
<td style="font-size: 15px; text-align: center;  padding: 10%;">&nbsp;'.$cl['st_fname'].'&nbsp;'.$cl['st_lname'].'&nbsp;&nbsp;</td>
<td style="font-size: 15px; text-align: center;  padding: 10%;">&nbsp;CLEARED&nbsp;&nbsp;</td>
</tr>';

    }

}else {
$d_html = '
<tr class="text-center">
<td class="text-start text-danger" colspan="11">No Record Found</td>
</tr>';

}

$d_html .= '

</table>';

$d_html .= ' </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>';
$d_html .='<div style="text-align: center; margin-top: 90%; font-size: 15px;">
    <p>________________________</p>
    <p>Signature</p>
</div>';

// Set some content to print
$html = <<<EOD

$d_html

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Clearance.pdf', 'I');





?>

