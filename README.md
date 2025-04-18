<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistema de Inscripciones</title>
	<style>
		body {
			margin: 0;
			padding: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(to right, #4facfe, #00f2fe);
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}
		.container {
			background-color: white;
			padding: 40px 50px;
			border-radius: 25px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
			text-align: center;
			max-width: 650px;
			width: 90%;
		}
		h1 {
			color: #007acc;
			margin-bottom: 10px;
			font-size: 30px;
		}
		h2 {
			color: #333;
			font-size: 20px;
			margin-bottom: 20px;
		}
		p.description {
			color: #444;
			font-size: 17px;
			margin-bottom: 25px;
			line-height: 1.4;
		}
		ol {
			text-align: left;
			color: #555;
			font-size: 18px;
			margin-bottom: 25px;
			padding-left: 20px;
		}
		ol li {
			margin: 8px 0;
		}
		.button-group {
			display: flex;
			flex-direction: column;
			gap: 10px;
			align-items: center;
		}
		a {
			display: inline-block;
			background-color: #00c6ff;
			color: white;
			text-decoration: none;
			padding: 14px 28px;
			border-radius: 10px;
			font-weight: bold;
			transition: background 0.3s ease, transform 0.2s;
			width: 80%;
			max-width: 300px;
		}
		a:hover {
			background-color: #007acc;
			transform: scale(1.05);
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>🎓 Sistema de Gestión Académica</h1>
		<h2>Control de Estudiantes y Materias</h2>
		<p class="description">
			Esta aplicación permite registrar estudiantes, agregar materias e inscribir estudiantes en sus cursos.
		</p>

		<h2>MENÚ DE OPCIONES</h2>
		<ol>
			<li>Selecciona una de estas opciones:</li>
		</ol>

		<div class="button-group">
			<a href="agregar_estudiante.php">➕ Añadir estudiantes</a>
			<a href="agregar_materia.php">📘 Agregar materia</a>
			<a href="inscribir_estudiante.php">📝 Inscribir estudiante</a>
			<a href="ver_inscripciones.php">👀 Ver inscripciones</a>
		</div>
	</div>
</body>
</html>
