<?php
    session_start();

    if (!empty($_FILES['Foto'])) {
        $dni= $_SESSION['dni'];
        //$oldFOTO= $_SESSION['foto'];

        if (is_uploaded_file ($_FILES['Foto']['tmp_name'])){
            $nombreDirectorio = "img/";
            $idUnico = $dni;
            $nombreFichero = $idUnico . "-" . $_FILES['Foto']['name'];
            $directorio= $nombreDirectorio . $nombreFichero;
            move_uploaded_file ($_FILES['Foto']['tmp_name'], $nombreDirectorio . $nombreFichero);
        }else print ("No se ha podido subir el fichero\n");

        $_SESSION['rol']= 'admin';
       
        $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
        $sql= "UPDATE profesores SET Foto='$directorio' WHERE DNI= '$dni'";
        var_dump($sql);
        $result= mysqli_query($connection, $sql);

        ?>
            <!--<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">-->
        <?php
    }
?>

<form action="EditAvatar.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
    <?php
        if(isset($_GET['dni'])){
            $_SESSION['dni']= $_GET['dni'];

            //$_SESSION['foto']= $_GET['foto'];
        }
    ?>
    <h1>Modificar Foto </h1>
    <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg" required></p>
    <button type="submit">Enviar</button>
</form>