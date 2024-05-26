<?php
require_once "./views/components/head.php";
require_once "./views/components/add-movies.php";
?>


<div class="pt-[8rem]  min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8 ">
        <div class="breadcrub-container mx auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Administrar Películas</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Administrar Películas</h2>

        </div>
        <div class="container-table mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF] relative">

            <div class="mb-4 ">
                <button class="bg-[#1C508D] text-white px-4 py-2 rounded" id="addMovie">Agregar Película</button>
            </div>
            <table id="moviesTable" class="display w-full !mb-2">
                <thead>
                    <tr>
                        <th class="left-data">ID</th>
                        <th>Título</th>
                        <th>Subtítulo</th>
                        <th>Fecha de Estreno</th>
                        <th>Género</th>
                        <th>Rating</th>
                        <th>Duración</th>
                        <th class="right-data">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../Cine-Colombia/assets/DataPrueba/Movies.php';
                    foreach ($movies as $movie) {
                        echo "<tr>
                            <td>{$movie['id']}</td>
                            <td>{$movie['title']}</td>
                            <td>{$movie['subtitle']}</td>
                            <td>{$movie['release_date']}</td>
                            <td>{$movie['genre']}</td>
                            <td>{$movie['rating']}</td>
                            <td>{$movie['duration']}</td>
                            <td class='flex items-center justify-center gap-[10px]'>
                                <button class='bg-yellow-500 text-white px-2 py-1 rounded editMovie' data-id='{$movie['id']}'>Editar</button>
                                <button class='bg-red-500 text-white px-2 py-1 rounded deleteMovie' data-id='{$movie['id']}'>Eliminar</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#moviesTable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "initComplete": function() {
                $('#moviesTable_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
            }
        });

        $('#moviesTable_filter input').addClass('!w-full !px-3 !py-2 !bg-[#E8F0FE] !rounded-[0.65rem] !bg-blue-100').attr('placeholder', 'Buscar...');


        $('#addMovie').on('click', function() {
            $('#modalTitle').text('Agregar Película');
            $('#movieForm')[0].reset();
            $('#movieId').val('');
            $('#movieModal').removeClass('hidden');
        });

        $('.editMovie').on('click', function() {
            var movieId = $(this).data('id');
            $('#modalTitle').text('Editar Película');
            $('#movieId').val(movieId);
            $('#movieTitle').val('Título de ejemplo');
            $('#movieModal').removeClass('hidden');
        });

        $('#closeModal').on('click', function() {
            $('#movieModal').addClass('hidden');
        });

        $('#movieForm').on('submit', function(e) {
            e.preventDefault();
            $('#movieModal').addClass('hidden');
            alert('Película guardada');
        });

        $('.deleteMovie').on('click', function() {
            var movieId = $(this).data('id');
            if (confirm('¿Está seguro de eliminar la película con ID: ' + movieId + '?')) {
                alert('Funcionalidad para eliminar la película con ID: ' + movieId);
            }
        });
    });
</script>

<style>
   
   div.container-table{
    border-bottom-left-radius: 2rem;
    border-bottom-right-radius: 2rem;
   }
    div#moviesTable_filter label {
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

    #movieModal .bg-blue-600 {
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