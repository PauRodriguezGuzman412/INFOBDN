<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="SignInGeneral.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>Iniciar Sesión como administrador</title>
</head>
<body>
<header> 
    <?php
        session_start();
        include('funciones.php');
    ?>
            <div class="div">
                <img src="book-png.png" alt="Logo" witdth="125px" height="125px">
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
                        <div class="inicioSession">Eres administrador, bienvenido</div>
                        <div class="a_fil">
                            <a class="general" href="index.php">Inicio</a>
                            <a class="general" href="AdminProfesor.php">Profesores</a><br>
                            <a class="general" href="AdminCurso.php">Cursos</a>
                            <li><a href="SignOut.php" class="general">Salir</a></li>

                        </div>
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
        
        if (isset($_POST['DNI']) && $_POST['DNI']=='49988375R') {
            
            $dni= $_POST['DNI'];
            $pass= $_POST['password'];
            
            $_SESSION['rol']= 'admin';

            $connection= connection();
            $sql= "SELECT DNI Password FROM administrador WHERE DNI= '$dni' AND Password= '".md5($pass)."'";
            $result= mysqli_query($connection, $sql);

            if(mysqli_num_rows($result)==1){
                ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
                <?php
            }else{
                echo"Error, no hay ningún profesor con esas credenciales";
            }
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
            <?php
        }
    ?>

    <form class="formulario" action="SignInAdmin.php" method="POST">
        <h1>Iniciar Sessión como admin</h1>
        <p>DNI: <input type="text" name="DNI" required></p>    
        <p>Contraseña: <input type="password" name="password" required></p>
        <button type="submit">Enviar</button>
    </form>
    <a href="index.php">Volver atrás</a>
</body>
</html>