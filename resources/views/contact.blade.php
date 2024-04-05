<x-layout>
    <x-slot:heading>Contact</x-slot:heading>
    <h1 class="text-xl mb-4">This is the Job page</h1>
    <h2>Displaying {{ $jobs->count() }} {{ "job" ? $jobs->count() == 1 || $jobs->count() == 0: "jobs" }}</h2>
    <div class="space-y-4">

        @foreach($jobs as $job)
            <a class="block border border-gray-200 px-4 py-6 rounded-lg" href="{{ route('job.show', ['id' => $job->id]) }}">
                <div class="font-medium text-sm text-blue-500">
                    {{ $job->employer->name }}
                </div>
                <div>
                    <strong>{{ $job->title }}:</strong> Pay {{ $job->salary }} per years
                </div>
            </a>
        @endforeach
    </div>
    <div class="my-8">{{ $jobs->links() }}</div>
</x-layout>
