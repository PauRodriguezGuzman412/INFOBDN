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
    include('funciones.php');
?>
    <form action="AdminCurso.php" method="POST" name="buscador">
        Buscador:<input type="text" id="buscador" name="buscador" placeholder="Buscador"></input>
        <button type="submit">Buscar</button>
    </form>
<?php


    echo("<table>");
    echo("<tr>");
    echo("<td>Codi</td>");
    echo("<td>Nom</td>");
    echo("<td>Descripción</td>");
    echo("<td>Horas</td>");
    echo("<td>Data de incio</td>");
    echo("<td>Data final</td>");
    echo("<td>Dni profesores</td>");
    echo("<td>Activo</td>");
    echo("<td>Editar</td>");
    echo("<td>Borrar</td>");
    echo("</tr>");
    

    if(isset($_POST['buscador']) && $_POST['buscador']!=""){
        $connection= connection();
        $sql3= "SELECT * FROM cursos WHERE Nom LIKE '%".$_POST['buscador']."%'";
        if($result3= mysqli_query($connection, $sql3)){
            while($row2= $result3->fetch_assoc()){
                $llista2[]= $row2;
            }
        }if(!isset($llista2)){
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=AdminCurso.php'>";
        }

        foreach($llista2 as $clave => $valor){
            echo "<tr>";
            foreach($valor as $clave1 => $valor1){
                echo "<td> ".$valor1." </td>";
            }
            echo "<td> <a href='EditCurso.php?curso=".$valor['id']."'>Editar</a> </td>";
            echo "<td> <a href='eliminarCurso.php?eliminar=".$valor['activo']."&codi=".$valor['id']."'>Borrar</a> </td>";
            echo "</tr>";
        }
        
        echo("</table>");
    }else{
        $connection= connection();
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
            echo "<td> <a href='EditCurso.php?curso=".$valor['id']."'>Editar</a> </td>";
            echo "<td> <a href='eliminarCurso.php?eliminar=".$valor['activo']."&codi=".$valor['id']."'>Borrar</a> </td>";
            echo "</tr>";
        }
        
        echo("</table>");
    }


    

?>