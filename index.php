<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de Página Web con Datos de Usuariossss</title>
</head>
<body>

<?php
// Conexión a la base de datos en Azure con SSL
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, "C:\Users\braya\Documents\CURSOS\PHP\certificados\DigiCertGlobalRootCA.crt.pem", NULL, NULL); // Reemplaza con la ruta real al certificado CA
$conn = mysqli_real_connect($con, "leonardo.mysql.database.azure.com", "leonardo", "Br@ya2001", "db_leonado_dev", 3306, MYSQLI_CLIENT_SSL);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta a la base de datos
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Mostrar los resultados en una tabla HTML
if ($result) {
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

    // Mostrar datos en la tabla HTML
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
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>



</body>
</html>
