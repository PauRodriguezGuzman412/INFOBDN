<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicar Sessión Alumno</title>
</head>
<body>

    <?php
        session_start();
        include('funciones.php');

        if (isset($_POST['email'])) {
            
            $email= $_POST['email'];
            $pass= $_POST['password'];
            
            $_SESSION['rol']= 'alumno';

            $connection= connection();

            // $nombre= "SELECT Nom FROM alumnos WHERE email= '$email'";
            // $resultNombre= mysqli_query($connection, $nombre);
            // $NombreAlumno= $resultNombre.mysqli_fetch_array();
            // $_SESSION['nombre']= $NombreAlumno;
            $_SESSION['email']= $email;

            $connection= connection();
            $sql= "SELECT email,Password FROM alumnos WHERE email= '$email' AND Password= '".md5($pass)."'";
            $result= mysqli_query($connection, $sql);
            $a= mysqli_fetch_assoc($result);

            print_r(($sql));
            if(mysqli_num_rows($result)==1){
                $sql1= "SELECT Nom FROM alumnos WHERE email= '$email'";
                $nombre= mysqli_query($connection, $sql1);
                $a= mysqli_fetch_assoc($nombre);
                $_SESSION['NombreHeader']= $a['Nom']; 

                ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
                <?php
            }else{
                echo"Error, no hay ningún alumno con esas credenciales";
            }
        }
    ?>

    <form action="SignIn.php" method="POST">
        <h1>Iniciar Sessión</h1>
        <p>Email: <input type="text" name="email" required></p>    
        <p>Contraseña: <input type="password" name="password" required ></p>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>