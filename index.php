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

<center>
<br>HI ALL<br>
<br>
this CMS is just for test
</center>
<br><br><br>
LAST NEWS:<br>
<p>

<?php

$query="select * from news";
$result=mysqli_query($sql,$query);

if($result)
	{
		while($row=mysqli_fetch_array($result))
		{$id=$row['id'];
		 $last=$id;
		}
	       if(isset($last))
		   {
			 $query="select * from news where id=$last";	
			 $result=mysqli_query($sql,$query);
	
			 while($row=mysqli_fetch_array($result))
				{$id=$row['id'];
				 $title=$row['title'];
				 $content=$row['content'];
				 $pic=$row['pic'];
				 $title=str_replace('%5c','\\',$title);
				 $content=str_replace('%5c','\\',$content);
				 
				 echo "<div class='title' >title: ".$title ."</div><br>";
				 echo "<div class='content' >content:". $row['content'] ."</div><br>";
				 
				 if($pic!=NULL)
					{echo "pic:<br> <img alt=".$row['pic']." height=200 width=300 src=". $row['pic']." />";}
				}
			}
			else
				{echo "Wellcome ";}	
	}			
else
	{echo "Wellcome ";}
?>

</p>
<br><br><br><br><br><br>
<div  class="footer">

</div>
</body>
</html>