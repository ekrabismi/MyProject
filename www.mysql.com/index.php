<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySQL Console</title>
</head>

<body>
<?php
$fp = fopen("ini.txt","r");
while(($data[] = fgets($fp))) { }
$file_host = $data[0];
$file_user = $data[1];
$file_password = $data[2];
$file_db = $data[3];

if(isset($_POST['connect']))
{
	$host = $_POST['host'];
	$user = $_POST['user'];
	$password = $_POST['password'];
	$db = $_POST['db'];
	
	$link = mysql_connect($host,$user,$password);
	$connect = mysql_select_db($db,$link);
	if($connect)
	{
	 echo "Connected";
	}
	else
	 echo "DB Connection Error!";
}
else if(isset($_POST['save']))
{
	$host = $_POST['host'];
	$user = $_POST['user'];
	$password = $_POST['password'];
	$db = $_POST['db'];
	
	$fp = fopen("ini.txt","w");
    fwrite($fp,$host."\n");
	fwrite($fp,$user."\n");
	fwrite($fp,$password."\n");
	fwrite($fp,$db."\n");
	
	echo "Saved";
}
?>
<form action="" method="post">
<table>
 
 <tr><td>Host</td><td>:</td>
 <td><input type="text" name="host" required="required" value="<?= isset($_POST['host'])? $_POST['host']: $file_host ?>" size="30" /></td>
 </tr>
 
 <tr><td>User</td><td>:</td>
 <td><input type="text" name="user" required="required" value="<?= isset($_POST['user'])? $_POST['user']: $file_user ?>" size="30" /></td>
 </tr>
 
 <tr><td>Password</td><td>:</td>
 <td><input type="text" name="password" value="<?= isset($_POST['password'])? $_POST['password']: $file_password ?>" size="30" /></td>
 </tr>

 <tr><td>DB</td><td>:</td>
 <td><input type="text" name="db" required="required" value="<?= isset($_POST['db'])? $_POST['db']: $file_db ?>" size="30" /></td>
 </tr>
 
</table>
<input type="submit" value="Check Connecttion" name="connect" />
<input type="submit" value="Save Info" name="save" />
<br />
<?php
if(isset($_POST['runsql']))
{
	$host = $_POST['host'];
	$db = $_POST['db'];
	$user = $_POST['user'];
	$password = $_POST['password'];
	$sql = $_POST['sql'];
	
	$link = mysql_connect($host,$user,$password);
	$connect = mysql_select_db($db,$link);
	if($connect)
	{
	 $result = mysql_query($sql,$link);
	 if($result)
	  echo "Run successful";
	 else
	  echo mysql_error();
	}
	else
	 echo "DB Connection Error!";
}
?>
<br />
<textarea  cols="60" rows="10" name="sql"><?= isset($_POST['sql'])? $_POST['sql']: '' ?></textarea>
<input type="submit" name="runsql" value="Run SQL" />
</form>
</body>
</html>