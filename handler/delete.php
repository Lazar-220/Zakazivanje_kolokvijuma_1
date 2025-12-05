<?php
require "../dbBroker.php";
require "../model/prijava.php";

if(isset($_POST['id_predmeta'])){
    $status=Prijava::deleteById($conn,$_POST['id_predmeta']);
    if($status){
        echo "Success";
    }else{
        echo "Failed";
        echo $status;
    }
}
?>