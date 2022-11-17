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
        <link href="EditCurso.css" rel="stylesheet" type="text/css">
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
        <?php
            
            if (!empty($_POST['Nom'])) {
                if($_POST['Data_final']<date("Y-m-d H:i:s")){
                    echo "La fecha final es menor que la fecha actual";
                }else if($_POST['Data_inici']<$_POST['Data_final']){
                    $name= $_POST['Nom'];
                    $desc= $_POST['Descripcion'];
                    $horas= $_POST['Hores'];
                    $inici= $_POST['Data_inici'];
                    $final= $_POST['Data_final'];
                    $prof= $_POST['Dni_Profesores'];
            
                    
                    $_SESSION['rol']= 'admin';
            
                    $connection= connection();
                    $sql= "INSERT INTO cursos (Nom,Descripcion,Hores,Data_inici,Data_final,Dni_Profesores) VALUES ('$name', '$desc', '$horas', '$inici', '$final','$prof')";
                    $result= mysqli_query($connection, $sql);
            
                    ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminCurso.php">
                    <?php
                }else{
                    echo "La fecha de inicio es mayor que la fecha final";
                }
            }
        ?>

        <form class='formulario' action="SignUpCurso.php" method="POST" name="InicioSession">
            <?php
                $connection= connection();
            
                //GUARDAR NOMBRE PROFESORES
                $sql= "SELECT Nom FROM profesores";
                $result= mysqli_query($connection, $sql);

                while($profe= mysqli_fetch_row($result)){
                    $array[] = $profe;    
                }

                //GUARDAR DNI PROFESORES
                $sql2= "SELECT DNI FROM profesores";
                $result2= mysqli_query($connection, $sql2);

                while($profe2= mysqli_fetch_row($result2)){
                    $array2[] = $profe2;    
                }

            ?>
            <?php
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
            ?>
            <h1>Registrar Curso</h1>
            <p>Nombre del curso: <input type="text" name="Nom" required></p>    
            <p>Descripción: <input type="text" name="Descripcion" required></p>    
            <p>Horas: <input type="number" name="Hores" required></p>
            <p>Data inicio: <input type="date" name="Data_inici" required></p>
            <p>Data final: <input type="date" name="Data_final" required></p>
            <p>
                <label for="Dni_Profesores">Profesor:
                    <select name="Dni_Profesores" id="Dni_Profesores"> 
                        <?php
                            for($i=0;$i<($result->num_rows);$i++){
                                ?>
                                <option value="<?php print($array2[$i][0]) ?>"><?php print($array[$i][0]) ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </label>
            </p>
            <button type="submit">Enviar</button>

        </form>
        <a href="AdminCurso.php">Volver atrás</a>
        <?php
                }else{
                    echo"No deberías estar aquí";
                }
            }
        ?>
</body>
</html>