<x-layout>
    <x-slot:heading>List of jobs</x-slot:heading>
    <x-slot:title>List of jobs</x-slot:title>
    <h1 class="text-xl mb-4">This is the Job page</h1>
    <h2>Displaying {{ $jobs->count() }} {{ "job" ? $jobs->count() == 1 || $jobs->count() == 0: "jobs" }}</h2>
    <div class="space-y-4">

        @foreach($jobs as $job)
            <a href="{{ route('jobs.show', $job) }}">
                <div class="flex justify-between items-center group border border-gray-200 px-4 py-6 rounded-lg hover:bg-gray-200">

                    <div>
                        <div class="font-medium text-sm text-blue-500">
                            {{ $job->employer->name }}
                        </div>
                        <div>
                            <strong>{{ $job->title }}:</strong> Pay {{ $job->salary }} per years
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('jobs.edit', $job) }}" class="flex justify-between space-x-2 items-center px-4 py-2 group-hover:bg-gray-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
{{--                            <span class="font-medium text-right">Edit</span>--}}
                        </a>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="my-8">{{ $jobs->links() }}</div>
</x-layout>
