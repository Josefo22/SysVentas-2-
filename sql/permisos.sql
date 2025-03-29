-- Insertar permisos básicos del sistema
INSERT INTO `permisos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'configuracion', 'Acceso al módulo de configuración'),
(2, 'usuarios', 'Acceso al módulo de usuarios'),
(3, 'clientes', 'Acceso al módulo de clientes'),
(4, 'productos', 'Acceso al módulo de productos'),
(5, 'ventas', 'Acceso al módulo de ventas'),
(6, 'nueva_venta', 'Crear nuevas ventas'),
(7, 'compras', 'Acceso al módulo de compras'),
(8, 'nueva_compra', 'Crear nuevas compras'),
(9, 'proveedores', 'Acceso al módulo de proveedores'),
(10, 'caja', 'Acceso al módulo de caja'),
(11, 'dashboard', 'Acceso al panel de control'),
(12, 'crear_usuario', 'Crear nuevos usuarios'),
(13, 'editar_usuario', 'Editar usuarios existentes'),
(14, 'eliminar_usuario', 'Eliminar usuarios'),
(15, 'crear_cliente', 'Crear nuevos clientes'),
(16, 'editar_cliente', 'Editar clientes existentes'),
(17, 'eliminar_cliente', 'Eliminar clientes'),
(18, 'crear_producto', 'Crear nuevos productos'),
(19, 'editar_producto', 'Editar productos existentes'),
(20, 'eliminar_producto', 'Eliminar productos'),
(21, 'ver_historial_ventas', 'Ver historial de ventas'),
(22, 'anular_venta', 'Anular ventas'),
(23, 'ver_historial_compras', 'Ver historial de compras'),
(24, 'anular_compra', 'Anular compras'),
(25, 'crear_proveedor', 'Crear nuevos proveedores'),
(26, 'editar_proveedor', 'Editar proveedores existentes'),
(27, 'eliminar_proveedor', 'Eliminar proveedores'),
(28, 'abrir_caja', 'Abrir caja'),
(29, 'cerrar_caja', 'Cerrar caja'),
(30, 'ver_historial_caja', 'Ver historial de caja'),
(31, 'crear_rol', 'Crear nuevos roles'),
(32, 'editar_rol', 'Editar roles existentes'),
(33, 'eliminar_rol', 'Eliminar o cambiar estado de roles'),
(34, 'permisos_rol', 'Gestionar permisos de roles');

-- Asignar todos los permisos al rol de Administrador (id=1)
INSERT INTO `detalle_permisos` (`id`, `id_permiso`, `id_rol`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 1),
(31, 31, 1),
(32, 32, 1),
(33, 33, 1),
(34, 34, 1);

-- Asignar permisos básicos al rol de Vendedor (id=2)
INSERT INTO `detalle_permisos` (`id_permiso`, `id_rol`) VALUES
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