<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Productos</title>
</head>
<body>
    <header>
        <h1>Agregar Producto</h1>
    </header>
    <main>
        <form action="Modelo.php" method="post">
            <fieldset>
                <legend>Nombre:</legend>
                <input name="name" required type="text">
            </fieldset>
            <fieldset>
                <legend>Descripción:</legend>
                <textarea name="description" required></textarea>
            </fieldset>
            <fieldset>
                <legend>Precio:</legend>
                <input name="price" required step="0.01" type="number">
            </fieldset>
            <input type="submit" value="Agregar Producto">
            <nav>
                <a href="index.php">Volver al menú principal</a>
            </nav>
        </form>
    </main>
</body>
</html>