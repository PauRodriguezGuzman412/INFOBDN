<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicar Sessión Profesor</title>
</head>
<body>

    <?php
        session_start();
        include('funciones.php');

        if (isset($_POST['DNI'])) {
            
            $DNI= $_POST['DNI'];
            $pass= $_POST['password'];
            
            $_SESSION['rol']= 'profesor';

            $connection= connection();
            $sql= "SELECT DNI Password FROM profesores WHERE DNI= '$DNI' AND Password= '$pass'";
            $result= mysqli_query($connection, $sql);

            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
            <?php
        }
    ?>

    <form action="SignInProfesor.php" method="POST">
        <h1>Iniciar Sessión</h1>
        <p>DNI: <input type="text" name="DNI" required></p>    
        <p>Contraseña: <input type="password" name="password" required ></p>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>