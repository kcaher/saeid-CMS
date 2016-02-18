<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role']!='user' )
{header("Location: index.php");exit();}

require "../include/connection.php";

?>
<html>
<head>
<title>USER-PASSWORD</title>

<link rel="stylesheet" href="../include/style.css" />
</head>
<body>
<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);

?>

<center>
<ul id="nav3">
<form method=post action=../search.php >
<li><a href=../index.php								>Index</a></li>
<li><a href=../news.php?page=<?php echo $count; ?> 		>News</a></li>
<li><a href=../about.php								>About us</a></li>
<li><a href=../contact.php								>Contact</a></li>

<input type=submit  class=search 				>
<input type=text  	class=search name=word		>
<input type=hidden 	class=search name=title		>
<input type=hidden 	class=search name=content	>
</form>
</ul>
</center>

<hr>
<br>


<form action='' method="post" >
password:<input name=password type=password ><br><hr>
new password:<input name=password1 type=password ><br>
new password:<input name=password2 type=password ><br>
         <input type=submit value="Change" submit=submit >
</form>



<?php
if(!empty($_POST['password']) && !empty($_POST['password1']) && !empty($_POST['password2']))
	{	$username =$_SESSION['username'];
		$password0=$_SESSION['password'];
		$password =$_POST['password']; 
		$password1=$_POST['password1']; 
		$password2=$_POST['password2']; 
		$testpass=preg_match('/^[-_A-Za-z0-9\s ]+$/',$password1,$array);
		
		$query="update saeid.users set password='$password1' where username='$username' ";

		if( ($password1==$password2) && ($password==$password0) && $testpass )
		{
			if(mysqli_query($sql,$query))
				{echo "<font color=green > ** your password updated successfully. **<br></font>";
				 unset($_SESSION['password']);
				 $_SESSION['password']=$password2;
				 
				}
			else
				{echo "<font color=red > * an error occurred:".mysqli_error($sql)."</font>";}
		}
		else
			{if(($password!==$password0))
				{echo "<font color=red > * Your Password Is Not True.</font>";}
			 if(!$testpass)
				{echo "<font color=red > * The allowed characters is a-z A_Z 0-9 - _ and space . </font>";}
			 if($password1!==$password2)	
				{echo "<font color=red > * Your New Password Is Not Match.</font>";}
				
			
				
			}
		
			
	}
else
	{if(isset($_POST['password']) || isset($_POST['password1']) || isset($_POST['password2']))  
		{echo "<font color=red > * fill all input.</font>";}
	}
?>

<br><br><br><br><br><br>
<div id="footer" >
<li><a href="index.php">Back</a></li>
</div>

</body>
</html>






