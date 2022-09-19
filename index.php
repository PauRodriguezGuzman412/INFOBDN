<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
    </head>
    <body>
        <?php
        session_start();    
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
                    ?>

                    <a href="SignUpProfesor.php">Registrar profesor</a>
                    <a href="SignUpCurso.php">Registrar curso</a>
                    <a href="AdminProfesor.php">Edit profesor</a>
                    <a href="AdminCurso.php">Edit curso</a>
    
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

           else{
            ?>
                <a href="SignInAdmin.php">Inicar Sessión como administrador</a><br>
                <a href="SignIn.php">Inicar Sessión</a><br>
                <a href="SignUp.php">Registrarse</a><br>
            <?php
            }
        ?>
    </body>
</html>