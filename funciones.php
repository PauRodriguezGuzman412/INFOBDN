<?php
    function connection(){
        $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
        if($connection){
            return $connection;
        }else{
            return "Error de conexión";
        }
    }


?>  
