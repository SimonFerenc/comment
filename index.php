<?php
date_default_timezone_set('Europe/Budapest');
include 'dbh.inc.php';
include 'comments.inc.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <?php
        if(isset($_GET['loginfailed'])){
            echo "Hibás felhasználónév vagy jelszó!";
        }
        if (isset($_SESSION['uid'])) {
            echo "<form method='POST' action='".userLogout()."'>
                <button type='submit' name='logoutSubmit'>Log out</button>  
            </form>";
            echo "You are logged in " . $_SESSION['uid'] . "!";
        }
        else {
            echo "<form method='POST' action='".getLogin($conn)."'>
                <input type='text' name='uid'>
                <input type='password' name='pwd'>
                <button type='submit' name='loginSubmit'>Login</button>
            </form>";
        }
        
        ?>
        <a href="reg.php">Regisztráció</a>
        <br><br>
        
       <img src="Star (Full).png">
       
       <?php
      echo "<form method='POST' action='".setComments($conn)."'>
           <textarea name='message'></textarea><br>
           <button type='submit' name='commentSubmit'>Comment</button>
       </form>";
      
      getComments($conn);
               ?>
    </body>
</html>
