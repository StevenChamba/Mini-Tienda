<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Eliminar</title>
</head>
<body>
    <header>
        <h1>Eliminar Producto</h1>
    </header>
    <main>
        <form action="Modelo.php" method="post">
            <fieldset>
                <legend>Eliminar Producto (ID):</legend>
                <input name="delete_product_id" type="text">
            </fieldset>
            <input type="submit" value="Guardar Cambios">
        </form>
        <nav>
            <a href="index.php">Volver al menú principal</a>
        </nav>
    </main>
</body>
</html>