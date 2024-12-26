<div class="container">
    <h2>90-Day Check-In Calendar</h2>
    <p><strong>Current Streak:</strong> {{ $currentStreak }} days</p>
    <p><strong>Longest Streak:</strong> {{ $longestStreak }} days</p>
    <div class="calendar">
        @php
        $i = 1;
        @endphp
        @foreach ($checkinsForCalendar as $date => $status)
        <div class="calendar-day
                {{ $status }}
                {{ $date == $today && $status == 'missed' ? 'current-day' : '' }}"
            {{ $date == $today && $status == 'missed' ? 'wire:click=checkin' : '' }}
            title="{{ ucfirst($status) }}">
            {{-- {{ \Carbon\Carbon::parse($date)->format('Y-m-d') }} --}}
            {{ $i++ }}
        </div>
        @endforeach
    </div>
</div>

<style>
    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        margin-top: 20px;
    }

    .calendar-day {
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }

    .calendar-day.checked {
        background-color: green;
        color: white;
    }

    .calendar-day.missed {
        background-color: red;
        color: white;
    }

    .calendar-day.remaining {
        background-color: grey;
        color: white;
    }

    .calendar-day.current-day {
        background-color: yellow;
        color: black;
    }

    .calendar-day:hover {
        opacity: 0.8;
    }
</style>