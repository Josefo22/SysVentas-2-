-- Crear tabla de roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar roles básicos
INSERT INTO `roles` (`nombre`, `descripcion`, `estado`) VALUES
('Administrador', 'Acceso total al sistema', 1),
('Vendedor', 'Acceso a ventas y consultas básicas', 1),
('Almacenista', 'Gestión de inventario y productos', 1);

-- Agregar campo de rol a la tabla de usuarios
ALTER TABLE `usuario` ADD COLUMN `id_rol` int(11) DEFAULT NULL AFTER `clave`;

-- Agregar relación con la tabla roles
ALTER TABLE `usuario` ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

-- Actualizar usuario administrador con el rol de administrador
UPDATE `usuario` SET `id_rol` = 1 WHERE `idusuario` = 1;

-- Crear tabla para definir permisos específicos por rol
CREATE TABLE IF NOT EXISTS `rol_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `fk_rolpermisos_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rolpermisos_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Asignar todos los permisos existentes al rol de administrador
INSERT INTO `rol_permisos` (`id_rol`, `id_permiso`)
SELECT 1, id FROM `permisos`;

-- Permisos básicos para el rol de vendedor
INSERT INTO `rol_permisos` (`id_rol`, `id_permiso`)
SELECT 2, id FROM `permisos` WHERE `nombre` IN ('ventas', 'nueva_venta', 'clientes');

-- Permisos básicos para el rol de almacenista
INSERT INTO `rol_permisos` (`id_rol`, `id_permiso`)
SELECT 3, id FROM `permisos` WHERE `nombre` IN ('productos', 'configuración'); 