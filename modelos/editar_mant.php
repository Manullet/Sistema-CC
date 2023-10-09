<?php
session_start();
//para validar si inicio sesion
if(!isset($_SESSION['usuario'])){
    echo'

    <script> 
        alert("Debes iniciar sesion");
        window.location = "index.php";
    </script>
    
    ';

    //header("location: index.php");
    //destruye cualquier session
    session_destroy();
    //para el codigo
    die();
    
}

?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../dist/css/diseño.css">
    <title>Editar Objeto</title>
</head>
<body>
    

    <h1>Editar Objeto</h1>
    <form action="php/mantenimiento_be.php" method="post">
        <label>Objeto</label>
        <input type="text" name="objeto" value="<?=$objeto['objeto']?>"> <br>
        <label>Descripción</label>
        <input type="text" name="Descripcion" value="<?=$objeto['Descripcion']?>"> <br>
        <label>Actualizado por</label>
        <input type="text" name="Actualizado_Por" value="<?=$objeto['Actualizado_Por']?>"> <br>
        <label>Status</label>
        <input type="text" name="Status" value="<?=$objeto['Status']?>"> <br>
        <input type="submit" name="Editar" value="EDITAR">
        <a href="../bienvenida.php">Regresar</a>
    </form>
</body>
</html>