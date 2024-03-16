<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 bg-slate-100 rounded-lg">
                    <div class="flex m-2 p-2">
                        <a href="{{ route('admin.reservations.index') }}"
                            class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded-lg">Reservations</a>
                    </div>


                    <div class="m-2 p-2">
                        <div class="space-y-8 divide-y divide-gray-200 mt-10">
                            <form method="POST" action="{{ route('admin.reservations.store') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name </label>
                                    <div class="mt-1">
                                        <input type="text" id="first_name" wire:model.lazy="first_name" name="first_name"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror" />
                                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />

                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name </label>
                                    <div class="mt-1">
                                        <input type="text" id="last_name" wire:model.lazy="last_name" name="last_name"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />

                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                    <div class="mt-1">
                                        <input type="text" id="email" wire:model.lazy="email" name="email"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="tel_number" class="block text-sm font-medium text-gray-700"> Tel Number
                                    </label>
                                    <div class="mt-1">
                                        <input type="tel" id="tel_number" wire:model.lazy="tel_number" name="tel_number"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('tel_number') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('tel_number')" />

                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date
                                    </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="res_date" wire:model.lazy="res_date" name="res_date" min="{{$min_date}}" max="{{$max_date}}"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('res_date') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('res_date')" />

                                    </div>
                                </div>

                                <div class="sm:col-span-6 pt-5">
                                    <label for="table_id"
                                        class="block text-sm font-medium text-gray-700">Tables</label>
                                    <div class="mt-1">
                                        <select name="table_id" id="table_id"
                                            class="form-select rounded-md shadow-sm border border-gray-300 p-2.5 text-gray-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm @error('table_id') border-red-400 @enderror">
                                                @foreach ($tables as $table)
                                                    <option value="{{ $table->id }}">{{ $table->name }} ({{$table->guest_number}} Guests)</option>
                                                @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('table_id')" />
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                    </label>
                                    <div class="mt-1">
                                        <input type="number" min="0" max="10000" step="1"
                                            id="guest_number" wire:model.lazy="guest_number" name="guest_number"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('guest_number')" />

                                    </div>
                                </div>
                                <div class="mt-6 p-4">
                                    <button type="submit"
                                        class="text-white px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Store</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
