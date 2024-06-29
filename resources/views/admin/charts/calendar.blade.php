<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title" style="font-weight: bold; text-align: center;">Event Calendar</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div id="calendar"></div>
    </div>
</div>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
<style>
    .fc {
        --fc-page-bg-color: #3a923a;
        --fc-border-color: #3a923a;
        --fc-header-bg-color: #004b00;
        --fc-header-text-color: #ffffff;
        --fc-day-bg-color: #3a923a;
        --fc-day-border-color: #004b00;
        --fc-today-bg-color: #004b00;
        --fc-today-border-color: #004b00;
        --fc-highlight-bg-color: #004b00;
        --fc-highlight-border-color: #004b00;
        --fc-event-bg-color: #00b300;
        --fc-event-border-color: #004b00;
        --fc-event-text-color: #ffffff;
        --fc-event-selected-bg-color: #004b00;
        --fc-event-selected-border-color: #004b00;
    }
    .fc .fc-toolbar {
        background-color: var(--fc-header-bg-color);
        color: var(--fc-header-text-color);
    }
    .fc .fc-daygrid-day {
        background-color: var(--fc-day-bg-color);
        border-color: var(--fc-day-border-color);
    }
    .fc .fc-daygrid-day.fc-day-today {
        background-color: var(--fc-today-bg-color);
        border-color: var(--fc-today-border-color);
    }
    .fc .fc-highlight {
        background-color: var(--fc-highlight-bg-color);
        border-color: var(--fc-highlight-border-color);
    }
    .fc .fc-event {
        background-color: var(--fc-event-bg-color);
        border-color: var(--fc-event-border-color);
        color: var(--fc-event-text-color);
    }
    .fc .fc-event.fc-selected {
        background-color: var(--fc-event-selected-bg-color);
        border-color: var(--fc-event-selected-border-color);
    }
    .fc-daygrid-day-number {
        color: white;
        font-weight: bold;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
        });
        calendar.render();
    });
</script>
