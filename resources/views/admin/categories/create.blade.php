<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 bg-slate-100 rounded-lg">
                    <div class="flex m-2 p-2">
                        <a href="{{route('admin.categories.index')}}" class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded-lg">Categories</a>
                    </div>

                    <div class="m-2 p-2">
                        <div class="space-y-8 divide-y divide-gray-200 mt-10">
                            <form enctype="multipart/form-data" method="POST" action="{{route('admin.categories.store')}}">
                                @csrf
                              <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                  <input type="text" id="name" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                              </div>
                              <div class="sm:col-span-6">
                                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                <div class="mt-1">
                                  <input type="file" id="image" wire:model="newImage" name="image" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('image') border-red-400 @enderror" />
                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                </div>
                              </div>
                              <div class="sm:col-span-6 pt-5">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                  <textarea id="description" rows="3" name="description" wire:model.lazy="description" class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-400 @enderror"></textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                              </div>
                              <div class="mt-6 p-4">
                                <button type="submit" class="text-white px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Store</button>
                              </div>
                            </form>
                          </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
