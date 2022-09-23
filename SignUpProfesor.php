<?php
    session_start();
    include('funciones.php');

    if (!empty($_POST['DNI'])) {
        $dni= $_POST['DNI'];
        $name= $_POST['Nom'];
        $surnames= $_POST['Cognoms'];
        $pass= $_POST['Password'];
        $title= $_POST['Titol'];
        $avatar= "img/".$_POST['Foto']."";
        
        $_SESSION['rol']= 'admin';


        if (is_uploaded_file ($_FILES['Foto']['tmp_name']))
        {
            $nombreDirectorio = "img/";
            $idUnico = $dni;
            $nombreFichero = $idUnico . "-" . $_FILES['Foto']['name'];
            $directorio= $nombreDirectorio . $nombreFichero;
            move_uploaded_file ($_FILES['Foto']['tmp_name'], $nombreDirectorio . $nombreFichero);
        }else print ("No se ha podido subir el fichero\n");


        $connection= connection();
        $sql= "INSERT INTO profesores (DNI,Nom,Cognoms,Password,Titol,Foto) VALUES ('$dni', '$name', '$surnames', md5('$pass'), '$title','$directorio')";
        var_dump($sql);
        $result= mysqli_query($connection, $sql);

        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
        <?php
    }
?>

<form action="SignUpProfesor.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
    <h1>Registrar profesor</h1>
    <p>DNI: <input type="text" name="DNI" required></p>    
    <p>Nombre: <input type="text" name="Nom" required></p>    
    <p>Cognoms: <input type="text" name="Cognoms" required></p>
    <p>Contraseña: <input type="text" name="Password" required></p>
    <p>Titol: <input type="text" name="Titol" required></p>
    <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg" required></p>
    <button type="submit">Enviar</button>
</form>
<a href="index.php">Volver atrás</a>