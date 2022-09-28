<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>

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

    <form action="SignUp.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
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
</body>
</html>