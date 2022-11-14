<!DOCTYPE html>
<html lang="en">
    <?php
        session_start(); 
        include('funciones.php');
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="EditCurso.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <title>Inicio</title>
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
                    $connection= connection();
                    $query= "SELECT Foto FROM alumnos WHERE Email LIKE '".$_SESSION['email']."'";
                    $resultado= mysqli_query($connection, $query);
                    $final= mysqli_fetch_row($resultado);
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
                    <div class="headerFinal">
                        <a href="EditarAlumno.php" class="SignOut"><img src="<?php echo ($final[0]) ?>" alt="usuario" class="SignOut" witdth="100px" height="100px"></a>
                        <a href="SignOut.php" class="SignOut">Salir</a>
                    </div>

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

        if (!empty($_POST['Nom'])) {
                $dni= $_POST['DNI'];
                $nom= $_POST['Nom'];
                $cognoms= $_POST['Cognoms'];
                $pass= $_POST['Password'];
                $edat= $_POST['Edat'];

                $connection= connection();
                $sql= "UPDATE alumnos SET DNI= '$dni', Nom= '$nom', Cognoms='$cognoms', Password='".md5($pass)."', Edat='$edat' WHERE Email='".$_SESSION['email']."'";
                $result= mysqli_query($connection, $sql);

                ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
                <?php
        }
        ?>

        <form class='formulario' action="EditarAlumno.php" method="POST" name="InicioSession">
                    <?php
                        if($_SESSION['rol']=='alumno'){
                            $connection= connection();
                    
                            $sql= "SELECT * FROM alumnos WHERE Email='".$_SESSION['email']."'";
                            $result= mysqli_query($connection, $sql);

                            $row= mysqli_fetch_assoc($result);
                    ?>
            <h1>Edit Alumno</h1>
            <p>DNI: <input type="text" name="DNI" required value="<?php echo($row['DNI']); ?>"></p>    
            <p>Nombre: <input type="text" name="Nom" required value="<?php echo($row['Nom']); ?>"></p>    
            <p>Cognoms: <input type="text" name="Cognoms" required value="<?php echo($row['Cognoms']); ?>"></p>
            <p>Contraseña: <input type="text" name="Password" required value="<?php echo($row['Password']); ?>"></p>
            <p>Edat: <input type="text" name="Edat" required value="<?php echo($row['Edat']) ?>"></p>
            <button type="submit">Enviar</button>
        </form>
        <a href="index.php">Volver atrás</a>
        <?php
            }else{
                echo"No deberías estar aquí";
            }
        ?>
</body>
</html>