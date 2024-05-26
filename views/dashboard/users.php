<?php
require_once "./views/components/head.php";
require_once "./views/components/add-users.php"; 
?>

<div class="pt-[8rem] min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Administrar Usuarios</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Administrar Usuarios</h2>
        </div>
        <div class="container-table mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF] relative">
            <div class="mb-4">
                <button class="bg-[#1C508D] text-white px-4 py-2 rounded" id="addUser">Agregar Usuario</button>
            </div>
            <table id="usersTable" class="display w-full !mb-2">
                <thead>
                    <tr>
                        <th class="left-data">ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th class="right-data">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../Cine-Colombia/assets/DataPrueba/users.php'; 
                    foreach ($users as $user) {
                        echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['role']}</td>
                            <td class='flex items-center justify-center gap-[10px]'>
                                <button class='bg-yellow-500 text-white px-2 py-1 rounded editUser' data-id='{$user['id']}'>Editar</button>
                                <button class='bg-red-500 text-white px-2 py-1 rounded deleteUser' data-id='{$user['id']}'>Eliminar</button>
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
        $('#usersTable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            },
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            "initComplete": function() {
                $('#usersTable_filter label').contents().filter(function() {
                    return this.nodeType === 3;
                }).remove();
            }
        });

        $('#usersTable_filter input').addClass('!w-full !px-3 !py-2 !bg-[#E8F0FE] !rounded-[0.65rem] !bg-blue-100').attr('placeholder', 'Buscar...');

        $('#addUser').on('click', function() {
            $('#modalTitle').text('Agregar Usuario');
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#userModal').removeClass('hidden');
        });

        $('.editUser').on('click', function() {
            var userId = $(this).data('id');
            $('#modalTitle').text('Editar Usuario');
            $('#userId').val(userId);
            $('#userName').val('Nombre de ejemplo'); 
            $('#userEmail').val('email@ejemplo.com');
            $('#userRole').val('Admin'); 
            $('#userModal').removeClass('hidden');
        });

        $('#closeModal').on('click', function() {
            $('#userModal').addClass('hidden');
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            $('#userModal').addClass('hidden');
            alert('Usuario guardado');
        });

        $('.deleteUser').on('click', function() {
            var userId = $(this).data('id');
            if (confirm('¿Está seguro de eliminar el usuario con ID: ' + userId + '?')) {
                alert('Funcionalidad para eliminar el usuario con ID: ' + userId);
            }
        });
    });
</script>

<style>
    div.container-table {
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }
    div#usersTable_filter label {
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
    #userModal .bg-blue-600 {
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