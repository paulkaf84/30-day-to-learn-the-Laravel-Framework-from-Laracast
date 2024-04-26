<x-layout>
    <x-slot:title>List of jobs</x-slot:title>
    <x-slot:heading>List of jobs</x-slot:heading>

    <div class="border-b border-gray-900/10 pb-12">
        <h2><strong>{{ $job->title }}</strong></h2>
        <p>This Job pays a salary of: {{ $job->salary }}</p>
    </div>


    <div class="mt-6 flex items-center justify-between gap-x-6">
        <div>
            <button form="jobs-destroy" class="text-red-500 font-semibold">delete</button>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('jobs.index') }}" class="text-sm font-semibold leading-6 text-gray-900">back</a>
            <x-buton :href=" route('jobs.edit', $job) ">Edit</x-buton>
            </div>
    </div>

    <form method="POST" id="jobs-destroy" action="{{ route('jobs.destroy', $job) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
