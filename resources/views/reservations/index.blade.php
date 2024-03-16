<x-guest-layout>
    <section class="pt-12 pb-12 bg-red-50">
        <div class="container flex items-center justify-center p-6 mx-auto bg-white shadow-lg sm:p-12 md:w-1/2">
            <form class="w-full" method="POST" action="{{route('frontend.reservations.store')}}">
                @csrf

                <h1
                    class="mb-4 text-2xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                    Make Your Reservation
                </h1>
                <div class="gap-2 mb-8 lg:flex">
                    <div class="w-full">
                        <label class="block text-base">
                            First Name
                        </label>
                        <input type="text" name="first_name"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('first_name') border-red-400 @enderror"
                            placeholder="First Name" />
                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />

                    </div>
                    <div class="w-full">
                        <label class="block text-base">
                            Last Name
                        </label>
                        <input type="text" name="last_name"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('last_name') border-red-400 @enderror"
                            placeholder="Last Name" />
                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />

                    </div>
                </div>
                <div class="gap-2 mb-8 lg:flex">
                    <div class="w-full">
                        <label class="block text-base">
                            Email
                        </label>
                        <input type="text" name="email"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('email') border-red-400 @enderror"
                            placeholder="Email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    </div>
                    <div class="w-full">
                        <label class="block text-base">
                            Phone Number
                        </label>
                        <input type="tel" name="tel_number"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('tel_number') border-red-400 @enderror"
                            placeholder="Phone Number" />
                        <x-input-error class="mt-2" :messages="$errors->get('tel_number')" />

                    </div>
                </div>
                <div class="gap-2 mb-8 lg:flex">
                    <div class="w-full">
                        <label class="block text-base">
                            Table Number
                        </label>
                        {{-- <input type="text" name="table"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600"
                            placeholder="Email" /> --}}

                        <select name="table_id" id="table_id"
                            class="form-select rounded-md shadow-sm w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('table_id') border-red-400 @enderror">
                                @foreach ($tables as $table)
                                    <option value="{{ $table->id }}">{{ $table->name }} ({{$table->guest_number}} Guests)</option>
                                @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('table_id')" />
                    </div>
                    <div class="w-full">
                        <label class="block text-base">
                            Guest Number
                        </label>
                        <input type="number" name="guest_number"
                            class="w-full px-4 py-2 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('guest_number') border-red-400 @enderror"
                            placeholder="Guest Number" />
                        <x-input-error class="mt-2" :messages="$errors->get('guest_number')" />

                    </div>
                </div>
                <div class="">
                    <label class="block text-base">
                        Reservation Date
                    </label>
                    <input type="datetime-local" id="res_date" wire:model.lazy="res_date" name="res_date" min="{{$min_date}}" max="{{$max_date}}"
                        class="w-full p-3 text-base border rounded-md focus:border-green-400 focus:outline-none focus:ring-1 focus:ring-green-600 @error('res_date') border-red-400 @enderror"/>
                    <x-input-error class="mt-2" :messages="$errors->get('res_date')" />

                </div>
                <button type="submit"
                    class="px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    Book Now
                </button>

            </form>
        </div>
    </section>
</x-guest-layout>
