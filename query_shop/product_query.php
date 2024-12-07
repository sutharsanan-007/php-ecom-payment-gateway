<?php
require("../../database/db.php");

$query = "
    SELECT products.id AS id, products.category_id AS category_id, products.name AS name, products.price AS price, products.image AS image, categories.name AS category_name, categories.image AS category_image
    FROM products
    INNER JOIN categories ON products.category_id = categories.id
    WHERE products.deleted_at = 0
";
$result = mysqli_query($db, $query);
if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(['data' => $data]);
}
?>