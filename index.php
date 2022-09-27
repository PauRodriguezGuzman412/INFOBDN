<!DOCTYPE html>
<html lang="en">
    <?php
session_start(); 
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="index.css" rel="stylesheet" type="text/css">
        <title>Inicio</title>
    </head>
    <body>
        <header> 
            <div class="div">
                <img src="skeletonoc-h22b8kbm.png" alt="Logo">
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
        </header> 

        <?php
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
                    ?>
                    
                    <div class="a1">

                        <a class="admin" href="AdminProfesor.php">Ver listado de profesores</a>
                        <a class="admin" href="AdminCurso.php">Ver listado de cursos</a>

                    </div>
                    
    
                    <?php
                }

                if($_SESSION['rol']=='alumno'){
                    ?>

                    <a href="cursos.php">Cursos</a> 
    
                    <?php
                }

                if($_SESSION['rol']=='profesor'){
                    ?>

                    <a href="cursos.php">Cursos</a> 
    
                    <?php
                }
            }
        ?>
    </body>
</html>