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
                    <a href="index.php" class="general">Inicio</a>
                    <a href="cursos.php" class="general">Cursos</a>
                    <?php
                }
                ?>
            </div>
        </header> 
            
        <?php
            if(isset($_SESSION['rol'])){
                echo "<table border>";
                if($_SESSION['rol']=='alumno'){
                    $email= $_SESSION['email'];

                    $connection= connection();
                    $sql= "SELECT cursos.* FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi";
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
                        $sql1= "SELECT cursos.* FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi";
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
                                echo "<tr>";
                                echo "<td><a href='cursos.php'>".$valor1['Nom']."</a></td>";
                                echo "<td><a href='cursos.php'>Duración: ".$valor1['Data_inici']." - ".$valor1['Data_final']."</a></td>";
                                foreach($llista2 as $clave2 => $valor2){
                                    if($valor1['Codi']==$valor2['Codi']){
                                        echo "<td><a href='cursos.php'>Profesor que imparte el curso: ".$valor2['Nom']."</a></td>";
                                    }
                                }
                                $codigo= $valor1['Codi'];
                                $sql3= "SELECT cursos.Nom, matriculas.activo FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi INNER JOIN Alumnos ON matriculas.Email_Alumnos=Alumnos.Email WHERE matriculas.Email_Alumnos LIKE '$email' AND matriculas.Codi LIKE '$codigo'";
                                if($result3= mysqli_query($connection, $sql3)){
                                    while($row3= $result3->fetch_assoc()){
                                        $llista3[]= $row3;
                                    }
                                    
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
            }
        ?>
    </body>
</html>