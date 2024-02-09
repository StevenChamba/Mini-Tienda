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
            Agregar Producto
        </h2>
        <form action="Modelo.php" method="post">
            <label for="name">
                Nombre:
            </label>
            <input name="name" required="" type="text">
                <br>
                    <br>
                        <br>
                            <label for="description">
                                Descripción:
                            </label>
                            <textarea name="description" required="">
                            </textarea>
                            <br>
                                <br>
                                    <br>
                                        <label for="price">
                                            Precio:
                                        </label>
                                        <input name="price" required="" step="0.01" type="number">
                                            <br>
                                                <br>
                                                    <input type="submit" value="Agregar Producto">
                                                    </input>
                                                </br>
                                                <br>
                                                    <a href="index.php">
                                                        Volver al menu principal
                                                    </a>
                                                </br>
                                            </br>
                                        </input>
                                    </br>
                                </br>
                            </br>
                        </br>
                    </br>
                </br>
            </input>
        </form>
    </body>
</html>
