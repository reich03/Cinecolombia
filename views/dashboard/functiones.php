<?php
require_once "./views/components/head.php";
require_once "./views/components/add-functions.php";
?>


<div class="pt-[8rem] min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Administrar Funciones</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Administrar Funciones</h2>
        </div>
        <div class="container-table mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF] relative">
            <div class="mb-4">
                <button class="bg-[#1C508D] text-white px-4 py-2 rounded" id="addFunction">Agregar Función</button>
            </div>
            <table id="functionsTable" class="display w-full !mb-2">
                <thead>
                    <tr>
                        <th class="left-data">ID</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Fecha</th>
                        <th>Película</th>
                        <th>Sala</th>
                        <th class="right-data">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->functions as $function) : ?>
                        <tr>
                            <td><?= $function['idfuncion'] ?></td>
                            <td><?= $function['hora_inicio'] ?></td>
                            <td><?= $function['hora_fin'] ?></td>
                            <td><?= $function['fecha'] ?></td>
                            <td><?= $function['idpeliculas'] ?></td>
                            <td><?= $function['idsala'] ?></td>
                            <td class='flex items-center justify-center gap-[10px]'>
                                <button class='bg-yellow-500 text-white px-2 py-1 rounded editFunction' data-id='<?= $function['idfuncion'] ?>'>Editar</button>
                                <button class='bg-red-500 text-white px-2 py-1 rounded deleteFunction' data-id='<?= $function['idfuncion'] ?>'>Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#functionsTable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "initComplete": function() {
                $('#functionsTable_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
            }
        });

        $('#functionsTable_filter input').addClass('!w-full !px-3 !py-2 !bg-[#E8F0FE] !rounded-[0.65rem] !bg-blue-100').attr('placeholder', 'Buscar...');

        $('#addFunction').on('click', function() {
            $('#modalTitle').text('Agregar Función');
            $('#functionForm')[0].reset();
            $('#functionId').val('');
            $('#functionModal').removeClass('hidden');
        });

        $('.editFunction').on('click', function() {
            var functionId = $(this).data('id');
            $.ajax({
                url: '/Cine-Colombia/dashboard/getFunction/' + functionId,
                method: 'GET',
                success: function(data) {
                    var func = JSON.parse(data);
                    $('#modalTitle').text('Editar Función');
                    $('#functionId').val(func.idfuncion);
                    $('#functionStartTime').val(func.hora_inicio);
                    $('#functionEndTime').val(func.hora_fin);
                    $('#functionDate').val(func.fecha);
                    $('#functionMovie').val(func.idpeliculas);
                    $('#functionRoom').val(func.idsala);
                    $('#functionModal').removeClass('hidden');
                }
            });
        });

        $('#closeModal').on('click', function() {
            $('#functionModal').addClass('hidden');
        });

        $('#functionForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $('#functionId').val() ? '/Cine-Colombia/dashboard/updateFunction' : '/Cine-Colombia/dashboard/createFunction';
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'La operación se ha realizado con éxito'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'Hubo un problema al realizar la operación'
                        });
                    }
                }
            });
        });

        $('.deleteFunction').on('click', function() {
            var functionId = $(this).data('id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás revertir esta acción!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/Cine-Colombia/dashboard/deleteFunction/' + functionId,
                        method: 'GET',
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire(
                                    'Eliminado!',
                                    'La función ha sido eliminada.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al eliminar la función'
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<style>
    div.container-table {
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }

    div#functionsTable_filter label {
        display: block !important;
        padding-bottom: 1rem !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
    }

    table.dataTable thead th {
        background-color: #1C508D;
        color: white;
    }

    table.dataTable tbody tr:nth-child(even) {
        background-color: #F5F9FF;
    }

    table.dataTable tbody tr:nth-child(odd) {
        background-color: #FFFFFF;
    }

    table.dataTable tbody tr:hover {
        background-color: #E8F0FE;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #1C508D;
        color: white !important;
        border-radius: 0.25rem;
        margin: 0 0.25rem;
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #003366;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #003366;
    }

    #functionModal .bg-blue-600 {
        background-color: #1C508D;
    }

    th.left-data {
        border-top-left-radius: 10px;
    }

    th.right-data {
        border-top-right-radius: 10px;
    }
</style>
<?php
require_once "./views/components/footer.php";
?>