<?php
session_start();

if(isset($_POST['submit'])){
    $db= mysqli_connect('localhost', 'root', '', 'commentsection');
    
    if(mysqli_connect_error()){
        die('Hibakód: '.mysqli_connect_error());
    }


$user=$_POST['uname'];
$passwd=$_POST['passwd'];

$select='SELECT * FROM user WHERE uid="'.$user. '"';
$result = $db->query($select);
if (mysqli_num_rows($result) > 0){
    echo "A felhasználónév már foglalt!";
}
else {
  $SelectStr='INSERT INTO user (uid,pwd)VALUES ("'.$user. '","'.sha1($passwd).'")';
$result= mysqli_query($db, $SelectStr);


header('location:index.php');


mysqli_close($db);  
}
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Regisztráció</title>
    </head>
    <body>
        <form method="post">
        <input type="text" name="uname"><br>
        <input type="password" name="passwd"><br>
        <input type="submit" name="submit"><br>
        </form>
    </body>
</html>


