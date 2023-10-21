<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de Página Web con Datos de Usuarios</title>
</head>
<body>

<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Variables de entorno
$dbServer = $_ENV['DB_SERVER'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];

try {
    // Conexión a la base de datos utilizando PDO
    $conn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUsername, $dbPassword);

    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Seleccionar todos los usuarios de la tabla "users"
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    // Mostrar los resultados en una tabla HTML
    echo "<h2>Usuarios:</h2>";
    echo "<table border='1'>
    <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Email</th>
    </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

</body>
</html>
