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
    //Una de las fotos es mía. La puedes ver si vas a https://gamejolt.com/@Hombreguz412

    if (!empty($_FILES['Foto'])) {
        $dni= $_SESSION['dni'];

        if (is_uploaded_file ($_FILES['Foto']['tmp_name'])){
            $nombreDirectorio = "img/";
            $idUnico = $dni;
            $nombreFichero = $idUnico . "-" . $_FILES['Foto']['name'];
            $directorio= $nombreDirectorio . $nombreFichero;
            move_uploaded_file ($_FILES['Foto']['tmp_name'], $nombreDirectorio . $nombreFichero);
        }else print ("No se ha podido subir el fichero\n");

        $_SESSION['rol']= 'admin';
       
        $connection= connection();
        $sql= "UPDATE profesores SET Foto='$directorio' WHERE DNI= '$dni'";
        $result= mysqli_query($connection, $sql);

        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
        <?php
    }
?>

<form class='formulario' action="AdminProfesor.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
    <?php
        if(isset($_SESSION['rol'])){
            if($_SESSION['rol']=='admin'){
                if(isset($_GET['dni'])){
                    $_SESSION['dni']= $_GET['dni'];
                }
    ?>
    <h1>Modificar Foto </h1>
    <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg" required></p>
    <button type="submit">Enviar</button>
</form>
<a href="AdminProfesor.php">Volver atrás</a>
<?php
    }else{
        echo"No deberías estar aquí";
    }}
?>   
</body>
</html>