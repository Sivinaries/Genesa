<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shift</title>
    @include('layout.head')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <style>
        /* Make FullCalendar responsive */
        @media (max-width: 768px) {
            .fc-toolbar.fc-header-toolbar {
                flex-direction: column;
                gap: 0.5rem;
            }

            .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }

            .fc-toolbar-title {
                font-size: 1.2rem;
                text-align: center;
            }

            /* Shrink calendar content for small screens */
            .fc-daygrid-day-number {
                font-size: 0.75rem;
            }

            .fc-event {
                font-size: 0.7rem;
                padding: 2px 3px;
            }

            .fc-col-header-cell-cushion {
                font-size: 0.7rem;
                padding: 4px;
            }

            /* Allow horizontal scroll if needed */
            #calendar {
                min-width: 600px;
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    @include('layout.sidebar')

    <main class="md:ml-64 xl:ml-72 2xl:ml-72">
        @include('layout.navbar')

        <div class="p-5">
            <div class='w-full rounded-lg bg-white h-fit mx-auto'>
                <div class="p-3">
                    <div class="flex justify-between">
                        <h1 class="font-extrabold text-3xl">Shift</h1> <a
                            class="p-2 px-8 bg-green-500 rounded-lg text-white hover:text-black text-center"
                            href="{{ route('addshift') }}">+ Add</a>
                    </div>
                </div>
                <div class="p-2">
                    <div class="overflow-auto">
                        <div id="calendar" class="rounded-lg min-w-[320px]"></div>
                    </div>
                </div>
            </div>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const shifts = @json($shifts);

        // Fungsi untuk membuat warna unik dari string
        function stringToColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            const color = Math.floor(Math.abs(Math.sin(hash) * 16777215) % 16777215).toString(16);
            return '#' + '0'.repeat(6 - color.length) + color;
        }

        const events = shifts.map(shift => {
            const employeeName = shift.employee ? shift.employee.name : 'No employee';
            const color = stringToColor(employeeName);

            return {
                title: employeeName,
                start: shift.start_datetime ?? `${shift.start_shift}T${shift.start_time}`,
                end: shift.end_datetime ?? `${shift.end_shift}T${shift.end_time}`,
                backgroundColor: color,
                borderColor: color,
                extendedProps: {
                    description: shift.description ?? 'No description',
                    branch: shift.branch ? shift.branch.name : '-'
                }
            };
        });

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events,
            eventClick(info) {
                const desc = info.event.extendedProps.description || 'No description';
                const branch = info.event.extendedProps.branch || '-';
                alert(`Shift: ${info.event.title}\nBranch: ${branch}\nNote: ${desc}`);
            }
        });

        calendar.render();
    });
</script>


        @include('sweetalert::alert')
</body>

</html>
