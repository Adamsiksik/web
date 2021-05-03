<?php
session_start();
if(isset($_SESSION['isMember'])){
if($_SESSION['isMember']==1){
$mysqli = new mysqli('localhost', 'root', '', 'proj');
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}
$sql = "SELECT NAME , Email,Password,PhoneNumber,Gender FROM member";
$rs=$mysqli->query($sql);

;?>


    <style>
        body{
            background-image: url("./img/index.jpg") ;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: fantasy;

        }
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: lavender;
            font-family: fantasy;


        }

        .sup {
            width: 100%;
            background-color: darkcyan;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: fantasy;

        }

       .sup:hover {
            background-color: #45a049;
        }

        div {
            background-color: transparent;
        }

        table {
            margin-top: 10px;
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 100%;

        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: darkcyan;
            color: white;
        }
        .button {
            background-color:darkcyan;
            margin-left: 1600px;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            font-family: fantasy;

        }
        .te{
            margin-left: 15px;
            font-weight: bold;
            color:darkblue;
        }

    </style>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
<body>
    <a href="p1.html" style="color:black;"> <button class="button" >Logout</button></a>
<table style="width:100%">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>PhoneNumber</th>
        <th>Gender</th>

    </tr>
    <?php
    if ($rs = mysqli_query($mysqli, $sql)) {
        while ($row = mysqli_fetch_row($rs)) {
            if($row[1]=="adamsiki@Hotmail.com"){
            }
            else
            {
                echo " <tr>";
                echo " </tr>";
                echo " <td>";
                printf($row[0]);
                echo " </td>";
                echo " <td>";
                printf($row[1]);
                echo " </td>";
                echo " <td>";
                printf($row[2]);
                echo " </td>";
                echo " <td>";
                printf($row[3]);
                echo " </td>";
                echo " <td>";
                printf($row[4]);
                echo " </td>";
            }
        }
        $rs -> free_result();
        ?>
        </table>

        <script>
            function del() {
                <?php
                $em=$_POST['email'];
                $sql = "DELETE FROM member WHERE Email= '$em'";
                if ($mysqli->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . $mysqli->error;
                }
                ?>
            }

            function add() {
                <?php
                if(isset($_POST['Name'])&&isset($_POST['psw'])&&isset($_POST['email'])) {
                    $name=$_POST['Name'];
                    $email = $_POST['email'];
                    $PN = $_POST['PhoneNumber'];
                    $pass = $_POST['psw'];
                    $g = $_POST['gender'];

                    echo $name;
                    echo $email;


                    try {
                        $db = new mysqli('localhost', 'root', '', 'proj');
                        $qry = "INSERT INTO `member` (`Name`, `PhoneNumber`, `Email`, `Password`, `Gender`) VALUES ('".$name."', '".$PN."', '".$email ."', SHA1('".$pass."'),'".$g ."')";
                        $rs=$db->query($qry);
                        $db->commit();
                        $db->close();
                        echo $rs;
                    } catch (Exception $e) {
                        echo "there is already an email with that value";
                    }
                }
                ?>
            }
        </script>

        <form onsubmit=" del()" style="border:1px solid #ccc" method="post" >
            <label class="te" ><b>Email to delete its data:</b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter Email" name="email"required>

            <button class="sup" type="submit" class="submit">Delete</button>

        </form>

        <div>
            <h2 class="te">Add users:</h2>
            <form onsubmit=" add()" style="border:1px solid #ccc" method="post" >
                <label class="te" for="Name"> Name</label>
                <input type="text" id="Name" name="Name" placeholder="Your Name">

                <label class="te" for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your email">

                <label class="te" for="email">Phonenumber</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Your phone">

                <label class="te" for="email">password</label>
                <input type="text" id="pass" name="psw" placeholder="Your passwrod">

                <label class="te" for="gender">Gender:</label>
                <div class="col-75">
                    <select id="gender" name="gender">
                        <option value="Male" >male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <input class="sup" type="submit" value="Submit">
            </form>
        </div>
        </body>
        </html>
        <?php
    }
    else{
        header('Location:login.php');

    }
}
}

