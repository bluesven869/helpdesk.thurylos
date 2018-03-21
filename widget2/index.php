<?php
if(!empty($_GET['url'])) {
	var_dump($_GET['url']);
	$url = "https://helpdesk.bitrix24.com";
	$p = 0;
	foreach ($_GET as $key=>$value){
		if($p == 0) {
			$url .=  "/?".$key."=".urldecode($value);
		}else {
			$url .= "&".$key."=".urldecode($value);
		}
		$p++;
	}
} 
//header('Location: http://helpdesk.thurlyos.com/?url='.$url);
?>
