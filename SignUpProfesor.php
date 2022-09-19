<?php
    session_start();
    
    if (!empty($_POST['DNI'])) {
        $dni= $_POST['DNI'];
        $name= $_POST['Nom'];
        $surnames= $_POST['Cognoms'];
        $pass= $_POST['Password'];
        $title= $_POST['Titol'];
        $avatar= $_POST['Foto'];
        
        $_SESSION['rol']= 'admin';

        $connection= mysqli_connect('localhost', 'root', '', 'infoBDN');
        $sql= "INSERT INTO profesores (DNI,Nom,Cognoms,Password,Titol) VALUES ('$dni', '$name', '$surnames', '$pass', '$title')";
        $result= mysqli_query($connection, $sql);

        ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php">
        <?php
    }
?>

<form action="SignUpProfesor.php" method="POST" name="InicioSession">
    <h1>Registrar profesor</h1>
    <p>DNI: <input type="text" name="DNI" required></p>    
    <p>Nombre: <input type="text" name="Nom" required></p>    
    <p>Cognoms: <input type="text" name="Cognoms" required></p>
    <p>Contraseña: <input type="text" name="Password" required></p>
    <p>Titol: <input type="text" name="Titol" required></p>
    <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg" required></p>   
    <button type="submit">Enviar</button>
</form>