<?php

    function connection(){
        $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
        if($connection){
            return $connection;
        }else{
            return "Error de conexión";
        }
    }


    function EDitarCursos($var){
        $connection= connection();
        $sql3= "SELECT * FROM cursos WHERE CODI=".$var;
        $result3= mysqli_query($connection, $sql3);                
        $row= mysqli_fetch_assoc($result3);
        
        return $row;
    }
?>  