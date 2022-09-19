<?php
session_start();

    echo("<table>");
    echo("<tr>");
    echo("<td>DNI</td>");
    echo("<td>Nom</td>");
    echo("<td>Cognoms</td>");
    echo("<td>Password</td>");
    echo("<td>Titol</td>");
    echo("<td>Foto</td>");
    echo("<td>Editar</td>");
    echo("<td>Borrar</td>");
    echo("</tr>");

    $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
    $sql2= "SELECT * FROM profesores";
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
        echo "<td> <a href='editarProfesor.php'>Editar</a> </td>";
        echo "<td> <a href='eliminarProfesor.php'>Borrar</a> </td>";
        echo "</tr>";
    }
    echo("</table>");


?>