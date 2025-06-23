<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // List all events
    public function index()
    {
        $events = Event::all()->sortBy('start_datetime');
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
            'location'       => 'nullable|string|max:255',
            'color'          => 'nullable|string|max:7',
            'is_all_day'     => 'boolean',
            'status'         => 'in:upcoming,ongoing,completed,cancelled',
        ]);

        $validated['created_by'] = Auth::id();
        $row                     = Event::create($validated);
        if ($request->is('api/*')) {
            return response()->json([
                'data'    => $row,
                'message' => 'Event created successfully',
            ], 201);
        } else {
            return redirect()->route('events.index')->with('success', 'Event created successfully');
        }

    }

    // Show a specific event
    public function show(Event $event)
    {
        return $event;
    }

    // Update an event
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'          => 'sometimes|string|max:255',
            'description'    => 'nullable|string',
            'start_datetime' => 'sometimes|date',
            'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
            'location'       => 'nullable|string|max:255',
            'color'          => 'nullable|string|max:7',
            'is_all_day'     => 'boolean',
            'status'         => 'in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update($validated);

        if ($request->is('api/*')) {
            return response()->json([
                'data' => $event,
                'message' => 'Event updated successfully'
            ], 200);
        } else {
            return redirect()->route('events.index')->with('success', 'Event updated successfully');
        }
    }

    // Delete an event
    public function destroy(Event $event)
    {
        $event->delete();
        if (request()->is('api/*')) {
            return response()->json([
                'message' => 'Event deleted successfully'
            ], 204);
        } else {
            return redirect()->route('events.index')->with('success', 'Event deleted successfully');
        }
    }

    public function slideEvent(Event $event, Request $request)
    {
        $validated = $request->validate([
            'start' => 'required|date',
        ]);
        // Find the event by ID check the start date and update it before update the start date check diff between old start date and new start date and add diff seconds to end date and also for fallowing events
        // $event = Event::findOrFail($validated['eventId']);
        $oldStart              = $event->start_datetime;
        $event->start_datetime = $validated['start'];
        $diffInSeconds         = $oldStart->diffInSeconds($event->start_datetime);
        $event->end_datetime   = $event->end_datetime ? $event->end_datetime->addSeconds($diffInSeconds) : null;
        $event->save();

        // dd($event->end_datetime, $event->start_datetime, $oldStart, $diffInSeconds);
        // Update all following events of same day till the end of the day of same user
        $followingEvents = Event::where('created_by', $event->created_by)
            ->where('start_datetime', '>', $event->start_datetime->toDateTimeString())
            ->where('start_datetime', '<=', $event->start_datetime->copy()->endOfDay()->toDateTimeString())
            ->where('id', '!=', $event->id)
            ->get();

        // dd($followingEvents,$event->start_datetime->toDateTimeString(),$event->start_datetime->copy()->endOfDay()->toDateTimeString());

        foreach ($followingEvents as $followingEvent) {
            $followingEvent->start_datetime = $followingEvent->start_datetime->addSeconds($diffInSeconds);
            $followingEvent->end_datetime   = $followingEvent->end_datetime ? $followingEvent->end_datetime->addSeconds($diffInSeconds) : null;
            $followingEvent->save();
        }
        
        if ($request->is('api/*')) {
            return response()->json([
                'data'             => $event,
                'message'          => 'event updated successfully',
                'following_events' => $followingEvents,
            ], 201);
        } else {
            return redirect()->route('events.index')->with('success', 'Event updated successfully');
        }
    }
}
