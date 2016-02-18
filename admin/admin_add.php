<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || ($_SESSION['role'])!='admin' || $_SESSION['username']!='admin')
{header("Location: admin.php");}

require "../include/connection.php";

?>
<html>
<head>
<title></title>

<link rel="stylesheet" href="../include/style.css" />
</head>
<body>
<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);
?>

<center>

<ul id="nav">

<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../index.php							">Index</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../news.php?page=<?php echo $count;?>	">News</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>										">Admin</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../about.php							">About us</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../contact.php							">Contact</a></li>

</ul>
</center>
<hr>
<br>


<form action='' method="post" >
username:<input name=username type=text >
password:<input name=password type=text >
         <input type=submit value="Add" submit=submit >
</form>



<?php
if(!empty($_POST['password']) && !empty($_POST['username']) ){

$username=$_POST['username']; 
$password=$_POST['password']; 


$testuser=preg_match('/^[-_A-Za-z0-9\s ]+$/',$username,$array);
$testpass=preg_match('/^[-_A-Za-z0-9\s ]+$/',$password,$array);

	if($testuser && $testpass)
		{$query="insert into admins (username, password, status) values ('$username', '$password','1')";
			if(mysqli_query($sql,$query))
				{echo "<font color=green > ** added **</font><br>";}
			else
				{echo "an error occurred:".mysqli_error($sql);}
		}
	else
		{echo "<font color=red > * The allowed characters is a-z A_Z 0-9 - _ and space . </font>";}
}
else
	{if((isset($_POST['password']) || isset($_POST['username'])) && (empty($_POST['password']) || empty($_POST['username'])) )
		{echo "<font color=red > * fill both input.</font>";}
	}
?>

<br><br><br><br><br><br>
<div id="footer" >
<li><a href="admin.php ">Back</a></li>
</div>

</body>
</html>






