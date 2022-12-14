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
                if($_SESSION['rol']=='admin'){
                    ?>
                    
                    <div class="a1">
                        
                        <a class="admin" href="AdminProfesor.php">Ver listado de profesores</a>
                        <a class="admin" href="AdminCurso.php">Ver listado de cursos</a>

                    </div>
                    
    
                    <?php
                }

                if($_SESSION['rol']=='alumno'){
                    echo "<div class='profetotal'>";
                    $connection= connection();
                    $sql= "SELECT * FROM cursos";
                    if($result= mysqli_query($connection, $sql)){
                        while($row= $result->fetch_assoc()){
                            $llista[]= $row;
                        }
                        echo "<div class='CursosTotal'>";
                        foreach($llista as $clave => $valor){
                            if($valor['activo']==1){
                                echo "<div class='CursosTotal2'>";
                                    echo $valor['Nom']."<br>";
                                    echo "</div>";
                                }
                            }
                        echo "</div>";
                    }if(!isset($llista)){
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=AdminCurso.php'>";
                    }
                    ?>

                    <div class='cursosProfe'>
                        <p class="texto">Usuario <?php echo($_SESSION['NombreHeader'])  ?>, <br>Cursos en los que estás inscrito:</p>
                        
                        
                        <?php
                        $sql1= "SELECT cursos.Nom, cursos.Data_inici, cursos.Data_final, cursos.activo FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi INNER JOIN Alumnos ON matriculas.Email_Alumnos=Alumnos.Email WHERE matriculas.Email_Alumnos LIKE '".$_SESSION['email']."'";
                        if($result1= mysqli_query($connection, $sql1)){
                            while($row1= $result1->fetch_assoc()){
                                $llista1[]= $row1;
                            }
                        }if(!isset($llista1)){
                            echo "<br>NO estás inscrito en ningún curso";
                        }else{
                                echo "<br>";
                                echo "<table class='tabla'>";
                                foreach($llista1 as $clave1 => $valor1){
                                    if($valor1['activo']==1){
                                        echo "<tr class='tabla'>";
                                        echo "<td class='tabla'>".$valor1['Nom']." </td>";
                                        echo "<td class='tabla'>".$valor1['Data_inici']." </td>";
                                        echo "<td class='tabla'>".$valor1['Data_final']."<br></td>";
                                        echo "</tr>";
                                    }
                                echo "</table>";
                            }
                        }
                        echo "</div>";
                        ?>
                        
                    </div>
                    
                    <?php
                }
                if($_SESSION['rol']=='profesor'){
                    echo "<div class='profetotal'>";
                    $connection= connection();
                    $sql= "SELECT * FROM cursos";
                    if($result= mysqli_query($connection, $sql)){
                        while($row= $result->fetch_assoc()){
                            $llista[]= $row;
                        }
                        echo "<div class='CursosTotal'>";
                        foreach($llista as $clave => $valor){
                            if($valor['activo']==1){
                                echo "<div class='CursosTotal2'>";
                                echo $valor['Nom'];
                                echo "</div>";
                            }
                        }
                        echo "</div>";
                    }if(!isset($llista)){
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=AdminCurso.php'>";
                    }
                    ?>

                        <div class='cursosProfe'>
                            <p class="texto">Usuario <?php echo($_SESSION['NombreHeader']) ?>, <br>Cursos en los que eres profesor:<br></p>
                            
                            
                            <?php
                            $sql1= "SELECT cursos.Codi, cursos.Nom, cursos.Data_inici, cursos.Data_final, cursos.activo FROM cursos INNER JOIN Profesores ON cursos.Dni_Profesores=Profesores.DNI WHERE cursos.Dni_profesores LIKE '".$_SESSION['DniProfesor']."'";
                            if($result1= mysqli_query($connection, $sql1)){
                                while($row1= $result1->fetch_assoc()){
                                    $llista1[]= $row1;
                                }
                            }if(!isset($llista1)){
                                echo "<br>NO estás inscrito en ningún curso";
                            }else{
                                echo "<br>";
                                echo "<table class='tabla'>";
                                foreach($llista1 as $clave1 => $valor1){
                                    if($valor1['activo']==1){

                                    echo "<tr class='tabla'>";
                                    foreach($valor1 as $clave2 => $valor2){
                                        echo "<td class='tabla'>".$valor2."</td>";
                                    }
                                    echo "";echo "<td><a class='blanco' href='Nota.php?id=".$valor1['Codi']."'>Detalles</a></td>";
                                    echo "</tr>";
                                    }
                                }
                                echo "</table>";
                            }
                                
                            ?>
                        
                        </div> 
                    <?php
                        echo "</div>";
                }
            }
        ?>
    </body>
    <footer>
        <a href="SignInAdmin.php">Configuración</a>
    </footer>
</html>