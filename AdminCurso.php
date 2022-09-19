<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="EditCurso.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
    session_start();
    
    echo("<table>");
    echo("<tr>");
    echo("<td>Codi</td>");
    echo("<td>Nom</td>");
    echo("<td>Descripción</td>");
    echo("<td>Horas</td>");
    echo("<td>Data de incio</td>");
    echo("<td>Data final</td>");
    echo("<td>Dni profesores</td>");
    echo("<td>Editar</td>");
    echo("<td>Borrar</td>");
    echo("</tr>");
    

    $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
    $sql2= "SELECT * FROM cursos";
    if($result2= mysqli_query($connection, $sql2)){
        while($row= $result2->fetch_assoc()){
            $llista[]= $row;
        }
    }

    foreach($llista as $clave => $valor){
        echo "<tr>";
        foreach($valor as $clave1 => $valor1){
            echo "<td> ".$valor1." </td>";
        }
        echo "<td> <a href='editarCurso.php'>Editar</a> </td>";
        echo "<td> <a href='eliminarCurso.php'>Borrar</a> </td>";
        echo "</tr>";
    }

    echo("</table>");
?>