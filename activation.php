<?php
require "include/connection.php";
?>

<html>
<head>
<link rel="stylesheet" href="include/style.css" />
<title>welcome</title>
<head>
<body>

<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);

?>

<center>
<ul id="nav3">
<form method=post action=search.php >
<li><a href=index.php								>Index</a></li>
<li><a href=news.php?page=<?php echo $count; ?> 	>News</a></li>
<li><a href=admin									>Admin</a></li>
<li><a href=login.php								>login</a></li>
<li><a href=register.php							>register</a></li>
<li><a href=about.php								>About us</a></li>
<li><a href=contact.php								>Contact</a></li>

<input type=submit  class=search 				>
<input type=text  	class=search name=word		>
<input type=hidden 	class=search name=title		>
<input type=hidden 	class=search name=content	>
</form>
</ul>
</center>
<hr>



<?php 

if(isset($_GET['active']) && isset($_GET['usr']) )
	{
	 $active=$_GET['active'];
	 $user=$_GET['usr'];
	 $query="update users set status=\"1\" where username=\"$user\" and active_code=\"$active\" ";
		if(mysqli_query($sql,$query))
			{echo "<font color=green > ** Your account was actived. ** </font>";}
	 	else
			{echo "<font color=red > * Not acceptable.</font>";}
	}
else
	{header("Location: register.php");}
?>


<br><br><br><br><br><br>
<div  class="footer">

</div>
</body>
</html>