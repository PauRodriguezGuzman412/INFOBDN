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
                }else if($_SESSION['rol']=='admin'){
                    ?>
                        <div class="inicioSession">Hola "nombre", bienvenido</div>
                        <div class="a_fil">
                            <a class="general" href="index.php">Inicio</a>
                            <a class="general" href="AdminProfesor.php">Profesores</a><br>
                            <a class="general" href="AdminCurso.php">Cursos</a>
                        </div>
                    <?php
                }else{
                    ?>
                    <div class="inicioSession">Hola <?php echo($_SESSION['NombreHeader'])  ?>, bienvenido</div>
                    <?php
                }
                ?>
            </div>
        </header>
        <?php
        
        if($_GET['id']=='si'){
            $connection= connection();
            $sql2= "INSERT INTO matriculas(Codi, Email_Alumnos) VALUES ('".$_GET['valor']."','".$_GET['email']."')";
            $result2= mysqli_query($connection, $sql2);

            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=MisCursos.php">
            <?php
        }else{
            $connection= connection();
            $sql= "DELETE FROM matriculas WHERE matriculas.Codi='".$_GET['valor']."' AND matriculas.Email_Alumnos='".$_GET['email']."'";
            $result= mysqli_query($connection, $sql);

            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=MisCursos.php">
            <?php
        }

        ?>
    </body>
</html>