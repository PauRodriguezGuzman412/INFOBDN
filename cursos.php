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
                    <div class="inicioSession">Hola "nombre", bienvenido</div>
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
                echo "<table>";
                if($_SESSION['rol']=='alumno'){
                    
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
                        Usuario "Nombre", <br>Cursos en los que estás inscrito:
                        
                        
                        <?php
                        $sql1= "SELECT cursos.*, matriculas.Nota FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi INNER JOIN Alumnos ON matriculas.Email_Alumnos=Alumnos.Email WHERE matriculas.Email_Alumnos LIKE '".$_SESSION['email']."'";
                        $sql2= "SELECT profesores.Nom FROM profesores INNER JOIN cursos ON cursos.Dni_Profesores = profesores.DNI";
                        $result2= mysqli_query($connection, $sql2);
                        $row2= mysqli_fetch_assoc($result2);
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
                                echo "<td><a href='cursos.php'>Profesor que imparte el curso: ".$row2['Nom']."</a></td>";
                                echo "<td><a href='cursos.php'>Nota: ".$valor1['Nota']."</a></td>";

                                echo "</tr>";
                            }
                        }
                    echo "</table>";
                            
                        ?>
                        
                    </div>
                    
                        <a href="cursos.php">Eres un alumno</a>
                    <?php
                }

                if($_SESSION['rol']=='profesor'){
                    ?>

                    <a href="cursos.php">Eres un profesor</a> 
    
                    <?php
                }
            }
        ?>
    </body>
</html>