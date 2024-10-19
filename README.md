<h1>Aplicación de Procesamiento de Natural Lenguage con Evaluación de Sentimientos y Rinvex/Countries en PHP</h1>
<p>Este proyecto integra la API de Google Cloud Natural Language para evaluar el sentimiento de los comentarios realizados sobre países, utilizando la librería <strong>Rinvex/Countries</strong> para la selección de países en una aplicación PHP basada en el patrón MVC (Modelo-Vista-Controlador), ejecutada localmente con <strong>XAMPP</strong> en la carpeta <code>htdocs</code>.</p>

<h2>Características</h2>
<ul>
    <li><strong>Búsqueda y información detallada de países</strong>: Utiliza la librería Rinvex/Countries para seleccionar un país y acceder a sus datos.</li>
    <li><strong>Comentarios</strong>: Los usuarios pueden agregar comentarios sobre los países seleccionados.</li>
    <li><strong>Análisis de sentimiento</strong>: La API de Google Cloud Natural Language evalúa el sentimiento del comentario (positivo, negativo o neutral).</li>
    <li><strong>MVC</strong>: Separación clara de responsabilidades mediante el patrón MVC.</li>
</ul>

<h2>Requisitos previos</h2>
<p>Antes de ejecutar este proyecto, asegúrate de tener lo siguiente:</p>
<ul>
    <li>PHP 7.3+ (Instalado con XAMPP)</li>
    <li>Composer para gestionar dependencias</li>
    <li>Cuenta de Google Cloud y clave de la API de Google Cloud Natural Language</li>
    <li>Google Cloud SDK instalado y configurado para autenticación</li>
    <li>Base de datos MySQL (opcional, si decides guardar los comentarios y resultados)</li>
</ul>

<h2>Estructura del proyecto</h2>
<p>El proyecto utiliza el patrón MVC para organizar el código.</p>

<pre><code>/app
/controllers  // Controladores que gestionan la lógica
/models       // Modelos que gestionan los datos
/views        // Vistas que muestran el contenido al usuario
/config         // Archivos de configuración
/vendor         // Dependencias instaladas con Composer
</code></pre>

<h3>Archivos clave:</h3>
<ul>
    <li><code>app/controllers/NaturalLanguageController.php</code>: Maneja la interacción con la API de Google Cloud Natural Language.</li>
    <li><code>app/controllers/CountryController.php</code>: Gestiona la búsqueda y selección de países usando Rinvex/Countries.</li>
    <li><code>app/models/Comentario.php</code>: Modelo para gestionar los comentarios.</li>
    <li><code>tp5pwd/tp5/vista/pais/indexPrincipal.php</code>: Página para seleccionar pais.</li>
    <li><code>tp5pwd/tp5/vista/pais/actionPais.php</code>: Página para mostrar los datos de pais, y agregar comentarios.</li>
</ul>

<h2>Instrucciones de configuración</h2>

<h3>Paso 1: Clonar el repositorio</h3>
<pre><code>
    cd C:\xampp\htdocs
    git clone https://github.com/Esteban0010/Tp5pwd.git
    cd /tp5pwd
</code></pre>

<h3>Paso 2: Instalar dependencias</h3>
<p>Instala las dependencias de PHP usando Composer:</p>
<pre><code>composer install
</code></pre>

<h3>Paso 3: Configuración de Google Cloud</h3>
<ol>
    <li>Habilita la API de Google Cloud Natural Language en tu consola de Google Cloud.</li>
    <li>Descarga el archivo de credenciales en formato JSON y colócalo en la carpeta <code>/config</code>.</li>
    <li>Actualiza tu archivo <code>.env</code> o <code>config/google_cloud.php</code> con la ruta de las credenciales:</li>
</ol>

<pre><code>putenv('GOOGLE_APPLICATION_CREDENTIALS=/ruta/a/tus/credenciales.json');
</code></pre>

<h3>Paso 4: Configuración de la base de datos (opcional)</h3>
<p>Si decides guardar los comentarios y resultados de análisis, configura la base de datos en <code>config/database.php</code>. Ejecuta el siguiente script SQL para crear las tablas de comentarios y evaluaciones:</p>

<pre><code>CREATE TABLE `comentarios` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,                    
    `autor` VARCHAR(255) NOT NULL,                           
    `comentario` TEXT NOT NULL,                              
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     
    `pais` VARCHAR(16) NOT NULL,                              
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `evaluacion` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,  
    `id_comentario` INT(11) NOT NULL,      
    `sentimiento` FLOAT NOT NULL,          
    `entidades` TEXT NOT NULL,             
    `syntaxis` TEXT NOT NULL,              
    PRIMARY KEY (`id`),                    
    FOREIGN KEY (`id_comentario`) REFERENCES `comentarios`(`id`) ON DELETE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
</code></pre>

<h3>Paso 5: Configuración de Rinvex/Countries</h3>
<li>Asegúrate de que la librería esté correctamente cargada en tu proyecto añadiendo la siguiente línea al inicio de tus archivos que la usen:</li>
<pre><code>require 'vendor/autoload.php';</code></pre>

<li>En el controlador de AbmPais.php (app/controllers/AbmPais.php</code>), usa la librería para cargar y enviar la información del pais al script accion. Un ejemplo básico de cómo acceder a los datos es el siguiente:</li>
<pre><code>
use Rinvex\Country\CountryLoader; 
class AbmPais {
    public function paisInformacion($param){
        $pais = country($param);    
        $array = [
            "nombre" => $pais->getName(),  
            "nombreOficial" => $pais->getOfficialName(), 
            "capital" => $pais->getCapital(),
            "gentilicio" => $pais->getDemonym(),
            "idioma" => $pais ->getLanguages(),
            "codigoPostal" => $pais ->usesPostalCode(),
            "numeroIso" => $pais->getIsoNumeric(),
            "continente" => $pais->getContinent(),
            "limitrofes" => $pais->getBorders(),
            "maxLatitud" => $pais->getMaxLatitude(),
            "minLatitud" => $pais->getMinLatitude(), 
            "area" => $pais->getArea(),
            "region" => $pais->getRegion(),
            "sinLitoral" => $pais->isLandlocked(),
            "emoji" => $pais->getEmoji(),
            "bandera" => $pais->getFlag()            
        ];        
        return $array;
    }
}
</code></pre>

<li>En la vista (actionPais.php) (tp5pwd/tp5/vista/pais/actionPais.php</code>), puedes mostrar el array con los datos del país selccionado de la siguiente manera:</li>
<pre><code>
    $country = new AbmPais();
    $colPaisInfo = $country->paisInformacion($datos['codigoPais']); // Obtiene un array de informacion del pais
    echo "<p><strong>Nombre: </strong>" . $colPaisInfo['nombre'] . "</p>"; // Ej: Argentina
    echo "<p><strong>Capital: </strong>" . $colPaisInfo['capital'] . "</p>";
    echo "<p><strong>Nombre Oficial: </strong>" . $colPaisInfo['nombreOficial'] . "</p>";
    echo "<p><strong>Numero de ISO: </strong>" . $colPaisInfo['numeroIso'] . "</p>";
    echo "<div><strong>Bandera(s): </strong><div>" . $colPaisInfo['bandera'] . "</div></div>";
</code></pre>

<h3>Paso 6: Ejecutar el proyecto</h3>
<p>Ubica el proyecto en la carpeta <code>htdocs</code> de XAMPP y arranca tu servidor:</p>
<p>Inicia Apache  y MySql</p>
<p>Visita <code>http://localhost/tp5pwd/tp5/vista/pais/indexPrincipal.php</code> en tu navegador para comenzar a usar la aplicación.</p>

<h2>Uso</h2>
<ol>
    <li>Selecciona un país a través del formulario.</li>
    <li>Escribe un comentario sobre el país seleccionado.</li>
    <li>El sistema analizará el comentario utilizando la API de Google Cloud Natural Language y mostrará el resultado del análisis de sentimiento.</li>
</ol>

<h2>Bibliotecas utilizadas</h2>
<ul>
    <li><strong>API de Google Cloud Natural Language</strong> - Para el análisis de sentimiento de los comentarios.</li>
    <li><strong>Rinvex/Countries</strong> - Para la búsqueda y selección de países. Rinvex/Countries permite obtener información detallada de países, como el nombre oficial, el código ISO, la moneda, y más, con soporte multilenguaje.</li>
</ul>


