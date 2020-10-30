
<?php
// require_once(ROOT . '/vendor' . DS  . 'mpdf' . DS .'mpdf' . DS . 'src' . DS . 'Mpdf.php');
// $html = '<table class="table table-striped table-bordered table-hover" id="sample_" style="width:75%">                                               
// <tr>
//     <th class="hidden-phone"><b>Booking Id</b></th>
//     <td>'.$booking['view_id'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Booking Done on</b></th>
//     <td>'.gmdate('M d, Y h:i A',strtotime($booking['created_date'])).'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Booking Status</b></th>
//     <td>'.$booking['service_status']=="P"?"Pending":($booking['service_status']=="C&R"?"Cancel & Refunded":"Completed").'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Customer Name</b></th>
//     <td>'.$booking['customer']['firstName'].' '.$booking['customer']['lastName'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Service Provider Name</b></th>
//     <td>'.$booking['provider']['firstName'].' '.$booking['provider']['lastName'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Service Name</b></th>
//     <td>'.$booking['service']['title'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>City Name where service is provided</b></th>
//     <td>'.$booking['city']['name'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Service Location</b></th>
//     <td>'.$booking['service_loaction'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Booking Date</b></th>
//     <td>'.gmdate('M d, Y h:i A',strtotime($booking['booking_date'])).'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Booking Time</b></th>
//     <td>'.gmdate('h:i A',strtotime($booking['booking_time'])).'</td>
// </tr>

// <tr>
//     <th class="hidden-phone"><b>Payment Status</b></th>
//     <td>'.$booking['payment_status']==1?"Paid":"UnPaid".'</td>
// </tr>


// <tr>
//     <th class="hidden-phone"><b>Currency</b></th>
//     <td>'.$booking['payment']['currency'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Payment Method</b></th>
//     <td>'.$booking['payment']['payment_method'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Transaction Id</b></th>
//     <td>'.$booking['payment']['transaction_id'].'</td>
// </tr>
// <tr>
//     <th class="hidden-phone"><b>Payment Date</b></th>
//     <td>'.$booking['payment']['createdDate'].'</td>
// </tr>

// <tr>
//     <th class="hidden-phone"><b>Size of Waste in ton</b></th>
//     <td>'.$booking['waste_size'].'</td>
// </tr>

// <tr>
//     <th class="hidden-phone"><b>Service Charge per ton</b></th>
//     <td>₵'.$booking['service_charge'].'</td>
// </tr>


// <tr>
//     <th class="hidden-phone">Total Amount</th>
//     <td>

//         <table>
//         <tr>
            
//             <th>Total Service Charge</th>
//             <th>Municipality Charge</th>
//             <th>Total Charge</th>
//         </tr>

//         <tr>
//             <td>₵'.$booking['payment']['service_charge'].'</td>
//             <td>₵'.$booking['payment']['municipality_charge'].'</td>
//             <td>₵'.$booking['payment']['total_amount'].'</td>
//         </tr>
        
//         </table>
//     </td>
// </tr>  

// </table>';

// $mode = "utf-8";
// $format =" A10";
// $default_font_size  = "12"; // size in pt
// $default_font = "Courier";
// $margin_left = 20;
// $margin_right = 20;
// $margin_top = 10;
// $margin_bottom = 10;
// $header = 5;
// $footer = 5;
// $orientation = "L"; // can be P (Portrait) or L (Landscape)
// $pdf=new \Mpdf\Mpdf([$mode,$format, $default_font_size, $default_font, $margin_left, $margin_right, $margin_top, $margin_bottom, $header, $footer, $orientation]);
// $pdf->SetWatermarkText('GoWasteOs');
// $pdf->showWatermarkText = true;
// //$pdf->SetWatermarkImage('tiger.wmf', 0.15, 'F');
// $pdf->SetHeader('');
// $pdf->WriteHTML($html);
// $pdf->SetFooter('');

require_once ROOT . '/vendor/autoload.php';

$url="http://localhost/GoWasteOS/admin/Bookings/view/NA==";
if (ini_get('allow_url_fopen')) {
    $html = file_get_contents($url);

} else {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , 1 );
    $html = curl_exec($ch);
    curl_close($ch);
}

echo $html;
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->SetDisplayMode('fullwidth');

// $mpdf->CSSselectMedia='mpdf'; // assuming you used this in the document header
// $mpdf->setBasePath($url);
// $mpdf->WriteHTML($html);

// $mpdf->Output('download.pdf','D');

exit();
