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
            <th>medicine</th>
            <th style="width: 500px">started taking at</th>
            <th>price </th>
            <th>used to cure</th>
        </tr>
        <?php
        if ($rs = mysqli_query($mysqli, $sql)) {
            while ($row = mysqli_fetch_row($rs)) {

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
