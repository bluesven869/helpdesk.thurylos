<?php
include("../simple_html_dom.php");
if(!empty($_GET['url'])) {
	
	$url = $_GET['url'];
	
	$new_url = "https://helpdesk.bitrix24.com/widget2";
	$p = 0;
	foreach ($_GET as $key=>$value){
		if($p == 0) {
			$new_url .=  "/?".$key."=".urldecode($value);
		}else {
			$new_url .= "&".$key."=".urldecode($value);
		}
		$p++;
	}
	$new_url = str_replace("http://thurlyos.com", "https://bitrix24.com", $new_url);
} 

$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
); 
var_dump($new_url);
$content = file_get_contents($new_url, false, stream_context_create($arrContextOptions));
$content = str_replace("/bitrix/tools/conversion/ajax_counter.php", "https://helpdesk.bitrix24.com/bitrix/tools/conversion/ajax_counter.php", $content);
$content = str_replace("Bitrix24", "ThurlyOS", $content);
$html = str_get_html($content);
/*$css_list = $html->find('link');
foreach($css_list as $key=>$css) {
	$css_list[$key]->attr["href"] = "https://helpdesk.bitrix24.com/" .$css_list[$key]->attr["href"];
}
$javascript_list = $html->find('script');
foreach($javascript_list as $key=>$script) {
	if($script->src)
	{
		$pos = strpos($script->src, "http");
		if($pos === false) {
			$javascript_list[$key]->src = "https://helpdesk.bitrix24.com/" . $javascript_list[$key]->src ;
		}	
		
	}
	
}
if($html->find('div[class=b24w-header-logo-item-text-word]', 0))
	$html->find('div[class=b24w-header-logo-item-text-word]', 0)->innertext = 'Thurly';
if($html->find('div[class=b24w-header-logo-item-text-number]', 0))
	$html->find('div[class=b24w-header-logo-item-text-number]', 0)->innertext = 'OS';
$menu_link = $html->find('a[class=b24w-content-menu-section-link]');
foreach($menu_link as $key=>$link) {
	$menu_link[$key]->attr["data-internal-url"] = "?url=".$menu_link[$key]->attr["data-internal-url"];
}
$my_link = $html->find('a[class=b24w-content-inner-block-list-item-detail-link]');
foreach($my_link as $key=>$link) {
	$my_link[$key]->attr["data-internal-url"] = "?url=".$my_link[$key]->attr["data-internal-url"];
	$my_link[$key]->attr["href"] = "?url=".$my_link[$key]->attr["href"];
}*/
echo $html;
?>
