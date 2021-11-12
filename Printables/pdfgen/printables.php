<?php 

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

class Printables {

    function getAge($bdate){
        $currentDate = date('Y-m-d');
        $age = date_diff(date_create($bdate), date_create( $currentDate));
        return $age->format("%y");
    }

    function dateFormat($date) {
        $date= date_create($date);
        return date_format($date,"F d, Y");
    }

    /**
     * 
     * Returns a string 
     */
    function header(){

        return '
        <table style="margin:auto;">
            <tr>
                <td style="width:25%; padding:0;margin:0;">
                    &nbsp;&nbsp;&nbsp;<img src="pdfgen/image/logo.jpg" alt="asdfsdf" style="width:90px;">
                </td>
                <td style="width:75%;text-align:center;"><br>
                    <div style="padding-top:10px"><b>SOUTH EAST OCCUPATIONAL HEALTH AND ENVIRONTMENTAL SAFETY SERVICES, INC.</b></div>
                    <div style="padding-top:5px">2nd floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City <br>Telephone No.: 480-76-74</div>
                </td>
            </tr>
        </table>';
    }


    function patientForm($patient, $labr){

        return '
        <table>
            <tr>
                <td style="width:60%">Name: '. $patient[$labr['patient_id']]['fname'].' '.$patient[$labr['patient_id']]['lname'].'</td>
                <td style="width:40%">Date: '. $date = $this->dateFormat($labr['date']) .'</td>
            
            </tr>
        </table>
        <div></div>

        <table>
            <tr>
                <td style="width:20%">Age: '.$this->getAge($patient[$labr['patient_id']]['bdate']).'</td>
                <td style="width:20%">Sex: '.$patient[$labr['patient_id']]['gender'].'</td>
                <td style="width:60%">Physician/Company: </td>
            </tr>
        </table>
        <div></div>';

    }

    /**
     * Clinic chemical printable document
     */
    function clinic_chem(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '<div style="text-align:center;color:blue;">Laboratory Department</div>
                        <div style="text-align:center;color:red;">Clinical Chemistry</div>
                        <div></div>';

        $htmlAnalysisTable = '
                <table style="border-collapse:collapse;font-size:11px;">
                    <tr>
                        <td style="border-top:1px solid #888;border-bottom:1px solid #888;">
                            Test
                        </td>
                        <td style="border-top:1px solid #888;border-bottom:1px solid #888;">
                            Result(s)
                        </td>
                        <td style="border-top:1px solid #888;border-bottom:1px solid #888;">
                            Reference Badge
                        </td>
                    </tr>
                    '.$htmlDynamicData.'
                </table>';

        $htmlSignatures = '
                <div></div>
                <table style="border-collapse:collapse;font-size:11px;">
                    <tr>
                        <td style="width:50%; text-align:center;">
                            <u>Jhon Bryan E. Sena, RMT</u><br>
                            Medical Technologist<br>
                            PRC Lic.# 74517
                        </td>
                        <td style="width:50%; text-align:center;">
                            <u>Jhon Bryan E. Sena, RMT</u><br>
                            Medical Technologist<br>
                            PRC Lic.# 74517
                        </td>
                    </tr>
                </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm(). $htmlAnalysisTable . $htmlSignatures;

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('clinic_chemistry.pdf','I');
    }

    /**
     * Fecalysis printable document
     */
    function fecalysis($labr, $patient, $labTest, $medTech,$pathologist){
        $labTestArray = json_decode($labr['resultdata'],false);

        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20,10, 20, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Routine Fecalysis</div>
            <div></div>';

        $htmlMacroscopicExamination = '
                <div></div>
                <table>
                    <tr>
                        <td>
                            Macroscopic Examination<br>
                            Color: '.$labTestArray[0].'<br>
                            Consistency:'.$labTestArray[1].'
                        </td>
                    </tr>
                </table>
                ';
        
        $htmlMicroscopicExamination = '
                <div></div>
                <table>
                    <tr>
                        <td style="width:50%">
                            Microscopic Examination<br>
                            Pus cells: '.$labTestArray[2].'<br>
                            Red blood cells: '.$labTestArray[3].'<br>
                            Fat globules: '.$labTestArray[4].'<br>
                            Muscle fiber: '.$labTestArray[5].'<br>
                            Yeast cells: '.$labTestArray[6].'<br>
                            Others: '.$labTestArray[7].'<br>
                            Vegetable Cells: '.$labTestArray[8].'<br>
                            Occult blood: '.$labTestArray[9].'
                        </td>
                        <td style="width:50%">
                            Parasites: '.$labTestArray[10].'<br>
                            Ascaris: '.$labTestArray[11].'<br>
                            Trichuris: '.$labTestArray[22].'<br>
                            Hookworm: '.$labTestArray[12].'<br>
                            Others: '.$labTestArray[13].'<br><br>
                            Amoeba: '.$labTestArray[14].'<br>
                            Entamoeba histolytica: '.$labTestArray[15].'<br>
                            Cyst: '.$labTestArray[16].'<br>
                            Trophozoite: '.$labTestArray[17].'<br>
                            Entamoeba coli: '.$labTestArray[18].'<br>
                            Cyst: '.$labTestArray[19].'<br>
                            Trophozoite: '.$labTestArray[20].'<br>
                            Others: '.$labTestArray[21].'
                        </td>
                    </tr>
                </table>
        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>'.$medTech[$labr['medtech_id']]['fname'] .' '.$medTech[$labr['medtech_id']]['mname']. ' ' .$medTech[$labr['medtech_id']]['lname'].'</u><br>
                        '.ucwords($medTech[$labr['medtech_id']]['position']).'<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>'.$pathologist[$labr['pathologist_id']]['fname'] .' '.$pathologist[$labr['pathologist_id']]['mname']. ' ' .$pathologist[$labr['pathologist_id']]['lname'].'</u><br>
                        '.ucwords($pathologist[$labr['pathologist_id']]['position']).'<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm($patient, $labr) . $htmlMacroscopicExamination .  $htmlMicroscopicExamination . $htmlSignatures;


        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('fecalysis.pdf','I');

    }

    function serology(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Serology</div>
            <div></div>';

        $htmlTestResult = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="margin:auto;">
                <tr>
                    <td></td>
                    <td style="width:100%;text-align:left">
                        <strong>Test: Hepatitis & Screening</strong><br>
                        Result: <br>
                        Kit: Blue Cross HAV Test Device<br>
                        Lot #: 20170201<br>
                        Expiration date: 14.02.2019<br>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        ';


        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm() . $htmlTestResult .  $htmlSignatures;
        $pdf->writeHTML($html, true, false, true, false, '');
        

        $pdf->Output('serology.pdf','I');
    }

    function hematology(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Hematology</div>
            <div></div>';
        
        $htmlTestResult = '
            <div></div>
            <table cellpadding="5">
                <tr>
                    <td>
                        Test
                    </td>
                    <td>
                        Result
                    </td>
                </tr>
                <tr>
                    <td>
                        ABO/Rh typing:
                    </td>
                    <td>
                
                    </td>
                </tr>
            </table>
        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm() . $htmlTestResult . $htmlSignatures;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('hematology.pdf','I');
    }

    function clinicalMicroscopy(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Clinical Microscopy</div>
            <div></div>';

        $body1 = '
            <div></div> 
            <div></div>
            <div></div>
            <table>
                <tr>
                    <td></td>
                    <td width="100%">
                    <strong>Test:</strong> Pregnancy Test<br>
                    <strong>Sample:</strong> Urine<br>
                    <strong>Result:</strong><br>
                    <strong>Kit:</strong> Lumiquick<br>
                    <strong>Lot #:</strong> 17031714<br>
                    <strong>Expiration date: </strong> 2018.09
                    </td>
                    <td></td>
                </tr>
            </table>
        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm() . $body1 . $htmlSignatures;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('clinicalMicroscopy.pdf','I');
        

    }

    function miscellaneous(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Miscellaneous</div>
            <div></div>';

        $body1 = '
            <div></div> 
            <div></div>
            <div></div>
            <table>
                <tr>
                    <td></td>
                    <td width="100%">
                    <strong>Test:</strong> Cotinine Test<br>
                    <strong>Result:</strong><br>
                    <strong>Kit:</strong> Blue Screen<br>
                    <strong>Lot #:</strong> COT6110007<br>
                    <strong>Expiration date: </strong>2018-11
                    </td>
                    <td></td>
                </tr>
            </table>
        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm() . $body1 . $htmlSignatures;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('miscellaneous.pdf','I');
        

    }

    function urinalysis($labr,$patient,$labs,$medTech,$pathologist){
        $labrArray = json_decode($labr['resultdata'], false);
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->AddPage();

        

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Routine Urinalysis</div>
            <div></div>';

        $body1 = '
            <div></div>
            <table cellpadding="2">
                <tr>
                    <td>Macroscopic Examination</td>
                    <td>Chemical Tests:  '.$labrArray[4].'</td>
                </tr>
                <tr>
                    <td>Color: '.$labrArray[0].'</td>
                    <td>Protein: '.$labrArray[5].'</td>
                </tr>
                <tr>
                    <td>Transparency: '.$labrArray[1].'</td>
                    <td>Sugar: '.$labrArray[6].'</td>
                </tr>
                <tr>
                    <td colspan="2">Ph: '.$labrArray[2].'</td>
                </tr>
                <tr>
                    <td colspan="2">Specific Gravity: '.$labrArray[3].'</td>
                </tr>
            </table>
        ';

        $body2 = '
            <div></div>
            <table cellpadding="2">
                <tr>
                    <td>Microscopic Examination</td>
                    <td>Epithelium: '.$labrArray[14].'</td>
                </tr>
                <tr>
                    <td>Casts</td>
                    <td>Squamous: '.$labrArray[15].'</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Coarse granualar cast: '.$labrArray[7].'</td>
                    <td>Renal: '.$labrArray[16].'</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Fine granualar cast: '.$labrArray[8].'</td>
                    <td>Mucus thread: '.$labrArray[17].'</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Hyaline cast: '.$labrArray[9].'</td>
                    <td>Bacteria: '.$labrArray[18].'</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Plus cast: '.$labrArray[10].'</td>
                    <td>Other: '.$labrArray[19].'</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;&nbsp;RBC cast: '.$labrArray[11].'</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;Epithelial cast: '.$labrArray[12].'</td>
                    <td>Cells</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pus Cells: '.$labrArray[20].'</td>
                </tr>
                <tr>
                    <td>Pregnancy Test: '.$labrArray[13].'</td>
                    <td>Red blood cells: '.$labrArray[21].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Yeast cells: '.$labrArray[22].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Crystals</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Amorphous urates: '.$labrArray[23].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Calcium oxalates: '.$labrArray[24].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Amorphous phospates: '.$labrArray[25].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Triple Phosphates: '.$labrArray[26].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Uric Acid: '.$labrArray[27].'</td>
                </tr>
            </table>
        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>'.$medTech[$labr['medtech_id']]['fname'] .' '.$medTech[$labr['medtech_id']]['mname']. ' ' .$medTech[$labr['medtech_id']]['lname'].'</u><br>
                        '.ucwords($medTech[$labr['medtech_id']]['position']).'<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>'.$pathologist[$labr['pathologist_id']]['fname'] .' '.$pathologist[$labr['pathologist_id']]['mname']. ' ' .$pathologist[$labr['pathologist_id']]['lname'].'</u><br>
                        '.ucwords($pathologist[$labr['pathologist_id']]['position']).'<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory . $this->patientForm($patient,$labr) . $body1 . $body2 . $htmlSignatures;
        $pdf->writeHTML($html, true, false, true, false, '');
        ob_end_clean();
        $pdf->Output('urinalysis.pdf','I');
    }

    function spermAnalysis(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->AddPage();

        $htmlCategory = '
            <div></div>
            <div style="text-align:center;color:blue;">Laboratory Department</div>
            <div style="text-align:center;color:red;">Sperm Analysis</div>
            <div></div>';
        
        $body1 = '
            <div></div>
            <table>
                <tr>
                    <td>Time collected: </td>
                </tr>
                <tr>
                    <td>Time received:</td>
                </tr>
            </table>
        ';

        $body2 = '
            <div></div>
            <table cellpadding="2">
                <tr>
                    <td colspan="2">Macroscopic Examination:</td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td>Volume:</td>
                </tr>
                <tr>
                    <td>Odor:</td>
                    <td>Liquefaction time:</td>
                </tr>
                <tr>
                    <td>Ph:</td>
                    <td>Viscosity:</td>
                </tr>
            </table>
        ';

        $body3 = '
            <div></div>
            <table cellpadding="2">
                <tr>
                    <td colspan="2">Microscopic Examination:</td>
                </tr>
                <tr>
                    <td colspan="2">Motility:<br>
                        <table cellspacing="2">
                            <tr>
                                <td>&nbsp;Progressively Motile:</td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;Non-progressively motile:</td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;Non-motile:</td>
                                <td>%</td>
                            </tr>
                        </table>
                    </td>                   
                </tr>
                <br>
                <tr>
                    <td colspan="2">Morphology:<br>
                        <table cellspacing="2">
                            <tr>
                                <td>&nbsp;Normal:</td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>&nbsp;Abnormal:</td>
                                <td>%</td>
                            </tr>
                        </table>
                    </td>                   
                </tr>
                <br>
                <tr>
                    <td colspan="2">Remarks:<br></td>                   
                </tr>
                <br><br>
                <tr>
                    <td>Sperm count:</td>  
                    <td>Normal value: 20 - 120 million/cu.mm</td>                    
                </tr>
            </table>

        ';

        $htmlSignatures = '
            <div></div>
            <div></div>
            <div></div>
            <table style="border-collapse:collapse;font-size:11px;">
                <tr>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                    <td style="width:50%; text-align:center;">
                        <u>Jhon Bryan E. Sena, RMT</u><br>
                        Medical Technologist<br>
                        PRC Lic.# 74517
                    </td>
                </tr>
            </table>';

        $html = $this->header() . $htmlCategory .  $this->patientForm() . $body1 .$body2 .$body3 .$htmlSignatures ;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('spermAnalysis.pdf','I');

    }

    function physicalCertificaiton(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20,10, 20, true);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->AddPage();

        $title = '
            <div></div>
            <div></div>
            <div style="text-align:center; font-size: 16px;"><strong><u>CERTIFICATION</u></strong></div>
        ';

        $body = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            TO WHOM IT MAY CONCERN<br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that ________________________________ age _____ gender _____ Address ___________________________________________________________. Is physically fit to ____________<br>____________________________________. 
        ';


        $body2 = '
            <div></div>
            <div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued upon request of the interested party this _____day of ___________ for whatever purpose this certification may serve.
            </div>
        ';


        $signature = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table>
                <tr>
                    <td></td>
                    <td style="border-top:1px solid black; text-align:center;">Attending Physician</td>
                </tr>
            </table>
        ';



        $html = $this->header() .$title.$body.$body2.$signature;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('consultCertification.pdf','I');

    }

    function consultCertification(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20,10, 20, true);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->AddPage();

        $title = '
            <div></div>
            <div></div>
            <div style="text-align:center; font-size: 16px;"><strong><u>CERTIFICATION</u></strong></div>
        ';

        $body = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            TO WHOM IT MAY CONCERN<br><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that ________________________________ age _____ gender _____ resident of ___________________________________________________________. Consulted the undersigned on ______________________________ because of ___________________________________________.
        ';

        $body2 = '
            <div></div>
            Diagnosis: _____________________________________________________________________________
            <div></div>
            Remarks: ______________________________________________________________________________
        ';

        $body3 = '
            <div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Issued upon request of the interested party this _____day of ___________ for whatever purpose this certification may serve.
            </div>
        ';


        $signature = '
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <table>
                <tr>
                    <td></td>
                    <td style="border-top:1px solid black; text-align:center;">Attending Physician</td>
                </tr>
            </table>
        ';



        $html = $this->header() .$title.$body.$body2.$body3.$signature;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('consultCertification.pdf','I');

    }


    function consultationForm(){
        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(15,10, 15, true);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->AddPage();

        $title = '
            <br>
            <div style="font-size: 16px;"><strong>CONSULATION FORM</strong></div>
            <hr style="line-height:1px;">
            <hr style="line-height:1px;">
        ';

        $date = '
            <div>Date: ____________________________</div>
        ';

        $patientInfo = '
            <div></div>
            <table cellpadding="4">
                <tr>
                    <td width="50%">Name of Patient: ______________________________ </td>
                    <td width="25%">Age: _________________</td>
                    <td width="25%">Gender: _____________</td>
                </tr>
                <tr>
                    <td>Contact No.: _________________________________ </td>
                    <td colspan="2">Address: ____________________________________</td>
                </tr>
                <tr>
                    <td>Company: ___________________________________</td>
                    <td colspan="2">Occupation: __________________________________</td>
                </tr>
                <tr>
                    <td colspan="3">Chief Complaint: ____________________________________________________________________________</td>
                </tr>
            </table>
        ';

        $body1 = '
            <div></div>
            History of Present illness:<br><br><br><br><br><table>
                <tr>
                    <td>Past Medical History:</td>
                    <td>OB-Gyne History:<br>FPAL(___ ___ ___) G ____ P ____</td>
                </tr>
            </table>
            <div></div>
            Past  Occupational History / Hazard Exposure History:<br><br><br><br><br>Family History:<br><br><br><br><br><table cellpadding="2">
                <tr>
                    <td width="40%">Vital Signs: BP: _______________________</td>
                    <td width="20%">HR: ______________</td>
                    <td width="20%">RR: _____________</td>
                    <td width="20%">Temp: ____________</td>
                </tr>
                <tr>
                    <td colspan="2" width="20%">Height: __________</td>
                    <td colspan="2" width="20%">Weight: __________</td>
                </tr>
            </table>
            <div></div>
            Physical Examination:<br><br><br><br>Diagnosis/Working Impression:<br><br><br><br>Plan of Management:<br><br><br><br><br><br><br>
            <table style="text-align:center;">
                <tr>
                    <td width="40%" style="border-top:1px solid black">Signature of Patient</td>
                    <td width="20%"></td>
                    <td width="40%" style="border-top:1px solid black">Signature of Attending Physician</td>
                </tr>
            </table>
        ';

        $html = $this->header() . $title .$date.$patientInfo.$body1;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('consultationForm.pdf','I');

    }

    function nbsp($pieces){
        $nbsp = '';
        for($x=0;$x<$pieces;$x++){
            $nbsp .= '&nbsp;';
        }
        return $nbsp;
    }

    function audiometryScreening(){

        $pdf = new TCPDF('P','mm','Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10,10, 10, true);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->AddPage();

        // get the current page break margin
        $bMargin = $pdf->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
        // disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = '../image/logo.jpg';
        $pdf->SetAlpha(.5);
        $pdf->Image($img_file, 65, 100, 70, 70, '', '', '', false, 300, '', false, false, 0);
        $pdf->SetAlpha(1);
        // restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();

        $head = '
            <table cellpadding="1">
                <tr>
                    <td rowspan="4" style="width:15%; padding-top:10px;margin:0; text-align:center;">&nbsp;&nbsp;&nbsp;<img src="../image/logo.jpg" style="width:60px;"></td>
                    <td width="85%"><b>SOUTH EAST OCCUPATIONAL HEALTH AND ENVIRONTMENTAL SAFETY SERVICES, INC.</b></td>
                </tr>
                <tr>
                    <td>2nd floor, Tower Mall Bldg. 4, Landco Business Park, Legazpi City</td>
                </tr>
                <tr>
                    <td>Email: southeastoccupationalhealth@gmail.com</td>
                </tr>
                <tr>
                    <td style="border-bottom:2px solid #999;">Tel #: 480 - 7674 CP#: 09276152400</td>
                </tr>
            </table>
        ';

        $title = '<div></div><div style="text-align:center"><strong><u>AUDIOMETRY SCREENING</u></strong></div>';

        $patientInfo = '
            <div></div>
            <table>
                <tr> 
                    <td width="45%">Name: _________________________________</td>
                    <td width="10%">Age: ____</td>
                    <td width="15%">Gender: ______</td>
                    <td width="30%">Date of Examination: ___________</td>
                </tr>
                <br>
                <tr>
                    <td colspan="2">Address:  ___________________________________________</td>
                    <td colspan="2">Contact Number:  _____________________________</td>
                </tr>
            </table>
        ';

        $tbTitle = '
            <div></div>
            <div style="text-align:center;">Frequency [kHz]</div>
        ';

        

        $table = '
            <table>
                <tr>
                    <td style="font-size:9px; text-align:center; line-height: 180px;" width="10%">Decibles[db]</td>
                    <td width="5%">
                        <table style="font-size:9px">
                            <tr>
                                <td></td>
                            </tr>
                            <tr><td style="line-height: 25px;">0</td></tr>
                            <tr><td style="line-height: 1px">10</td></tr>
                            <tr><td style="line-height: 26px">20</td></tr>
                            <tr><td style="line-height: 1pxpx">30</td></tr>
                            <tr><td style="line-height: 24px">40</td></tr>
                            <tr><td style="line-height: 1px">50</td></tr>
                            <tr><td style="line-height: 24px">60</td></tr>
                            <tr><td style="line-height: 1px">70</td></tr>
                            <tr><td style="line-height: 24px">80</td></tr>
                            <tr><td style="line-height: 1px">90</td></tr>
                            <tr><td style="line-height: 24px">100</td></tr>
                            <tr><td style="line-height: 1px">110</td></tr>
                            <tr><td style="line-height: 24px">120</td></tr>
                        </table>
                    </td>
                    <td width="85%">
                        <table>
                            <tr>
                                <td>0.125</td>
                                <td>0.25</td>
                                <td>0.5</td>
                                <td>0.75</td>
                                <td>1</td>
                                <td>1.5</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>6</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td><td style="border:1px solid #888"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        ';


        $legend = '
            <div></div>
            <table>
                
                <tr>
                    <td>
                        <table>
                            <div>LEGEND</div>
                            <tr>
                                <td>A. Air Conduction</td>
                                <td>B. Bone Conduction </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;X - left</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;< - left</td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;O - right</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;> - rigth</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table style="font-size: 8px; text-align:center;" >
                            <tr>
                                <td colspan="12" style="text-align:center;">PURE TONE AUDIOGRAM</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">Air</td>
                                <td style="border:1px solid #888">0.125</td>
                                <td style="border:1px solid #888">0.25</td>
                                <td style="border:1px solid #888">0.5</td>
                                <td style="border:1px solid #888">0.75</td>
                                <td style="border:1px solid #888">1</td>
                                <td style="border:1px solid #888">l.5</td>
                                <td style="border:1px solid #888">2</td>
                                <td style="border:1px solid #888">3</td>
                                <td style="border:1px solid #888">4</td>
                                <td style="border:1px solid #888">6</td>
                                <td style="border:1px solid #888">8</td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">R.E</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">L.E</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">Bone</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">R.E</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">L.E</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #888">F.F</td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                                <td style="border:1px solid #888"></td>
                            </tr>
                        </table> 
                    </td>
                </tr>
            </table>
        ';

        $remarks = '
            <div></div>
            <div>REMARKS:</div>
            <div>________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</div>
            <div>Examiner</div>
            <div>_______________________________________</div>
        ';


        $signature = '
            <div></div>
            <div></div>
            <table>
                <tr>
                    <td></td>
                    <td>Ear, Nose, and Throat</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Head and Neck Surgery</td>
                </tr>
                <tr>
                    <td></td>
                    <td>License #:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="color:red">NOT VALID WITHOUT OFFICIAL SEAL</td>
                </tr>
            </table>
        ';

        

        $html = $head . $title . $patientInfo . $tbTitle .  $table . $legend . $remarks . $signature ;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('audiometryScreening.pdf','I');

    }

    function medicalCertification(){
        $pdf = new TCPDF('P','mm',array(216,356));
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10,10, 10, true);
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->AddPage();

        $head = '
            <table cellpadding="1" style="font-size:9px;">
                <tr>
                    <td style="width:10%; padding-top:10px;margin:0; text-align:center;">&nbsp;&nbsp;&nbsp;<img src="../image/logo.jpg" style="width:60px;"></td>
                    <td width="75%" style="text-align:center;"><b>SOUTH EAST OCCUPATIONAL HEALTH AND ENVIRONTMENTAL SAFETY SERVICES, INC.</b>
                    <br>2nd Floor, Tower Mall Bldg. 4 LandCo Business Park, Legazpi City
                    <br><u style="color:blue;">southeastoccupationalhealth@gmail.com</u>
                    <br>Tel. No.: (052) 742-4820    CP No.:(0927)6152400</td>
                    <td  width="15%" style="text-align:center; border:1px solid #888;"><div></div>Passport size picture</td>
                </tr>
            </table>
            <br>
            <hr>
        ';
        $title = '
            <table style="line-height:20px;">
                <tr>
                    <td></td>
                    <td><strong>MEDICAL CERTIFICATION</strong></td>
                    <td>Charge Slip #: </td>
                </tr>
            </table>
        ';
        $rows = '';
        $array1 = array('Accident/trauma','Allergy','Anemia','Asthma','Cancer or Tumor','Chronic cough','Constipation','Diabetes','Diarrhea','Dysmenorrhea','Dizziness','Fainting/Seizures');
        $array2 = array('Ear Problem','Eye Problem','Nose trouble','Throat trouble','Genetic disorders','Frequent Headache','Heart Trouble','Hernia','Hemorrhoids','Hypertension','Hospitalization','Insomia');
        $array3 = array('Malaria, if yes, date','Upper back pain','Lower back pain','Shoulder/joint pain','Head/Neck injury','Hand problem','Carpal tunnel syndrome','Rheumatism','Liver/Gall bladder','Stomach/ulcer','Kidney problem','STD');
        $array4 = array('Pneumonia','Tuberculosis','Typhoid','Typhoid problem','Depression','Mental disorder','Nervous breakdown','Operations','Any repatriation','','','');
        for($x=0;$x<12;$x++){
            if($x == 0) {
                $rows .= '<tr>
                <td style="border:1px solid black; width:15%; "></td>
                <td style="border:1px solid black; width:4%; text-align:center;">No</td>
                <td style="border:1px solid black; width:4%; text-align:center;">Yes</td>
                <td style="border:1px solid black; width:17%;"></td>
                <td style="border:1px solid black; width:4%; text-align:center;">No</td>
                <td style="border:1px solid black; width:4%; text-align:center;">Yes</td>
                <td style="border:1px solid black; width:19%;"></td>
                <td style="border:1px solid black; width:4%; text-align:center;">No</td>
                <td style="border:1px solid black; width:4%; text-align:center;">Yes</td>
                <td style="border:1px solid black; width:17%;"></td>
                <td style="border:1px solid black; width:4%; text-align:center;">No</td>
                <td style="border:1px solid black; width:4%; text-align:center;">Yes</td>
                </tr>';
            }
            $rows .= '
            <tr>
                <td style="border:1px solid black; width:15%;">'.$array1[$x].'</td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:17%;">'.$array2[$x].'</td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:19%;">'.$array3[$x].'</td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:17%;">'.$array4[$x].'</td>
                <td style="border:1px solid black; width:4%;"></td>
                <td style="border:1px solid black; width:4%;"></td>
            </tr>
            ';
        }

        $rows2 = '';
        $array1 = array('skin','Head, neck, scalp','Eyes, external','Pupils','Ears','Nose,sinuses','Mouth, throat','Neck,LN,thyroid','Chest,Breast,Axilla');
        $array2 = array('Lungs','Heart','Abdomen','Back','Anus,rectum','GU system','Inguinal,gennitals','Reflexes','Extremities');

        for($x=0;$x<9;$x++) {
            $rows2 .= '
            <tr>
                <td colspan="4" style="border:1px solid black; width:16.66%;">'.$array1[$x].'</td>
                <td colspan="4" style="border:1px solid black; width:8.33%;"></td>
                <td colspan="3" style="border:1px solid black; width:8.33%;"></td>
                <td colspan="3" style="border:1px solid black; width:16.66%;"></td>
                <td colspan="3" style="border:1px solid black; width:16.66%;">'.$array2[$x].'</td>
                <td colspan="3" style="border:1px solid black; width:8.33%;"></td>
                <td colspan="3" style="border:1px solid black; width:8.33%;"></td>
                <td colspan="3" style="border:1px solid black; width:16.66%;"></td>
            </tr>
            ';
        }

        $rows3 = '';
        $array1 = array('Chest X-ray','CBC','Blood type','Fecalysis','Urinalysis');
        $array2 = array('ECG','HIV','HBsag','VDRL/RPR','');
        $array3 = array('Pregnancy test','Neurological evaluation','Pychological Evaluation','Drug Tests','BMI =');

        for($x=0;$x<5;$x++) {
            if($x==0) {
                $rows3 .= '
                    <tr>
                        <td style="border:1px solid black; width:9%;"></td>
                        <td style="border:1px solid black; width:9%; text-align:center;">Normal</td>
                        <td style="border:1px solid black; width:9%; text-align:center;">Abnormal</td>
                        <td style="border:1px solid black; width:10.5%;"></td>
                        <td style="border:1px solid black; text-align:center;">Normal</td>
                        <td style="border:1px solid black; text-align:center;">Abnormal</td>
                        <td style="border:1px solid black; width:18%;"></td>
                        <td style="border:1px solid black; text-align:center;">Normal</td>
                        <td style="border:1px solid black; text-align:center;">Abnormal</td>
                    </tr>
                ';
            } else {
                $rows3 .= '
                    <tr>
                        <td style="border:1px solid black; width:9%;">'.$array1[$x].'</td>
                        <td style="border:1px solid black; width:9%;"></td>
                        <td style="border:1px solid black; width:9%;"></td>
                        <td style="border:1px solid black; width:10.5%;">'.$array2[$x].'</td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black; width:18%;">'.$array3[$x].'</td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                    </tr>
                ';

            }
        }

        $content = '
            <table cellpadding="2">
                <tr>
                    <td style="border:1px solid black; width:10%;">&nbsp;Last Name</td>
                    <td style="border:1px solid black; width:23%;"></td>
                    <td style="border:1px solid black; width:10%;">&nbsp;First Name</td>
                    <td style="border:1px solid black; width:23%;"></td>
                    <td style="border:1px solid black; width:11%;">&nbsp;Middle Initial</td>
                    <td colspan="5" style="border:1px solid black; width:23%;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="border:1px solid black;">&nbsp;Present Mailing Address</td>
                    <td colspan="9" style="border:1px solid black;"></td>
                </tr>
                
                <tr>
                    <td style="border:1px solid black; width:4%;">Sex</td>
                    <td style="border:1px solid black; width:5%" ></td>
                    <td style="border:1px solid black; width:4%;">Age</td>
                    <td style="border:1px solid black; width:5%"></td>
                    <td style="border:1px solid black; width:10%;">&nbsp;Civil status</td>
                    <td style="border:1px solid black; width:20%"></td>
                    <td style="border:1px solid black; width:7%;">&nbsp;Tel No.</td>
                    <td style="border:1px solid black; width:15%"></td>
                    <td style="border:1px solid black; width:10%;">&nbsp;Occupation</td>
                    <td style="border:1px solid black; width:20%"></td>
                </tr>
                <tr>
                    <td colspan="10" style="padding: 2px;border:1px solid black;"><strong>I. Medical History - has applicant suffered from or has been told to suffer, any of the following:</strong>
                    <br><table cellpadding="2">'.$rows.'
                    <tr>
                        <td colspan="4" style="border:1px solid black;">Last menstrual period:</td>
                        <td colspan="2" style="border:1px solid black;">G: &nbsp;&nbsp;&nbsp;&nbsp;P:   </td>
                        <td colspan="6" style="border:1px solid black;">FPAL ( . . .)</td>
                    </tr>
                    <tr>
                        <td colspan="12" style="border:1px solid black;">Smoker  Yes ( ) No ( ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number of sticks per day ( ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number of years smoking ( )
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" style="border:1px solid black;">Alcoholic beverage drink Yes ( ) No ( ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bottles per session ( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bottles/session)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( &nbsp; ) frequent &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( &nbsp; ) occasional
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" style="border:1px solid black;">Parent Medications: <br>
                        </td>
                    </tr>
                    </table>
                    <strong>II. Physical Examination to be completed by examining physician/dentist</strong>
                    <br><table cellpadding="2">
                    <tr>
                        <td colspan="4" style="border:1px solid black;">Height:</td>
                        <td colspan="4" style="border:1px solid black;">Weight:</td>
                        <td colspan="4" style="border:1px solid black;">Blood Pressure:</td>
                        <td colspan="2" style="border:1px solid black;">Pulse:</td>
                        <td colspan="4" style="border:1px solid black;">Respiration:</td>
                        <td colspan="4" style="border:1px solid black;">Body built:</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; width: 11%;">Visual Acuity</td>
                        <td colspan="2" style="border:1px solid black; width: 8.5%;">Far Vision</td>
                        <td colspan="2" style="border:1px solid black; width: 10%;">Near Vision</td>
                        <td style="border:1px solid black; width: 10%;">Ishihara</td>
                        <td style="border:1px solid black; width: 10%;">Hearing</td>
                        <td style="border:1px solid black; width: 6%;">Dental</td>
                        <td style="border:1px solid black; width: 2.47%;">8</td>
                        <td style="border:1px solid black; width: 2.47%;">7</td>
                        <td style="border:1px solid black; width: 2.47%;">6</td>
                        <td style="border:1px solid black; width: 2.47%;">5</td>
                        <td style="border:1px solid black; width: 2.47%;">4</td>
                        <td style="border:1px solid black; width: 2.47%;">3</td>
                        <td style="border:1px solid black; width: 2.47%;">2</td>
                        <td style="border:1px solid black; width: 2.47%;">1</td>
                        <td style="border:1px solid black; width: 2.47%;">R</td>
                        <td style="border:1px solid black; width: 2.47%;">L</td>
                        <td style="border:1px solid black; width: 2.47%;">1</td>
                        <td style="border:1px solid black; width: 2.47%;">2</td>
                        <td style="border:1px solid black; width: 2.47%;">3</td>
                        <td style="border:1px solid black; width: 2.47%;">4</td>
                        <td style="border:1px solid black; width: 2.47%;">5</td>
                        <td style="border:1px solid black; width: 2.47%;">6</td>
                        <td style="border:1px solid black; width: 2.47%;">7</td>
                        <td style="border:1px solid black; width: 2.47%;">8</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black;">Uncorrected</td>
                        <td style="border:1px solid black;">OD<br>20/</td>
                        <td style="border:1px solid black;">OS<br>20/</td>
                        <td style="border:1px solid black;">OD<br>J</td>
                        <td style="border:1px solid black;"><br>OS<br>J</td>
                        <td style="border-top:1px solid black; border-left:1px solid black; border-right:1px solid black;">Color<br>Vision</td>
                        <td style="border:1px solid black;"><div></div>AD:</td>
                        <td style="border:1px solid black;">Upper</td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black;">Corrected</td>
                        <td style="border:1px solid black;">OD<br>20/</td>
                        <td style="border:1px solid black;">OS<br>20/</td>
                        <td style="border:1px solid black;">OD<br>J</td>
                        <td style="border:1px solid black;"><br>OS<br>J</td>
                        <td style="border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black;"></td>
                        <td style="border:1px solid black;"><div></div>AS:</td>
                        <td style="border:1px solid black;">Lower</td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                        <td style="border:1px solid black;"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border:1px solid black; width:16.66%;"></td>
                        <td colspan="4" style="border:1px solid black; width:16.66%; text-align:center;">Normal</td>
                        <td colspan="5" style="border:1px solid black; width:16.66%; text-align:center;">Findings</td>
                        <td colspan="4" style="border:1px solid black; width:16.66%; text-align:center;"></td>
                        <td colspan="4" style="border:1px solid black; width:16.66%; text-align:center;">Normal</td>
                        <td colspan="5" style="border:1px solid black; width:16.66%; text-align:center;">Findings</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border:1px solid black; width:16.66%; "></td>
                        <td colspan="4" style="border:1px solid black; width:8.33%; text-align:center;">Yes</td>
                        <td colspan="3" style="border:1px solid black; width:8.33%; text-align:center;">No</td>
                        <td colspan="3" style="border:1px solid black; width:16.66%; "></td>
                        <td colspan="3" style="border:1px solid black; width:16.66%;"></td>
                        <td colspan="3" style="border:1px solid black; width:8.33%; text-align:center;">Yes</td>
                        <td colspan="3" style="border:1px solid black; width:8.33%; text-align:center;">No</td>
                        <td colspan="3" style="border:1px solid black; width:16.66%;"></td>
                    </tr>
                    '.$rows2.'
                    </table>
                    III. <strong>Remarks</strong><br><br><br><span style="font-style:8px;">IV. <strong >Diagnostic / Laboratory Examination Reports</strong></span> <strong style="color:red; font-size:7px;">(NOTE: PLEASE WRITE THE ABNORMALITY/IES OF THE RESULTS IN THE "ABNORMAL" COLUMN)</strong><br><table cellpadding="1" style="font-size: 8px;">
                        '.$rows3.'
                    </table>
                    V. Recommendation [&nbsp; ] Class A physically fit for any work<br>'.$this->nbsp(34).'[ &nbsp;]Class B physically under-developed or with correctible defect (EOR, dental carles etc) but fir to work.<br>'.$this->nbsp(33).'
                    [ &nbsp;]Class C employable but requires special placement or limited duty.<br>'.$this->nbsp(34).'[ &nbsp;] Class D unit for work.<br><table style="border-top:1px solid black; font-size: 8px;">
                        <tr>
                            <td style="font-size:7px;">I hereby permit the undersigned to furnish such information that the company may need pertaining to my health status. I do hereby release them from any legal responsability by doing so. I further certify that my medical history contained above is true and any false statment will disqualify me from my employment</td>
                        </tr>
                    </table><br><br><table style="font-size:8px; border-bottom:1px solid black;">
                        <tr>
                            <td width="25%">Signature of applicant<br><br><br>EXAMINING PHYSICIAN</td>
                            <td width="15%">Date:</td>
                            <td width="35%"style="text-align:center;"><div></div><strong>CESAR O. CHUA, MD, MPH</strong><br>Chief Executive Officer</td>
                            <td>CONTROL NUMBER: SOHS O<br>Valid until: _______________<br><span style="color:red; text-align:center;">Not Valid Without Official Seal</span><br><strong style="text-align:center;">Xerox not Accepted</strong></td>
                        </tr>
                    </table><br><span style="font-size:7px;">NOTE: This certification does not cover diseases that require special procedures and examinations for their detection like, endoscopy, UGIS, IVP, biopsy etc and also diseases that are asymptomatic at the time of examination.</span>
                    </td>
                    
                </tr>
                
            </table>
        ';
        $html = $head . $title . $content;
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('audiometryScreening.pdf','I');


    }

}



?>