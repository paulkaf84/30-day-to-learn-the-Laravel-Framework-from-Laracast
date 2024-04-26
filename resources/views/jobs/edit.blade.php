<x-layout>
    <x-slot:title>Edit Job</x-slot:title>
    <x-slot:heading>{{ $job->title }}</x-slot:heading>

    <form method="POST" action="{{ route('jobs.update', $job) }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <div class="flex-row rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input value="{{ $job->title }}" type="text" name="title" id="title" class="w-full block flex-1 outline-none bg-transparent py-1.5 px-2 text-gray-900 placeholder:text-gray-400 sm:text-sm sm:leading-6" placeholder="Developer">
                            </div>
                            @error('title')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                        {{ $message  }}
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="salary" class="block text-sm font-medium leading-6 text-gray-900">Salary</label>
                        <div class="mt-2">
                            <div class="flex-row rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input value="{{ $job->salary }}" type="text" name="salary" id="salary" autocomplete="salary" class="w-full block flex-1 outline-none bg-transparent py-1.5 px-2 text-gray-900 placeholder:text-gray-400 sm:text-sm sm:leading-6" placeholder="$50,000 USD">
                            </div>

                            @error('salary')
                            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                        {{ $message }}
                                    </span>
                            @enderror

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('jobs.show', $job) }}" class="text-sm font-semibold leading-6 text-gray-900">Back</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</x-layout>
