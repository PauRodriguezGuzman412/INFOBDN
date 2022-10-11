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
        <link href="cursos.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
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
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
                    ?>
                    
                    <div class="a1">
                        
                        <a class="admin" href="AdminProfesor.php">Ver listado de profesores</a>
                        <a class="admin" href="AdminCurso.php">Ver listado de cursos</a>

                    </div>
                    
    
                    <?php
                }
                echo "<table border>";
                if($_SESSION['rol']=='alumno'){
                    $email= $_SESSION['email'];


                    $connection= connection();
                    $sql= "SELECT * FROM cursos";
                    if($result= mysqli_query($connection, $sql)){
                        while($row= $result->fetch_assoc()){
                            $llista[]= $row;
                        }

                        foreach($llista as $clave => $valor){
                            echo "<a href='cursos.php'>".$valor['Nom']."</a><br>";
                        }
                    }if(!isset($llista)){
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=AdminCurso.php'>";
                    }
                    ?>

                    <div>
                        <?php
                        $sql1= "SELECT cursos.* FROM cursos";
                        $sql2= "SELECT profesores.Nom, cursos.Codi FROM profesores INNER JOIN cursos ON cursos.Dni_Profesores=profesores.DNI";
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
                                echo "<tr>";
                                echo "<td><a href='cursos.php'>".$valor1['Nom']."</a></td>";
                                echo "<td><a href='cursos.php'>Duración: ".$valor1['Data_inici']." - ".$valor1['Data_final']."</a></td>";
                                foreach($llista2 as $clave2 => $valor2){
                                    if($valor1['Codi']==$valor2['Codi']){
                                        echo "<td><a href='cursos.php'>Profesor que imparte el curso: ".$valor2['Nom']."</a></td>";
                                    }
                                }
                                $codigo= $valor1['Codi'];
                                $sql3= "SELECT matriculas.activo FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi INNER JOIN Alumnos ON matriculas.Email_Alumnos=Alumnos.Email WHERE matriculas.Email_Alumnos LIKE '$email' AND matriculas.Codi LIKE '$codigo'";
                                if($result3= mysqli_query($connection, $sql3)){
                                    while($row3= $result3->fetch_assoc()){
                                        $llista3[]= $row3;
                                    }
                                    // print_r();
                                }if(isset($llista3) && isset($llista3[$valor1['Codi']]) && $llista3[$valor1['Codi']]['activo']==1){
                                    $id= 'no';
                                    echo "<br><td><a href='Matricularse.php?id=".$id."&email=".$email."&valor=".$valor1['Codi']."'>Darse de baja</a></td>";
                                }else{
                                    $id= 'si';
                                    echo "<br><td><a href='Matricularse.php?id=".$id."&email=".$email."&valor=".$valor1['Codi']."'>Darse de alta</a></td>";
                                }
                                echo "</tr>";
                            }
                        }
                    echo "</table>";
                            
                        ?>
                        
                    </div>
                    <?php
                }

                if($_SESSION['rol']=='profesor'){
                    $connection= connection();
                    $sql= "SELECT * FROM cursos WHERE Dni_Profesores LIKE '".$_SESSION['DniProfesor']."'";
                    if($result= mysqli_query($connection, $sql)){
                        while($row= $result->fetch_assoc()){
                            $llista[]= $row;
                        }
                        // echo "<table border>";
                        // echo "<tr>";
                        // echo "<td>Nombre del curso</td>";
                        // echo "<td>Descripcion</td>";
                        // echo "<td>Horas</td>";
                        // echo "<td>Data inici</td>";
                        // echo "<td>Data final</td>";
                        // echo "<td>Ver detalles</td>";
                        // echo "</tr>";
                        foreach($llista as $clave => $valor){
                            // echo "<tr>";
                            echo "<div class='divGeneral'>";
                                echo "<div class='name'>".$valor['Nom']."</div>";
                                echo "<div class='details'>";
                                echo "Descripcion: ".$valor['Descripcion']."<br>";
                                echo "Horas: ".$valor['Hores']."<br>";
                                echo "Duración: ".$valor['Data_inici']."_";
                                echo $valor['Data_final'];
                                echo "</div>";
                                echo "<div class='link'><a href='Nota.php?id=".$valor['Codi']."'>Detalles</a></div>";
                            echo "</div>";
                            // echo "</tr>"; 
                        }
                        // echo "</table>";
                    }if(!isset($llista)){
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=AdminCurso.php'>";
                    }
                    ?>

                    <?php
                }
            }
        ?>
    </body>
</html>