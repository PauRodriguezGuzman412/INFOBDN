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

    if (!empty($_POST['DNI'])) {
        $dni= $_POST['DNI'];
        $name= $_POST['Nom'];
        $surnames= $_POST['Cognoms'];
        $pass= $_POST['Password'];
        $title= $_POST['Titol'];
        
        $_SESSION['rol']= 'admin';
       
        $connection= connection();
        $sql= "UPDATE profesores SET DNI= '$dni', Nom= '$name', Cognoms='$surnames', Password=md5('$pass'), Titol='$title' WHERE DNI= '$dni'";
        var_dump($sql);
        $result= mysqli_query($connection, $sql);

        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminProfesor.php">
        <?php
    }
?>

<?php
    if(isset($_SESSION['rol'])){
        if($_SESSION['rol']=='admin'){
            $connection= connection();
            $sql= "SELECT * FROM profesores WHERE DNI=".$_GET['curso'];
            $result= mysqli_query($connection, $sql);
            
            $row= mysqli_fetch_assoc($result);
?>
<form class='formulario' action="EditProfesor.php" method="POST" name="InicioSession">
    <h1>Editar profesor </h1>
    <p>DNI: <input type="text" name="DNI" value="<?php echo($row['DNI']); ?>" required></p>    
    <p>Nombre: <input type="text" name="Nom" value="<?php echo($row['Nom']); ?>" required></p>    
    <p>Cognoms: <input type="text" name="Cognoms" value="<?php echo($row['Cognoms']); ?>" required></p>
    <p>Contraseña: <input type="text" name="Password" value="<?php echo($row['Password']); ?>" required></p>
    <p>Titol: <input type="text" name="Titol" value="<?php echo($row['Titol']); ?>" required></p>
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