<?php
    $conn=new mysqli('localhost','root','','kolokvijumi');

    if($conn->connect_errno){
        echo "Neuspesno povezivanje sa bazom: " . $conn->conn_errno;
    }
?>