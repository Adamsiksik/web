<?php
session_start();
if(isset($_POST['email'])&&isset($_POST['psw'])) {
    $user = $_POST['email'];
    $pass = $_POST['psw'];
    try {
        $db = new mysqli('localhost', 'root', '', 'proj');
        $qry = "select * from member";
        $db->query($qry);
        $res = $db->query($qry);
        for ($i = 0; $i < $res->num_rows; $i++) {
            $row = $res->fetch_assoc();
            if(( $row['Email']=$user)&&($row['Password']==sha1($pass))){
                $_SESSION['isMember']=1;
                $_SESSION['UserName']=$user;
                if($_SESSION['UserName']=="adamsiki@Hotmail.com"){
                    header('Location:admin.php');
                }
                else{
                    header('Location:medic.php');
                }
            }
        }
        $db->close();
    } catch (Exception $e) {

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: lightyellow;
        background-image: url("./img/67813040-abstract-background-medical-substance-and-molecules-.jpg");
        background-repeat: no-repeat;
        background-size: 2000px;
        position: absolute;
    }
    form{
        margin-left: 480px;
        margin-top:170px;
        background-color: white;
        width: 50%;
        height: 500px;
    }
    form h1{
        margin-left: 15px;
    }
    form p{
        margin-left: 15px;
    }
    form label{
        margin-left: 15px;
    }

    input[type=text], input[type=password] {
        margin-bottom: 15px;
        margin-top: 10px;
        width: 90%;
        padding: 15px;
        box-sizing:border-box;
        margin-left: 15px;
        margin-right: 200px;
        display: inline-block;
        border: 1px solid #ccc;
        background: #f1f1f1;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }
    button {
        background-color:lightgreen;
        color: black;
        padding: 14px 20px;
        margin-left: 25px;
        margin-top: 8px;
        border: none;
        cursor: pointer;
        width: 150px;
        box-sizing:border-box;
        opacity: 0.9;
        transition-duration: 0.4s;
        text-decoration: none;
        overflow: hidden;
        cursor: pointer;
    }
    button:hover {background-color: #3e8e41}

    button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

</style>
<body>
<form  style="border:1px solid #ccc" method="post">
    <div class="container">
        <h1>Login</h1>

        <hr>

        <label ><b>Email</b></label>
        <input type="text" onfocus="this.value=''" placeholder="Enter Email" name="email"required>

        <label ><b>Password</b></label>
        <input type="password" onfocus="this.value=''" placeholder="Enter Password" name="psw" required>

        <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="clearfix">
            <a href="p1.html" style="color:black;"> <button type="button" class="cancelbtn">Cancel</button></a>
            <button type="submit" class="signupbtn">login</button>
        </div>
    </div>
</form>
</body>
</html>