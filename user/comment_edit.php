<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role']!='user')
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
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../about.php							">About us</a></li>
<li><a href="<?php echo dirname($_SERVER['PHP_SELF']);?>/../contact.php							">Contact</a></li>

</ul>
</center>
<hr>
<br>

<?php 
//editor comment
$username=$_SESSION['username'];
if(isset($_GET['ediid']) && is_numeric($_GET['ediid'])) 
	{
	 $ediid=$_GET['ediid'];

	 $query="select username from comments where id=$ediid";
	 $result=mysqli_query($sql,$query);
	 if($result=$username)
		{
		 $query="select * from comments where id=$ediid ";
		 $result=mysqli_query($sql,$query);

		 while($row=mysqli_fetch_array($result))
			{	
			 $eid=$row['id'];
			 $content=$row['content'];
			 $content=str_replace('%5c','\\',$content);
			}
		
		 echo "
			 <form action='' method=post >
			 comment :<br> <textarea  cols=50 rows=3 type=text name=content value=$content >$content</textarea>
			 <input type=submit name=submit value=Edit >
			 </form>";	
			
			 if(isset($_POST['submit']))
				 {
				 $content=$_POST['content'];
				
				 //forbidden SQL bug
				 $content=str_replace('\\','%5c',$content);
	 	 
				 //forbidden XSS bug
				 $content=htmlentities($content);
				
				 $redirect=$_SERVER['HTTP_REFERER'];
				 $query="update comments set content='$content' where id='$ediid' ";
				 if(mysqli_query($sql,$query))
					{echo "<font color=green > ** Your Content Edited Successfully. **</font>";}
				}

				
		}
	}
?>

 
<br><br><br><br><br><br>
<div id="footer" >
<li><a href="comment.php ">Back</a></li>
</div>
</body>
</html>
	
		