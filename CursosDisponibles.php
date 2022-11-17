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
        <link href="CursosDisponibles.css" rel="stylesheet" type="text/css">
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
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='alumno'){
                    $email= $_SESSION['email'];

                    $connection= connection();
                    ?>

                    <div>
                        <?php
                        $sql1= "SELECT cursos.* FROM cursos WHERE cursos.Codi NOT IN (SELECT Codi FROM matriculas WHERE '".$email."'=matriculas.Email_Alumnos) AND Data_inici>'".date("Y-m-d")."'";
                        $sql2= "SELECT profesores.Nom, cursos.Codi FROM profesores INNER JOIN cursos ON cursos.Dni_Profesores=profesores.DNI ";
                        if($result2= mysqli_query($connection, $sql2)){
                            while($row2= $result2->fetch_assoc()){
                                $llista2[]= $row2;
                            }
                        }
                        if($result1= mysqli_query($connection, $sql1)){
                            while($row1= $result1->fetch_assoc()){
                                $llista1[]= $row1;
                            }
                        }if(!isset($llista1)){
                            echo "<br>NO estás inscrito en ningún curso";
                        }else{
                            foreach($llista1 as $clave1 => $valor1){
                                $sql3= "SELECT Data_inici, Data_final FROM cursos WHERE cursos.codi = ".$valor1['Codi']."";
                                if($result3= mysqli_query($connection, $sql3)){
                                    while($row3= $result3->fetch_assoc()){
                                        $llista3[]= $row3;
                                    }
                                }
                                if($valor1['activo']==1){
                                    echo "<div class='divGeneral'>";
                                    echo "<div class='name'>".$valor1['Nom']."</div>";
                                    echo "<div class='details'>";
                                        echo "Duración: ".$valor1['Data_inici']." - ".$valor1['Data_final']."<br>";
                                        foreach($llista2 as $clave2 => $valor2){
                                            if($valor1['Codi']==$valor2['Codi']){
                                                echo "Profesor que imparte el curso: ".$valor2['Nom']."<br>";
                                            }
                                        }
                                    echo "</div>";
                                    echo "<div class='link'>";
                                        if($llista1[$clave1]['Data_inici']>date("Y-m-d")){
                                            $id= 'si';
                                            echo "<br><a href='Matricularse.php?id=".$id."&email=".$email."&valor=".$valor1['Codi']."'>Darse de alta</a>";
                                        }
                                        else{
                                            echo "El curso ya ha empezado";
                                        }
                                    echo "</div>";
                                    echo "</div>";                               
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
            }
        ?>
    </body>
</html>