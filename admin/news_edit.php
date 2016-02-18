<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role']!='admin')
{header("Location: index.php");exit();}

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

<?php 


$query="select * from news";
$result=mysqli_query($sql,$query);

		while($row=mysqli_fetch_array($result))		
		{
		 $eid=$row['id'];
		 $title=$row['title'];
		 $content=$row['content'];
		 $title=str_replace('%5c','\\',$title);
		 $content=str_replace('%5c','\\',$content);
		 $pic=$row['pic'];

		 echo "<div class=title >Title : " . $title ."</div>";
		 echo "<div class=content >Content : " . $content ."</div>";
		 
		 echo "<br>";
		
		 if($pic!=NULL)
			{echo "Pic :<br> <img src=$pic hight=40px width=80px >"; }
		
		 echo "<ul id='nav2'><li><a href=\"manager.php?eid=$eid\">Edit</a></li></ul>";

		 echo "===============================================================================<br>";	
		
		}


?>
<br><br><br><br><br><br>
<div id="footer" >
<li><a href="admin.php ">Back</a></li>
</div>
</body>
</html>
