<x-layout>
    <x-slot:title>List of jobs</x-slot:title>
    <x-slot:heading>List of jobs</x-slot:heading>

    <h2><strong>{{ $job->title }}</strong></h2>
    <p>This Job pays a salary of: {{ $job->salary }}</p>
</x-layout>
