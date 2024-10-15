CREATE TABLE `evaluacion` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,  -- Identificador único para cada evaluación
    `id_comentario` INT(11) NOT NULL,      -- Clave foránea que relaciona el comentario con una evaluación
    `sentimiento` FLOAT NOT NULL,          -- Almacena el puntaje de sentimiento (análisis de sentimiento)
    `entidades` TEXT NOT NULL,             -- Almacena las entidades detectadas (formato JSON)
    `syntaxis` TEXT NOT NULL,              -- Almacena la estructura de la sintaxis (formato JSON)
    PRIMARY KEY (`id`),                    -- Clave primaria en el campo `id`
    FOREIGN KEY (`id_comentario`) REFERENCES `comentarios`(`id`) ON DELETE CASCADE  -- Relación con evaluacion
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `comentarios` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,                     -- Identificador único del comentario
    `autor` VARCHAR(255) NOT NULL,                            -- Nombre del autor del comentario
    `comentario` TEXT NOT NULL,                               -- El contenido del comentario
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,     -- Fecha de creación del comentario
    `pais` VARCHAR(16) NOT NULL,                              -- País del comentario
    PRIMARY KEY (`id`)                                         -- Se elimina la coma extra aquí
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
