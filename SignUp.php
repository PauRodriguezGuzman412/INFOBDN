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
            $query= "INSERT * INTO "
        }
    ?>

    <form action="SignUp.php" method="POST" name="InicioSession">
        <h1>Registrarse</h1>
        <p>Email: <input type="text" name="Email" required></p>    
        <p>DNI: <input type="text" name="DNI" required></p>    
        <p>Nombre: <input type="text" name="Nom" required></p>    
        <p>Cognoms: <input type="text" name="Cognoms" required></p>
        <p>Contraseña: <input type="text" name="Password" required></p>
        <p>Edat: <input type="text" name="Edat" required></p>
        <p>Avatar: <input type="file" name="Foto" accept=".png, .jpg, .jpeg"></p>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>