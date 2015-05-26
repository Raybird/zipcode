<?php
/**
 * http://data.gov.tw/
 * search: 3+2碼郵遞區號
 * 
 * http://data.gov.tw/node/5948
 * parser txt to json for simple jquery demo
 */
 
$citys = array();

function lineParser($string){
	global $citys;
	$line = explode("  ", $string);
	$str = trim($line[0]);
	
	$zipcode = mb_substr($str, 0, 5, 'utf-8');
	$city = mb_substr($str, 5, 3, 'utf-8');
	$area = mb_substr($str, 8, 10, 'utf-8');
	
	$c = array();
	if(array_key_exists($city, $citys)){
		$c = $citys[$city];
		$c[$area] = $zipcode;
	}else{
		$c[$area] = $zipcode;
	}
	$citys[$city] = $c;
}


$handle = fopen("Zip32_UTF8_10303.TXT", "r");
if ($handle) {
	// 下載下來的檔案第一行解析有問題
	// 直接第一行手動輸入 enter 換行，跳過第一行
	$line = fgets($handle);
	while (($line = fgets($handle)) !== false) {
		lineParser($line);
	}

	fclose($handle);
	$result = "var zipcode =";
	$result .=  json_encode($citys, JSON_UNESCAPED_UNICODE);
	echo $result;
	$fp = fopen('results.js', 'w');
	fwrite($fp, $result);
	fclose($fp);
} else {
	// error opening the file.
}