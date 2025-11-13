<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Employee</title>
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
                    <h1 class="font-extrabold text-3xl">Add employee</h1>
                </div>
                <div class="p-6">
                     @if ($errors->any())
                        <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form" class="space-y-3" method="post" action="{{ route('postemployee') }}"
                        enctype="multipart/form-data">
                        @csrf @method('post')

                        <div class="space-y-2">
                            <label class="font-semibold text-black">Branch:</label>
                            <select id="employee" name="employee_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full" required>
                                <option></option>
                                @foreach ($branch as $bra)
                                    <option value="{{ $bra->id }}">{{ $bra->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="font-semibold text-black">Name:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="name" name="name" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Email:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="email" name="email" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Password:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Nik:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="nik" name="nik" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Phone:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Address:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Position:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Join date:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                            <div class="space-y-2">
                                <label class="font-semibold text-black">Status:</label>
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                    id="phone" name="phone" required />
                            </div>

                        </div>

                        <div class="space-y-2">
                            <label class="font-semibold text-black">Role:</label>
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full"
                                id="phone" name="phone" required />
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
        const form = document.getElementById('form');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', () => {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
</body>

</html>
