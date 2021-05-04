<?php
session_start();
if(isset($_SESSION['isMember'])){
    if($_SESSION['isMember']==1){
        $mysqli = new mysqli('localhost', 'root', '', 'proj');
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }
        $u=$_SESSION['UserName'];
        $sql = "SELECT medicine_name , Date_of_start,price,used_to_cure FROM medicine WHERE u_email='$u'";
        $rs=$mysqli->query($sql);
        ;?>
        <script>

            function del() {
                <?php
                $em=$_POST['medi'];
                $db = new mysqli('localhost', 'root', '', 'proj');
                $qry = "DELETE FROM medicine WHERE medicine_name= '$em'";
                if ($mysqli->query($qry) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . $mysqli->error;
                }

                ?>
            }

            function add() {
                <?php
                if(isset($_POST['med'])) {
                    $name=$_POST['med'];
                    $date = $_POST['date'];
                    $pr = $_POST['price'];
                    $cu = $_POST['cure'];

                    try {
                        $db = new mysqli('localhost', 'root', '', 'proj');
                        $qry = "INSERT INTO `medicine` (`medicine_name`, `Date_of_start`, `price`, `used_to_cure`, `u_email`) VALUES ('". $name."', '".$date."', '".$pr ."', '".$cu."','".$u ."')";
                        $rs=$db->query($qry);
                        $db->commit();
                        $db->close();
                        header('location: medic.php');
                    } catch (Exception $e) {

                    }
                }
                ?>
            }

        </script>

        <style>
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
            table {
                margin-top: 20px;
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
                background-color: #4CAF50;
                color: white;
            }
            body {font-family: Arial, Helvetica, sans-serif;}
            * {box-sizing: border-box;}

            /* Button used to open the contact form - fixed at the bottom of the page */
            .open-button {
                background-color: #555;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                opacity: 0.8;
                position: fixed;
                bottom: 23px;
                right: 28px;
                width: 280px;
            }

            /* The popup form - hidden by default */
            .form-popup {
                display: none;
                position: fixed;
                margin-left: 600px;
                margin-bottom: 100px;
                border: 3px solid #f1f1f1;
                z-index: 9;

            }

            /* Add styles to the form container */
            .form-container {
                max-width: 450px;
                padding: 10px;
                background-color: white;
            }

            /* Full-width input fields */
            .form-container input[type=text], .form-container input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                border: none;
                background: #f1f1f1;
            }

            /* When the inputs get focus, do something */
            .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }

            /* Set a style for the submit/login button */
            .form-container .btn {
                background-color: #04AA6D;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-bottom:10px;
                opacity: 0.8;
            }

            /* Add a red background color to the cancel button */
            .form-container .cancel {
                background-color: #04AA6D;
            }

            /* Add some hover effects to buttons */
            .form-container .btn:hover, .open-button:hover {
                opacity: 1;
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

    <script>
        function openForm1() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm1() {
            document.getElementById("myForm").style.display = "none";
        }

        function openForm2() {
            document.getElementById("myForm2").style.display = "block";
        }

        function closeForm2() {
            document.getElementById("myForm2").style.display = "none";
        }


    </script>

        <button class="open-button" onclick="openForm1()">Add medicine</button>

        <div class="form-popup" id="myForm">
            <form  class="form-container " style="border:1px solid #ccc" method="post" >
                <h1>Enter Data to add</h1>

                <label for="med"><b>Medicine Name</b></label>
                <input type="text" placeholder="Enter med" name="med" required>

                <label for="date"><b>Date</b></label>
                <input type="text" placeholder="Enter date" name="date" required>

                <label for="price"><b>Price</b></label>
                <input type="text" placeholder="Enter price" name="price" required>

                <label for="cure"><b>User To Cure</b></label>
                <input type="text" placeholder="Enter what its used to cure" name="cure" required>

                <input class="btn" type="submit" value="submit">
                <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
            </form>
        </div>

        <button style="left: 1100px" class="open-button" onclick="openForm2()">delete medicine</button>
        <div class="form-popup" id="myForm2">
            <form  class="form-container " style="border:1px solid #ccc" method="post" >
                <h1>Enter Medicine to delete</h1>

                <label for="medi"><b>Medicine Name</b></label>
                <input type="text" placeholder="Enter medicine to delete" name="medi" required>


                <input class="btn" type="submit" value="submit">
                <button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
            </form>
        </div>


    <table style="width:100%">
        <tr>
            <th>medicine</th>
            <th style="width: 500px">started taking at</th>
            <th>price </th>
            <th>used to cure</th>
        </tr>
        <?php
        if ($rs = mysqli_query($mysqli, $sql)) {
            while ($row = mysqli_fetch_row($rs)) {
                    echo " <tr>";
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
                echo " </tr>";

            }
            $rs -> free_result();
            ?>
            </table>
            </body>
            </html>
            <?php
        }
        else{
            header('Location:login.php');

        }
    }
}
