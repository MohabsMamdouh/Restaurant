<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('tables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 bg-slate-100 rounded-lg">
                    <div class="flex m-2 p-2">
                        <a href="{{ route('admin.tables.index') }}"
                            class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded-lg">Tables</a>
                    </div>


                    <div class="m-2 p-2">
                        <div class="space-y-8 divide-y divide-gray-200 mt-10">
                            <form method="POST" action="{{ route('admin.tables.store') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                    <div class="mt-1">
                                        <input type="text" id="name" wire:model.lazy="name" name="name"
                                            class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />

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

                                <div class="sm:col-span-6 pt-5">
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <select name="status" id="status"
                                            class="form-select rounded-md shadow-sm border border-gray-300 p-2.5 text-gray-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm @error('status') border-red-400 @enderror">
                                                @foreach (App\Enums\TableStatus::cases() as $status)
                                                    <option value="{{ $status->value }}">{{ $status->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                    </div>
                                </div>

                                <div class="sm:col-span-6 pt-5">
                                    <label for="location"
                                        class="block text-sm font-medium text-gray-700">Location</label>
                                    <div class="mt-1">
                                        <select name="location" id="location"
                                            class="form-select rounded-md shadow-sm border border-gray-300 p-2.5 text-gray-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm @error('location') border-red-400 @enderror">
                                                @foreach (App\Enums\TableLocation::cases() as $location)
                                                    <option value="{{ $location->value }}">{{ $location->name }}</option>
                                                @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
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
