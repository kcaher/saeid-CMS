<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || ($_SESSION['username']!="admin" ) || ($_SESSION['role'])!='admin' )


{header("Location: index.php");exit();}

require "../include/connection.php";

?>
<html>
<head>
<title>Admin manage</title>

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
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>						">Admin</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../about.php			">About us</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../contact.php			">Contact</a></li>

</ul>
</center>
<hr>
<br>

<?php

$query="select * from admins where id!=1";
$result=mysqli_query($sql,$query);

while($row=mysqli_fetch_array($result))
	{$username=$row['username'];
	 $id=$row['id'];
	 $status=$row['status'];
	 
		if($status==1)
			{echo " <ul id=\"nav2\"><li><a href=\" admin_manage.php?inadm=$id \" >Inactive</a> $username<br></li></ul>";}
		 elseif($status==0)
			{echo " <ul id=\"nav2\"><li><a href=\" admin_manage.php?acadm=$id \" >active</a> $username<br></li></ul>";}

	}

if(isset($_GET['inadm']))
	{$id=$_GET['inadm'];
	 $query="update admins set status='0' where id=$id ";
	 if(mysqli_query($sql,$query))
			{header("Location: admin_manage.php");exit();}
		else
			{echo "an error occurred: ".mysqli_error($sql);}	
}

if(isset($_GET['acadm']))
	{$id=$_GET['acadm'];
	 $query="update admins set status='1' where id=$id ";
	 if(mysqli_query($sql,$query))
			{header("Location: admin_manage.php");exit();}
		else
			{echo "an error occurred: ".mysqli_error($sql);}	
}
?>

<br><br><br><br><br><br>
<div id="footer" >
<li><a href="admin.php">Back</a></li>
</div>

</body>
</html>






