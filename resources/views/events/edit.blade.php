<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Event') }}
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

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2 mt-1" rows="3">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', \Carbon\Carbon::parse($event->start_datetime)->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">End Date & Time</label>
                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime', $event->end_datetime ? \Carbon\Carbon::parse($event->end_datetime)->format('Y-m-d\TH:i') : '') }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Location</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Event Color</label>
                <input type="color" name="color" value="{{ old('color', $event->color ?? '#3b82f6') }}" class="w-20 h-10 border rounded mt-1">
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
                    <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('events.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 mr-2">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update Event</button>
            </div>
        </form>
    </div>
</x-app-layout>
