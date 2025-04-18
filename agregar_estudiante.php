<?php
include 'config.php';

$mensaje = "";
$colorMensaje = "green";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $curso = trim($_POST['curso']);

    if (!empty($nombre) && !empty($curso)) {
        $sql = "INSERT INTO Estudiante (nombre, curso) VALUES (:nombre, :curso)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':curso', $curso);

        if ($stmt->execute()) {
            $mensaje = "✅ Estudiante agregado exitosamente.";
            $colorMensaje = "green";
        } else {
            $mensaje = "❌ Error al agregar el estudiante.";
            $colorMensaje = "red";
        }
    } else {
        $mensaje = "⚠️ Todos los campos son obligatorios.";
        $colorMensaje = "orange";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Estudiantes</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 35px 45px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 450px;
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
            color: #007acc;
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
            color: #333;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="submit"],
        .btn-volver {
            background-color: #00c6ff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s;
            margin-top: 20px;
        }
        input[type="submit"]:hover,
        .btn-volver:hover {
            background-color: #007acc;
            transform: scale(1.05);
        }
        .mensaje {
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>🧑‍🎓 Registro de Estudiantes</h2>
        <p class="subtitulo">Agrega nuevos estudiantes con su nombre y curso correspondiente.</p>

        <?php if (!empty($mensaje)) : ?>
            <div class="mensaje" style="color: <?= $colorMensaje ?>;">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="agregar_estudiante.php">
            <label for="nombre">Nombre del estudiante:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="curso">Curso:</label>
            <input type="text" name="curso" id="curso" required>

            <input type="submit" value="Agregar Estudiante">
        </form>

        <button class="btn-volver" onclick="window.location.href='index.php'">⬅ Volver al inicio</button>
    </div>
</body>
</html>