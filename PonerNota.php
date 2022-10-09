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
        <link href="PonerNota.css" rel="stylesheet" type="text/css">
        <title>Inicio</title>
    </head>
    <body>
        <header> 
                <div class="div">
                    <img src="skeletonoc-h22b8kbm.png" alt="Logo">
                    <?php
                    if(!isset($_SESSION['rol'])){
                        ?>  <div class="headerAll">
                                <a class="header" href="SignInAdmin.php">Inicar Sessión como administrador</a><br>
                                <a class="header2" href="SignIn.php">Inicar Sessión</a><br>
                                <a href="SignInProfesor.php">Inicar Sessión Como profesor</a><br>
                            
                                <a class="header2" href="SignUp.php">Registrarse</a><br>

                                <div class="header3">No has iniciado sessión</div>
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
                        ?>
                        <!-- MENU DESPLEBAGLE -->
                        <!-- <select class="generalAll" name="Menu">
                            <option>Menu</option>
                            <option><a for="Menu" id="Menu" value="Inicio" href="index.php">Inicio</a></option>
                            <option><a for="Menu" id="Menu" value="MisCursos" href="MisCursos.php">Mis Cursos</a></option>
                            <option><a for="Menu" id="Menu" value="CursosDisponibles" href="CursosDisponibles.php">Cursos Disponibles</a></option>
                        </select>
                        <li><a href="SignOut.php" class="general">Salir</a></li> -->
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
                        <div class="inicioSession">Hola <?php echo($_SESSION['NombreHeader'])  ?>, bienvenido</div>
                        <nav>
                            <ul class="generalAll">
                                <li><a href="index.php" class="general">Inicio</a></li>
                                <li><a href="cursos.php" class="general">Curso</a></li>
                                <li><a href="SignOut.php" class="general">Salir</a></li>
                            </ul>
                        </nav>
                        <?php
                    }
                    ?>
                </div>
            </header> 

            <?php

                if (!empty($_POST['Nota'])) {
                    $nota= $_POST['Nota'];
                
                    $connection= connection();
                    $sql= "UPDATE matriculas SET nota=".$nota." WHERE Codi LIKE ".$_GET['id']." AND Email_Alumnos LIKE '".$_GET['Email']."'";
                    $result= mysqli_query($connection, $sql);

                    ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo "Nota.php?id=".$_GET['id']."" ?>">  
                        <!-- javascript:history.back(-1); -->
                    <?php
                }
            ?>

            <?php
                if($_SESSION['rol']=='profesor'){
            ?>
            <form class="formulario" action="<?php echo "PonerNota.php?Email=".$_GET['Email']."&id=".$_GET['id']."" ?> " method="POST" name="PonerNota">
                <h1> Poner Nota </h1>
                <p>Nota: <input type="number" name="Nota" min="0" max="10" required>
                <button type="submit">Enviar</button>
            </form>
            <a href=" <?php echo "Nota.php?id=".$_GET['id']."" ?> ">Volver atrás</a>
            <?php
                }else{
                    echo"No deberías estar aquí";
                }
            ?> 
        </body>
</html>