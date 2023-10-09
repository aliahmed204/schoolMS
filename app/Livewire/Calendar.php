<?php

namespace App\Livewire;

use App\Models\Event;


use Livewire\Component;

class Calendar extends Component
{
    public $events ;

    public function mount()
    {
        $this->getevent();
    }

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();
        return  json_encode($events);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);

    }

    /**
     * Write code on Method
     * @return response()
     */
    public function eventDrop($event, $oldEvent)
    {
        $eventdata = Event::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->save();
    }


    public function eventDelete($eventId)
    {
        $event = Event::find($eventId);
        if ($event) {
            $event->delete();
            return json_encode(['message' => 'Event deleted successfully']);
        }
        return json_encode(['error' => 'Event not found']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function render()
    {
        $this->dispatch('livewire:init');
        $events = Event::select('id','title','start')->get();
        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}
