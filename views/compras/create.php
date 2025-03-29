<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nueva Compra</h1>
    <a href="<?php echo BASE_URL; ?>Compra" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Ha ocurrido un error en la operación
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="proveedor_search">Proveedor</label>
                            <input type="text" id="proveedor_search" class="form-control search-input" placeholder="Buscar proveedor...">
                            <input type="hidden" id="id_proveedor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="producto_search">Producto</label>
                            <input type="text" id="producto_search" class="form-control search-input" placeholder="Buscar producto...">
                            <input type="hidden" id="id_producto">
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="producto_detalle">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input id="descripcion" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Stock Actual</label>
                            <input id="stock" class="form-control" type="text" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Precio de Compra</label>
                            <input id="precio" class="form-control" type="number" min="0.01" step="0.01" value="0.00">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input id="cantidad" class="form-control" type="number" min="1" value="1">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Acción</label><br>
                            <button id="btn_agregar" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="table_detalle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="detalle_compra">
                        </tbody>
                        <tfoot>
                            <tr class="font-weight-bold">
                                <td colspan="4" class="text-right">TOTAL</td>
                                <td id="total">0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-end mt-3">
    <div class="col-md-4">
        <div class="form-group">
            <button id="btn_generar_compra" class="btn btn-primary btn-block">Registrar Compra</button>
        </div>
    </div>
</div>

<script>
    // Inicializar la variable global para productos agregados
    window.productosAgregados = [];
    
    // Función para eliminar un producto (declarada en ámbito global)
    function eliminarProducto(index) {
        console.log("Eliminando producto en índice:", index);
        
        // Acceder a la variable global y eliminar el elemento
        window.productosAgregados.splice(index, 1);
        
        // Actualizar la tabla después de eliminar
        window.actualizarTabla();
    }

    $(document).ready(function() {
        let total = 0.00;
        
        // Inicializar autocompletado para productos
        $('#producto_search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>Producto/buscarPorNombre',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#producto_search').val(ui.item.label);
                mostrarDetallesProducto(ui.item.id);
            }
        });
        
        // Inicializar autocompletado para proveedores
        $('#proveedor_search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo BASE_URL; ?>Proveedor/buscarPorNombre',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#proveedor_search').val(ui.item.label);
                $('#id_proveedor').val(ui.item.id);
            }
        });
        
        // Función para mostrar detalles del producto seleccionado
        function mostrarDetallesProducto(id) {
            $.ajax({
                url: '<?php echo BASE_URL; ?>Producto/obtenerPorId',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#producto_detalle').removeClass('d-none');
                        $('#descripcion').val(data.descripcion);
                        $('#stock').val(data.existencia);
                        // En compras, el precio no viene predefinido
                        $('#precio').val('');
                        $('#cantidad').val(1);
                        $('#id_producto').val(data.id);
                        console.log("ID del producto:", data.id); // Agregamos log para depuración
                        $('#precio').focus();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener producto:", error);
                    console.log("Respuesta del servidor:", xhr.responseText); // Agregamos log para ver la respuesta completa
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al obtener detalles del producto'
                    });
                }
            });
        }
        
        // Agregar producto a la tabla
        $('#btn_agregar').click(function(e) {
            e.preventDefault();
            agregarProducto();
        });
        
        // Capturar tecla Enter en cantidad
        $('#cantidad').keyup(function(e) {
            if(e.keyCode === 13) {
                agregarProducto();
            }
        });
        
        // Capturar tecla Enter en precio
        $('#precio').keyup(function(e) {
            if(e.keyCode === 13) {
                agregarProducto();
            }
        });
        
        function agregarProducto() {
            const id = $('#id_producto').val();
            const descripcion = $('#descripcion').val();
            const cantidad = parseInt($('#cantidad').val());
            const precio = parseFloat($('#precio').val());
            
            console.log("Agregando producto - ID:", id, "Descripción:", descripcion);
            
            if (id === '' || descripcion === '' || isNaN(cantidad) || isNaN(precio)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Todos los campos son obligatorios'
                });
                return;
            }
            
            if (cantidad <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La cantidad debe ser mayor a cero'
                });
                return;
            }
            
            if (precio <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El precio debe ser mayor a cero'
                });
                return;
            }
            
            // Verificar si el producto ya está en la tabla
            const existeProducto = window.productosAgregados.findIndex(item => item.id === id);
            
            console.log("Existe producto:", existeProducto >= 0, "Array productos:", window.productosAgregados);
            
            if (existeProducto >= 0) {
                // Actualizar cantidad y precio
                window.productosAgregados[existeProducto].cantidad = cantidad;
                window.productosAgregados[existeProducto].precio = precio;
                window.productosAgregados[existeProducto].subtotal = cantidad * precio;
            } else {
                // Agregar nuevo producto
                const subtotal = cantidad * precio;
                window.productosAgregados.push({
                    id: id,
                    descripcion: descripcion,
                    cantidad: cantidad,
                    precio: precio,
                    subtotal: subtotal
                });
            }
            
            // Actualizar la tabla y el total
            actualizarTabla();
            
            // Limpiar campos y preparar para siguiente producto
            $('#producto_search').val('');
            $('#id_producto').val('');
            $('#producto_detalle').addClass('d-none');
            $('#producto_search').focus();
        }
        
        // Hacemos actualizarTabla accesible globalmente
        window.actualizarTabla = function() {
            let html = '';
            let suma = 0;
            
            console.log("Actualizando tabla con productos:", window.productosAgregados);
            
            window.productosAgregados.forEach((item, index) => {
                html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.descripcion}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio.toFixed(2)}</td>
                        <td>${item.subtotal.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="eliminarProducto(${index})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                suma += item.subtotal;
            });
            
            console.log("HTML generado:", html);
            
            $('#detalle_compra').html(html);
            $('#total').text(suma.toFixed(2));
            total = suma;
        };
        
        // Generar compra
        $('#btn_generar_compra').click(function() {
            const id_proveedor = $('#id_proveedor').val();
            
            if (id_proveedor === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debe seleccionar un proveedor'
                });
                return;
            }
            
            if (window.productosAgregados.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debe agregar al menos un producto'
                });
                return;
            }
            
            // Preparar datos para enviar
            const data = {
                id_proveedor: id_proveedor,
                total: total,
                productos: window.productosAgregados
            };
            
            // Enviar datos al servidor
            $.ajax({
                url: '<?php echo BASE_URL; ?>Compra/store',
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Compra registrada correctamente',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?php echo BASE_URL; ?>Compra';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Ha ocurrido un error al registrar la compra'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error en la comunicación con el servidor'
                    });
                }
            });
        });
    });
</script>

<?php require_once 'views/layouts/footer.php'; ?> 