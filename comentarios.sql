CREATE TABLE `evaluacion` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,  -- Identificador único para cada evaluación
    `sentimiento` FLOAT NOT NULL,          -- Almacena el puntaje de sentimiento (análisis de sentimiento)
    `entidades` TEXT NOT NULL,             -- Almacena las entidades detectadas (formato JSON)
    `syntaxis` TEXT NOT NULL,              -- Almacena la estructura de la sintaxis (formato JSON)
    `class_text` TEXT NOT NULL,            -- El texto original que fue analizado
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación de la evaluación
    PRIMARY KEY (`id`)                     -- Clave primaria en el campo `id`
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `comentarios` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,                     -- Identificador único del comentario
    `id_evaluacion` INT(11) NOT NULL,                         -- Clave foránea que relaciona el comentario con una evaluación
    `autor` VARCHAR(255) NOT NULL,                            -- Nombre del autor del comentario
    `email_autor` VARCHAR(255) NOT NULL,                      -- Email del autor
    `comentario` TEXT NOT NULL,                               -- El contenido del comentario
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     -- Fecha de creación del comentario
    `estado` ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente',  -- Estado de moderación
    `ip_autor` VARCHAR(45) DEFAULT NULL,                      -- IP del autor del comentario
    `url` VARCHAR(255) DEFAULT NULL,                          -- URL de la página donde se hizo el comentario
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_evaluacion`) REFERENCES `evaluacion`(`id`) ON DELETE CASCADE  -- Relación con evaluacion
) ENGINE=InnoDB DEFAULT CHARSET=utf8;