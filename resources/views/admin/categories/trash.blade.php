<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex">
                        <div class="flex flex-start justify-end m-2 p-2">
                            <a href="{{route('admin.categories.create')}}" class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded-lg">New Category</a>
                        </div>
                        <div class="flex flex-end justify-end m-2 p-2">
                            <a href="{{route('admin.categories.index')}}" class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded-lg">Categories</a>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Category name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$category->name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{Storage::url($category->image)}}" alt="" class="w-16 h-16 rounded">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$category->description}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <a href="{{route('admin.categories.restore', $category->id)}}" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg text-white font-medium hover:underline">Restore</a>
                                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                        action="{{route('admin.categories.force.delete', $category->id)}}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are u sure? This will delete forever!');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Remove</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
