<?php 
    $connect = mysqli_connect('localhost', 'root', 'Neys_1417', 'pos');
    
    if (!$connect) {
        die('Error connect to DataBase');
    }
?>