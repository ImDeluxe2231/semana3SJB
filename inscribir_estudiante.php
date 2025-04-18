<?php
include 'config.php';

$mensaje = "";

try {
    // Obtener los datos de los combos
    $estudiantes = $pdo->query("SELECT * FROM Estudiante")->fetchAll();
    $materias = $pdo->query("SELECT * FROM Materia")->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $estudiante_id = $_POST['estudiante_id'];
        $materia_codigo = $_POST['materia_codigo'];
        $fecha_inscripcion = $_POST['fecha_inscripcion'];

        // Validar existencia de estudiante y materia
        $validar_estudiante = $pdo->prepare("SELECT COUNT(*) FROM Estudiante WHERE ID = :id");
        $validar_estudiante->execute([':id' => $estudiante_id]);

        $validar_materia = $pdo->prepare("SELECT COUNT(*) FROM Materia WHERE codigo = :codigo");
        $validar_materia->execute([':codigo' => $materia_codigo]);

        if ($validar_estudiante->fetchColumn() == 0 || $validar_materia->fetchColumn() == 0) {
            $mensaje = "❌ Estudiante o materia no válido.";
        } else {
            // Verificar si ya está inscrito
            $verificar = $pdo->prepare("SELECT COUNT(*) FROM Inscripcion WHERE estudiante_id = :eid AND materia_codigo = :mc");
            $verificar->execute([':eid' => $estudiante_id, ':mc' => $materia_codigo]);

            if ($verificar->fetchColumn() > 0) {
                $mensaje = "⚠️ El estudiante ya está inscrito en esta materia.";
            } else {
                // Insertar inscripción
                $sql = "INSERT INTO Inscripcion (estudiante_id, materia_codigo, fecha_inscripcion) 
                        VALUES (:estudiante_id, :materia_codigo, :fecha_inscripcion)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':estudiante_id', $estudiante_id);
                $stmt->bindParam(':materia_codigo', $materia_codigo);
                $stmt->bindParam(':fecha_inscripcion', $fecha_inscripcion);

                if ($stmt->execute()) {
                    $mensaje = "✅ Estudiante inscrito exitosamente.";
                } else {
                    $mensaje = "❌ Error al inscribir al estudiante.";
                }
            }
        }
    }
} catch (PDOException $e) {
    $mensaje = "❌ Error en la base de datos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción de Estudiantes</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #00c9ff, #92fe9d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            text-align: left;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select, input[type="date"], input[type="submit"], .btn-volver {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"], .btn-volver {
            background-color: #007bff;
            color: white;
            border: none;
            font-weight: bold;
            transition: background 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover, .btn-volver:hover {
            background-color: #0056b3;
        }

        .btn-volver {
            margin-top: 10px;
        }

        .mensaje {
            margin-bottom: 15px;
            font-weight: bold;
            color: green;
        }

        .mensaje.error {
            color: red;
        }

        .mensaje.warning {
            color: #e67e22;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Inscripción de Estudiantes</h2>

        <?php if (!empty($mensaje)) : ?>
            <div class="mensaje <?php echo (str_contains($mensaje, '❌') ? 'error' : (str_contains($mensaje, '⚠️') ? 'warning' : '')); ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="inscribir_estudiante.php">
            <label for="estudiante_id">Estudiante:</label>
            <select name="estudiante_id" id="estudiante_id" required>
                <?php foreach ($estudiantes as $estudiante) { ?>
                    <option value="<?php echo $estudiante['ID']; ?>">
                        <?php echo htmlspecialchars($estudiante['nombre']); ?>
                    </option>
                <?php } ?>
            </select>

            <label for="materia_codigo">Materia:</label>
            <select name="materia_codigo" id="materia_codigo" required>
                <?php foreach ($materias as $materia) { ?>
                    <option value="<?php echo $materia['codigo']; ?>">
                        <?php echo htmlspecialchars($materia['nombre']); ?>
                    </option>
                <?php } ?>
            </select>

            <label for="fecha_inscripcion">Fecha de Inscripción:</label>
            <input type="date" name="fecha_inscripcion" id="fecha_inscripcion" required>

            <input type="submit" value="Inscribir Estudiante">
        </form>

        <button class="btn-volver" onclick="window.location.href='index.php'">⬅ Volver</button>
    </div>
</body>
</html>