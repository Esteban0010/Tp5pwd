Aplicación de Procesamiento de Lenguaje Natural con Evaluación de Sentimientos y Rinvex/Countries en PHP
Este proyecto integra la API de Google Cloud Natural Language para evaluar el sentimiento de los comentarios realizados sobre países, utilizando la librería Rinvex/Countries para la selección de países en una aplicación PHP basada en el patrón MVC (Modelo-Vista-Controlador).

Características
Búsqueda de países: Utiliza la librería Rinvex/Countries para seleccionar un país.
Comentarios: Los usuarios pueden agregar comentarios sobre los países seleccionados.
Análisis de sentimiento: La API de Google Cloud Natural Language evalúa el sentimiento del comentario (positivo, negativo o neutral).
MVC: Separación clara de responsabilidades mediante el patrón MVC.
Requisitos previos
Antes de ejecutar este proyecto, asegúrate de tener lo siguiente:

PHP 7.3+
Composer para gestionar dependencias
Cuenta de Google Cloud y clave de la API de Google Cloud Natural Language
Google Cloud SDK instalado y configurado para autenticación
Base de datos MySQL (opcional, si decides guardar los comentarios y resultados)
Estructura del proyecto
El proyecto utiliza el patrón MVC para organizar el código.

arduino
Copiar código
/app
  /controllers  // Controladores que gestionan la lógica
  /models       // Modelos que gestionan los datos
  /views        // Vistas que muestran el contenido al usuario
/config         // Archivos de configuración
/vendor         // Dependencias instaladas con Composer
Archivos clave:
app/controllers/NaturalLanguageController.php: Maneja la interacción con la API de Google Cloud Natural Language.
app/controllers/CountryController.php: Gestiona la búsqueda y selección de países usando Rinvex/Countries.
app/models/Comentario.php: Modelo para gestionar los comentarios.
app/views/country.php: Página para mostrar la información del país y formulario para agregar comentarios.
app/views/analysis.php: Página para mostrar los resultados del análisis de sentimiento.
config/google_cloud.php: Configuración de la API de Google Cloud.
Instrucciones de configuración
Paso 1: Clonar el repositorio
bash
Copiar código
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
Paso 2: Instalar dependencias
Instala las dependencias de PHP usando Composer:

bash
Copiar código
composer install
Paso 3: Configuración de Google Cloud
Habilita la API de Google Cloud Natural Language en tu consola de Google Cloud.
Descarga el archivo de credenciales en formato JSON y colócalo en la carpeta /config.
Actualiza tu archivo .env o config/google_cloud.php con la ruta de las credenciales:
php
Copiar código
putenv('GOOGLE_APPLICATION_CREDENTIALS=/ruta/a/tus/credenciales.json');
Paso 4: Configuración de la base de datos (opcional)
Si decides guardar los comentarios y resultados de análisis, configura la base de datos en config/database.php. Ejecuta el siguiente script SQL para crear la tabla de comentarios:

sql
Copiar código
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pais VARCHAR(100),
    comentario TEXT,
    sentimiento VARCHAR(50),
    fecha_creacion DATETIME
);
Paso 5: Ejecutar el proyecto
Inicia tu servidor de desarrollo de PHP:

bash
Copiar código
php -S localhost:8000
Visita http://localhost:8000 en tu navegador para comenzar a usar la aplicación.

Uso
Selecciona un país a través del formulario.
Escribe un comentario sobre el país seleccionado.
El sistema analizará el comentario utilizando la API de Google Cloud Natural Language y mostrará el resultado del análisis de sentimiento.
Bibliotecas utilizadas
API de Google Cloud Natural Language - Para el análisis de sentimiento de los comentarios.
Rinvex/Countries - Para la búsqueda y selección de países.
Licencia
Este proyecto está licenciado bajo la Licencia MIT.

