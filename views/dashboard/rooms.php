<?php
require_once "./views/components/head.php";
require_once "./views/components/add-rooms.php";
?>

<div class="pt-[8rem] min-h-screen">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Administrar Salas</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Administrar Salas</h2>
        </div>
        <div class="container-table mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF] relative">
            <div class="mb-4">
                <button class="bg-[#1C508D] text-white px-4 py-2 rounded" id="addRoom">Agregar Sala</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                foreach ($this->rooms as $room) {
                    echo "<div class='bg-white shadow-md rounded-lg overflow-hidden p-4'>
                        <h3 class='text-lg font-bold mb-2'>{$room['nombre_sala']}</h3>
                        <p class='text-gray-600 mb-2'>Capacidad: {$room['capacidad']}</p>
                        <p class='text-gray-600 mb-2'>Cantidad Preferencial: {$room['cant_prefe']}</p>
                        <p class='text-gray-600 mb-2'>Cantidad General: {$room['cant_gen']}</p>
                        <p class='text-gray-600 mb-2'>Tipo: {$room['tipo_sala']}</p>
                        <div class='flex items-center justify-center gap-2'>
                            <button class='bg-yellow-500 text-white px-4 py-2 rounded editRoom' data-id='{$room['idsala']}'>Editar</button>
                            <button class='bg-red-500 text-white px-4 py-2 rounded deleteRoom' data-id='{$room['idsala']}'>Eliminar</button>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#addRoom').on('click', function() {
            $('#modalTitle').text('Agregar Sala');
            $('#roomForm')[0].reset();
            $('#roomId').val('');
            $('#roomModal').removeClass('hidden');
        });

        $('.editRoom').on('click', function() {
            var roomId = $(this).data('id');
            $.ajax({
                url: '/Cine-Colombia/dashboard/getRoom/' + roomId,
                method: 'GET',
                success: function(data) {
                    var room = JSON.parse(data);
                    $('#modalTitle').text('Editar Sala');
                    $('#roomId').val(room.idsala);
                    $('#roomName').val(room.nombre_sala);
                    $('#roomCapacity').val(room.capacidad);
                    $('#roomType').val(room.tipo_sala);
                    $('#roomPreferential').prop('checked', room.preferencial);
                    $('#roomModal').removeClass('hidden');
                }
            });
        });

        $('#closeModal').on('click', function() {
            $('#roomModal').addClass('hidden');
        });

        $('#roomForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var url = $('#roomId').val() ? '/Cine-Colombia/dashboard/updateRoom' : '/Cine-Colombia/dashboard/createRoom';
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
                            text: 'Hubo un problema al realizar la operación'
                        });
                    }
                }
            });
        });

        $('.deleteRoom').on('click', function() {
            var roomId = $(this).data('id');
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
                        url: '/Cine-Colombia/dashboard/deleteRoom/' + roomId,
                        method: 'GET',
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire(
                                    'Eliminado!',
                                    'La sala ha sido eliminada.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un problema al eliminar la sala'
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

    #roomModal .bg-blue-600 {
        background-color: #1C508D;
    }
</style>
<?php
require_once "./views/components/footer.php";
?>