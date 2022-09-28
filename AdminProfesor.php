<?php
   session_start();
   include('funciones.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="AdminProfesor.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>   
    <?php
        if(isset($_SESSION['rol'])){
            if($_SESSION['rol']=='admin'){
    ?>
    
        <div class="div">
            <img class="logo" src="skeletonoc-h22b8kbm.png" alt="Logo">
            <?php
            if(!isset($_SESSION['rol'])){
                ?>
                    <a href="SignInAdmin.php">Inicar Sessión como administrador</a><br>
                    <a href="SignIn.php">Inicar Sessión</a><br>
                    <a href="SignUp.php">Registrarse</a><br>
                
                    <div class="">No has iniciado sessión</div>
                <?php
            }else{
                ?>
                    <div class="inicioSession">Hola "nombre", bienvenido</div>
                    
                    <div class="a_fil">
                        <a class="general" href="AdminProfesor.php">Profesores</a><br>
                        <a class="general" href="AdminCurso.php">Cursos</a>
                    </div>
                <?php
            }
            ?>
        </div>

            <form action="AdminProfesor.php" method="POST" name="buscador">
                Buscador:<input type="text" id="buscador" name="buscador" placeholder="Busca el profesor por nombre"></input>
                <button type="submit">Buscar</button>
            </form>
            <a href="SignUpProfesor.php">Registrar profesor</a>
        <?php
    
        echo("<table>");
        echo("<tr>");
        echo("<td>DNI</td>");
        echo("<td>Nom</td>");
        echo("<td>Cognoms</td>");
        echo("<td>Titol</td>");
        echo("<td>Foto</td>");
        echo("<td>Activo</td>");
        echo("<td>Editar Profesor</td>");
        echo("<td>Editar Foto</td>");
        echo("<td>Borrar</td>");
        echo("</tr>");
    
        if(isset($_POST['buscador']) && $_POST['buscador']!=""){
            $connection2= connection();
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
        
            $connection= connection();
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
                    }else if($valor['Password']!=$valor1 && $valor['activo']!=$valor1){
                        echo "<td> ".$valor1." </td>";
                    }else if($valor['activo']==$valor1 && $valor['activo']==0){
                        echo "<td> No </td>";
                    }else if($valor['activo']==$valor1 && $valor['activo']==1){
                        echo "<td> Si </td>";
                    }
                }
                echo "<td> <a href='EditProfesor.php?curso=".$valor['DNI']."'><img src='https://cdn-icons-png.flaticon.com/512/45/45406.png' width='50px' height='50px'></a> </td>";
                echo "<td> <a href='EditAvatar.php?dni=".$valor['DNI']."&foto=".$valor['Foto']."'><img src='https://es.seaicons.com/wp-content/uploads/2015/11/Users-Edit-User-icon.png' width='50px' height='50px'></a> </td>";

                if($valor['activo']==1){
                    echo "<td> <a href='eliminarProfesor.php?eliminar=".$valor['activo']."&dni=".$valor['DNI']."'><img src='https://cdn-icons-png.flaticon.com/512/458/458594.png' width='50px' height='50px'></a> </td>";
                }else{
                    echo "<td> <a href='eliminarProfesor.php?eliminar=".$valor['activo']."&dni=".$valor['DNI']."'><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Flat_tick_icon.svg/768px-Flat_tick_icon.svg.png' width='50px' height='50px'></a> </td>";
                }
                echo "</tr>";
            }
            echo("</table>");
        }
        ?>
        <a href="index.php">Volver atrás</a>
        <?php
            }else{
                echo"No deberías estar aquí";
            }}
        ?>   
</body>
</html>
