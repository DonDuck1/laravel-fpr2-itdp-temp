<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($organisation->name) }}
        </h2>
    </x-slot>

    <p>Name: {{ $organisation->name }}</p>
    <br>
    <p>Id: {{ $organisation->id }}</p>
    <br>
    <p>
        Active:
        @if($organisation->active === 1)
            {{ 'Yes' }}
        @elseif($organisation->active === 0)
            {{ 'No' }}
        @endif
    </p>
    <br>
    <p>Departments:</p>
    @can('create', \App\Models\Department::class)
        <a href="{{ route('departments.create', $organisation) }}">CREATE NEW</a>
    @endcan
    <table>
        <tr>
            <th>Department</th>
            <th>ID</th>
            <th>Active</th>
            <th>More information</th>
        </tr>
        @foreach($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td>{{ $department->id }}</td>
                <td>
                    @if($department->active === 1)
                        {{ 'Yes' }}
                    @elseif($department->active === 0)
                        {{ 'No' }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}">Link</a>
                </td>
            </tr>
        @endforeach
    </table>
    @can('update', $organisation)
        <a href="{{ route('organisations.edit', $organisation->id) }}">EDIT</a>
    @endcan
    @can('delete', $organisation)
        <form method="POST" action="{{ route('organisations.destroy', $organisation->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endcan
</x-app-layout>
