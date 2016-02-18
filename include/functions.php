<?php 



function random_active_code(){

$str="0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM~!@$^*)(-_=+?:";
$len=strlen($str)-1;
$random="";
	for($a=0;$a<50;$a++)
	{
		$mtrand=mt_rand(0,$len);
		$random.=substr($str,$mtrand,1);	
	}
	
return $random;
}



 //******************************************************************//
?>

