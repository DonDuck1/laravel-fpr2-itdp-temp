<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organisations') }}
        </h2>
    </x-slot>

    @can('create', \App\Models\Department::class)
        <a href="{{ route('departments.create') }}">CREATE NEW</a>
    @endcan

    <table>
        <tr>
            <th>Department</th>
            <th>ID</th>
            <th>Active</th>
            <th>Organisation</th>
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
                    @foreach($organisations as $organisation)
                        @if($department->organisation_id === $organisation->id)
                            {{ $organisation->name }}
                        @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}">Link</a>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
