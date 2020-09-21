<?php
#-------------------------------------------------------------------
# Direct File Access Protection
#-------------------------------------------------------------------
if(SYSTEM_PREVENT_DIRECT_ACCESS) exit("Direct access not permitted!");

#-------------------------------------------------------------------
function System_GetAPI($APIMODE,$SendRequest) {
#-------------------------------------------------------------------
	global $System_Connection,$SystemSession_Staff_ID,$SystemSession_Staff_Token,$System_ListAPI,$System_ListAPICURL,$SendRequest;
	$Result=array(); $arSQLData=array(); $ErrorMessage=array(); $action="";
	if($SystemSession_Staff_ID<>"") {    $SendRequest["SystemSession_Staff_ID"]=$SystemSession_Staff_ID; }
	if($SystemSession_Staff_Token<>"") { $SendRequest["SystemSession_Staff_Token"]=$SystemSession_Staff_Token; }
	//----------------------------------------------------
	if($APIMODE=="MYSQL") {
		$act = trim($SendRequest["act"]);
		if(file_exists(SYSTEM_RELATIVEPATH_API."/".$act.".php")) {
			include(SYSTEM_RELATIVEPATH_API."/".$act.".php");
		} else {
			$Result["Status"] = "API File Not Found!";
		}
		return $Result;
	}
	//----------------------------------------------------
	if($APIMODE=="API") {
		ksort($SendRequest);
		$System_ListAPI[]=$SendRequest;
		$SendRequestString=http_build_query($SendRequest);
		$System_ListAPICURL[]=SYSTEM_FULLPATH_API."?".$SendRequestString;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, SYSTEM_FULLPATH_API);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $SendRequestString);
		$ResultCurl = curl_exec($ch);
		curl_close($ch);
		return json_decode($ResultCurl,true);
	}
	//----------------------------------------------------
}
#-------------------------------------------------------------------
function System_GenToken($UserID) {
#-------------------------------------------------------------------
    $myToken=md5(SYSTEM_AUTHEN_KEY.$UserID.SYSTEM_DATETIMENOW);
    return $myToken;
}

#-------------------------------------------------------------------
function System_getDateNow() {
#-------------------------------------------------------------------
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];
	$today=getdate(mktime($HH,$MM+CONFIG_TIMENOW_MINUTE_ADD,$SS,$Month,$Day,$Year));
	$Day=$today['mday'];
	$Month=$today['mon'];
	$Year=$today['year'];
	$SS=$today['seconds'];
	$MM=$today['minutes'];
	$HH=$today['hours'];
	$DateIs=sprintf("%04d-%02d-%02d",$Year,$Month,$Day);
	return($DateIs);
}

#-------------------------------------------------------------------
function System_getTimeNow() {
#-------------------------------------------------------------------
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];
	$today=getdate(mktime($HH,$MM+CONFIG_TIMENOW_MINUTE_ADD,$SS,$Month,$Day,$Year));
	$Day=$today['mday'];
	$Month=$today['mon'];
	$Year=$today['year'];
	$SS=$today['seconds'];
	$MM=$today['minutes'];
	$HH=$today['hours'];
	$DateIs=sprintf("%02d:%02d:%02d",$HH,$MM,$SS);
	return($DateIs);
}

#-------------------------------------------------------------------
function System_DateToSlash($myDate) {
#-------------------------------------------------------------------
	$myDate=trim($myDate);
	if($myDate=="" || $myDate=="0000-00-00") {
		return "";
	} else {
		$arDate=explode("-",$myDate);
		return $arDate[2]."/".$arDate[1]."/".$arDate[0];
	}
}

#-------------------------------------------------------------------
function System_SlashToDate($myDate) {
#-------------------------------------------------------------------
	$myDate=trim($myDate);
	if($myDate=="" || $myDate=="00/00/0000") {
		return "0000-00-00";
	} else {
		$arDate=explode("/",$myDate);
		return $arDate[2]."-".$arDate[1]."-".$arDate[0];
	}
}

#-------------------------------------------------------------------
function System_DateTimeDiff($myDateTimeFrom,$myDateTimeTo) {
#-------------------------------------------------------------------
	$fromArray = explode(" ",$myDateTimeFrom);
	$fromDateArray = explode("-",$fromArray[0]);
	$fromTimeArray = explode(":",$fromArray[1]);
	$toArray = explode(" ",$myDateTimeTo);
	$toDateArray = explode("-",$toArray[0]);
	$toTimeArray = explode(":",$toArray[1]);
	return ( mktime($fromTimeArray[0]*1,$fromTimeArray[1]*1,$fromTimeArray[2]*1,$fromDateArray[1]*1,$fromDateArray[2]*1,$fromDateArray[0]*1) - 
			 mktime($toTimeArray[0]*1,$toTimeArray[1]*1,$toTimeArray[2]*1,$toDateArray[1]*1,$toDateArray[2]*1,$toDateArray[0]*1)
			)
			/60;
}

#-------------------------------------------------------------------
function System_ShowDateTimeEasy($myDateTime) {
#-------------------------------------------------------------------
	if($myDateTime<>"") {
			$myMin = floor(System_DateTimeDiff(SYSTEM_DATETIMENOW,$myDateTime));
			if($myMin>=-2 && $myMin<=2) {
				return "ขณะนี้";
			} else if($myMin>0) {
				if($myMin>=(365*60*24)) { 
					$myYear=floor($myMin/(365*60*24));
					return " ".$myYear." ปีก่อน"; 
				} else if($myMin>=(30*60*24)) {
					$myMon=floor($myMin/(30*60*24));
					return " ".$myMon." เดือนก่อน";
				} else if($myMin>=(60*24)) {
					$myDay=floor($myMin/(60*24));
					return " ".$myDay." วันก่อน";
				} else if($myMin>=60) {
					$myHr=floor($myMin/60);
					return " ".$myHr." ชั่วโมงก่อน";
				} else {
					return " ".$myMin." นาทีก่อน";
				}
			} else {
				$myMin=$myMin*-1;
				if($myMin>=(365*60*24)) { 
					$myYear=floor($myMin/(365*60*24));
					return "อีก ".$myYear." ปี"; 
				} else if($myMin>=(30*60*24)) {
					$myMon=floor($myMin/(30*60*24));
					return "อีก ".$myMon." เดือน";
				} else if($myMin>=(60*24)) {
					$myDay=floor($myMin/(60*24));
					return "อีก ".$myDay." วัน";
				} else if($myMin>=60) {
					$myHr=floor($myMin/60);
					return "อีก ".$myHr." ชั่วโมง";
				} else {
					return "อีก ".$myMin." นาที";
				}
			}
	} else {
			return "&nbsp;";
	}
}
#-------------------------------------------------------------------
function System_ShowDate($myDate) {
#-------------------------------------------------------------------
	if($myDate=="" || $myDate=="0000-00-00") { return "ยังไม่กำหนด"; }
	$myDateArray=explode("-",$myDate);
	$myDay = sprintf("%d",$myDateArray[2]);
	switch($myDateArray[1]) {
		case "01" : $myMonth = "ม.ค.";  break;
		case "02" : $myMonth = "ก.พ.";  break;
		case "03" : $myMonth = "มี.ค."; break;
		case "04" : $myMonth = "เม.ย."; break;
		case "05" : $myMonth = "พ.ค.";   break;
		case "06" : $myMonth = "มิ.ย.";  break;
		case "07" : $myMonth = "ก.ค.";   break;
		case "08" : $myMonth = "ส.ค.";  break;
		case "09" : $myMonth = "ก.ย.";  break;
		case "10" : $myMonth = "ต.ค.";  break;
		case "11" : $myMonth = "พ.ย.";   break;
		case "12" : $myMonth = "ธ.ค.";  break;
	}
	$myYear = substr(sprintf("%d",$myDateArray[0])+543,2,2);
	return($myDay . " " . $myMonth . " " . $myYear);
}
#-------------------------------------------------------------------
function System_ShowDateTime($myDateTime) {
#-------------------------------------------------------------------
	$arDateTime=explode(" ",$myDateTime);
	$myDate=$arDateTime[0];
	$myTime=$arDateTime[1];
	if($myDate=="" || $myDate=="0000-00-00") { return "ยังไม่กำหนด"; }
	$myDateArray=explode("-",$myDate);
	$myDay = sprintf("%d",$myDateArray[2]);
	switch($myDateArray[1]) {
		case "01" : $myMonth = "ม.ค.";  break;
		case "02" : $myMonth = "ก.พ.";  break;
		case "03" : $myMonth = "มี.ค."; break;
		case "04" : $myMonth = "เม.ย."; break;
		case "05" : $myMonth = "พ.ค.";   break;
		case "06" : $myMonth = "มิ.ย.";  break;
		case "07" : $myMonth = "ก.ค.";   break;
		case "08" : $myMonth = "ส.ค.";  break;
		case "09" : $myMonth = "ก.ย.";  break;
		case "10" : $myMonth = "ต.ค.";  break;
		case "11" : $myMonth = "พ.ย.";   break;
		case "12" : $myMonth = "ธ.ค.";  break;
	}
	$myYear = substr(sprintf("%d",$myDateArray[0])+543,2,2);
	$myTimeArray=explode(":",$myTime);
	return("วันที่ ".$myDay." ".$myMonth." ".$myYear." เวลา ".$myTimeArray[0].":".$myTimeArray[1]." น.");
}
#-------------------------------------------------------------------
function showme($myArray) {
#-------------------------------------------------------------------
	echo "<pre>";
	if(is_array($myArray)) {
		echo "Array:<br>";
		print_r($myArray);
	} else {
		echo "Text:<br>";
		echo $myArray;
	}
	echo "</pre>";
}
#-------------------------------------------------------------------
function System_SaveUploadFile($key,$folder) {
#-------------------------------------------------------------------
	global $_REQUEST;
	$myFileUploadName=$_REQUEST['input'.$key];
	if(strpos(" ".$myFileUploadName,"http:")>0 || strpos(" ".$myFileUploadName,"https:")>0) { // old picture path
		return "";
	} else {
		$newimage='';
		$arraypic = explode(".",$myFileUploadName);
		$filetype = strtolower($arraypic[sizeof($arraypic)-1]);
		if($filetype<>"") {
			$newimage = date('YmdHis')."-".strtolower($key).".".$filetype;
			$arTmp=explode("/upload",$myFileUploadName);
			$target_dir = SYSTEM_RELATIVEPATH_UPLOAD."/".$folder."/";
			$target     = SYSTEM_RELATIVEPATH_UPLOAD."/".$folder."/".$newimage;
			$src        = SYSTEM_RELATIVEPATH_UPLOAD."/".$arTmp[1];
			if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); chmod($target_dir, 0777); }
			copy($src,$target);
			return $newimage;
		} else {
			return "";
		}
	}
}
#-------------------------------------------------------------------
function System_UploadPicture($key,$folder) {
#-------------------------------------------------------------------
	global $_FILES;
	$newimage='';
	$imageupload = $_FILES['input'.$key]['tmp_name'];
	$imageupload_name = $_FILES['input'.$key]['name'];
	if(isset($imageupload_name)){
		$arraypic = explode(".",$imageupload_name);
		$filetype = strtolower($arraypic[sizeof($arraypic)-1]);
		if($filetype<>"") {
			$newimage = date('YmdHis')."-".strtolower($key).".".$filetype;
			$target_dir = SYSTEM_RELATIVEPATH_UPLOAD."/".$folder."/";
			if(!is_dir($target_dir)) { mkdir($target_dir, 0777, true); chmod($target_dir, 0777); }
			copy($imageupload , $target_dir.$newimage);
			return $newimage;
		}
	}
	return "";
}
#-------------------------------------------------------------------
function System_CreateThumb($file,$folder,$w,$h) {
#-------------------------------------------------------------------
	if($file<>"") {
		$arInfo = getimagesize($folder.$file); 
		$mime   = $arInfo['mime'];
		$width  = $arInfo[0];
		$height = $arInfo[1];
		$r = $width / $height;
		if ($w/$h > $r) {
			$newheight = $w/$r;
			$newwidth = $w;
		} else {
			$newwidth = $h*$r;
			$newheight = $h;
		}
		if($newwidth>$w) {
			$addx=ceil(($newwidth-$w)/2);
			$addy=0;
		} else if($newheight>$h) {
			$addy=ceil(($newheight-$h)/2);
			$addx=0;
		} else {
			$addx=0;
			$addy=0;
		}
		//$randnum = sprintf("%06d", mt_rand(1, 999999));
		$newname = "thumb-".$file;
		if($mime=="image/png") {
			// resize ------------------------------------------------
			$src = imagecreatefrompng($folder.$file);
			$dst = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			// crop ------------------------------------------------
			if($addx>0 || $addy>0) {
				$dst2 = imagecreatetruecolor($w,$h);
				imagecopyresampled($dst2, $dst, 0, 0, $addx, $addy, $newwidth, $newheight, $newwidth, $newheight);
				imagepng($dst2,$folder.$newname);
			} else {
				imagepng($dst,$folder.$newname);
			}
		}
		if($mime=="image/jpeg" || $mime=="image/jpg") {
			// resize ------------------------------------------------
			$src = imagecreatefromjpeg($folder.$file);
			$dst = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($dst,$folder.$newname);
			// crop ------------------------------------------------
			if($addx>0 || $addy>0) {
				$dst2 = imagecreatetruecolor($w,$h);
				imagecopyresampled($dst2, $dst, 0, 0, $addx, $addy, $newwidth, $newheight, $newwidth, $newheight);
				imagejpeg($dst2,$folder.$newname);
			} else {
				imagejpeg($dst,$folder.$newname);
			}
		}
	}
}
#-------------------------------------------------------------------
function System_Minify_HTML($buffer) {
#-------------------------------------------------------------------
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
	if(CONFIG_MINIFY_OUTPUT) { $buffer = preg_replace($search, $replace, $buffer); }
    return $buffer;
}
#-------------------------------------------------------------------
function System_Clear_Cache($arClearCache) {
#-------------------------------------------------------------------
	if(CONFIG_USE_FILE_CACHING) {
		for($i=0;$i<=sizeof($arClearCache);$i++) {
			if($arClearCache[$i]<>"") {
				$Cache_Folder=SYSTEM_RELATIVEPATH_UPLOAD."/system_cache/".$arClearCache[$i]."/";
				if(is_dir($Cache_Folder)) {
					$Cache_Dir = scandir($Cache_Folder);
					foreach($Cache_Dir as $Cache_FileName) {
						if ($Cache_FileName!='.' && $Cache_FileName!='..') {
							@unlink($Cache_Folder.$Cache_FileName);
						}
					}
				}
			}
		}
	}
}

?>