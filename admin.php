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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
<body>
<table style="width:100%">
    <tr>
        <th>Name</th>
        <th>Email</th>
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
                    echo $name;
                    echo $email;


                    try {
                        $db = new mysqli('localhost', 'root', '', 'proj');
                        $qry = "INSERT INTO `member` (`Name`, `PhoneNumber`, `Email`, `Password`, `Gender`) VALUES ('".$name."', '".$PN."', '".$email ."', SHA1('".$pass."'), 'male')";
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
            <label ><b>Email to delete its data</b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter Email" name="email"required>

            <button type="submit" class="submit">delete</button>

        </form>

        <form onsubmit="add()" style="border:1px solid #ccc" method="post" >
            <label ><b>Name </b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter Name" name="Name"required>

            <label ><b>Email </b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter Email" name="email"required>

            <label ><b>PhoneNumer</b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter PN" name="PhoneNumber"required>

            <label ><b>Password </b></label>
            <input type="text" onfocus="this.value=''" placeholder="Enter Pass" name="psw"required>

            <button type="submit" class="submit">add</button>
        </form>

        </body>
        </html>
        <?php
    }
    else{
        header('Location:login.php');

    }
}
}

