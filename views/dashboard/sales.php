<?php require_once "./views/components/head.php"; ?>

<div class="pt-[8rem]">
    <main class="flex-grow mx-auto container pt-6 bg-white p-8 ">
        <div class="breadcrub-container mx-auto container bg-[#F5F9FF] rounded-md px-[3rem] py-[2rem] mb-[1rem] border border-[#E6F0FF]">
            <nav class="text-gray-700 mb-4">
                <ol class="list-reset flex">
                    <li><a href="/Cine-Colombia/dashboard" class="text-[#1C508D] hover:text-blue-700">Inicio</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Historial de Ventas</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold mb-6">Historial de Ventas</h2>
        </div>
        <div class="container-sales mx-auto container bg-[#F5F9FF] rounded-xl px-[3rem] py-[2rem] border border-[#E6F0FF]">
            <table id="salesTable" class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 px-4 py-2">Título</th>
                        <th class="w-1/4 px-4 py-2">Fecha</th>
                        <th class="w-1/4 px-4 py-2">Hora</th>
                        <th class="w-1/4 px-4 py-2">Sala</th>
                        <th class="w-1/4 px-4 py-2">Cantidad</th>
                        <th class="w-1/4 px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php require_once "./views/components/footer.php"; ?>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetchSales();

        function fetchSales() {
            $.ajax({
                url: '/Cine-Colombia/dashboard/getSales',
                method: 'GET',
                success: function (response) {
                    const sales = JSON.parse(response);
                    const tableBody = document.getElementById('salesTableBody');
                    tableBody.innerHTML = '';

                    sales.forEach(sale => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="py-2 px-4 border-b">${sale.titulo}</td>
                            <td class="py-2 px-4 border-b">${sale.fecha}</td>
                            <td class="py-2 px-4 border-b">${sale.hora}</td>
                            <td class="py-2 px-4 border-b">${sale.sala}</td>
                            <td class="py-2 px-4 border-b">${sale.cantidad}</td>
                            <td class="py-2 px-4 border-b">${sale.total}</td>
                        `;
                        tableBody.appendChild(row);
                    });

                    $('#salesTable').DataTable({
                        "paging": true,
                        "searching": true,
                        "info": true,
                        "lengthChange": true,
                        "autoWidth": false,
                    });
                }
            });
        }
    });
</script>

<style>
    div.container-table {
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }

    div#salesTable_filter label {
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
