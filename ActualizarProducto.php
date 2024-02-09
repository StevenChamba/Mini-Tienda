<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
            <title>
                Formulario de Productos
            </title>
        </meta>
    </head>
    <body>
        <h2>
            Agregar/Actualizar Producto
        </h2>
        <form action="Modelo.php" method="post">
            <label for="product_id">
                ID del Producto (dejar en blanco para agregar nuevo):
            </label>
            <input name="product_id" type="text" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
                <br>
                    <label for="name">
                        Nombre:
                    </label>
                    <input name="name" required="" type="text" value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>">
                        <br>
                            <label for="description">
                                Descripción:
                            </label>
                            <textarea name="description" required="">
                                <?php echo isset($product['description']) ? $product['description'] : ''; ?>
                            </textarea>
                            <br>
                                <label for="price">
                                    Precio:
                                </label>
                                <input name="price" required="" step="0.01" type="number" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">
                                    <br>
                                        <input type="submit" value="Guardar Producto">
                                            <a href="index.php">
                                                Volver al menu principal
                                            </a>
                                        </input>
                                    </br>
                                </input>
                            </br>
                        </br>
                    </input>
                </br>
            </input>
        </form>
    </body>
</html>
