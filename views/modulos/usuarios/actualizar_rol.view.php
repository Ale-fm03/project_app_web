<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Actualizar un Rol</h1>
    <form action="" method="POST">
        <input type="hidden" name="rol_code" value="<?php echo $rolUpd->getRolCode() ?>">
        <div>
            <label for="">Nombre</label>
            <input type="text" name="rol_nombre" value="<?php echo $rolUpd->getRolNombre() ?>">
        </div>
        <div>
            <input type="submit" value="Actualizar">
        </div>
    </form>
</body>
</html>