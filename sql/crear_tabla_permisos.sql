-- Script para crear la tabla de permisos si no existe
-- o verificar su estructura

-- Crear tabla de permisos si no existe
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_unique` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Verificar si existe la tabla detalle_permisos, y crearla si no existe
CREATE TABLE IF NOT EXISTS `detalle_permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permiso_rol_unique` (`id_permiso`, `id_rol`),
  KEY `id_permiso` (`id_permiso`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `fk_detalle_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_detalle_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 