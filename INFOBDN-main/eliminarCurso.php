<?php

    session_start();
    include('funciones.php');

    $connection= connection();
    $sql= "SELECT activo FROM cursos WHERE Codi= ".$_GET['codi']."";
    $result= mysqli_query($connection, $sql);
    if(mysqli_fetch_row($result)[0]==1){
        $sql= "UPDATE cursos SET activo= 0 WHERE Codi= ".$_GET['codi']."";
        $result= mysqli_query($connection, $sql);
    }else{
        $sql= "UPDATE cursos SET activo= 1 WHERE Codi= ".$_GET['codi']."";
        $result= mysqli_query($connection, $sql);
    }

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminCurso.php">
<?php

?>