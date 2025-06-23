<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event List') }}
        </h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('events.create') }}" class="inline-block px-4 py-2 mb-4 bg-blue-500 text-white rounded hover:bg-blue-600">
            Add New Event
        </a>

        <table class="min-w-full bg-white border border-gray-200 shadow rounded">
            <thead>
                <tr class="bg-blue-100 text-left text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Start</th>
                    <th class="px-4 py-2">End</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">{{ $event->id }}</td>
                        <td class="px-4 py-2">{{ $event->title }}</td>
                        <td class="px-4 py-2">
                            <input type="datetime-local" value="{{ \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i') }}" class="w-full border rounded px-3 py-2 mt-1" data-id="{{ $event->id }}" data-field="start_datetime" data-update="true" >
                        </td>
                        <td>
                            <input type="datetime-local" value="{{ $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i') : '' }}" class="w-full border rounded px-3 py-2 mt-1" data-id="{{ $event->id }}" data-field="end_datetime" readonly >
                        </td>
                        <td class="px-4 py-2 capitalize">{{ $event->status }}</td>
                        <td class="px-4 py-2">
                            <div class="relative inline-block text-left">
                                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50" id="options-menu-{{ $event->id }}">
                                    Actions
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="hidden absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <a href="{{ route('events.show', $event->id) }}" class="block px-4 py-2 text-sm text-green-600 hover:bg-gray-100">View</a>
                                        <a href="{{ route('events.edit', $event->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });

            document.addEventListener('click', function () {
                document.querySelectorAll('[id^="options-menu-"]').forEach(button => {
                    const dropdown = button.nextElementSibling;
                    dropdown.classList.add('hidden');
                });
            });

            // fetch all datetime-local inputs which have data-update attribute and listen for changes and update the event
            document.querySelectorAll('input[type="datetime-local"][data-update="true"]').forEach(input => {
                input.addEventListener('change', function () {
                    const eventId = this.getAttribute('data-id');
                    const field = 'start';
                    // const field = this.getAttribute('data-field');
                    const value = this.value;
                    fetch(`/event/slide/${eventId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ [field]: value })
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        alert('Event updated successfully');
                        window.location.reload();
                    }).then(data => {
                        console.log('Event updated successfully:', data);
                    }).catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
                });
            });
        });
    </script>
</x-app-layout>
