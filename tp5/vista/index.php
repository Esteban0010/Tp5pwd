<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paises</title>
    <!-- css bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- js bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- js validacion formulario -->
    <script src="./Assets/validarPais.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="action/actionPais.php" method="POST " onsubmit="return validar()">
            <h2>COUNTRIES</h2>
            <div class="form-group">

                <label for="pais" class="form-label">Buscar Pais:</label><br>
                <input type="text" id="pais" name="pais" placeholder="Ingrese un pais" style="width: 300px;">
                <input type="hidden" id="codigoPais" name="codigoPais" value="">
                <div class="invalid-feedback">Por favor, ingrese un país válido.</div>
            </div>

            <!-- Boton Enviar -->
            <input type="submit" class="btn btn-primary" value="Buscar" style="margin-top: 8px;">
        </form>
    </div>


</body>


</html>