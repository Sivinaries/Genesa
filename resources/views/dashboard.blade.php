<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    @include('layout.head')
</head>

<body class="bg-gray-50">

    <!-- sidenav  -->
    @include('layout.sidebar')
    <!-- end sidenav -->
    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- end Navbar -->
        <div class="p-5">

            <!-- chart section -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-2 lg:grid-cols-2 ">
                <!-- chart 1: Total Order -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Total Order</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <canvas id="grafikHistoy" width="100" height="50"></canvas>
                </div>
                <!-- chart 2: Total Revenue -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Total Revenue</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <canvas id="grafikRevenue" width="100" height="50"></canvas>
                </div>
                <!-- chart 3: Settlement -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Settlement</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <label for="dateSelect">Select date:</label>
                    <select class="border bg-gray-100 p-2 rounded-xl" id="dateSelect" onchange="updateChart()">

                    </select>
                    <canvas id="grafikSettlement" width="100" height="50"></canvas>
                </div>
                <!-- chart 4: Total Expense -->
                <div class="p-6 bg-white rounded-xl shadow-xl">
                    <h1 class="font-light">Total Expense</h1>
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <canvas id="grafikExpense" width="100" height="50"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @include('sweetalert::alert')

</body>

</html>
