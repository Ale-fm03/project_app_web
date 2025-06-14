<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Consultar roles</h1>
    <a href="?c=Usuarios&a=crearRol">Crear Rol</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>NOMBRE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol) : ?>
                <tr>
                    <td><?php echo $rol->getRolCode(); ?></td>
                    <td><?php echo $rol->getRolNombre(); ?></td>
                    <td>
                        <a href="?c=Usuarios&a=actualizarRol&idRol=<?php echo $rol->getRolCode(); ?>">Actualizar</a>
                        <a href="?c=Usuarios&a=eliminarRol&idRol=<?php echo $rol->getRolCode(); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>