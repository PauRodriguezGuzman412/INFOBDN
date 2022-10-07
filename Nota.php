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
                            <li><a href="SignOut.php" class="general">Salir</a></li>
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
                if($_SESSION['rol']=='profesor'){
                    $connection= connection();
                    
                    $sql= "SELECT Alumnos.Nom,Alumnos.Email,matriculas.Nota,matriculas.Codi FROM Alumnos INNER JOIN matriculas ON Alumnos.Email=matriculas.Email_Alumnos";
                    $result= mysqli_query($connection, $sql);
                    // $var= mysqli_fetch_assoc($result);

                    if($result= mysqli_query($connection, $sql)){
                        while($row= $result->fetch_assoc()){
                            $llista[]= $row;
                        }
                    }
                    echo "<table border>";
                    echo "<tr>";
                    echo "<td>Alumnos</td>";
                    echo "<td>Nota</td>";
                    echo "<td>Poner nota</td>";
                    echo "</tr>";
                    foreach($llista as $clave1 => $valor1){
                        if($result= mysqli_query($connection, $sql)){
    
    
                            echo "<tr>";
                            echo "<td>".$valor1['Nom']."</td>";
                            echo "<td>".$valor1['Nota']."</td>";
                            echo "<td><a href='PonerNota.php?Email=".$valor1['Email']."&id=".$valor1['Codi']."'>Poner Nota</a></td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
            }
        ?>
    </body>
</html>