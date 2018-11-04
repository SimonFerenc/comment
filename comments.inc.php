<?php

function setComments($conn) {
    if (isset($_POST['commentSubmit'])){
        if (isset($_SESSION['uid'])) {
            $uid = $_SESSION['uid'];
        }
        else {
            $uid = 'Anonymous';
        }
        $date = date('Y-m-d H:i:s');
        $message = $_POST['message'];
        
        $sql = "INSERT INTO comments (uid, date, message) "
                . "VALUES ('$uid', '$date', '$message')";
        $result = mysqli_query($conn,$sql);
        
        header("Location: index.php");
        exit();
    }
}

function getComments($conn) {
    $sql = "SELECT * FROM comments";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
       echo "<div class='comment-box'><p>"; 
       echo $row['uid']."<br>";  
       echo $row['date']."<br>";  
       echo nl2br($row['message']);  
       echo "</p></div>";
    }
    
   
}
function getLogin($conn) {
    if (isset($_POST['loginSubmit'])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    
    $sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='".sha1($pwd)."'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0){
       if ($row = $result->fetch_assoc()){ 
           $_SESSION['uid'] = $row['uid'];
           header("Location: index.php?loginsucces");
           exit();
    }
       
    }else {
        header("Location: index.php?loginfailed");
           exit();
    }
    
    }
}
function userLogout() {
   if (isset($_POST['logoutSubmit'])){
    session_start();
    session_destroy();
      header("Location: index.php");
           exit();
   }   
}

