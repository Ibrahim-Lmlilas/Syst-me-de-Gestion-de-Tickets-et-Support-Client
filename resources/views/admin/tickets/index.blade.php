@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Tickets</h2>
                </div>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Agent</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td class="border px-4 py-2">{{ $ticket->title }}</td>
                            <td class="border px-4 py-2">{{ $ticket->description }}</td>
                            <td class="border px-4 py-2">{{ $ticket->status }}</td>
                            <td class="border px-4 py-2">{{ $ticket->user->name }}</td>
                            <td class="border px-4 py-2">{{ $ticket->category->name }}</td>
                            <td class="border px-4 py-2">{{ $ticket->agent ? $ticket->agent->name : '-' }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
