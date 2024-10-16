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
    <title>Document</title>

    <style>
        .navbar-nav {
            margin-left: 120px;
            /* Ajusta el valor según sea necesario   */
        }

        html,
        body {
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
        }

        .titulo:hover {
            color: white;
        }

        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-info">

            <a class="titulo" href="../../../Menu.php">
                <h2>Programación Web Dinámica 2024 - Grupo 21</h2>
            </a>

            <ul class="navbar-nav">
                <!-- TP1 -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">TP1</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../TP1/Vista/1.form.php">Ejercicio 1</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/2.form.php">Ejercicio 2</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/3.form.php">Ejercicio 3</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/4.form.php">Ejercicio 4</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/5.form.php">Ejercicio 5</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/6.form.php">Ejercicio 6</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/7.form.php">Ejercicio 7</a></li>
                        <li><a class="dropdown-item" href="../../../TP1/Vista/8.form.php">Ejercicio 8</a></li>
                    </ul>
                </li>
                <!-- TP2 -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">TP2</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.1.form.php">Ejercicio 2.1</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.2.form.php">Ejercicio 2.2</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.3.form.php">Ejercicio 2.3</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.4.form.php">Ejercicio 2.4</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.5.form.php">Ejercicio 2.5</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.6.form.php">Ejercicio 2.6</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.7.form.php">Ejercicio 2.7</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/2.8.form.php">Ejercicio 2.8</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/3.formLogIn.php">Ejercicio 3</a></li>
                        <li><a class="dropdown-item" href="../../../TP2/Vista/4.formularioCinemas.php">Ejercicio 4</a></li>
                    </ul>
                </li>
                <!-- TP3 -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">TP3</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../TP3/Vista/1.formulario.php">Ejercicio 1</a></li>
                        <li><a class="dropdown-item" href="../../../TP3/Vista/2.formulario.php">Ejercicio 2</a></li>
                        <li><a class="dropdown-item" href="../../../TP3/Vista/3.formulario.php">Ejercicio 3</a></li>
                    </ul>
                </li>


                <!-- TP4 -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">TP4</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="verAutos.php">Ejercicio: 3</a></li>
                        <li><a class="dropdown-item" href="buscarAuto.php">Ejercicio: 4 </a></li>                        
                        <li><a class="dropdown-item" href="listaPersonas.php">Ejercicio: 5</a></li>
                        <li><a class="dropdown-item" href="nuevaPersona.php">Ejercicio: 6</a></li>
                        <li><a class="dropdown-item" href="nuevoAuto.php">Ejercicio: 7</a></li>
                        <li><a class="dropdown-item" href="cambioDuenio.php">Ejercicio: 8 </a></li>
                        <li><a class="dropdown-item" href="buscarPersona.php">Ejercicio: 9</a></li>

                    </ul>
                </li>
            </ul>

        </nav>
    </header>

    <main align="center">
    