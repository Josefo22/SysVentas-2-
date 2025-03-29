-- Script para agregar permisos de forma incremental sin duplicar IDs

-- Insertar nombres de permisos sin especificar IDs (dejar que MySQL asigne autoincrement)
-- Primero crear una tabla temporal con los permisos que queremos
CREATE TEMPORARY TABLE temp_permisos (
    nombre VARCHAR(50) NOT NULL
);

-- Insertar todos los nombres de permisos que queremos tener
INSERT INTO temp_permisos (nombre) VALUES
('configuracion'),
('usuarios'),
('clientes'),
('productos'),
('ventas'),
('nueva_venta'),
('compras'),
('nueva_compra'),
('proveedores'),
('caja'),
('dashboard'),
('crear_usuario'),
('editar_usuario'),
('eliminar_usuario'),
('crear_cliente'),
('editar_cliente'),
('eliminar_cliente'),
('crear_producto'),
('editar_producto'),
('eliminar_producto'),
('ver_historial_ventas'),
('anular_venta'),
('ver_historial_compras'),
('anular_compra'),
('crear_proveedor'),
('editar_proveedor'),
('eliminar_proveedor'),
('abrir_caja'),
('cerrar_caja'),
('ver_historial_caja'),
('crear_rol'),
('editar_rol'),
('eliminar_rol'),
('permisos_rol');

-- Insertar solo los permisos que no existen aún
INSERT INTO permisos (nombre)
SELECT t.nombre FROM temp_permisos t
LEFT JOIN permisos p ON t.nombre = p.nombre
WHERE p.id IS NULL;

-- Limpiar tabla temporal
DROP TEMPORARY TABLE IF EXISTS temp_permisos;

-- Ahora asignar todos los permisos al rol de Administrador (id=1)
-- Primero obtener los IDs de los permisos
INSERT IGNORE INTO detalle_permisos (id_permiso, id_rol)
SELECT p.id, 1 FROM permisos p
LEFT JOIN detalle_permisos dp ON dp.id_permiso = p.id AND dp.id_rol = 1
WHERE dp.id_permiso IS NULL;

-- Asignar permisos básicos al rol de Vendedor (id=2)
-- Primero crear una tabla temporal con los nombres de permisos para vendedores
CREATE TEMPORARY TABLE temp_permisos_vendedor (
    nombre VARCHAR(50) NOT NULL
);

-- Insertar los nombres de permisos para vendedores
INSERT INTO temp_permisos_vendedor (nombre) VALUES
('clientes'),       -- 3
('productos'),      -- 4
('ventas'),         -- 5
('nueva_venta'),    -- 6
('caja'),           -- 10
('dashboard'),      -- 11
('crear_cliente'),  -- 15
('editar_cliente'), -- 16
('ver_historial_ventas'), -- 21
('abrir_caja'),     -- 28
('cerrar_caja'),    -- 29
('ver_historial_caja'); -- 30

-- Insertar solo los permisos que no están ya asignados
INSERT IGNORE INTO detalle_permisos (id_permiso, id_rol)
SELECT p.id, 2 FROM permisos p
JOIN temp_permisos_vendedor tpv ON p.nombre = tpv.nombre
LEFT JOIN detalle_permisos dp ON dp.id_permiso = p.id AND dp.id_rol = 2
WHERE dp.id_permiso IS NULL;

-- Limpiar tabla temporal
DROP TEMPORARY TABLE IF EXISTS temp_permisos_vendedor; 