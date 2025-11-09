#!/usr/bin/php
<?php
//Updated databased log.
//$db_log = fopen("databaseupdatelog.txt", "a") or die("Unable to open file!");
//$txt = "File Attempted to run: " .  date('Y-m-d H:i:s') . "\n";
//fwrite($db_log, $txt);
//fclose($db_log);

//OLD SERVER
//$hostname_callcenter = "localhost";
//$database_callcenter = "stricklands_gmc";
//$username_callcenter = "gmc_user";
//$password_callcenter = "P827535bS";
//$callcenter = mysql_connect($hostname_callcenter, $username_callcenter, $password_callcenter) or trigger_error(mysql_error(),E_USER_ERROR);

error_reporting(E_ALL);
//NEW SERVER
$hostname_callcenter = "67.227.173.96";
$database_callcenter = "adminstr_website";
$username_callcenter = "adminstr_website";
$password_callcenter = "LeNI35?ud{M?";
$callcenter = mysql_connect($hostname_callcenter, $username_callcenter, $password_callcenter) or trigger_error(mysql_error(),E_USER_ERROR);



mysql_select_db($database_callcenter, $callcenter);

/*******Functions******/
function converttotimestamp($date)
{
	$timestamp = "";

	if ($date <> "")
	{
		$year = substr($date, -4);
		$month = substr($date, -10, 2);
		$day = substr($date, -7, 2);	
		
		$timestamp = $year . "-" . $month . "-" . $day . " 00:00:00";
	}
	
	
	return $timestamp;
}

function codeconversion($code)
{

	echo " code: " . $code . "<br>";

	if (strcmp($code,"Safety Checked") == 0)
	{
		$returncode = "SS";
	}
	else if (strcmp($code,"As Is - Uncertified") == 0)
	{
		$returncode = "A";
	}
	 // else if (strcmp($fldSoldStatus, "Sold") == 0)
	 // {
	 // 	$returncode = "P";
	 // }
	else
	{

		$returncode = "";
	}
	
	if (strcmp($myfldSoldStatus, "Sold") == 0)
	 {
	 	//$returncode = "P";
	 }

	return $returncode;
}

function convertallcodes($codestring)
{
	//$returnstring = "A|B|C|D";
	$returnstring = str_replace(", ","|",$codestring);
	$returnstring = str_replace(",","|",$returnstring);	
	$returnstring = str_replace(" ","|",$returnstring);

	$returnstring = $returnstring . "|";
		
	return $returnstring;
}

function getfieldtype($body)
{

	switch ($body) {
	  case "2-Door Coupe":
		$typecode = "C";
		break;
	  case "3-Door Hatchback":
		$typecode = "C";
		break;
	  case "4-Door Sedan":
		$typecode = "C";
		break;
	  case "5-Door Hatchback":
		$typecode = "C";
		break;
	  case "Convertible":
		$typecode = "C";
		break;

	  case "SUV":
		$typecode = "S";
		break;
	  case "Crossover":
		$typecode = "S";
		break;

	  case "Truck":
		$typecode = "T";
		break;
	  case "Pick up":
		$typecode = "T";
		break;

	  case "Cargovan":
		$typecode = "T";
		break;
	  case "Minivan":
		$typecode = "V";
		break;
	  case "Van":
		$typecode = "T";
		break;
	  case "Wagon":
		$typecode = "C";
		break;

	  default:
		$typecode = "T";
	}
	
	return $typecode;
}


function updatedatabase($filename,$callcenter,$defaultlotcode,$convertcodes)
{
	//$file = $filename;
	
	$filestring = "CDK/" . $filename;
	$file = fopen($filestring,"r");
	
	//Order of titles in csv file:
	//
	//[0] 	fldStockNo 
	//[1]	fldVINNo 
	//[2]	fldStatusCode
	//[3]	fldShortVINNo
	//[4]	fldYear
	//[5]	fldMake
	//[6]	fldModel
	//[7]	fldModelGroup
	//[8]	fldCyl
	//[9]	fldOdometer
	//[10]	fldTransmission
	//[11]	fldExteriorColor
	//[12]	fldDateReceived
	//[13]	fldRetail
	//[14]	fldSoldStatus
	//[15]	fldLocation
	//[16]	fldLocationCode
	//[17]	fldModelNo
	//[18]	fldAllCodes
	//[19]	fldCodeDesc
	//[20]	fldFuelType
	//[21]	fldComments
	//[22]	fldEngine
	//[23]	fldType
	//[24]	fldDistributor
	//[25]	fldFPCode
	//[26]	fldBody
	//[27]	fldTrimColor
	//[28]	fldCode
	//[29]	fldKey1
	//[30]	fldKey2
	//[31]	fldRadioCode
	//[32]	fldKeyCode
	//[33]	fldRetailNotes
	//[34] 	fldEdition
	//new
	//[36] fldMSRP
	//[37] TrimDescription(AutoTrader Only)
	
	//Put outside the loop to remove the titles.
	$filecontents = fgetcsv($file);

	while(! feof($file))
		{					
			$filecontents = fgetcsv($file);
			
			$stocknumber = $filecontents[0];
			$fldVINNo = $filecontents[1];
			$fldStatusCode = $filecontents[2];

			if (strcmp($fldStatusCode,"Demo") == 0)
			{				
				$fldStatusCode = "U";
			}
			else if (strcmp($fldStatusCode,"New") == 0)
			{
				$fldStatusCode = "N";
			}
			else
			{
				$fldStatusCode = "U";
			}
			
			$fldShortVINNo = $filecontents[3];
			$fldYear = $filecontents[4];
			$fldMake = strtoupper($filecontents[5]);
			
			$fldModel = strtoupper($filecontents[6]);
			$fldModelGroup = $filecontents[7];
			$fldCyl = $filecontents[22];//Taking contents of fldEngine and putting it in fldCyl
			$fldOdometer = $filecontents[9];
			$fldTransmission = $filecontents[10];
			$fldExteriorColor = $filecontents[11];
	
			$fldDateReceived =  $filecontents[12];
			$fldDateReceived = converttotimestamp($fldDateReceived);
			
	
			$fldRetail = $filecontents[35];//Taking contents of fldSalesPrice and using it as Retail price.

			//ADDED 9/22/16
			$fldMSRP = $filecontents[36];

			//added 1/4/17
			$fldTrimDescription = $filecontents[37];


			
			$fldSoldStatus = $filecontents[14];
			$myfldSoldStatus = $filecontents[14];
			//echo "sold status: " . $fldSoldStatus;
			//$fldKey1 = "";
			if (strcmp($fldSoldStatus,"Sold") == 0)
			{				
				$fldSoldStatus = 0;  //So all cars show on admin
				//$fldKey1 = "P";
				//$fldKey1 = $filecontents[29];
				//$fldCodeDesc = $filecontents[19];
			}
			else if (strcmp($fldSoldStatus,"For Sale - Ready") == 0)
			{
				$fldSoldStatus = 0;  //So all cars show on admin
$fldKey1 = $filecontents[29];
			}
			else if (strcmp($fldSoldStatus,"For Sale - Not Ready") == 0)
			{
				$fldSoldStatus = 1;  //So all cars show on admin
$fldKey1 = $filecontents[29];
			}
			else if (strcmp($fldSoldStatus,"On Hold") == 0)
			{
				$fldSoldStatus = 1;  //So all cars show on admin
$fldKey1 = $filecontents[29];
			}
			else
			{
				//$fldSoldStatus = "";
				$fldKey1 = $filecontents[29];
			}
			
			$fldCode = $filecontents[28];
			$fldCode = codeconversion($fldCode);
			$fldCodeTrigger = $fldCode;
			// echo "******".$fldCodeTrigger."******";
  if ($fldCodeTrigger !== '')
  			{
  			//$fldCode = "noCode";
//  				echo "--triggered--";
  			}
  			else {
  				//$fldCode = "noCode";
  				
//  				echo "not--triggered--";
//  				//$fldCode = $fldKey1;
  			}
  			if (strcmp($filecontents[14],"Sold") == 0)
			{				
				//$fldSoldStatus = 0;  //So all cars show on admin
				$fldCode = "P";
				//$fldKey1 = $filecontents[29];
				//$fldCodeDesc = $filecontents[19];
			}
// //echo $fldCode;
// //echo $fldKey1;
			$fldLocation = $filecontents[15];
			$fldLocationCode = $filecontents[15];//Using the same code from fldLocation.
			
			//If location code in file is empty.  Set the default code which is passed in.
			if (strcmp($fldLocation,"") == 0)
			{
				$fldLocation = $defaultlotcode;
				$fldLocationCode = $defaultlotcode;
			}
			
			$fldModelNo = mysql_real_escape_string($filecontents[32]);//Taking contents of fldKeyCode and putting it in fldModelNo//"";//Leave blank for now, until correct info is populated. $filecontents[17];
			
			$fldAllCodes = $filecontents[19];
			
			//if (strcmp($fldStatusCode,"Used") == 0)
			if ($convertcodes == 1)
			{				
				$fldAllCodes = mysql_real_escape_string(convertallcodes($fldAllCodes));		
				//$fldCodeDesc = $filecontents[19];
			}
			else
			{
				$fldAllCodes = "";
			}
			
			$fldFuelType = $filecontents[20];
			
			$fldComments = $filecontents[21];
			$fldComments = mysql_escape_string($fldComments);
			
			$fldEngine = "";//$filecontents[22]; Leaving blank for now.
	
			$fldDistributor = mysql_real_escape_string($filecontents[24]);
			$fldFPCode = $filecontents[25];
	
			$fldBody = $filecontents[26];
			$fldType = $filecontents[23];//This is an empty field.  Call to a function and populate based on result.
			$fldType = getfieldtype($fldBody);
					
			$fldTrimColor = $filecontents[27];
			
			

			if (strcmp($fldCode,"A")==0)
			{
				$fldStatusCode = "U";				
			}
	
			
			$fldKey2 = $filecontents[30];
			//$fldRadioCode = $filecontents[31];
			//$fldKeyCode = $filecontents[32];

			if (strcmp($fldModel,"UNLISTED ITEM") == 0)
			{
				$fldModel = "";
			}
	
			$query = "SELECT * FROM van_vehicles WHERE fldStockNo = '$stocknumber'";
			$rs = mysql_query($query, $callcenter) or die(mysql_error());
			$total_rows = mysql_num_rows($rs);		

			if (($total_rows == 0) && (strcmp($stocknumber,"") <> 0))
			{
				
				//$query_insert = "INSERT INTO van_vehicles (fldStockNo,fldVINNo,fldStatusCode,fldShortVINNo,fldYear,fldMake,fldModel,fldModelGroup,fldCyl,fldOdometer,fldTransmission,fldExteriorColor,fldDateReceived,fldRetail,fldSoldStatus,fldLocation,fldLocationCode,fldModelNo,fldAllCodes,fldFuelType,fldComments,fldEngine,fldType,fldDistributor,fldFPCode,fldBody,fldTrimColor,fldCode,fldKey1,fldKey2) VALUES ('$stocknumber','$fldVINNo','$fldStatusCode','$fldShortVINNo','$fldYear','$fldMake','$fldModel','$fldModelGroup','$fldCyl','$fldOdometer','$fldTransmission','$fldExteriorColor','$fldDateReceived','$fldRetail','$fldSoldStatus','$fldLocation','$fldLocationCode','$fldModelNo','$fldAllCodes','$fldFuelType','$fldComments','$fldEngine','$fldType','$fldDistributor','$fldFPCode','$fldBody','$fldTrimColor','$fldCode','$fldKey1','$fldKey2');";			
				$query_insert = "INSERT INTO van_vehicles (fldStockNo,fldVINNo,fldStatusCode,fldShortVINNo,fldYear,fldMake,fldModel,fldModelGroup,fldCyl,fldOdometer,fldTransmission,fldExteriorColor,fldDateReceived,fldRetail,fldSoldStatus,fldLocation,fldLocationCode,fldModelNo,fldAllCodes,fldFuelType,fldComments,fldEngine,fldType,fldFPCode,fldBody,fldTrimColor,fldCode,fldKey1,fldKey2,fldDistributor,fldMSRP, fldTrimDescription) VALUES ('$stocknumber','$fldVINNo','$fldStatusCode','$fldShortVINNo','$fldYear','$fldMake','$fldModel','$fldModelGroup','$fldCyl','$fldOdometer','$fldTransmission','$fldExteriorColor','$fldDateReceived','$fldRetail','$fldSoldStatus','$fldLocation','$fldLocationCode','$fldModelNo','$fldAllCodes','$fldFuelType','$fldComments','$fldEngine','$fldType','$fldFPCode','$fldBody','$fldTrimColor','$fldCode','$fldKey1','$fldKey2','$fldDistributor','$fldMSRP','$fldTrimDescription');";
				//echo "Stock Number from excel = " . $filecontents[0] . " Converted = " . $fldStatusCode . "<br>";				
				  if($fldStatusCode=='U'){
    $urlvar='used-';
   // echo $urlvar;
  }
  else{
    $urlvar='new-';
    }
				echo "<div style=\"color:blue; font-family: verdana; font-size: 12px;\">Stock Number: " . $stocknumber . " Status: " . $urlvar . " Type:BODY " . $fldType . ":" . $fldBody . "</div>";
				mysql_query($query_insert, $callcenter) or die(mysql_error());
			}
		
		}
	
	
	fclose($file);
}

$query_delete = "DELETE FROM van_vehicles;";			
mysql_query($query_delete, $callcenter) or die(mysql_error());


$filename = "Stratford Toyota.csv";
$defaultlotcode = "T"; //Set default lotcode based on what location the database file is coming from.
$convertcodes = 1;
updatedatabase($filename,$callcenter,$defaultlotcode,$convertcodes);


$filename = "Strickland's Automart Limited.csv";
$defaultlotcode = "E"; //Set default lotcode based on what location the database file is coming from.
$convertcodes = 1;
updatedatabase($filename,$callcenter,$defaultlotcode,$convertcodes);

$filename = "Strickland's Brantford.csv";
$defaultlotcode = "BG"; //Set default lotcode based on what location the database file is coming from.
$convertcodes = 0;
updatedatabase($filename,$callcenter,$defaultlotcode,$convertcodes);


//Updated databased log.
//$db_log = fopen("databaseupdatelog.txt", "a") or die("Unable to open file!");
//$txt = "Database updated: " .  date('Y-m-d H:i:s') . "\n";
//fwrite($db_log, $txt);
//fclose($db_log);

?> 
<?php 
$hostname_conn_php_mysql = "67.227.173.96";
$database_conn_php_mysql = "adminstr_website";
$username_conn_php_mysql = "adminstr_website";
$password_conn_php_mysql = "LeNI35?ud{M?";


//$hostname_conn_php_mysql = "67.227.173.96";
//$database_conn_php_mysql = "mailstri_admin";
//$username_conn_php_mysql = "mailstri_flennon";
//$password_conn_php_mysql = "freelancedev17";

//$conn_php_mysql = mysql_pconnect($hostname_conn_php_mysql, $username_conn_php_mysql, $password_conn_php_mysql) or trigger_error(mysql_error(),E_USER_ERROR);

$pdo_obj = new PDO("mysql:host=$hostname_conn_php_mysql;dbname=$database_conn_php_mysql", $username_conn_php_mysql, $password_conn_php_mysql);
$pdo_obj->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo_obj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php 
$query_makes = $pdo_obj->prepare("SELECT * FROM `van_vehicles`;");
$res =$query_makes->execute(); 
$result = $query_makes->fetchAll();
//echo count($result);die;
foreach($result as $row)
{
	$fldYear = $row['fldYear'];
	$fldMake = strtolower($row['fldMake']);
	$fldModel =  str_replace(' ', '-', strtolower($row['fldModel']));	
	$fldModelNo = str_replace(' ', '-', strtolower($row['fldModelNo']));
	$fldStockNo = strtolower($row['fldStockNo']);
	$fldUrlCode =  strtolower($row['fldStatusCode']);
  
  if($fldUrlCode=='n'){
    $urlvar='new-';
    echo $urlvar;
  }
  else{
    $urlvar='used-';
    }
    
  
	$model_res = preg_replace('/[^A-Za-z0-9\-]/', '', $fldModel);
	$modelno_res = preg_replace('/[^A-Za-z0-9\-]/', '', $fldModelNo);
	
	$aa = (empty($fldModel) ? '' : $model_res);
	//$aa = (empty($fldModel) ? '' : $model_res.'-');
	//$bb = (empty($fldModelNo) ? '' : $modelno_res.'-');
	
	//$qq = $fldYear.'-'.$fldMake.'-'.$aa.$bb.$fldStockNo;
	$qq = $fldStockNo.'-'.$urlvar.$fldYear.'-'.$fldMake.'-'.$aa.$bb;
	$qq = $fldStockNo.'-'.$urlvar.$fldYear.'-'.$fldMake.'-'.$aa.'-for-sale';
	$query_makes1 = $pdo_obj->prepare("update van_vehicles set url='".$qq."' where fldStockNo = '".$fldStockNo."'");
	$res =$query_makes1->execute();
	
}
?>
