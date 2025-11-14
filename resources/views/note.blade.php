<!DOCTYPE html>
<html lang="en">

<head>
    <title>Note</title>
    @include('layout.head')
    <link href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">
    @include('layout.sidebar')

    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        @include('layout.navbar')
        <div class="p-5 space-y-4">

            <!-- Header & Add Button -->
            <div
                class="flex justify-between items-center bg-gradient-to-l from-blue-100 to-blue-50 p-4 rounded-lg shadow">
                <h1 class="font-semibold text-2xl text-black">Note</h1>
                <button id="addBtn"
                    class="p-2 px-8 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                    Add
                </button>
            </div>

            <!-- Table -->
            <div class="w-full rounded-lg bg-white shadow-md">
                <div class="p-2 overflow-auto">
                    <table id="myTable" class="bg-gray-50 border-2 w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($notes as $item)
                                <tr class="border-2">
                                    <td>{{ $no++ }}</td>
                                   <td>{{ $item->created_at ?? 'N/A' }}</td>
                                        <td>{{ $item->employee->name ?? 'N/A' }}</td>
                                        <td>{{ $item->start_date ?? 'N/A' }}</td>
                                        <td>{{ $item->end_date ?? 'N/A' }}</td>
                                        <td>{{ $item->type ?? 'N/A' }}</td>
                                        <td>{{ $item->reason ?? 'N/A' }}</td>
                                        <td>{{ $item->status ?? 'N/A' }}</td>
                                    <td class="flex gap-2">
                                        <button class="editBtn w-full" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-phone="{{ $item->phone }}"
                                            data-address="{{ $item->address }}">
                                            <span
                                                class="p-2 text-white bg-blue-500 rounded-lg w-full hover:text-gray-300 block text-center shadow transition">Edit</span>
                                        </button>
                                        <form method="post" action="{{ route('delleave', ['id' => $item->id]) }}"
                                            class="deleteForm w-full">
                                            @csrf
                                            @method('delete')
                                            <button type="button"
                                                class="delete-confirm p-2 text-white bg-red-500 rounded-lg w-full hover:text-gray-300 shadow transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 bg-white/40 backdrop-blur-sm flex items-center justify-center z-50">
        <div
            class="bg-white rounded-lg p-6 w-full max-w-lg shadow-lg relative transform transition-all duration-300 scale-95">
            <button id="closeAddModal"
                class="absolute top-4 right-4 text-white hover:text-gray-300 bg-red-500 p-1 px-4 rounded-full">
                ✕
            </button>

            <h1 class="text-2xl font-semibold mb-8">Add</h1>

            <form id="addForm" method="post" action="{{ route('postbranch') }}" enctype="multipart/form-data"
                class="space-y-3">
                @csrf
                @method('post')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Name:</label>
                        <input type="text" name="name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                    </div>
                    <div>
                        <label class="font-semibold">Phone:</label>
                        <input type="text" name="phone" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                    </div>
                </div>
                <div>
                    <label class="font-semibold">Address:</label>
                    <input type="text" name="address" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                </div>
                <button type="submit"
                    class="bg-green-500 text-white p-4 w-full rounded-lg hover:bg-green-600 shadow transition">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-white/40 backdrop-blur-sm flex items-center justify-center z-50">
        <div
            class="bg-white rounded-lg p-6 w-full max-w-lg shadow-lg relative transform transition-all duration-300 scale-95">
            <button id="closeModal"
                class="absolute top-4 right-4 text-white hover:text-gray-300 bg-red-500 p-1 px-4 rounded-full">✕</button>

            <h1 class="text-2xl font-semibold mb-8">Edit</h1>

            <form id="editForm" method="post" enctype="multipart/form-data" class="space-y-3">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold">Name:</label>
                        <input type="text" id="editName" name="name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                    </div>
                    <div>
                        <label class="font-semibold">Phone:</label>
                        <input type="text" id="editPhone" name="phone" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                    </div>
                </div>
                <div>
                    <label class="font-semibold">Address:</label>
                    <input type="text" id="editAddress" name="address" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 p-2 rounded-lg w-full">
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white p-4 w-full rounded-lg hover:bg-blue-600 shadow transition">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#myTable', {
                columnDefs: [{
                    targets: 1,
                    render: function(data) {
                        const date = new Date(data);
                        return date.toLocaleDateString();
                    },
                }],
            });

            // Add modal
            const addModal = $('#addModal');
            $('#addBtn').click(() => addModal.removeClass('hidden'));
            $('#closeAddModal').click(() => addModal.addClass('hidden'));
            $(window).click((e) => {
                if (e.target === addModal[0]) addModal.addClass('hidden');
            });

            // Edit modal
            const editModal = $('#editModal');
            $('.editBtn').click(function() {
                const btn = $(this);
                $('#editName').val(btn.data('name'));
                $('#editPhone').val(btn.data('phone'));
                $('#editAddress').val(btn.data('address'));
                $('#editForm').attr('action', `/branch/update/${btn.data('id')}`);
                editModal.removeClass('hidden');
            });
            $('#closeModal').click(() => editModal.addClass('hidden'));
            $(window).click((e) => {
                if (e.target === editModal[0]) editModal.addClass('hidden');
            });

            // Delete confirmation
            $('.delete-confirm').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>

    @include('sweetalert::alert')

</body>

</html>
