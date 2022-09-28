<?php
    //Una de las fotos es mía. La puedes ver si vas a https://gamejolt.com/@Hombreguz412
    session_start();
    include('funciones.php');

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

<form action="AdminProfesor.php" method="POST" name="InicioSession" ENCTYPE="multipart/form-data">
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