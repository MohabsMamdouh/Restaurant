<x-guest-layout>
    <section class="pt-12 pb-12 bg-red-50">
        <div class="container flex items-center justify-center p-6 mx-auto bg-white shadow-lg sm:p-12 md:w-1/2">
            {{-- {{$reservation}} --}}

            <div class="flex w-full">
                <div class="flex-col">
                    <div>Name:</div>
                    <div>Email:</div>
                    <div>Phone Number:</div>
                    <div>Guest Number:</div>
                    <div>Reservation Date:</div>
                </div>
                <div class="flex-col ml-5">
                    <div>{{$reservation->first_name}} {{$reservation->last_name}}</div>
                    <div>{{$reservation->email}}</div>
                    <div>{{$reservation->tel_number}}</div>
                    <div>{{$reservation->guest_number}}</div>
                    <div>
                        {{ str_replace('-', ' ', date('F j, Y, g:i A', strtotime($reservation->res_date))) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
