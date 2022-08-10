<?php
    $host = "localhost"; 
    $username= "root";  
    $password= ""; 
    $db_name ="db_modal_ajax";

    $conn = mysqli_connect($host,$username,$password,$db_name);

    if(!$conn){
        echo "Error conect database : ". mysqli_connect_error();
    }
?>