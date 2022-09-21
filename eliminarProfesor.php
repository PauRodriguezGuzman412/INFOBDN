<?php

session_start();

var_dump($_GET['dni']);

$connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
$sql= "UPDATE profesores SET activo= 0 WHERE DNI= '".$_GET['dni']."'";
var_dump($sql);
$result= mysqli_query($connection, $sql);

?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
<?php

?>