<html>

<head>
    <!-- css bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- js bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pais</title>

    <style>
        html, body {
            height: 100%;
            margin: 0
        }

        body {
            display: flex;
            flex-direction: column;
        }        

        .titulo {
            text-decoration: none;
            color: black;
            text-align: center;
            width: 100%;
        }

        .titulo:hover {
            color: white;
        }    

        #container{
            position: relative; /* Para ser el contenedor de referencia */
            width: 100%; /* Que sea responsivo */
            height: auto; /* Ajusta según el contenido de la imagen */
        }
        
        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        nav.navbar {
            justify-content: center;
        }

        .bg-pastel-red {
            background-color: #ffb3b3 !important;
            /* Rojo pastel */
        }

        .bg-pastel-blue {
            background-color: #b3d1ff !important;
            /* Azul pastel */
        }

        .bg-pastel-green {
            background-color: #b3ffb3 !important;
            /* Verde pastel */
        }

        .bg-beige {
            background-color: #f5f5dc !important;
            /* Fondo beige */
        }        
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-black">
            <a class="titulo" href="indexPrincipal.php">
                <h2 style="color: white;">Programación Web Dinámica 2024 - Grupo 21</h2>
            </a>
        </nav>
    </header>
    <main class="container mt-2">