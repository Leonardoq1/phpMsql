<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de Página Web con Datos de Usuarios</title>
</head>
<body>

<?php
 require __DIR__ . '/vendor/autoload.php'; // Cargar el autoload de Composer

 use Dotenv\Dotenv;

 $dotenv = Dotenv::createImmutable(__DIR__);
 $dotenv->load();

 // Variables de entorno
 $dbServer = $_ENV['DB_SERVER'];
 $dbUsername = $_ENV['DB_USERNAME'];
 $dbPassword = $_ENV['DB_PASSWORD'];
 $dbName = $_ENV['DB_NAME'];
$sslCa = "/certificados/DigiCertGlobalRootCA.crt.pem"; // Ruta al certificado CA

// Configurar la conexión
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, $sslCa, NULL, NULL);
$conn = mysqli_real_connect($con, $dbServer, $dbUsername, $dbPassword, $dbName, 3306, MYSQLI_CLIENT_SSL);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Seleccionar todos los usuarios de la tabla "users"
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Mostrar los resultados en una tabla HTML
echo "<h2>Usuarios:</h2>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Nombres</th>
<th>Apellidos</th>
<th>Dirección</th>
<th>Correo</th>
<th>Teléfono</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombres'] . "</td>";
    echo "<td>" . $row['apellidos'] . "</td>";
    echo "<td>" . $row['direccion'] . "</td>";
    echo "<td>" . $row['correo'] . "</td>";
    echo "<td>" . $row['telefono'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión
mysqli_close($conn);
?>


</body>
</html>
