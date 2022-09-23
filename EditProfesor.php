<?php
    session_start();
    include('funciones.php');

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
    $connection= connection();
    $sql= "SELECT * FROM profesores WHERE DNI=".$_GET['curso'];
    $result= mysqli_query($connection, $sql);
    
    $row= mysqli_fetch_assoc($result);
?>
<form action="EditProfesor.php" method="POST" name="InicioSession">
    <h1>Editar profesor </h1>
    <p>DNI: <input type="text" name="DNI" value="<?php echo($row['DNI']); ?>" required></p>    
    <p>Nombre: <input type="text" name="Nom" value="<?php echo($row['Nom']); ?>" required></p>    
    <p>Cognoms: <input type="text" name="Cognoms" value="<?php echo($row['Cognoms']); ?>" required></p>
    <p>Contraseña: <input type="text" name="Password" value="<?php echo($row['Password']); ?>" required></p>
    <p>Titol: <input type="text" name="Titol" value="<?php echo($row['Titol']); ?>" required></p>
    <button type="submit">Enviar</button>
</form>
<a href="AdminProfesor.php">Volver atrás</a>