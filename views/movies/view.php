<?php
require_once "./views/components/head.php";
?>

<div class="pt-[8rem] mx-auto container bg-contain bg-no-repeat bg-center h-[48rem]" style="background-image: url('<?= $this->movie['background'] ?>');">
    <main class="flex-grow mx-auto container bg-white bg-opacity-90 p-6">
        <article class="w-full pb-[4rem]">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3 flex-shrink-0">
                    <img src="<?= $this->movie['img'] ?>" alt="<?= $this->movie['title'] ?>" class="w-full h-[40rem] object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:w-2/3 md:ml-6 mt-4 md:mt-0">
                    <div class="flex flex-wrap space-x-4 items-start flex-col top-[64%] relative">
                        <h3 class="text-3xl font-bold text-[#1c508d] pl-[1rem]"><?= $this->movie['title'] ?></h3>
                        <p class="text-lg text-gray-600 mb-4"><?= $this->movie['subtitle'] ?></p>
                        <p class="text-gray-700 mb-2"><strong>Estreno:</strong> <?= $this->movie['release_date'] ?></p>
                        <p class="text-gray-700 mb-2"><strong>Género:</strong> <?= $this->movie['genre'] ?></p>
                        <div class="flex items-center mt-[1rem] gap-2 mb-4">
                            <span class="inline-block bg-red-500 text-white text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['rating'] ?></span>
                            <span class="inline-block bg-gray-300 text-black text-xs rounded-xs py-[.3125rem] px-[.625rem]"><?= $this->movie['duration'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</div>

<div class="mx-auto container px-6 py-3 pt-[5.75rem]">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 md:col-span-1">
            <p class="text-gray-600 mb-6"><?= $this->movie['description'] ?></p>
            <h3 class="text-xl font-bold text-[#1c508d]">Titulo Original</h3>
            <h3 class="text-md font-semiBold text-black mb-2"><?= $this->movie['title'] ?></h3>
            <p class="text-[#1c508d] text-[16px] font-Bold mb-2">Director:</p>
            <p class="text-gray-700 mb-2">Jesus Reyes</p>
            <p class="text-[#1c508d] text-[16px] font-Bold mb-2">Actores:</p>
            <p class="text-gray-700 mb-2">Jhojan grisales, cristian rojas, camilo suat, angel rusinque</p>
        </div>
        <div class="col-span-1 md:col-span-2">
            <div id="funciones-container">
                <h4 class="text-xl font-bold text-[#1c508d] mb-2">Funciones</h4>
                <div>
                    <?php
                    $fechas = [];
                    foreach ($this->funciones as $funcion) {
                        $fechas[$funcion['fecha']][] = $funcion;
                    }

                    $fechaMasCercana = min(array_keys($fechas));
                    ?>
                    <div class="flex items-center space-x-2 mb-4">
                        <?php foreach (array_keys($fechas) as $fecha) : ?>
                            <button class="fecha-btn <?= $fecha === $fechaMasCercana ? 'bg-[#1E3A8A] text-white' : 'bg-gray-200 text-black' ?> px-6 py-2 rounded-lg border border-gray-300 shadow-sm hover:bg-[#1E3A8A] hover:text-white transition" data-fecha="<?= $fecha ?>">
                                <span class="block text-center"><?= date('d', strtotime($fecha)) ?></span>
                                <span class="block text-center text-xs"><?= strtoupper(date('M', strtotime($fecha))) ?></span>
                                <span class="block text-center text-xs"><?= strtoupper(date('D', strtotime($fecha))) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach ($fechas as $fecha => $funcionesPorFecha) : ?>
                        <div class="fecha-funciones <?= $fecha === $fechaMasCercana ? '' : 'hidden' ?>" data-fecha="<?= $fecha ?>">
                            <h5 class="text-lg font-semibold text-[#1c508d] mb-2"><?= date('d M, Y', strtotime($fecha)) ?></h5>
                            <div class="mb-4">
                                <?php
                                $salas = [];
                                foreach ($funcionesPorFecha as $funcion) {
                                    $salas[$funcion['idsala']][] = $funcion;
                                }
                                ?>
                                <?php foreach ($salas as $sala => $funcionesPorSala) : ?>
                                    <div class="mb-4 border-t border-gray-300 pt-4">
                                        <h6 class="text-md font-semibold text-[#1c508d] mb-2">Sala <?= $sala ?></h6>
                                        <div class="flex flex-wrap space-x-2 mb-2">
                                            <?php foreach ($funcionesPorSala as $funcion) : ?>
                                                <button class="funcion-btn bg-white text-[#1E3A8A] px-4 py-2 rounded-full mb-2 border border-[#1E3A8A] hover:bg-[#1E3A8A] hover:text-white" data-id="<?= $funcion['idfuncion'] ?>" data-sala="<?= $sala ?>" data-hora="<?= date('h:i A', strtotime($funcion['hora_inicio'])) ?>" data-fecha="<?= $fecha ?>"> 
                                                    <?= date('h:i A', strtotime($funcion['hora_inicio'])) ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="seleccion-container" class="hidden">
                <h4 class="text-xl font-bold text-[#1c508d] mb-2">Seleccionar Asientos</h4>
                <button id="btn-volver" class="text-[#1E3A8A] mb-4"><i class="fa-solid fa-chevron-left"></i> Volver</button>
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-gray-700">Preferencial:</span>
                        <button id="btn-decrementar-preferencial" class="bg-gray-200 text-black px-4 py-2 rounded-lg border border-gray-300 shadow-sm">-</button>
                        <span id="cantidad-preferencial" class="text-gray-700">0</span>
                        <button id="btn-incrementar-preferencial" class="bg-gray-200 text-black px-4 py-2 rounded-lg border border-gray-300 shadow-sm">+</button>
                    </div>
                    <div class="flex items-center justify-center space-x-4">
                        <span class="text-gray-700">General:</span>
                        <button id="btn-decrementar-general" class="bg-gray-200 text-black px-4 py-2 rounded-lg border border-gray-300 shadow-sm">-</button>
                        <span id="cantidad-general" class="text-gray-700">0</span>
                        <button id="btn-incrementar-general" class="bg-gray-200 text-black px-4 py-2 rounded-lg border border-gray-300 shadow-sm">+</button>
                    </div>
                    <div>
                        <span class="text-gray-700">Total: $<span id="total">0</span></span>
                    </div>
                    <button id="btn-aceptar" class="bg-[#1E3A8A] text-white px-4 py-2 rounded-lg transition">Aceptar</button>
                </div>
            </div>

            <div id="asientos-container" class="hidden">
                <h4 class="text-xl font-bold text-[#1c508d] mb-2">Escoger Ubicación</h4>
                <button id="btn-volver-asientos" class="text-[#1E3A8A] mb-4"><i class="fa-solid fa-chevron-left"></i> Volver</button>
                <div id="screen" class="bg-gray-500 text-white text-center py-2 mb-4 rounded-md">Pantalla</div>
                <div id="seat-map" class="flex flex-col space-y-2 items-center"></div>
                <div class="flex justify-center space-x-4 mt-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gray-200 border border-gray-300 rounded-md"></div>
                        <span class="text-gray-700">Disponible</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-green-500 border border-gray-300 rounded-md"></div>
                        <span class="text-gray-700">Tus Sillas</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-red-500 border border-gray-300 rounded-md"></div>
                        <span class="text-gray-700">Ocupado</span>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button id="btn-confirmar-asientos" class="bg-[#1E3A8A] text-white px-4 py-2 rounded-lg transition mt-4">Confirmar</button>
                </div>
            </div>

            <div id="resumen-container" class="hidden">
                <h4 class="text-xl font-bold text-[#1c508d] mb-2">Resumen de Compra</h4>
                <div id="resumen-detalles" class="mb-4"></div>
                <button id="btn-finalizar" class="bg-[#1E3A8A] text-white px-4 py-2 rounded-lg transition">Finalizar</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once "./views/components/footer.php";
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/Cine-Colombia/assets/DataPrueba/getRooms.php')
            .then(response => response.json())
            .then(rooms => {
                const fechaBtns = document.querySelectorAll('.fecha-btn');
                const fechaFunciones = document.querySelectorAll('.fecha-funciones');
                const funcionBtns = document.querySelectorAll('.funcion-btn');
                const funcionesContainer = document.getElementById('funciones-container');
                const seleccionContainer = document.getElementById('seleccion-container');
                const asientosContainer = document.getElementById('asientos-container');
                const resumenContainer = document.getElementById('resumen-container');
                const btnVolver = document.getElementById('btn-volver');
                const btnVolverAsientos = document.getElementById('btn-volver-asientos');
                const btnDecrementarPreferencial = document.getElementById('btn-decrementar-preferencial');
                const btnIncrementarPreferencial = document.getElementById('btn-incrementar-preferencial');
                const cantidadPreferencialSpan = document.getElementById('cantidad-preferencial');
                const btnDecrementarGeneral = document.getElementById('btn-decrementar-general');
                const btnIncrementarGeneral = document.getElementById('btn-incrementar-general');
                const cantidadGeneralSpan = document.getElementById('cantidad-general');
                const totalSpan = document.getElementById('total');
                const btnAceptar = document.getElementById('btn-aceptar');
                const btnConfirmarAsientos = document.getElementById('btn-confirmar-asientos');
                const seatMap = document.getElementById('seat-map');
                const resumenDetalles = document.getElementById('resumen-detalles');
                const btnFinalizar = document.getElementById('btn-finalizar');

                let precioPreferencial = 20000;
                let precioGeneral = 10000;
                let cantidadPreferencial = 0;
                let cantidadGeneral = 0;
                let asientosSeleccionados = [];
                let funcionSeleccionada = {};

                fechaBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const fecha = this.getAttribute('data-fecha');

                        fechaFunciones.forEach(funcion => {
                            if (funcion.getAttribute('data-fecha') === fecha) {
                                funcion.classList.remove('hidden');
                            } else {
                                funcion.classList.add('hidden');
                            }
                        });

                        fechaBtns.forEach(button => {
                            button.classList.remove('bg-[#1E3A8A]', 'text-white');
                            button.classList.add('bg-gray-200', 'text-black');
                        });

                        this.classList.remove('bg-gray-200', 'text-black');
                        this.classList.add('bg-[#1E3A8A]', 'text-white');
                    });
                });

                funcionBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        funcionesContainer.classList.add('hidden');
                        seleccionContainer.classList.remove('hidden');
                        resetSeleccion();
                        actualizarTotal();
                        funcionSeleccionada = {
                            id: this.getAttribute('data-id'),
                            sala: this.getAttribute('data-sala'),
                            hora: this.getAttribute('data-hora'),
                            fecha: this.getAttribute('data-fecha')
                        };
                    });
                });

                btnVolver.addEventListener('click', function() {
                    seleccionContainer.classList.add('hidden');
                    funcionesContainer.classList.remove('hidden');
                    resetSeleccion();
                    actualizarTotal();
                });

                btnVolverAsientos.addEventListener('click', function() {
                    asientosContainer.classList.add('hidden');
                    seleccionContainer.classList.remove('hidden');
                    resetSeleccion();
                    actualizarTotal();
                });

                btnDecrementarPreferencial.addEventListener('click', function() {
                    if (cantidadPreferencial > 0) {
                        cantidadPreferencial--;
                        cantidadPreferencialSpan.textContent = cantidadPreferencial;
                        actualizarTotal();
                    }
                });

                btnIncrementarPreferencial.addEventListener('click', function() {
                    cantidadPreferencial++;
                    cantidadPreferencialSpan.textContent = cantidadPreferencial;
                    actualizarTotal();
                });

                btnDecrementarGeneral.addEventListener('click', function() {
                    if (cantidadGeneral > 0) {
                        cantidadGeneral--;
                        cantidadGeneralSpan.textContent = cantidadGeneral;
                        actualizarTotal();
                    }
                });

                btnIncrementarGeneral.addEventListener('click', function() {
                    cantidadGeneral++;
                    cantidadGeneralSpan.textContent = cantidadGeneral;
                    actualizarTotal();
                });

                btnAceptar.addEventListener('click', function() {
                    seleccionContainer.classList.add('hidden');
                    asientosContainer.classList.remove('hidden');
                    generarMapaDeAsientos();
                });

                btnConfirmarAsientos.addEventListener('click', function() {
                    resumenContainer.classList.remove('hidden');
                    asientosContainer.classList.add('hidden');
                    mostrarResumen();
                });

                btnFinalizar.addEventListener('click', function() {
                    imprimirResumen();
                });

                function resetSeleccion() {
                    cantidadPreferencial = 0;
                    cantidadGeneral = 0;
                    cantidadPreferencialSpan.textContent = 0;
                    cantidadGeneralSpan.textContent = 0;
                    btnDecrementarPreferencial.disabled = false;
                    btnIncrementarPreferencial.disabled = false;
                    btnDecrementarGeneral.disabled = false;
                    btnIncrementarGeneral.disabled = false;
                }

                function actualizarTotal() {
                    let total = (cantidadPreferencial * precioPreferencial) + (cantidadGeneral * precioGeneral);
                    totalSpan.textContent = total.toLocaleString('es-CO');

                    if (cantidadPreferencial > 0) {
                        btnDecrementarGeneral.disabled = true;
                        btnIncrementarGeneral.disabled = true;
                    } else if (cantidadGeneral > 0) {
                        btnDecrementarPreferencial.disabled = true;
                        btnIncrementarPreferencial.disabled = true;
                    } else {
                        btnDecrementarPreferencial.disabled = false;
                        btnIncrementarPreferencial.disabled = false;
                        btnDecrementarGeneral.disabled = false;
                        btnIncrementarGeneral.disabled = false;
                    }
                }

                function generarMapaDeAsientos() {
                    seatMap.innerHTML = '';
                    asientosSeleccionados = [];
                    const preferencial = cantidadPreferencial > 0;
                    const totalAsientos = preferencial ? cantidadPreferencial : cantidadGeneral;

                    const sala = funcionSeleccionada.sala;
                    const room = rooms.find(r => r.id == sala);

                    if (!room) {
                        console.error("Sala no encontrada");
                        return;
                    }

                    const filas = Math.ceil(room.capacity / 10);
                    const columnas = 10;

                    for (let i = 0; i < filas; i++) {
                        const fila = document.createElement('div');
                        fila.classList.add('flex', 'space-x-2');
                        for (let j = 0; j < columnas; j++) {
                            const asiento = document.createElement('button');
                            asiento.classList.add('bg-gray-200', 'text-black', 'px-4', 'py-2', 'rounded-lg', 'border', 'border-gray-300', 'shadow-sm', 'hover:bg-[#1E3A8A]', 'hover:text-white');
                            asiento.textContent = `${String.fromCharCode(65 + i)}${j + 1}`;

                            const esPreferencial = i >= (filas - Math.ceil(room.cant_prefe / 10));
                            asiento.addEventListener('click', function() {
                                if (asiento.classList.contains('bg-green-500')) {
                                    asiento.classList.remove('bg-green-500');
                                    asiento.classList.add('bg-gray-200');
                                    const index = asientosSeleccionados.indexOf(asiento.textContent);
                                    if (index > -1) {
                                        asientosSeleccionados.splice(index, 1);
                                    }
                                } else if (asientosSeleccionados.length < totalAsientos && ((!preferencial && !esPreferencial) || (preferencial && esPreferencial))) {
                                    asiento.classList.remove('bg-gray-200');
                                    asiento.classList.add('bg-green-500');
                                    asientosSeleccionados.push(asiento.textContent);
                                }
                            });
                            fila.appendChild(asiento);
                        }
                        seatMap.appendChild(fila);
                    }
                }

                function mostrarResumen() {
                    resumenDetalles.innerHTML = `
                        <p class="text-gray-700 mb-2"><strong>Película:</strong> <?= $this->movie['title'] ?></p>
                        <p class="text-gray-700 mb-2"><strong>Fecha:</strong> ${funcionSeleccionada.fecha}</p>
                        <p class="text-gray-700 mb-2"><strong>Hora:</strong> ${funcionSeleccionada.hora}</p>
                        <p class="text-gray-700 mb-2"><strong>Sala:</strong> ${funcionSeleccionada.sala}</p>
                        <p class="text-gray-700 mb-2"><strong>Asientos:</strong> ${asientosSeleccionados.join(', ')}</p>
                        <p class="text-gray-700 mb-2"><strong>Total:</strong> $${totalSpan.textContent}</p>
                    `;
                }

                function imprimirResumen() {
                    const printWindow = window.open('', '', 'width=800,height=600');
                    printWindow.document.write(`
                        <html>
                        <head>
                            <title>Resumen de Compra</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    padding: 20px;
                                }
                                h4 {
                                    color: #1c508d;
                                }
                                p {
                                    margin: 5px 0;
                                }
                            </style>
                        </head>
                        <body>
                            <h4>Resumen de Compra</h4>
                            ${resumenDetalles.innerHTML}
                        </body>
                        </html>
                    `);
                    printWindow.document.close();
                    printWindow.print();
                }
            })
            .catch(error => console.error('Error al cargar las salas:', error));
    });
</script>