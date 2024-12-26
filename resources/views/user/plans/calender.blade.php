<div>
    <div class="card bg-base-100 w-80vw shadow-xl">
        <div class="card-body">
            <h2 class="card-title flex flex-row justify-between mb-2">
                Checkin
            </h2>
            <div class="flex flex-col justify-between">
                <div class="flex items-center">
                    @if ($currentStreak >= 3)
                        @if ($checkedin)
                            <img src="{{ asset('assets/svg/streak-on.svg') }}" class="w-8 h-8 p-0 m-0">
                        @else
                            <img src="{{ asset('assets/svg/streak-off.svg') }}" class="w-8 h-8 p-0 m-0">
                        @endif
                        <p class="text-2xl whitespace-nowrap p-0">{{ $currentStreak }}</p>
                    @endif
                </div>
                <div class="mt-4 grid grid-cols-6 md:grid-cols-12 gap-2">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($checkinsForCalendar as $date => $status)
                        <div class="flex items-center justify-center w-10 h-10 rounded-full text-white text-sm cursor-pointer
                            {{ $status === 'checked' ? 'bg-green-500' : '' }}
                            {{ $status === 'missed' ? 'bg-red-500' : '' }}
                            {{ $status === 'remaining' ? 'bg-gray-500' : '' }}
                            {{ $date == $today ? 'border-4 border-yellow-400' : '' }}
                            {{ $date == $today && $status == 'missed' ? 'bg-yellow-400' : '' }}"
                            {{ $date == $today && $status == 'missed' ? 'wire:click=checkin' : '' }}>
                            {{ $i++ }} </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div>
        @if ($currentDay == 90)
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 z-50">
                <div class="text-center relative">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script><lottie-player
                        src="https://lottie.host/e643be76-98db-40ab-a026-c7ec1b3e6733/ADg81uAWlI.json"
                        background="##FFFFFF" speed="1" autoplay
                        direction="1" mode="normal"></lottie-player>
                </div>  
            </div>
        @endif
    </div>

    <x-livewire-extras />
</div>
