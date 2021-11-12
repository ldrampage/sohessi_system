<?php 

require_once('tcpdf_include.php');

class tcpdf_extension {
    function head(){
        $htmlHead = '
        <table style="margin:auto;  font-size:11pt;">
            <tr>
                <td style="width:25%; padding:0;margin:0;">
                    &nbsp;&nbsp;&nbsp;<img src="../image/logo.jpg" style="width:90px;">
                </td>
                <td style="width:75%;text-align:center;"><br>
                    <div style="padding-top:10px"><b>SOUTH EAST OCCUPATIONAL HEALTH AND ENVIRONTMENTAL SAFETY SERVICES, INC.</b></div>
                    <div style="padding-top:5px">2nd floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City Telephone No.: 480-76-74</div>
                </td>
            </tr>
        </table>
        <div style="text-align:center;color:blue;">Laboratory Department</div>
        <div style="text-align:center;color:red;">Clinical Chemistry</div>
        <div></div>';
        return $htmlHead;
    }


}

?>