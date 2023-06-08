<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organisations') }}
        </h2>
    </x-slot>

    @can('create', \App\Models\Organisation::class)
        <a href="{{ route('organisations.create') }}">CREATE NEW</a>
    @endcan

    <table>
        <tr>
            <th>organisation</th>
            <th>ID</th>
            <th>Active</th>
            <th>More information</th>
        </tr>
        @foreach($organisations as $organisation)
            <tr>
                <td>{{ $organisation->name }}</td>
                <td>{{ $organisation->id }}</td>
                <td>
                    @if($organisation->active === 1)
                        {{ 'Yes' }}
                    @elseif($organisation->active === 0)
                        {{ 'No' }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('organisations.show', $organisation->id) }}">Link</a>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
