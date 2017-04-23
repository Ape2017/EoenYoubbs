<?php
$TestData = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f',
			 'g','h','j','k','l','z','x','c','v','b','n','m','0','1',
			 '2','3','4','5','6','7','8','9','林','灿','斌','编','写',
			 '于','二','零','一','五','年','四','月','三','十','日');
if(isset($_GET['char']) && $_GET['char'] != null ){
	$Char = $_GET['char'];
}else{
	$Char = $TestData[mt_rand(0,count($TestData)-1)];
}
$OutputSize = min(512, empty($_GET['size'])?36:intval($_GET['size']));
//Demo start

require(dirname(__FILE__) . "/include/avatars/avatars.php");
// composer
// require(__DIR__ . "/vendor/autoload.php");

$Avatar = new Md\MDAvatars($Char, 512);

$Avatar->Output2Browser($OutputSize);
$Avatar->Save(dirname(__FILE__) .'/avatar/large/9999.png', 73);
//Demo end