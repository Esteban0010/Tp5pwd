<?php
include_once '../../configuracion.php';
// include_once '../../control/Pais.php';
include_once '../../model/CountryModel.php';

// use ABM\control\Pais;

// Obtener los datos enviados desde el formulario
$datos = data_submitted();

$country = null;

if (isset($datos['accion']) && $datos['accion'] === 'buscarPais') {
    $countryName = $datos['paises']; // Ahora estamos buscando por nombre

    // Instanciar el controlador y obtener el país
    $countryController = new Pais();
    $country = $countryController->showCountryByName($countryName);

    // Mostrar la información del país
    if ($country) {
        //informacion
        $nombre = $country['name'];
        $capital = $country['capital'];
        foreach ($country['currency'] as $currency) {
            $moneda = $currency['iso_4217_name'] . " (" . $currency['iso_4217_code'] . ")<br>";
        }
        $idioma = implode(', ', $country['languages']);
        $limitrofes =  implode(', ', $country['borders']);
        $bandera =  $country['flag'];

        //invocacion en html
        $dato1 = " <p> $nombre</p>";
        $dato2 = " <p><strong>Capital: </strong>  $capital</p>";
        $dato3 = " <p><strong>Moneda: </strong>  $moneda</p>";
        $dato4 = " <p><strong>Idioma(s): </strong>  $idioma</p>";
        $dato5 = " <p><strong>Paises limitrofes(s): </strong>  $limitrofes</p>";
        $dato6 = " <p><strong>Bandera(s): </strong>  $bandera</p>";

        // Aquí se muestra la información que vamos a usar en el HTML


    } else {
        echo "No se encontró información para el país especificado.";
    }
} else {
    echo "Acción no válida o país no especificado.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paises</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <style>
        .flag {
            width: 50px;
            /* Tamaño de la bandera */
        }

        .comment-box {
            min-height: 150px;
        }
    </style> -->
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card para mostrar la información del país -->
                <?php if ($country) : ?>
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h2><?php
                                echo $dato1;
                                ?></h2>
                        </div>
                        <div class="card-body">
                            <?php
                            echo $dato2;
                            echo $dato3;
                            echo $dato4;
                            echo $dato5;
                            echo $dato6;
                            ?>


                            <p><strong>Emoji:</strong> <?php echo $country['emoji']; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sección de comentarios -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h3>Dejanos tu comentario si ya visitaste <?php echo $country['name']; ?></h3>
                    </div>
                    <div class="card-body">
                        <form id="comment-form">
                            <div class="form-group mb-3">
                                <textarea name="comentario" id="comentario" class="form-control comment-box" placeholder="Escribe tu comentario aquí..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Dejar comentario!</button>
                        </form>

                        <div class="mt-4" id="comentarios"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script para manejar el envío del comentario
        document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const comentario = document.getElementById('comentario').value;

            if (comentario) {
                const comentarioDiv = document.createElement('div');
                comentarioDiv.classList.add('alert', 'alert-info', 'mt-3');
                comentarioDiv.innerText = comentario;

                // Agrega el comentario a la sección de comentarios
                document.getElementById('comentarios').appendChild(comentarioDiv);

                // Limpia el textarea
                document.getElementById('comentario').value = '';
            }
        });
    </script>

</body>

</html>