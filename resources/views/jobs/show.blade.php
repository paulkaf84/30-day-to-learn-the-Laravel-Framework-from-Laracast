<x-layout>
    <x-slot:heading>Job Show</x-slot:heading>

    <h2><strong>{{ $job->title }}</strong></h2>
    <p>This Job pays a salary of: {{ $job->salary }}</p>
</x-layout>
