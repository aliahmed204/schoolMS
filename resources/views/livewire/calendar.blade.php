<div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
    @endpush

</div>
        <script>
            document.addEventListener('livewire:init', function() {
                console.log('Livewire loaded');
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var calendar;

                Livewire.on('refreshCalendar', () => {
                    calendar.refetchEvents();
                });

                // Initialize the calendar once and update it later
                initializeCalendar();

                function initializeCalendar() {
                    var data = @json($events);

                    calendar = new Calendar(calendarEl, {
                        events: JSON.parse(data),
                        dateClick(info) {
                            var title = prompt("{{trans('main.Event_create')}}");
                            var date = new Date(info.dateStr);
                            if (title != null && title != '') {
                                calendar.addEvent({
                                    title: title,
                                    start: date,
                                    allDay: true
                                });
                                var eventAdd = { title: title, start: date };
                                @this.addevent(eventAdd);
                                alert("{{trans('main.Event_created')}}");
                            } else {
                                alert("{{trans('main.not_created')}}");
                            }
                        },
                        editable: true,
                        selectable: true,
                        displayEventTime: false,
                        droppable: true,
                        drop: function (info) {
                            if (checkbox.checked) {
                                info.draggedEl.parentNode.removeChild(info.draggedEl);
                            }
                        },
                        eventDrop:  info => @this.eventDrop(info.event, info.oldEvent),

                        eventClick: function(info) {
                            if (confirm("{{trans('main.Event_Delete')}}")) {
                                var id = info.event.id;
                                var eventDelete = id;
                            @this.eventDelete(eventDelete);
                                alert("{{trans('main.Deleted')}}");
                            }else{
                                alert("{{trans('main.Cancel')}}");
                            }
                        },

                    loading: function (isLoading) {
                            if (!isLoading) {
                                if (typeof calendar !== 'undefined') {
                                    calendar.getEvents().forEach(function (e) {
                                        if (e.source === null) {
                                            e.remove();
                                        }
                                    });
                                }
                            }
                        }
                    });

                    calendar.render();
                }
            });
    </script>

@push('scripts')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush

