<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organisations') }}
        </h2>
    </x-slot>

    <p>Name: {{ $department->name }}</p>
    <br>
    <p>Id: {{ $department->id }}</p>
    <br>
    <p>
        Active:
        @if($department->active === 1)
            {{ 'Yes' }}
        @elseif($department->active === 0)
            {{ 'No' }}
        @endif
    </p>
    <br>
    <p>Organisation: <a href="{{ route('organisations.show', $organisation->id) }}">{{ $organisation->name }}</a></p>
    <br>
    @can('update', $department)
        <a href="{{ route('departments.edit', $department->id) }}">EDIT</a>
    @endcan
    @can('delete', $department)
        <form method="POST" action="{{ route('departments.destroy', $department->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endcan
</x-app-layout>
