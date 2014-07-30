<?php
$action = $_POST['action'];

switch ($action){
	case 'gift_card':
	
	
	break;

	case 'floral_consult':

		error_reporting(E_ALL);
		
		ini_set('display_errors','on');
		
		require_once "Mail.php"; // Pear Mail Library\
		require_once "Mail/mime.php";
		require('fpdf.php');
		
		$month = $_POST['month'];
		$day = $_POST['day'];
		$year = $_POST['year'];
		$time = $_POST['time'];
		
		$wedName = $_POST['wedName'];
		$wedStreet = $_POST['wedStreet'];
		$wedCity = $_POST['wedCity'];
		$wedState = $_POST['wedState'];
		$wedZip = $_POST['wedZip'];
		$color = $_POST['color'];
		$info = $_POST['info'];
		
		$bName = $_POST['bName'];
		$bStreet = $_POST['bStreet'];
		$bCity = $_POST['bCity'];
		$bState = $_POST['bState'];
		$bZip = $_POST['bZip'];
		$bPhoneNum = $_POST['bPhoneNum'];
		$bEmail = $_POST['bEmail'];
		
		preg_match("/(\d{3})(\d{3})(\d{4})/",$bPhoneNum,$matches1);
		$b_phone = "($matches1[1]) $matches1[2]-$matches1[3]";
		
		$gName = $_POST['gName'];
		$gStreet = $_POST['gStreet'];
		$gCity = $_POST['gCity'];
		$gState = $_POST['gState'];
		$gZip = $_POST['gZip'];
		$gPhoneNum = $_POST['gPhoneNum'];
		$gEmail = $_POST['gEmail'];
		
		preg_match("/(\d{3})(\d{3})(\d{4})/",$gPhoneNum,$pMatch);
		$g_phone = "($pMatch[1]) $pMatch[2]-$pMatch[3]";
		
		class PDF extends FPDF
		{
		var $B;
		var $I;
		var $U;
		var $HREF;
		
			function PDF($orientation='P', $unit='mm', $size='A4')
			{
				// Call parent constructor
				$this->FPDF($orientation,$unit,$size);
				// Initialization
				$this->B = 0;
				$this->I = 0;
				$this->U = 0;
				$this->HREF = '';
			}
			
			function WriteHTML($html)
			{
				// HTML parser
				$html = str_replace("\n",' ',$html);
				$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
				foreach($a as $i=>$e)
				{
					if($i%2==0)
					{
						// Text
						if($this->HREF)
							$this->PutLink($this->HREF,$e);
						else
							$this->Write(5,$e);
					}
					else
					{
						// Tag
						if($e[0]=='/')
							$this->CloseTag(strtoupper(substr($e,1)));
						else
						{
							// Extract attributes
							$a2 = explode(' ',$e);
							$tag = strtoupper(array_shift($a2));
							$attr = array();
							foreach($a2 as $v)
							{
								if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
									$attr[strtoupper($a3[1])] = $a3[2];
							}
							$this->OpenTag($tag,$attr);
						}
					}
				}
			}
			
			function OpenTag($tag, $attr)
			{
				// Opening tag
				if($tag=='B' || $tag=='I' || $tag=='U')
					$this->SetStyle($tag,true);
				if($tag=='A')
					$this->HREF = $attr['HREF'];
				if($tag=='BR')
					$this->Ln(5);
			}
			
			function CloseTag($tag)
			{
				// Closing tag
				if($tag=='B' || $tag=='I' || $tag=='U')
					$this->SetStyle($tag,false);
				if($tag=='A')
					$this->HREF = '';
			}
			
			function SetStyle($tag, $enable)
			{
				// Modify style and select corresponding font
				$this->$tag += ($enable ? 1 : -1);
				$style = '';
				foreach(array('B', 'I', 'U') as $s)
				{
					if($this->$s>0)
						$style .= $s;
				}
				$this->SetFont('',$style);
			}
			
		
		// Page header
			function Header(){
		
				$wedName = $_POST['wedName'];
		
				// Logo
				$this->Image('rgcvect.png',10,6,40);
				// Arial bold 15
				$this->SetFont('Arial','B',15);
				// Move to the right
				$this->Cell(80);
				// Title
				$this->Cell(40,20,'Floral Consultation Questionaire for ' . $wedName,0,0,'C');
				// Line break
				$this->Ln(20);
			}
		
		// Page footer
			function Footer(){
				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];
				
				$wedName = $_POST['wedName'];	
							
				// Position at 1.5 cm from bottom
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial','I',8);
				// Page number
				$this->Cell(0,10, $wedName . '\'s application -- ' . $month . '/' . $day . '/' . $year,0,0,'C');
			}
		}
			
			// Instanciation of inherited class
			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			
		/*	$pdf->Cell(30,30,'Date: ' . $month . '/' . $day . '/' . $year,0,1);
			$pdf->Cell(30,0,'First Name: ' . $first,0,1);
			$pdf->Cell(30,15,'Last Name: ' . $last,0,1);
			$pdf->Cell(30,15,'Address: ' . $street . ' ' . $city . ' ' . $state . ', ' . $zip,0,1);
			$pdf->Cell(30,15,'Phone Number: ' . $phone,0,1);
			$pdf->Cell(30,15,'E-mail Address: ' . $email,0,1);
			$pdf->Cell(30,15,'Are you currently employed?: ' . $current_employ,0,1);
			$pdf->Cell(30,15,'Part-time Availability?: ' . $part_time,0,1);
			$pdf->Cell(30,15,'Full-time Availability: ' . $full_time,0,1);
		
			$pdf->Cell(30,15,'Available on Weekends?: ' . $weekends,0,1);
			$pdf->Cell(30,15,'Areas of Expertise: ' . $checkbox,0,1);
			$pdf->Cell(30,15,'Qualifications/Additional Info: ' . $qualifications,0,1);*/
		
		$html = '<br />
		<br />
		<b>Date and Time: </b> ' . $month . '/' . $day . '/' . $year . ' -- ' . $time . '<br />
		<br />
		<br />
		<br />
		<b>Wedding Name: </b> ' . $wedName . '<br />
		<br />
		<b>Wedding Address: </b> ' . $wedStreet . ' ' . $wedCity . ' ' . $wedState . ',' . $wedZip . '<br />
		<br />
		<b>Color Scheme: </b> ' . $color . '<br />
		<br />
		<b>Additional Information: </b> ' . $info . '<br />
		<br />
		<br />
		<br />
		<b><u>Bride Info: </u></b>
		<br />
		<br />
		<b>Bride Name: </b> ' . $bName . '<br />
		<br />
		<b>Bride Address: </b> ' . $bStreet . ' ' . $bCity . ' ' . $bState . ', ' . $bZip . '<br />
		<br />
		<b>Bride Phone: </b> ' . $bPhoneNum . '<br />
		<br />
		<b>Bride Email: </b> ' . $bEmail . '<br />
		<br />
		<br />
		<br />
		<b><u>Groom Info: </u></b>
		<br />
		<br />
		<b>Groom Name: </b> ' . $gName . '<br />
		<br />
		<b>Groom Address: </b> ' . $gStreet . ' ' . $gCity . ' ' . $gState . ', ' . $gZip . '<br />
		<br />
		<b>Groom Phone: </b> ' . $gPhoneNum . '<br />
		<br />
		<b>Groom Email: </b> ' . $gEmail . '<br />
		<br />
		<br />		 		 
		
		
		';	
		
		$pdf->WriteHTML($html);
		$pdf->Output('floral_consultations/floral_consult_' . $wedName . '_' .$month . $day . $year .'.pdf','F');
		
		
		$from = '<tony@tonyfitzhugh.com>';
		$to = '<bevm@russellsgardencenter.com>';
		$subject = 'Floral Questionaire for: ' . $wedName . ' on ' . $month . '/' . $day . '/' . $year . '.pdf';
						
		$headers = array(
			'From' => $from,
			'To' => $to,
			'Subject' => $subject,
			'MIME-Version' => "1.0",
			'Content-type' => "text/html;"
		);
		
		// create MIME object
		$mime = new Mail_mime;
		
		// add body parts
		
		
		$html = '
		<html><body style="background-color:#fefbc5"><table class="tg" style="margin-left:auto; margin-right:auto;undefined;table-layout: fixed; width: 594px;border-collapse:collapse;border-spacing:0;border-color:#bbb;border-width:1px;border-style:solid;"><colgroup><col style="width: 279px"><col style="width: 315px"></colgroup><tr><th class="tg-e5l4" colspan="2" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#37761d;color:white;;text-align:center;font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;background-color:#37761d;">Floral Consultation Information</th></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><u>Wedding Information:</u></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td></tr>  <tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Date and Time:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $month . '/' . $day . '/' . $year . '--' . $time . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Wedding Name:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $wedName . '</td></tr><tr><td class="tg-ofi1"  style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Wedding Address:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $wedStreet . ' ' . $wedCity . ' ' . $wedState . ', ' . $wedZip . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Color Scheme:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $color . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Additional Information:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $info. '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><u>Bride Information:</u></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Bride Name:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $bName . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Bride Address: </td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><span class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $bStreet . ' ' . $bCity . ' ' . $bState . ', ' . $bZip . '</span></td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Bride Phone:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $bPhoneNum . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Bride Email:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $bEmail . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><u>Groom Information:</u></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">&nbsp;</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Groom Name:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $gName. '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><span class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Groom</span> Address: </td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><span class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $gStreet . ' ' . $gCity . ' ' . $gState . ', ' . $gZip . '</span></td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><span class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Groom</span> Phone:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $gPhoneNum . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"><span class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Groom</span> Email:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $gEmail . '</td></tr></table></body></html>
		
		
		';
		
		$text = '
		
		';
		
		$mime->setHTMLBody($html);
		
		$file = 'floral_consultations/floral_consult_' . $wedName . '_' .$month . $day . $year .'.pdf';
		$mime->addAttachment($file, 'application/pdf');
		
		// get MIME formatted message headers and body
		$headers = $mime->headers($headers);
		$body = $mime->get();
		
		$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://mail.tonyfitzhugh.com',
				'port' => '465',
				'auth' => true,
				'username' => 'tony@tonyfitzhugh.com',
				'password' => 'tonis111'
			));
			
		
		$mail = $smtp->send($to, $headers, $body);
		
		
		if (PEAR::isError($mail)) {
			echo('<p>' . $mail->getMessage() . '</p>');
		} else {
		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
		require "floralAppComplete.html";
		}
	
	break;

	case 'job_inquiry':
	
		error_reporting(E_ALL);

		ini_set('display_errors','on');
		
		require_once "Mail.php"; // Pear Mail Library\
		require_once "Mail/mime.php";
		require('fpdf.php');
		
		$month = $_POST['month'];
		$day = $_POST['day'];
		$year = $_POST['year'];
		
		$first = $_POST['first'];
		$last = $_POST['last'];
		
		$street = $_POST['street'];
		$city = $_POST['city'];
		$zip = $_POST['zip'];
		$state = $_POST['state'];
		
		$phone = $_POST['phoneNum'];
		
		preg_match("/(\d{3})(\d{3})(\d{4})/",$phone,$matches);
		$sep_phone = "($matches[1]) $matches[2]-$matches[3]";
		
		
		$email = $_POST['email'];
		
		$current_employ = $_POST['current_employ'];
		$part_time = $_POST['part_time'];
		$full_time = $_POST['full_time'];
		
		$weekends = $_POST['weekends'];
		
		$checkbox = implode(", \n", $_POST['area']);
		
		
		$qualifications = $_POST['qualifications'];	
		
		class PDF extends FPDF
		{
		var $B;
		var $I;
		var $U;
		var $HREF;
		
			function PDF($orientation='P', $unit='mm', $size='A4')
			{
				// Call parent constructor
				$this->FPDF($orientation,$unit,$size);
				// Initialization
				$this->B = 0;
				$this->I = 0;
				$this->U = 0;
				$this->HREF = '';
			}
			
			function WriteHTML($html)
			{
				// HTML parser
				$html = str_replace("\n",' ',$html);
				$a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
				foreach($a as $i=>$e)
				{
					if($i%2==0)
					{
						// Text
						if($this->HREF)
							$this->PutLink($this->HREF,$e);
						else
							$this->Write(5,$e);
					}
					else
					{
						// Tag
						if($e[0]=='/')
							$this->CloseTag(strtoupper(substr($e,1)));
						else
						{
							// Extract attributes
							$a2 = explode(' ',$e);
							$tag = strtoupper(array_shift($a2));
							$attr = array();
							foreach($a2 as $v)
							{
								if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
									$attr[strtoupper($a3[1])] = $a3[2];
							}
							$this->OpenTag($tag,$attr);
						}
					}
				}
			}
			
			function OpenTag($tag, $attr)
			{
				// Opening tag
				if($tag=='B' || $tag=='I' || $tag=='U')
					$this->SetStyle($tag,true);
				if($tag=='A')
					$this->HREF = $attr['HREF'];
				if($tag=='BR')
					$this->Ln(5);
			}
			
			function CloseTag($tag)
			{
				// Closing tag
				if($tag=='B' || $tag=='I' || $tag=='U')
					$this->SetStyle($tag,false);
				if($tag=='A')
					$this->HREF = '';
			}
			
			function SetStyle($tag, $enable)
			{
				// Modify style and select corresponding font
				$this->$tag += ($enable ? 1 : -1);
				$style = '';
				foreach(array('B', 'I', 'U') as $s)
				{
					if($this->$s>0)
						$style .= $s;
				}
				$this->SetFont('',$style);
			}
			
		
		// Page header
			function Header(){
		
				$first = $_POST['first'];
				$last = $_POST['last'];
		
				// Logo
				$this->Image('rgcvect.png',10,6,40);
				// Arial bold 15
				$this->SetFont('Arial','B',15);
				// Move to the right
				$this->Cell(80);
				// Title
				$this->Cell(40,20,'Job Application for ' . $first . ' ' . $last,0,0,'C');
				// Line break
				$this->Ln(20);
			}
		
		// Page footer
			function Footer(){
				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];
				
				$first = $_POST['first'];
				$last = $_POST['last'];		
							
				// Position at 1.5 cm from bottom
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial','I',8);
				// Page number
				$this->Cell(0,10, $first . ' ' . $last . '\'s application -- ' . $month . '/' . $day . '/' . $year,0,0,'C');
			}
		}
			
			// Instanciation of inherited class
			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Times','',12);
			
		/*	$pdf->Cell(30,30,'Date: ' . $month . '/' . $day . '/' . $year,0,1);
			$pdf->Cell(30,0,'First Name: ' . $first,0,1);
			$pdf->Cell(30,15,'Last Name: ' . $last,0,1);
			$pdf->Cell(30,15,'Address: ' . $street . ' ' . $city . ' ' . $state . ', ' . $zip,0,1);
			$pdf->Cell(30,15,'Phone Number: ' . $phone,0,1);
			$pdf->Cell(30,15,'E-mail Address: ' . $email,0,1);
			$pdf->Cell(30,15,'Are you currently employed?: ' . $current_employ,0,1);
			$pdf->Cell(30,15,'Part-time Availability?: ' . $part_time,0,1);
			$pdf->Cell(30,15,'Full-time Availability: ' . $full_time,0,1);
		
			$pdf->Cell(30,15,'Available on Weekends?: ' . $weekends,0,1);
			$pdf->Cell(30,15,'Areas of Expertise: ' . $checkbox,0,1);
			$pdf->Cell(30,15,'Qualifications/Additional Info: ' . $qualifications,0,1);*/
		
		$html = '<br /><br /><b>Date:  </b> ' . $month . '/' . $day . '/' . $year . '<br /><br /><br /><br /><b>Name:  </b> ' . $first . ' ' . $last . '<br /><br /><b>Address:  </b> ' . $street . ' ' . $city . ' ' . $state . ',' . $zip . '<br /><br /><b>Phone:  </b> ' . $sep_phone . '<br /><br /><b>E-mail:  </b> ' . $email . '<br /><br /><br /><br /><b>Currently Employed?:  </b> ' . $current_employ . '<br /><br /><b>Part-time Availability?:  </b> ' . $part_time . '<br /><br /><b>Full-time Availability?:  </b> ' . $full_time . '<br /><br /><b>Weekend Availability?:  </b> ' . $weekends . '<br /><br /><br /><br /><b>Areas of Expertise:  </b> ' . $checkbox . '<br /><br /><b>Qualifications/Additional Info:  </b> ' . $qualifications . '<br /><br />			 		 
		
		
		';	
		
		$pdf->WriteHTML($html);
		$pdf->Output('job_applications/job_app_' . $first . '_' . $last . '_' .$month . $day . $year .'.pdf','F');
		
		
		$from = '<tony@tonyfitzhugh.com>';
		$to = '<suzys@russellsgardencenter.com>';
		$subject = 'Job Application for: ' . $first . ' ' . $last . ' on ' . $month . '/' . $day . '/' . $year;
						
		$headers = array(
			'From' => $from,
			'To' => $to,
			'Subject' => $subject,
			'MIME-Version' => "1.0",
			'Content-type' => "text/html;"
		);
		
		// create MIME object
		$mime = new Mail_mime;
		
		// add body parts
		
		
		$html = '
		<html><body><table class="tg" style="undefined;table-layout: fixed; width: 594px;border-collapse:collapse;border-spacing:0;border-color:#bbb;border-width:1px;border-style:solid;"><colgroup><col style="width: 279px"><col style="width: 315px"></colgroup><tr><th class="tg-e5l4" colspan="2" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#37761d;color:white;;text-align:center;font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;background-color:#37761d;">Job Application Information</th></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Date:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $month . '/' . $day . '/' . $year . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Name:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $first . ' ' . $last . '</td></tr><tr><td class="tg-ofi1"  style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Address:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $street . ' ' . $city . ' ' . $state . ', ' . $zip . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Phone:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $sep_phone . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Email:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $email . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Currently Employed?:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $current_employ . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Part-time Availability?:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $part_time . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Full-time Availability?:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $full_time . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Available on Weekends?:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $weekends . '</td></tr><tr><td class="tg-ojos" style="background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;"></td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Areas of Expertise:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $checkbox . '</td></tr><tr><td class="tg-ofi1" style="font-family:Arial Black, Gadget, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">Qualifications/Additional Info:</td><td class="tg-elz1" style="font-family:Arial, Helvetica, sans-serif !important;;background-color:#fefbc5;font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#fefbc5;">' . $part_time . '</td></tr></table></body></html>
		
		';
		
		$text = '
		
		';
		
		$mime->setHTMLBody($html);
		
		$file = 'job_applications/job_app_' . $first . '_' . $last . '_' .$month . $day . $year .'.pdf';
		$mime->addAttachment($file, 'application/pdf');
		
		// get MIME formatted message headers and body
		$headers = $mime->headers($headers);
		$body = $mime->get();
		
		$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://mail.tonyfitzhugh.com',
				'port' => '465',
				'auth' => true,
				'username' => 'tony@tonyfitzhugh.com',
				'password' => 'tonis111'
			));
			
		
		$mail = $smtp->send($to, $headers, $body);
		
		
		if (PEAR::isError($mail)) {
			echo('<p>' . $mail->getMessage() . '</p>');
		} else {
		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
		require "jobAppComplete.html";
		}
	
	break;
}
?>