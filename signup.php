<?php
if(isset($_POST['Name'])&&isset($_POST['psw'])&&isset($_POST['email'])) {
    $name=$_POST['Name'];
    $email = $_POST['email'];
    $PN = $_POST['PhoneNumber'];
    $pass = $_POST['psw'];
    echo $name;
    echo $email;


    try {
        $db = new mysqli('localhost', 'root', '', 'proj');
        $qry = "INSERT INTO `member` (`Name`, `PhoneNumber`, `Email`, `Password`, `Gender`) VALUES ('".$name."', '".$PN."', '".$email ."', SHA1('".$pass."'), 'male')";
        $rs=$db->query($qry);
        $db->commit();
        $db->close();
        echo $rs;

        header('Location:p1.html');
    } catch (Exception $e) {
        echo "there is already an email with that value";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>

<script>

    function verifyPassword() {
        var pw = document.getElementById("pass").value;
        var pwr = document.getElementById("passr").value;
        if (pw != pwr) {
            document.getElementById("lab").style.visibility = 'visible';
            event.preventDefault();
        }
        else{
            return true;
        }

    }
</script>



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
        margin-top:110px;
        background-color: white;
        width: 50%;
        height:850px;
        margin-bottom: 80px;
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
        position: relative;
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



    .button--loading::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        border: 4px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
    }

    .gen{
        position: relative;
        margin-left: 20px;
        margin-top: 100px;
    }



</style>
<body >

<form onsubmit=" verifyPassword()" style="border:1px solid #ccc" method="post" >
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please Enter a Valid Username and Password </p>
        <hr>
        <label ><b>FullName</b></label>
        <input type="text" placeholder="Name" name="Name" required>

        <label ><b>PhoneNumber</b></label>
        <input type="text" onfocus="this.value=''"  placeholder="Enter PhoneNumber" name="PhoneNumber"required>

        <label ><b>Email</b></label>
        <input type="text" onfocus="this.value=''" placeholder="Enter Email" name="email"required>

        <label ><b>Password</b></label>
        <input type="password" placeholder="Repeat Password" id="pass" name="psw" required>

        <label ><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" id="passr" name="psw-repeat" required>

        <label id="lab" style="color: red; visibility: hidden">Please make sure the password is the same</label>
        <BR>
        <BR>
        <label ><b>Gender:</b></label>
        <br>
        <br>

        <label class="gen">Male
            <input type="radio" checked="checked" name="radio">
            <span ></span>
        </label>

        <label class="gen">Female
            <input type="radio" name="radio">
            <span ></span>
        </label>

        <br>
        <br>
        <br>

        <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="clearfix">
            <a href="p1.html" style="color:black;"> <button type="button" class="cancelbtn">Cancel</button></a>
            <button type="submit" class="submit">Sign Up</button>
        </div>
    </div>
</form>

</body>
</html>
