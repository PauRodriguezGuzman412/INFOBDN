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
        <link href="Nota.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <title>Inicio</title>
    </head>
    <body>
        <header> 
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
            
            <div class="content">
                <?php
                    if(isset($_SESSION['rol'])){
                        if($_SESSION['rol']=='profesor'){
                            $connection= connection();
                            
                            $sql= "SELECT Alumnos.Nom,Alumnos.Email,matriculas.Nota,matriculas.Codi FROM Alumnos INNER JOIN matriculas ON Alumnos.Email=matriculas.Email_Alumnos WHERE matriculas.Codi= '".$_GET['id']."'";
                            $result= mysqli_query($connection, $sql);
                            if($result= mysqli_query($connection, $sql)){
                                while($row= $result->fetch_assoc()){
                                    $llista[]= $row;
                                }
                            }
                            if(isset($llista)){
                                echo "<table border>";
                                echo "<tr>";
                                echo "<td>Alumnos</td>";
                                echo "<td>Nota</td>";
                                echo "<td>Poner nota</td>";
                                echo "</tr>";
                                foreach($llista as $clave1 => $valor1){
                                    if($result= mysqli_query($connection, $sql)){
                                        $sql1= "SELECT Data_inici, Data_final FROM cursos WHERE cursos.codi = ".$valor1['Codi']."";
                                        $resul1t= mysqli_query($connection, $sql1);
                                        if($result1= mysqli_query($connection, $sql1)){
                                            while($row1= $result1->fetch_assoc()){
                                                $llista1[]= $row1;
                                            }
                                        }
                                        echo "<tr>";
                                        echo "<td>".$valor1['Nom']."</td>";
                                        echo "<td>".$valor1['Nota']."</td>";
                                        if($llista1[$clave1]['Data_final']<date("Y-m-d")){
                                            echo "<td><a href='PonerNota.php?Email=".$valor1['Email']."&id=".$valor1['Codi']."  '>Poner Nota</a></td>";
                                        }
                                        else{
                                            echo "<td>El curso no ha acabado todavía</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                                echo "</table>";
                            }else{
                                echo "No hay alumnos en este curso<br>";
                            }
                            
                        }    
                    }else{
                        echo "No deberís estar aquí<br> ";
                    }
                ?>
            </div>
            <a href="index.php">Volver atrás</a>
    </body>
</html>