<?php
session_start();

    ?>
        <form action="AdminProfesor.php" method="POST" name="buscador">
            Buscador:<input type="text" id="buscador" name="buscador" placeholder="Buscador"></input>
            <button type="submit">Buscar</button>
        </form>
    <?php

    echo("<table>");
    echo("<tr>");
    echo("<td>DNI</td>");
    echo("<td>Nom</td>");
    echo("<td>Cognoms</td>");
    echo("<td>Password</td>");
    echo("<td>Titol</td>");
    echo("<td>Foto</td>");
    echo("<td>Activo</td>");
    echo("<td>Editar Profesor</td>");
    echo("<td>Editar Foto</td>");
    echo("<td>Borrar</td>");
    echo("</tr>");

    if(isset($_POST['buscador']) && $_POST['buscador']!=""){
        $connection2= mysqli_connect('localhost', 'root', '', 'infoBDN');
        $sql3= "SELECT * FROM profesores WHERE Nom LIKE '%".$_POST['buscador']."%'";
        if($result3= mysqli_query($connection2, $sql3)){
            while($row2= $result3->fetch_assoc()){
                $llista2[]= $row2;
            }
        }

        foreach($llista2 as $clave => $valor){
            echo "<tr>";
            foreach($valor as $clave1 => $valor1){
                if($valor['Foto']==$valor1){
                    echo "<td> <img width='50' height='50' src=".$valor1."> </td>";
                }else{
                    echo "<td> ".$valor1." </td>";
                }
            }
            echo "<td> <a href='EditProfesor.php?curso=".$valor['DNI']."'>Editar</a> </td>";
            echo "<td> <a href='eliminarProfesor.php?eliminar=".$valor['activo']."&dni=".$valor['DNI']."'>Borrar</a> </td>";
            echo "</tr>";
        }
        
        echo("</table>");
    }else{
    
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
                if($valor['Foto']==$valor1){
                    echo "<td> <img width='50' height='50' src=".$valor1."> </td>";
                }else{
                    echo "<td> ".$valor1." </td>";
                }
            }
    
            echo "<td> <a href='EditProfesor.php?curso=".$valor['DNI']."'>Editar Profesor</a> </td>";
            echo "<td> <a href='EditAvatar.php?dni=".$valor['DNI']."&foto=".$valor['Foto']."'>Editar Foto</a> </td>";
            echo "<td> <a href='eliminarProfesor.php?eliminar=".$valor['activo']."&dni=".$valor['DNI']."'>Borrar</a> </td>";
            echo "</tr>";
        }
        echo("</table>");
    }
?>