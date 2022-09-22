<?php

session_start();
include('funciones.php');

var_dump($_GET['codi']);

$connection= connection();
$sql= "UPDATE cursos SET activo= 0 WHERE Codi= ".$_GET['codi']."";
var_dump($sql);
$result= mysqli_query($connection, $sql);

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
<?php

?>