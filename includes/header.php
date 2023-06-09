<?php
    require_once('includes.php');

    //call database method for database connection
    $user = new User();
    $location = new Location();
    $transfer = new Transfer();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

     <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./fontawesome/css/all.min.css"/>
    <script src="./fontawesome/js/all.min.js"></script>
    
    <!-- JavaScript and JQuery -->
    <script src="./js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->
    
    <title><?php echo $systemName; ?></title>