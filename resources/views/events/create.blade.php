<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-6">
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2 mt-1" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">End Date & Time</label>
                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime') }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Event Color</label>
                <input type="color" name="color" value="{{ old('color', '#3b82f6') }}" class="w-20 h-10 border rounded mt-1">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox" {{ old('is_all_day') ? 'checked' : '' }} onchange="this.nextElementSibling.value = this.checked ? 1 : 0">
                    <input type="hidden" name="is_all_day" value="{{ old('is_all_day') ? 1 : 0 }}">
                    <span class="ml-2 text-gray-700">All Day Event</span>
                </label>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mr-2">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create Event</button>
            </div>
        </form>
    </div>
</x-app-layout>
