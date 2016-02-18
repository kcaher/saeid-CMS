<?php
require "include/connection.php";
require "include/functions.php";

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
<br>

<form action='' method=post >
username:<input name=username 	type=text  		/>
mail:	 <input name=mail 		type=text  		/><br><br>
password:<input name=password1 	type=password  	/>
password:<input name=password2 	type=password  /><br><br>
<input name=submit type=submit />
</form>



<?php

if(!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['mail']) && ($_POST['password1']==$_POST['password2']) && ($_POST['username']!="admin" ) )
	{
	 $username=$_POST['username'];
	 $password=$_POST['password1'];
	 $mail=$_POST['mail'];
	 
	 $testpass=preg_match('/^[-_a-z0-9\s ]+$/i' ,$password,$array);
	 $testuser=preg_match('/^[-_a-z0-9\s ]+$/i' ,$username,$array);
	 $testmail=$testmail=preg_match('/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-_a-z0-9]+(\.[-_a-z0-9]+)*(\.[a-z]{2,3})$/i',$mail,$array);  //filter_var($mail, FILTER_VALIDATE_EMAIL);  
	 
	 if($testmail==0)
		{echo "<font color=red > * The Mail Not Valid.</font>";}
	 if($testuser==0 || $testpass==0)
		{echo "<font color=red > * The acceptable characters is : a-z , A-Z , - , _ and space.</font>";}
		
	 if($testmail==1 && $testpass==1 && $testuser==1)	
		{
		 $actcod=random_active_code();
		 $query="insert into users (username,password,mail,active_code,status) values (\"$username\",\"$password\",\"$mail\",\"$actcod\",\"0\")";
		 if(mysqli_query($sql,$query))
			{mail($mail,'active code',"\n hi $username \n\n your data was submitted in our database.\n for complete your register please click on below link:\n
			 http://127.0.0.1/saeid-CMS/activation.php?usr=$username&active=$actcod");
			 echo "<font color=green > ** For Complete The Register Process Check YOur Mail. **</font>";}
		 else
			{echo "An error occurred: ".mysqli_error($sql);}
		
		}
	}
else
	{if(!isset($_POST['username']) || !isset($_POST['password1']) || !isset($_POST['password2']) || !isset($_POST['email']) )
		{echo "<font color=red > * Please fill all inputs.</font>";}
	
     if(isset($_POST['password1']) && isset($_POST['password2'])  && $_POST['password1']!=$_POST['password2'])
		{echo "<font color=red > * The Passwords Not Match.</font>";}
		
	 if(isset($_POST['username']) && $_POST['username']=="admin")	
		{echo "<font color=red > * YOU CAN NOT USE THIS USERNAME.</font>";}
	}


?>


<br><br><br><br><br><br>
<div  class="footer">

</div>
</body>
</html>