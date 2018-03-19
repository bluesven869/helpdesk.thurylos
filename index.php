<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("simple_html_dom.php");
$url = "https://helpdesk.bitrix24.com/widget2/?url=https%3A%2F%2Fbitrix24.com%3A80%2Fcompany%2Fpersonal%2Fuser%2Ftasks%2Findex.php&is_admin=1&user_id=1&tariff=&is_cloud=0&support_bot=0&action=open?";

if(!empty($_GET['url'])) $url = "https://helpdesk.bitrix24.com" . $_GET['url'];
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
); 
$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
$content = str_replace("/bitrix/tools/conversion/ajax_counter.php", "https://helpdesk.bitrix24.com/bitrix/tools/conversion/ajax_counter.php", $content);
$content = str_replace("\/widget2\/handler.php", "aaa", $content);

$html = str_get_html($content);
$css_list = $html->find('link');
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
$html->find('div[class=b24w-header-logo-item-text-word]', 0)->innertext = 'Thurly';
$html->find('div[class=b24w-header-logo-item-text-number]', 0)->innertext = 'OS';
$html->find('div[class=b24w-header-title-item-text-cnr]', 0)->innertext = str_replace("Bitrix24", "ThurlyOS",$html->find('div[class=b24w-header-title-item-text-cnr]', 0)->innertext);

$left_link = $html->find('span[class=b24w-content-menu-section-link-text]');
foreach($left_link as $key=>$link){
	$pos = strpos($link->innertext, "Bitrix24");
	if($pos === false) {

	} else {
		$left_link[$key]->innertext = str_replace("Bitrix24", "ThurlyOS", $link->innertext);
	}
}
$html->find('div[class=b24w-content-inner-item]', 0)->innertext = str_replace("Bitrix24", "ThurlyOS", $html->find('div[class=b24w-content-inner-item]', 0)->innertext);


$menu_link = $html->find('a[class=b24w-content-menu-section-link]');
foreach($menu_link as $key=>$link) {
	$menu_link[$key]->attr["data-internal-url"] = "?url=".$menu_link[$key]->attr["data-internal-url"];
}
$my_link = $html->find('a[class=b24w-content-inner-block-list-item-detail-link]');
foreach($my_link as $key=>$link) {
	$my_link[$key]->attr["data-internal-url"] = "?url=".$my_link[$key]->attr["data-internal-url"];
	$my_link[$key]->attr["href"] = "?url=".$my_link[$key]->attr["href"];
	$my_link[$key]->innertext = "aaa";
	var_dump($my_link[$key]->attr["href"]);
}
//var_dump($my_link);
echo $html;
?>