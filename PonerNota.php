<?php
    session_start();
    include('funciones.php');

    if (!empty($_POST['Nota'])) {
        $nota= $_POST['Nota'];
       
        $connection= connection();
        $sql= "UPDATE matriculas SET nota=".$nota." WHERE Codi LIKE ".$_SESSION['NotasId']." AND Email_Alumnos LIKE '".$_SESSION['NotasEmail']."'";
        var_dump($sql);
        $result= mysqli_query($connection, $sql);

        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=cursos.php">
        <?php
    }
?>

<?php
    if($_SESSION['rol']=='profesor'){
            $_SESSION['NotasId']= $_GET['id'];
            $_SESSION['NotasEmail']=$_GET['Email'];
?>
<form action="PonerNota.php" method="POST" name="PonerNota">
    <h1> Poner Nota </h1>
    <p>DNI: <input type="number" name="Nota" required>
    <button type="submit">Enviar</button>
</form>
<a href="cursos.php">Volver atrás</a>
<?php
    }else{
        echo"No deberías estar aquí";
    }
?>   