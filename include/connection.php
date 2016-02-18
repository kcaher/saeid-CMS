
<?php
$user ='root';
$pass ='';
$dbname ="saeid";
$host = 'localhost';

//connect to database
$sql = mysqli_connect($host,$user,$pass);
if(mysqli_connect_errno()){
echo "unable connect to $dbname".mysqli_connect_error()."<br>";
}else{
mysqli_select_db($sql,$dbname);
}

?>