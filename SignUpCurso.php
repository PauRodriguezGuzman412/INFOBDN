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
            $sql= "INSERT INTO cursos (Nom,Descripcion,Hores,Data_inici,Data_final,Dni_Profesores) VALUES ('$name', '$desc', '$horas', '$inici', '$final','$prof')";
            $result= mysqli_query($connection, $sql);
    
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AdminCurso.php">
            <?php
        }else{
            echo "La fecha de inicio es mayor que la fecha final";
        }
    }
?>

<form action="SignUpCurso.php" method="POST" name="InicioSession">
    <?php
        $connection= connection();
    
        //GUARDAR NOMBRE PROFESORES
        $sql= "SELECT Nom FROM profesores";
        $result= mysqli_query($connection, $sql);

        while($profe= mysqli_fetch_row($result)){
            $array[] = $profe;    
        }

        //print_r($array);

        //GUARDAR DNI PROFESORES
        $sql2= "SELECT DNI FROM profesores";
        $result2= mysqli_query($connection, $sql2);

        while($profe2= mysqli_fetch_row($result2)){
            $array2[] = $profe2;    
        }

        //print_r($array2);
    ?>
    <?php
    if(isset($_SESSION['rol'])){
        if($_SESSION['rol']=='admin'){
    ?>
    <h1>Registrar Curso</h1>
    <p>Nombre del curso: <input type="text" name="Nom" required></p>    
    <p>Descripción: <input type="text" name="Descripcion" required></p>    
    <p>Horas: <input type="text" name="Hores" required></p>
    <p>Data inicio: <input type="date" name="Data_inici" required></p>
    <p>Data final: <input type="date" name="Data_final" required></p>
    <!--<p>Profesor: <input type="text" name="Dni_Profesores"></p>-->
    <p>
        <label for="Dni_Profesores">Profesor:
            <select name="Dni_Profesores" id="Dni_Profesores"> 
                <?php
                    for($i=0;$i<($result->num_rows);$i++){
                        ?>
                        <option value="<?php print($array2[$i][0]) ?>"><?php print($array[$i][0]) ?></option>
                        <?php
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
        }
    }
?>    