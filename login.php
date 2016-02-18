<?php
session_start();
require "include/connection.php";

?>

<html>
<head>
<title>User Login</title>

<link rel="stylesheet" href="include/style.css" />
</head>
<body>
<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);
?>

<center>

<ul id="nav">

<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php							">Index</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/news.php?page=<?php echo $count;?>	">News</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/register.php						">register</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/about.php							">About us</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/contact.php						">Contact</a></li>

</ul>
</center>
<hr>

<br>
<form action="" method="post" >

username:<input type=text   	name=username >
password:<input type=password   name=password 	autocomplete=off >
         <input type=submit 	name=submit  	value=Login>

</form>

<?php 

if(isset($_POST['username']) && isset($_POST['password']) )
{
	$user=$_POST['username'];
	$pass=$_POST['password'];
	
	
	$query = "SELECT * FROM users";
	$result = mysqli_query($sql,$query); 

	while($row = mysqli_fetch_array($result))
		{ if($row['username']==$user && $row['password']==$pass && $row['status']==1 )
			{$_SESSION['username']=$user;
			 $_SESSION['password']=$pass;
			 $_SESSION['role']='user';
			 header("Location: user"); exit();
			}
			else
				{
				 if($row['username']==$user && $row['password']==$pass && $row['status']==0 )
					{echo "<font color=red > * Your Account Not Active.</font>";}
				}
		}
	 if(isset($_POST['username']) && isset($_POST['password']) )	
		{echo "<font color=red > * Your Username or Password is Incorrect.</font>";}	
}


?>
<br><br><br><br><br><br>
<div id="footer" >

</div>
</body>
</html>