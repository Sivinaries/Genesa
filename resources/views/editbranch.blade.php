<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Branch</title>
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
            <div class="w-full bg-white rounded-lg h-fit mx-auto">
                <div class="p-3 text-center">
                    <h1 class="font-extrabold text-3xl">Edit branch</h1>
                </div>
                <div class="p-6">
                    <form id="categoryForm" class="space-y-3" method="post"
                        action="{{ route('updatebranch', ['id' => $branch->id]) }}" enctype="multipart/form-data">
                        @csrf @method('put')

                        <div class="space-y-2">
                            <label class="font-semibold text-black">Name:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="name" name="name" value="{{ $branch->name }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Phone:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="phone" name="phone" value="{{ $branch->phone }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Address:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="address" name="address" value="{{ $branch->address }}" />
                        </div>
                        <button id="submitBtn" type="submit"
                            class="bg-blue-500 text-white p-4 w-full hover:text-black rounded-lg transition-all">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        const form = document.getElementById('categoryForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
</body>

</html>
