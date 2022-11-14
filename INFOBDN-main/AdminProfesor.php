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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>Administrar Profesores</title>
</head>
<body>   
        <header> 
            <div class="div">
                <img src="book-png.png" alt="logo" class="logo" witdth="125px" height="125px">
                <?php
                if(!isset($_SESSION['rol'])){
                    ?>  <div class="headerAll">
                            <a class="header" href="SignInAdmin.php">Inicar Sessión como administrador</a><br>
                            <a class="header" href="SignIn.php">Inicar Sessión como alumno</a><br>
                            <a class="header" href="SignInProfesor.php">Inicar Sessión Como profesor</a><br>
                        
                            <a class="header" href="SignUp.php">Registrarse</a><br>

                            <div class="header2">No has iniciado sessión</div>
                        </div>
                    <?php
                }else if($_SESSION['rol']=='admin'){
                    ?>
                    <div class="DivMenu">
                        <div class="inicioSession">Eres administrador, bienvenido</div>
                        
                        <nav>
                            <ul class="generalAll">
                                <li><a href="index.php" class="general">Inicio</a></li>
                                <li><a href="AdminProfesor.php" class="general">Profesores</a></li>
                                <li><a href="AdminCurso.php" class="general">Cursos</a></li>
                            </ul>
                        </nav>
                    </div>
                    
                    <a href="SignOut.php" class="SignOut">Salir</a>
                        
                    <?php
                }else if($_SESSION['rol']=='alumno'){
                    ?>
                    <div class="DivMenu">
                        <div class="inicioSession">Hola <?php echo($_SESSION['NombreHeader'])  ?>, bienvenido</div>
                        
                        <nav>
                            <ul class="generalAll">
                                <li><a href="index.php" class="general">Inicio</a></li>
                                <li><a href="MisCursos.php" class="general">Mis Cursos</a></li>
                                <li><a href="CursosDisponibles.php" class="general">Cursos Disponibles</a></li>
                            </ul>
                        </nav>
                    </div>
                    
                    <a href="SignOut.php" class="SignOut">Salir</a>

                    <?php
                }else if($_SESSION['rol']=='profesor'){
                    ?>
                    <div class="DivMenu">
                        <div class="inicioSession">Hola <?php echo($_SESSION['NombreHeader'])  ?>, bienvenido</div>
                        
                        <nav>
                            <ul class="generalAll">
                                <li><a href="index.php" class="general">Inicio</a></li>
                                <li><a href="cursos.php" class="general">Curso</a></li>                                
                            </ul>
                        </nav>
                    </div>
                    
                    <a href="SignOut.php" class="SignOut">Salir</a>
                    <?php
                }
                ?>
            </div>
        </header>
    <?php
        if(isset($_SESSION['rol'])){
            if($_SESSION['rol']=='admin'){
    ?>
            <form action="AdminProfesor.php" method="POST" name="buscador">
                Buscador:<input type="text" id="buscador" name="buscador" placeholder="Busca el profesor por nombre"></input>
                <button type="submit">Buscar</button>
            </form>
            <a href="SignUpProfesor.php">Registrar profesor</a>
        <?php
    
        echo("<table border class='TablaProfesores'>");
        echo("<tr>");
        echo("<td>DNI</td>");
        echo("<td>Nom</td>");
        echo("<td>Cognoms</td>");
        echo("<td>Titol</td>");
        echo("<td>Foto</td>");
        echo("<td>Activo</td>");
        echo("<td>Editar Profesor</td>");
        echo("<td>Editar Foto</td>");
        echo("<td>Desactivar</td>");
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
