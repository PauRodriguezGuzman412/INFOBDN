<?php

    session_start();
    include('funciones.php');

    $connection= connection();
    $sql= "SELECT activo FROM profesores WHERE DNI= '".$_GET['dni']."'";
    $result= mysqli_query($connection, $sql);
    if(mysqli_fetch_row($result)[0]==1){
        $sql= "UPDATE profesores SET activo= 0 WHERE DNI= '".$_GET['dni']."'";
        $result= mysqli_query($connection, $sql);
    }else{
        $sql= "UPDATE profesores SET activo= 1 WHERE DNI= '".$_GET['dni']."'";
        $result= mysqli_query($connection, $sql);
    }

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminProfesor.php">
<?php

?>