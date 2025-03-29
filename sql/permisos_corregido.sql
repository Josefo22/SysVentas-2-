-- Revisar la estructura de la tabla permisos
DESCRIBE permisos;

-- Insertar permisos básicos del sistema (sin columna 'descripcion') usando INSERT IGNORE
-- para evitar errores de duplicación en clave primaria
INSERT IGNORE INTO `permisos` (`id`, `nombre`) VALUES
(1, 'configuracion'),
(2, 'usuarios'),
(3, 'clientes'),
(4, 'productos'),
(5, 'ventas'),
(6, 'nueva_venta'),
(7, 'compras'),
(8, 'nueva_compra'),
(9, 'proveedores'),
(10, 'caja'),
(11, 'dashboard'),
(12, 'crear_usuario'),
(13, 'editar_usuario'),
(14, 'eliminar_usuario'),
(15, 'crear_cliente'),
(16, 'editar_cliente'),
(17, 'eliminar_cliente'),
(18, 'crear_producto'),
(19, 'editar_producto'),
(20, 'eliminar_producto'),
(21, 'ver_historial_ventas'),
(22, 'anular_venta'),
(23, 'ver_historial_compras'),
(24, 'anular_compra'),
(25, 'crear_proveedor'),
(26, 'editar_proveedor'),
(27, 'eliminar_proveedor'),
(28, 'abrir_caja'),
(29, 'cerrar_caja'),
(30, 'ver_historial_caja'),
(31, 'crear_rol'),
(32, 'editar_rol'),
(33, 'eliminar_rol'),
(34, 'permisos_rol');

-- Asignar todos los permisos al rol de Administrador (id=1)
-- Usamos IGNORE para evitar duplicados
INSERT IGNORE INTO `detalle_permisos` (`id_permiso`, `id_rol`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1);

-- Asignar permisos básicos al rol de Vendedor (id=2)
-- Usamos IGNORE para evitar duplicados
INSERT IGNORE INTO `detalle_permisos` (`id_permiso`, `id_rol`) VALUES
(3, 2),  -- clientes
(4, 2),  -- productos
(5, 2),  -- ventas
(6, 2),  -- nueva_venta
(10, 2), -- caja
(11, 2), -- dashboard
(15, 2), -- crear_cliente
(16, 2), -- editar_cliente
(21, 2), -- ver_historial_ventas
(28, 2), -- abrir_caja
(29, 2), -- cerrar_caja
(30, 2); -- ver_historial_caja 