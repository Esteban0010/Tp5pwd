<?php
include_once "estructura/Header.php";
?>


<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" id="container" style="height: 70vh;">
        <div class="container text-center my-4">
            <img src="Assets/imagen/paises.jpg" alt="Imagen de países" class="img-fluid rounded">
        </div>
        <form action="action/actionPais.php" method="POST" class="bg-white p-4 rounded shadow"
            style="width: 100%; max-width: 400px;" onsubmit="return validar()">
            <h2 class="text-center mb-4">Buscar País</h2>
            <div class="mb-3">
                <label for="pais" class="form-label">Nombre del País:</label>
                <input type="text" id="pais" name="pais" class="form-control" placeholder="Ingrese un país" required>
                <input type="hidden" id="codigoPais" name="codigoPais">
                <div class="invalid-feedback">Por favor, ingrese un país válido.</div>

            </div>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </form>
    </div>
    <div class="text-center mb-4">
        <p><strong>Integrantes:</strong> Esteban Pilchuman - Leonardo Pacheco - Martin Paredes - Francisco Pandolfi
            Jimenez</p>
    </div>


    <!-- js validacion formulario -->
    <script src="./Assets/validarPais.js"></script>

    <?php
    include_once "estructura/Footer.php";
    ?>