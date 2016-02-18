<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role']!="admin")
	{header("Location: index.php"); exit();}

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
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../include/install.php 				">Reinstall DB</a></li>

</ul>
</center>
<hr>
<br>



<?php echo "welcome ". $_SESSION['username']."\n"; ?>

<br>


<ul id="nav2">

<li><a href=admin_add.php		 >Add Admin</a></li>
<li><a href=admin_pass.php		 >Change Pass</a></li>
<li><a href=admin_manage.php   	 >manage admin</a></li><br>
<li><a href=news_add.php		 >Add New</a></li>
<li><a href=news_edit.php		 >Edit New</a></li>
<li><a href=news_remove.php		 >Remove New</a></li>
<li><a href=comment.php?page=1	 >comment New</a></li><br>
<li><a href=logout.php			 >Log out</a></li>

</ul>


<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>
</html>