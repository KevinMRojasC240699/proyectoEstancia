
-- -----------------------------------------------------
-- Table `menus`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Usuarios',
  `nombre` VARCHAR(25) NOT NULL COMMENT 'Nombre del usuario',
  `apellido` VARCHAR(25) NOT NULL COMMENT 'Apellido del usuario',
  `fecha_nacimiento` DATE NOT NULL COMMENT 'Fecha de nacimiento del usuario',
  `telefono` VARCHAR(10) NOT NULL COMMENT 'Teléfono del usuario',
  `usuario` VARCHAR(25) NOT NULL COMMENT 'Nombre de usuario',
  `contrasena` VARCHAR(65) NOT NULL COMMENT 'Contraseña del usuario',
  `genero` VARCHAR(15) NOT NULL COMMENT 'Género del usuario',
  `tipo` VARCHAR(15) NOT NULL COMMENT 'Tipo del usuario',
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administrador` (
  `id_ad` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Administrador',
  `Usuarios_idUsuarios` INT NOT NULL COMMENT 'ID del usuario asociado',
  PRIMARY KEY (`id_ad`),
  FOREIGN KEY (`Usuarios_idUsuarios`)
    REFERENCES `Usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador del menu',
  `nombre_platillo` VARCHAR(50) NOT NULL COMMENT 'Nombre del platillo',
  `fecha` DATE NOT NULL COMMENT 'Fecha del menu',
  `tipo_comida` VARCHAR(10) NOT NULL COMMENT 'Tipo de comida (almuerzo, comida, cena)',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`platillos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platillos` (
  `id_pla` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Platillos',
  `nombre_platillo` VARCHAR(25) NOT NULL COMMENT 'Nombre del platillo',
  `descripcion` VARCHAR(50) NOT NULL COMMENT 'Descripción del platillo',
  `cantidad` VARCHAR(25) NOT NULL COMMENT 'Cantidad de porción',
  `fecha` DATE NOT NULL COMMENT 'Fecha de creación del platillo',
  `verificacion` TINYINT NOT NULL COMMENT 'Verificación del platillo',
  PRIMARY KEY (`id_pla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`platillos_has_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `platillos_has_menu` (
  `platillos_id_pla` INT NOT NULL COMMENT 'ID del platillo',
  `menu_id_menu` INT NOT NULL COMMENT 'ID del menu',
  PRIMARY KEY (`platillos_id_pla`, `menu_id_menu`),
  FOREIGN KEY (`platillos_id_pla`)
    REFERENCES `platillos` (`id_pla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`menu_id_menu`)
    REFERENCES `menu` (`id_menu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`nutriologos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `nutriologos` (
  `id_nut` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Nutriologos',
  `especialidad` VARCHAR(25) NOT NULL COMMENT 'Especialidad del nutriologo',
  `Usuarios_idUsuarios` INT NOT NULL COMMENT 'ID del usuario asociado',
  PRIMARY KEY (`id_nut`),
  FOREIGN KEY (`Usuarios_idUsuarios`)
    REFERENCES `Usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id_pac` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla Pacientes',
  `Usuarios_idUsuarios` INT NOT NULL COMMENT 'ID del usuario asociado',
  PRIMARY KEY (`id_pac`),
  FOREIGN KEY (`Usuarios_idUsuarios`)
    REFERENCES `Usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------
-- Table `menus`.`pacientes_has_platillos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pacientes_has_platillos` (
  `pacientes_id_pac` INT NOT NULL COMMENT 'ID del paciente',
  `platillos_id_pla` INT NOT NULL COMMENT 'ID del platillo',
  PRIMARY KEY (`pacientes_id_pac`, `platillos_id_pla`),
  FOREIGN KEY (`pacientes_id_pac`)
    REFERENCES `pacientes` (`id_pac`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`platillos_id_pla`)
    REFERENCES `platillos` (`id_pla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE nutriologos_pacientes (
    id_nutriologo_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nutriologo_id INT,
    paciente_id INT,
    FOREIGN KEY (nutriologo_id) REFERENCES nutriologos(id_nut) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id_pac) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `nutriologos_has_platillos` (
  `nutriologos_id_pac` INT NOT NULL COMMENT 'ID del nutriologos',
  `platillos_id_pla` INT NOT NULL COMMENT 'ID del platillo',
  PRIMARY KEY (`nutriologos_id_pac`, `platillos_id_pla`),
  FOREIGN KEY (`nutriologos_id_pac`)
    REFERENCES `nutriologos` (`id_nut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`platillos_id_pla`)
    REFERENCES `platillos` (`id_pla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `pacientes_menus` (
    `id_paciente_menu` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la asignación de menú a paciente',
    `paciente_id` INT NOT NULL COMMENT 'ID del paciente',
    `menu_id` INT NOT NULL COMMENT 'ID del menú',
    `nutriologo_id` INT NOT NULL COMMENT 'ID del nutriólogo que asignó el menú',
    PRIMARY KEY (`id_paciente_menu`),
    FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_pac`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`nutriologo_id`) REFERENCES `nutriologos` (`id_nut`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





INSERT INTO `Usuarios` (nombre, apellido, fecha_nacimiento, telefono, usuario, contrasena, genero)
VALUES 
('Juan', 'Pérez', '1990-05-15', '1234567890', 'juan', 'password123', 'Masculino'),
('María', 'González', '1985-08-22', '0987654321', 'maria', 'password456', 'Femenino');

INSERT INTO `Usuarios` (nombre, apellido, fecha_nacimiento, telefono, usuario, contrasena, genero,tipo)
VALUES 
('roberto', 'Pérez', '1990-05-15', '1234567890', 'ana', 'password12', 'Masculino','admi');


CREATE TABLE bitacora_paciente (
    id_bitacora INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha DATE NOT NULL,
    nombre_platillo VARCHAR(255) NOT NULL,
    tipo_comida VARCHAR(50) NOT NULL,
    comentario TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE bitacora_paciente ADD COLUMN consumido ENUM('si', 'no') NOT NULL;




ALTER TABLE pacientes MODIFY nutriologos_id_nut INT(11) NULL;
ALTER TABLE menu ADD COLUMN tipo_comida VARCHAR(10) NOT NULL COMMENT 'Tipo de comida (almuerzo, comida, cena)';


