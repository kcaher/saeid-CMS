<?php
require "include/connection.php";
?>

<html>
<head>
<link rel="stylesheet" href="include/style.css" />
<title>Search</title>
<head>
<body>
<?php
$query="select * from news";
$result=mysqli_query($sql,$query);

$count = mysqli_num_rows($result);

?>
<center>
<ul id="nav">

<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/index.php							>Index</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/news.php?page=<?php echo $count; ?>	>News</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/admin								>Admin</a></li>
<li><a href=login.php																		>login</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/register.php						>register</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/about.php							>About us</a></li>
<li><a href=<?php echo dirname($_SERVER['PHP_SELF']);?>/contact.php							>Contact</a></li>

</ul>
</center>
<hr><br>

<form action=''		 method=post 	>
<input type=text 	 name=word 		>Enter Your word <br><br>
<input type=checkbox name=title 	>title
<input type=checkbox name=content 	>content<br><br>
<input type=submit 	 value=Search 	>
</form>




<?php

if(	(isset($_POST['word']) && !empty($_POST['word'])) && (	isset($_POST['title']) || isset($_POST['content'])  )	)
{
 $word=htmlentities($_POST['word']);
 $word=str_replace('\\','%5c',$word);
 
	if(isset($_POST['title']) && !isset($_POST['content']) )
	{
	 $c=0;
	 $query="select * from news where title like \"%$word%\" order by id desc";
	 
	 $result=mysqli_query($sql,$query);

		while($row=mysqli_fetch_array($result))
		{
		 $c+=1;
		 $id=$row['id'];
		 $title=$row['title'];
		 echo "<ul id='nav2' class=bw ><li><a href=news.php?id=$id >$title</a></li></ul></div>";
		 echo "=======================================";
		}	
	 echo "<br>$c case is Found.<br>";
		
	}
	
	if(isset($_POST['content']) && !isset($_POST['title']) )
	{
	 $c=0;
	 $query="select * from news where content like \"%$word%\" order by id desc ";
	 
	 $result=mysqli_query($sql,$query);
		while($row=mysqli_fetch_array($result))
		{
		 $c+=1;
		 $id=$row['id'];
		 $title=$row['title'];
		 echo "<ul id='nav2' class=bw ><li><a href=news.php?id=$id >$title</a></li></ul></div>";
		 echo "=======================================";
		}	
	 echo "<br>$c case is Found.<br>";
		
	}
	
		if(isset($_POST['content']) && isset($_POST['title']) )
	{
	 $c=0;
	 $query="select * from news where content like \"%$word%\" or title like \"%$word%\" order by id desc";
	 
	 $result=mysqli_query($sql,$query);
		while($row=mysqli_fetch_array($result))
		{
		 $c+=1;
		 $id=$row['id'];
		 $content=$row['content'];
		 $title=$row['title'];
		 
		 echo "<ul id='nav2' class=bw ><li><a href=news.php?id=$id >$title</a></li></ul></div>";
		 echo "=======================================";
		}	
	 echo "<br>$c case is Found.<br>";
		
	}
	

}
else
	{if( isset($_POST['word']) && !isset($_POST['content']) && !isset($_POST['title']))
		{echo "<font color=red > * Use Checkbox.</font>";}
		
	 if( (!isset($_POST['word']) || empty($_POST['word'])) && (isset($_POST['content']) || isset($_POST['title']))	)	
		{echo "<font color=red > * at least Need 1 character.</font>";}
	}



?>





<br><br><br><br><br><br>
<div  class="footer">

</div>
</body>
</html>