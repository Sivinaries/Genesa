<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee</title>
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
            <div>
                <h1>Leave</h1>
            </div>
            <div>
                <h1>Overtime</h1>
            </div>
            <div>
                <h1>Note</h1>
            </div>
        </div>
    </main>
    @include('sweetalert::alert')

</body>

</html>
