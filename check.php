<?php
session_start();
if(isset($_SESSION['isMember'])){
    if($_SESSION['isMember']==1){
     echo "hello" ;?>

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
        <body>
        <p>hello there</p>
        </body>

        </html>
        <?php

    }
else{
}
}
