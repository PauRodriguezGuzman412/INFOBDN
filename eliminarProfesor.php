<?php

    session_start();
    include('funciones.php');

    $connection= connection();
    $sql= "UPDATE profesores SET activo= 0 WHERE DNI= '".$_GET['dni']."'";
    $result= mysqli_query($connection, $sql);

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminProfesor.php">
<?php

?>