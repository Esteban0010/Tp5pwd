<?php
include_once "Estructura/Header.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrese País</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container text-center my-4">
        <img src="Assets/imagen/paises.jpg" alt="Imagen de países" class="img-fluid rounded">
    </div>
    <div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
        <form action="action/actionPais.php" method="POST" class="bg-white p-4 rounded shadow" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Buscar País</h2>
            <div class="mb-3">
                <label for="paises" class="form-label">Nombre del País:</label>
                <input type="text" id="paises" name="paises" class="form-control" placeholder="Ingrese un país" required>
                <input type="hidden" id="accion" name="accion" value="buscarPais">
            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>
    </div>
    <div class="text-center mb-4">
        <p><strong>Integrantes:</strong> Esteban Pilchuman - Leonardo Pacheco - Martin Paredes - Francisco Pandolfi Jimenez</p>
    </div>

    <?php
    include_once "Estructura/Footer.php";
    ?>
</body>
</html>