<?php
# Create Google Sitemap for Viviann Shop
# Created by Mai Minh minh@maingo.com
# Date: 28/11/2006
# Update By PhanTom 19/12/2013
#---------------------------------
# Autodetect current root folder
if (!defined( "ROOT_PATH" )) {
	define("ROOT_PATH", dirname(__FILE__)."/");
}

include_once(ROOT_PATH."includes/functions.inc.php");
include_once(ROOT_PATH."includes/config.inc.php");
include_once(ROOT_PATH."includes/constant.inc.php");
//include_once(ROOT_PATH."classes/data/textfilter.class.php");

$link = mysql_connect($config["db_server"],$config["db_user"],$config["db_pwd"]);
mysql_select_db($config["db_name"]) or die ("Cannot connect database!");

//include_once(ROOT_PATH.'classes/dao/domains.class.php');
//$domains = new Domains(); 
# Table Prefix in the database
$tableprefix = 'dc_';

$url = 'http://hungphatinterior.com';
#$domain = $rowdomain['name'];
# Path to the index (with trailing slash)
#$url = $_SERVER['HTTP_HOST'];
$sitemap_file = "sitemap.xml";

# Priotity settings
$week_prio = 0.5;
$item_prio = 0.3;
$cat_prio = 0.8;

# Update frequency
$weekly = 'weekly';
$item_update = 'weekly';
$cat_update = 'daily';
$content = "";

# Print XML header
$content .= xml_head($url);


#------------------------List Statics-------------------------------
$result = mysql_query('SELECT `slug` FROM '.$tableprefix.'static WHERE status = 1');
while ($row = mysql_fetch_array($result))
{
	$static = $url."/".$row['slug'].".htm";
	$content .= print_xml($static,$cat_prio,date("Y-m-d"),$item_update);
}

$result = mysql_query('SELECT `slug`,`id` FROM '.$tableprefix.'product_categories WHERE status = 1');
while ($row = mysql_fetch_array($result))
{
	$cateproduct = $url."/".$row['slug']."-c".$row['id'].".html";
	$content .= print_xml($cateproduct,$cat_prio,date("Y-m-d"),$item_update);
	$news_result = mysql_query('SELECT id,slug FROM '.$tableprefix.'products WHERE status = 1 AND `cat_id` ='.$row['id'].'');
			while ($news_row = mysql_fetch_array($news_result))
			{ 
			   
			     $newdetail=$url."/".$row['slug']."/";
				  $news = $newdetail.$news_row['slug'].'-p'.$news_row['id'].".html";
				  $content .= print_xml($news,$item_prio,date("Y-m-d"),$item_update);
				
			}
}

//$result = mysql_query('SELECT slug FROM '.$tableprefix.'static WHERE status = 1');
//while ($row = mysql_fetch_array($result))
//{
//	$static = $url."/en/information/".$row['slug'].".htm";
//	$content .= print_xml($static,$cat_prio,date("Y-m-d"),$item_update);
//}
#------------------------List News-------------------------------
$category = $url.'/tin-tuc/';
$content .= print_xml($category,$cat_prio,date("Y-m-d"),$item_update);
$results = mysql_query('SELECT id,slug FROM ' . $tableprefix . 'articles WHERE status = 1');
while ($rows = mysql_fetch_array($results))
{
			$category = $url.'/tin-tuc/'.$rows['slug'].'-n'.$rows['id'].".html";
			$content .= print_xml($category,$cat_prio,date("Y-m-d"),$item_update);
			
			
}










# Print XML footer
$content .= xml_foot();
write_local_file($sitemap_file,$content);
echo "Success!";

function xml_head($url) {
	$freq = 'daily';
	$priority = '1.0';
	$mod = date("Y-m-d")."T".date("H:i:s")."+00:00";
	$str = "<?xml version='1.0' encoding='UTF-8'?>
<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\"
xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">
<url>
  <loc>$url</loc>
  <lastmod>$mod</lastmod>
  <changefreq>$freq</changefreq>
  <priority>$priority</priority>
</url>";
	return $str;
}
#-----------------------------------------------
# xml_foot
#-----------------------------------------------
function xml_foot() {
	$str = "
</urlset>";
	return $str;
}

#-----------------------------------------------
# print_xml
#-----------------------------------------------
function print_xml($url,$priority,$lastmod,$changefreq) {
	$str = "
<url>
  <loc>$url</loc>
  <priority>$priority</priority>
  <lastmod>$lastmod</lastmod>
  <changefreq>$changefreq</changefreq>
</url>";
	return $str;
}
?>
