<div class="p-1 bg-gray-100 rounded-xl">
    <div
        class="relative w-full shadow rounded-lg  bg-white p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-neutral-900">



        <img src="" alt="">

        <div class="flex justify-between">
            <div>

                <h5 class="mb-1 font-medium leading-none tracking-tight">{{ $date }}</h5>
                <div class="text-sm opacity-70">{{ $reservationinfo }}</div>
                <div class="text-sm opacity-70">{{ $datum }}</div>
                <div class="text-sm opacity-70">{{ $start }}</div>
                <div class="text-sm opacity-70">{{ $end }}</div>
            </div>

            {{ $slot }}

        </div>



    </div>




</div>