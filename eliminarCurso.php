<?php

session_start();

var_dump($_GET['codi']);

$connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
$sql= "UPDATE cursos SET activo= 0 WHERE Codi= ".$_GET['codi']."";
var_dump($sql);
$result= mysqli_query($connection, $sql);

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
<?php

?>