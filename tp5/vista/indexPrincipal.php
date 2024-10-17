<!DOCTYPE html>
<html lang="es">
<?php
include_once "Estructura/Header.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="action/actionLeo.php" method="POST">
            <h2>COUNTRIES</h2>
            <!-- Paises -->
            <div class="form-group">
                <label for="paises" class="form-label">Buscar Pais:</label><br>
                <input type="text" id="paises" name="paises" placeholder="Ingrese un pais" style="width: 300px;">
                <input type="hidden" id="accion" name="accion" value="buscarPais">
                <!-- <div class="invalid-feedback">Por favor, ingrese un número de patente válido.</div> -->
            </div>
            <!-- Boton Enviar -->
            <input type="submit" class="btn btn-primary" value="Buscar" style="margin-top: 8px;">
        </form>
    </div>


</body>

<?php
include_once "Estructura/Footer.php";
?>
</html>