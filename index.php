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
                        <div class="inicioSession">Eres administrador, bienvenido</div>
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
                        Usuario <?php echo($_SESSION['NombreHeader'])  ?>, <br>Cursos en los que estás inscrito:
                        
                        
                        <?php
                        $sql1= "SELECT cursos.Nom, cursos.Data_inici, cursos.Data_final FROM cursos INNER JOIN matriculas ON cursos.Codi=matriculas.Codi INNER JOIN Alumnos ON matriculas.Email_Alumnos=Alumnos.Email WHERE matriculas.Email_Alumnos LIKE '".$_SESSION['email']."'";
                        if($result1= mysqli_query($connection, $sql1)){
                            while($row1= $result1->fetch_assoc()){
                                $llista1[]= $row1;
                            }
                        }if(!isset($llista1)){
                            echo "<br>NO estás inscrito en ningún curso";
                        }else{
                            foreach($llista1 as $clave1 => $valor1){
                                echo "<a href='cursos.php'>".$valor1['Nom'], $valor1['Data_inici'], $valor1['Data_final']."</a><br>";
                            }
                        }
                            
                        ?>
                        
                    </div>
                    
                    <?php
                }
                if($_SESSION['rol']=='profesor'){
                    
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
                        Usuario <?php echo($_SESSION['NombreHeader'])  ?>, <br>Cursos en los que eres profesor:
                        
                        
                        <?php
                        $sql1= "SELECT cursos.Nom, cursos.Data_inici, cursos.Data_final FROM cursos INNER JOIN Profesores ON cursos.Dni_Profesores=Profesores.DNI WHERE cursos.Dni_profesores LIKE '".$_SESSION['DniProfesor']."'";
                        if($result1= mysqli_query($connection, $sql1)){
                            while($row1= $result1->fetch_assoc()){
                                $llista1[]= $row1;
                            }
                        }if(!isset($llista1)){
                            echo "<br>NO estás inscrito en ningún curso";
                        }else{
                            foreach($llista1 as $clave1 => $valor1){
                                echo "<br><a href='cursos.php'>".$valor1['Nom']."</a> ";
                                echo "<a href='cursos.php'>".$valor1['Data_inici']."</a> ";
                                echo "<a href='cursos.php'>".$valor1['Data_final']."</a>";
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