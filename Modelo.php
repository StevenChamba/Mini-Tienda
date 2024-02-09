<?php
// include database configuration file
include 'Configuracion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se proporciona un product_id para eliminar
    if (isset($_POST['delete_product_id']) && !empty($_POST['delete_product_id'])) {
        $delete_product_id = $_POST['delete_product_id'];

        // Realizar la eliminación en la base de datos
        $deleteQuery = $db->prepare("DELETE FROM mis_productos WHERE id = ?");
        $deleteQuery->bind_param("i", $delete_product_id);

        if ($deleteQuery->execute()) {
            echo "Producto eliminado con éxito.";
        } else {
            echo "Error al eliminar el producto: " . $deleteQuery->error;
        }

        $deleteQuery->close();
    } else {
        // Obtener datos del formulario para agregar o actualizar productos
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        // Obtener el product_id desde el formulario
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;

        if (!empty($product_id)) {
            // Actualizar el producto existente si se proporciona un product_id
            $updateQuery = $db->prepare("UPDATE mis_productos SET name=?, description=?, price=? WHERE id=?");
            $updateQuery->bind_param("ssdi", $name, $description, $price, $product_id);

            if ($updateQuery->execute()) {
                echo "Producto actualizado con éxito.";
            } else {
                echo "Error al actualizar el producto: " . $updateQuery->error;
            }

            $updateQuery->close();
        } else {
            // Insertar un nuevo producto si no se proporciona un product_id
            $insertQuery = $db->prepare("INSERT INTO mis_productos (name, description, price) VALUES (?, ?, ?)");
            $insertQuery->bind_param("ssd", $name, $description, $price);

            if ($insertQuery->execute()) {
                echo "Producto agregado con éxito.";
            } else {
                echo "Error al agregar el producto: " . $insertQuery->error;
            }

            $insertQuery->close();
        }
    }

    // Cerrar la conexión y liberar recursos
    $db->close();
}
?>
