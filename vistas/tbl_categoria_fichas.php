<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_categoria_fichas.php';
 $_SESSION['content-wrapper'] = 'content-wrapper';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/estilos.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Categoría Ficha</h1>
            <br>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Crear
            </a>
        </div>

        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar ..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>

     <!--  descargar excel -->
     <div class="center-vertical">
            </div>
            <!--  fin de descargar -->

             <!-- descargar PDF-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

            <script>
                document.getElementById("pdfButton").addEventListener("click", function() {
                    // Código para generar el PDF usando jsPDF
                    const pdf = new jsPDF();
                    pdf.text("Contenido del PDF", 10, 10);
                    pdf.save("documento.pdf");
                });
            </script>
             <!--  fin de descargar PDF-->

                 <!-- descargar EXCEL -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.8/xlsx.full.min.js"></script>

                <script>
                    document.getElementById("excelButton").addEventListener("click", function() {
                        // Código para generar el archivo Excel usando SheetJS
                        const data = [
                            ["Nombre", "Edad"],
                            ["Juan", 30],
                            ["María", 25],
                            ["Pedro", 28]
                        ];
                        const ws = XLSX.utils.aoa_to_sheet(data);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
                        XLSX.writeFile(wb, "datos.xlsx");
                    });
                </script>

                  <!-- Fin descargar EXCEL-->



    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="table-dark text-center" style="background-color: #343A40;">
                <tr>
                    <th scope="col">Id Categoria Ficha</th>
                    <th scope="col">Id Sector</th>
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Categoria Ficha</th>
                    <th scope="col">Codigo Categoria Ficha</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Hoja</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Formula</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Estado</th>

                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_categorias_fichas.id_categoria_ficha, tbl_sector.sector, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_categorias_fichas.codigo_categoriaficha, tbl_categorias_fichas.descripcion, tbl_categorias_fichas.hoja, tbl_categorias_fichas.referencia, tbl_categorias_fichas.formula, tbl_categorias_fichas.creado_por, tbl_categorias_fichas.fecha_creacion, tbl_categorias_fichas.actualizado_por, tbl_categorias_fichas.fecha_actualizacion, tbl_categorias_fichas.estado 
                FROM tbl_categorias_fichas INNER JOIN tbl_sector ON tbl_categorias_fichas.id_sector = tbl_sector.id_sector  INNER JOIN tbl_fichas ON tbl_categorias_fichas.id_ficha = tbl_fichas.id_ficha");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_categoria_ficha ?></td>
                        <td><?= $datos->sector ?></td>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->categoria_ficha?></td>
                        <td><?= $datos->codigo_categoriaficha?></td>
                        <td><?= $datos->descripcion ?></td>
                        <td><?= $datos->hoja?></td>
                        <td><?= $datos->referencia ?></td>
                        <td><?= $datos->formula?></td>
                        <td><?= $datos->creado_por?></td>
                        <td><?= $datos->fecha_creacion?></td>
                        <td><?= $datos->actualizado_por?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_categoria_ficha ?>', '<?= $datos->sector ?>', '<?= $datos->descripcion ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->codigo_categoriaficha ?>', '<?= $datos->descripcion ?>', '<?= $datos->hoja ?>', '<?= $datos->referencia ?>', '<?= $datos->formula ?>', '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>', '<?= $datos->fecha_actualizacion ?>', '<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_categoriaFichas.php" style="display: inline;">
                                <input type="hidden" name="id_categoria_ficha" value="<?= $datos->id_categoria_ficha ?>">
                                <button type="submit" class="btn btn-eliminar">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link">Anterior</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal para editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">EDITAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioEditar" method="POST" action="modelos/update_categoriaFichas.php">
                    <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="id_categoria_ficha">Id Categoria Ficha:</label>
                              <input type="text" class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" readonly>
                          </div>
                            <div class="form-group">
                                <label for="id_sector">Id Sector</label>
                                <select class="form-control" id="id_sector_edit" name="id_sector" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_sector, sector FROM tbl_sector";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
 </div>
</div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_ficha">Id Ficha</label>
                                <select class="form-control" id="id_ficha_edit" name="id_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_ficha, id_ficha FROM tbl_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="categoria_ficha">Categoria Ficha:</label>
                            <input type="text" class="form-control" id="categoria_ficha_edit" name="categoria_ficha" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="codigo_categoriaficha">Codigo Categoria Ficha:</label>
                            <input type="text" class="form-control" id="codigo_categoriaficha_edit" name="codigo_categoriaficha" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion_edit" name="descripcion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="hoja">Hoja:</label>
                            <input type="text" class="form-control" id="hoja_edit" name="hoja" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="referencia">Referencia:</label>
                            <input type="text" class="form-control" id="referencia_edit" name="referencia" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="formula">Formula:</label>
                            <input type="text" class="form-control" id="formula_edit" name="formula" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="actualizarBtn">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" role="document">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">Crear</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modelos/insert_categoriaFichas.php" method="POST">
                <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_sector">Id Sector</label>
                                <select class="form-control" id="id_sector_edit" name="id_sector" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_sector, sector FROM tbl_sector";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
 </div>
</div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_ficha">Id Ficha</label>
                                <select class="form-control" id="id_ficha_edit" name="id_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_ficha, id_ficha FROM tbl_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="categoria_ficha">Categoria Ficha:</label>
                            <input type="text" class="form-control" id="categoria_ficha_edit" name="categoria_ficha" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="codigo_categoriaficha">Codigo Categoria Ficha:</label>
                            <input type="text" class="form-control" id="codigo_categoriaficha_edit" name="codigo_categoriaficha" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion_edit" name="descripcion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="hoja">Hoja:</label>
                            <input type="text" class="form-control" id="hoja_edit" name="hoja" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="referencia">Referencia:</label>
                            <input type="text" class="form-control" id="referencia_edit" name="referencia" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="formula">Formula:</label>
                            <input type="text" class="form-control" id="formula_edit" name="formula" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success" name="btnnuevo" value="ok">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_categoria_ficha, id_sector, id_ficha, categoria_ficha, codigo_categoriaficha, descripcion, hoja, referencia, formula, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, estado) {
        document.getElementById("id_categoria_ficha").value = id_categoria_ficha; 
        document.getElementById("id_sector_edit").value = id_sector;
        document.getElementById("id_ficha_edit").value = id_ficha;
        document.getElementById("categoria_ficha_edit").value = categoria_ficha;
        document.getElementById("codigo_categoriaficha_edit").value = codigo_categoriaficha;
        document.getElementById("descripcion_edit").value = descripcion;
        document.getElementById("hoja_edit").value = hoja;
        document.getElementById("referencia_edit").value = referencia;
        document.getElementById("formula_edit").value = formula;
        document.getElementById("creado_por").value = creado_por;
        document.getElementById("fecha_creacion").value = fecha_creacion;
        document.getElementById("actualizado_por").value = actualizado_por;
        document.getElementById("fecha_actualizacion").value = fecha_actualizacion;
        document.getElementById("estado_edit").value = estado;


        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>


<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos/update_categoriaFichas.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                            title: "Registro actualizado correctamente",
                            text: "El Registro se ha actualizado correctamente.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            $("#modalEditar").modal("hide");
                            location.reload(); // Recarga la página
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Hubo un problema al actualizar el registro.",
                            icon: "error",
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            location.reload(); // Recarga la página
                        });
                    }
                }
            });
        });
    });
</script>

<!-- Script para mostrar el mensaje al momento de eliminar un usuario-->
<script>
    $(document).ready(function() {
        $("form#deleteForm").on("submit", function(event) {
            event.preventDefault();

            var form = $(this);

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará el periodo. Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr("action"),
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            if (response == "success") {
                                Swal.fire({
                                    title: "Registro eliminado correctamente",
                                    text: "El Registro se ha eliminado correctamente.",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Hubo un problema al eliminar el Registro.",
                                    icon: "error",
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "lengthChange": false,
            "pageLength": 10
        });
    });
</script>