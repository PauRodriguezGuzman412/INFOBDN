<?php

    session_start();
    include('funciones.php');


    $connection= connection();
    $sql= "UPDATE cursos SET activo= 0 WHERE Codi= ".$_GET['codi']."";
    $result= mysqli_query($connection, $sql);

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminCurso.php">
<?php

?>