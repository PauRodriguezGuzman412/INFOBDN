<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="SignUp.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <title>Registrar</title>
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
        session_start();
        include('funciones.php');
        
        if (!empty($_POST['Email'])) {
            $Email= $_POST['Email'];
            $DNI= $_POST['DNI'];
            $name= $_POST['Nom'];
            $surnames= $_POST['Cognoms'];
            $pass= $_POST['Password'];
            $Edat= $_POST['Edat'];
            
            $_SESSION['rol']= 'admin';
    
    
            if (is_uploaded_file ($_FILES['Foto']['tmp_name']))
            {
                $nombreDirectorio = "imgAlumnos/";
                $idUnico = $DNI;
                $nombreFichero = $idUnico . "-" . $_FILES['Foto']['name'];
                $directorio= $nombreDirectorio . $nombreFichero;
                move_uploaded_file ($_FILES['Foto']['tmp_name'], $nombreDirectorio . $nombreFichero);
            }else print ("No se ha podido subir el fichero\n");
    
    
            $connection= connection();
            $sql= "INSERT INTO alumnos (Email,DNI,Nom,Cognoms,Password,Edat,Foto) VALUES ('$Email', '$DNI', '$name', '$surnames', md5('$pass'), '$Edat','$directorio')";
            $result= mysqli_query($connection, $sql);
    

            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
            <?php
        }
    ?>

    <form class="formulario" action="SignUp.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
        <h1>Registrarse</h1>
        <p>Email: <input type="text" name="Email" required></p>    
        <p>DNI: <input type="text" name="DNI" required></p>    
        <p>Nombre: <input type="text" name="Nom" required></p>    
        <p>Cognoms: <input type="text" name="Cognoms" required></p>
        <p>Contraseña: <input type="password" name="Password" required></p>
        <p>Edat: <input type="text" name="Edat" required></p>
        <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg"></p>
        <button type="submit">Enviar</button>
    </form>
    <a href="index.php">Volver atrás</a>
</body>
</html>