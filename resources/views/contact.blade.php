<x-layout>
    <x-slot:heading>Contact</x-slot:heading>
    <h1 class="text-xl mb-4">This is the Job page</h1>
    <ol class="list-decimal">
        @foreach($jobs as $job)
            <a class="text-blue-900" href="{{ route('job.show', ['id' => $job->id]) }}"><li>{{ $job->title }}</li></a>
        @endforeach
    </ol>
</x-layout>
