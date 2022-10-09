<?php
    session_start();
    include('funciones.php');

    if (!empty($_POST['Nom'])) {
        if($_POST['Data_inici']<$_POST['Data_final']){
            $name= $_POST['Nom'];
            $desc= $_POST['Descripcion'];
            $horas= $_POST['Hores'];
            $inici= $_POST['Data_inici'];
            $final= $_POST['Data_final'];
            $prof= $_POST['Dni_Profesores'];

            
            $_SESSION['rol']= 'admin';

            $connection= connection();
            $sql= "UPDATE cursos SET Nom= '$name', Descripcion= '$desc', Hores='$horas', Data_inici='$inici', Data_final='$final', Dni_Profesores='$prof' WHERE Codi=".$_SESSION['id']."";
            $result= mysqli_query($connection, $sql);

            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminCurso.php">
            <?php
        }else{
            echo "La fecha de inicio es mayor que la fecha final";
        }
    }
?>

<form action="EditCurso.php" method="POST" name="InicioSession">
            <?php
            if(isset($_SESSION['rol'])){
                if($_SESSION['rol']=='admin'){
                    $connection= connection();
            
                    //GUARDAR NOMBRE PROFESORES
                    $sql= "SELECT Nom FROM profesores";
                    $result= mysqli_query($connection, $sql);
                    
                    while($profe= mysqli_fetch_row($result)){
                        $array[] = $profe;    
                    }
                    
                    //GUARDAR DNI PROFESORES
                    $sql2= "SELECT DNI FROM profesores";
                    $result2= mysqli_query($connection, $sql2);
                    
                    while($profe2= mysqli_fetch_row($result2)){
                        $array2[] = $profe2;    
                    }

                    $_SESSION['id']= $_GET['curso'];

                    $row= EditarCursos($_GET['curso']);
            ?>
    <h1>Edit Curso</h1>
    <p>Nombre del curso: <input type="text" name="Nom" required value="<?php echo($row['Nom']); ?>"></p>    
    <p>Descripción: <input type="text" name="Descripcion" required value="<?php echo($row['Descripcion']); ?>"></p>    
    <p>Horas: <input type="text" name="Hores" required value="<?php echo($row['Hores']); ?>"></p>
    <p>Data inicio: <input type="date" name="Data_inici" required value="<?php echo($row['Data_inici']); ?>"></p>
    <p>Data final: <input type="date" name="Data_final" required value="<?php echo($row['Data_final']) ?>"></p>
    <p>
        <label for="Dni_Profesores">Profesor:
            <select name="Dni_Profesores"> 
                <?php
                    for($i=0;$i<($result->num_rows);$i++){
                        if($array2[$i][0]==$row['Dni_Profesores']){
                            ?>
                                <option value="<?php print($array2[$i][0]) ?>"selected><?php print($array[$i][0])  ?></option>
                            <?php
                        }else{
                            ?>
                                <option value="<?php print($array2[$i][0]) ?>"><?php print($array[$i][0]) ?></option>
                        <?php
                        }
                    }
                ?>
            </select>
        </label>
    </p>
    <button type="submit">Enviar</button>
</form>
<a href="AdminCurso.php">Volver atrás</a>
<?php
    }else{
        echo"No deberías estar aquí";
    }}
?>   