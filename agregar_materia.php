<?php
include 'config.php';

$mensaje = "";
$colorMensaje = "green";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $sql = "INSERT INTO Materia (nombre) VALUES (:nombre)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);

        if ($stmt->execute()) {
            $mensaje = "✅ Materia agregada exitosamente.";
            $colorMensaje = "green";
        } else {
            $mensaje = "❌ Error al agregar la materia.";
            $colorMensaje = "red";
        }
    } else {
        $mensaje = "⚠️ El nombre de la materia es obligatorio.";
        $colorMensaje = "orange";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Materias</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 40px 35px;
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
            text-align: center;
            width: 90%;
            max-width: 420px;
        }
        h2 {
            color: #007acc;
            margin-bottom: 10px;
        }
        p.subtitulo {
            color: #555;
            margin-bottom: 25px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            text-align: left;
            font-weight: bold;
            color: #444;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="submit"], .btn-volver {
            background-color: #00c6ff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
        }
        input[type="submit"]:hover, .btn-volver:hover {
            background-color: #007acc;
            transform: scale(1.05);
        }
        .btn-volver {
            margin-top: 10px;
        }
        .mensaje {
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>📘 Registro de Materias</h2>
        <p class="subtitulo">Agrega una nueva materia para el sistema.</p>

        <?php if (!empty($mensaje)) : ?>
            <div class="mensaje" style="color: <?= $colorMensaje ?>;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="agregar_materia.php">
            <label for="nombre">Nombre de la Materia:</label>
            <input type="text" name="nombre" id="nombre" required>

            <input type="submit" value="Agregar Materia">
        </form>

        <button class="btn-volver" onclick="window.location.href='index.php'">⬅ Volver al inicio</button>
    </div>
</body>
</html>