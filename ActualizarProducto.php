<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Productos</title>
</head>
<body>
    <header>
        <h1>Agregar/Actualizar Producto</h1>
    </header>
    <main>
        <form action="Modelo.php" method="post">
            <fieldset>
                <legend>ID del Producto (dejar en blanco para agregar nuevo):</legend>
                <input name="product_id" type="text" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
            </fieldset>
            <fieldset>
                <legend>Nombre:</legend>
                <input name="name" required="" type="text" value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>">
            </fieldset>
            <fieldset>
                <legend>Descripción:</legend>
                <textarea name="description" required=""><?php echo isset($product['description']) ? $product['description'] : ''; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Precio:</legend>
                <input name="price" required="" step="0.01" type="number" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">
            </fieldset>
            <input type="submit" value="Guardar Producto">
        </form>
        <nav>
            <a href="index.php">Volver al menú principal</a>
        </nav>
    </main>
</body>
</html>