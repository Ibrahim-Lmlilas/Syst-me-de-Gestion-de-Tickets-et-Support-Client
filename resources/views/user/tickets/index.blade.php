@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">My Tickets</h2>
                </div>

                <a href="{{ route('user.tickets.create') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-800 text-sm font-medium rounded-md border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Create Ticket
                </a>

                <table class="table-auto w-full mt-6">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td class="border px-4 py-2">{{ $ticket->title }}</td>
                            <td class="border px-4 py-2">{{ $ticket->description }}</td>
                            <td class="border px-4 py-2">{{ $ticket->status }}</td>
                            <td class="border px-4 py-2">{{ $ticket->category->name }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('user.tickets.edit', $ticket->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('user.tickets.destroy', $ticket->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>
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
