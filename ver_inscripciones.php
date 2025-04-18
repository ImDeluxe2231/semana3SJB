<?php
include 'config.php';

try {
    $sql = "SELECT e.nombre AS estudiante, m.nombre AS materia, i.fecha_inscripcion 
            FROM Inscripcion i
            JOIN Estudiante e ON i.estudiante_id = e.ID
            JOIN Materia m ON i.materia_codigo = m.codigo";
    $inscripciones = $pdo->query($sql)->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener las inscripciones: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripciones</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 1.1rem;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2e2e2;
        }

        .btn-volver {
            display: block;
            width: fit-content;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-volver:hover {
            background-color: #0056b3;
        }

        .mensaje {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 30px;
            color: #555;
        }
    </style>
</head>
<body>

    <h1>Lista de Inscripciones</h1>

    <?php if (count($inscripciones) > 0): ?>
        <table>
            <tr>
                <th>Estudiante</th>
                <th>Materia</th>
                <th>Fecha de Inscripción</th>
            </tr>
            <?php foreach ($inscripciones as $inscripcion): ?>
                <tr>
                    <td><?= htmlspecialchars($inscripcion['estudiante']) ?></td>
                    <td><?= htmlspecialchars($inscripcion['materia']) ?></td>
                    <td><?= htmlspecialchars($inscripcion['fecha_inscripcion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="mensaje">No hay inscripciones registradas.</div>
    <?php endif; ?>

    <a href="index.php" class="btn-volver">⬅ Volver al inicio</a>

</body>
</html>