<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Ticket;

class UserController extends Controller
{
    public function ticketsIndex(): View
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('user.tickets.index', compact('tickets'));
    }

    public function ticketsCreate(): View
    {
        $categories = \App\Models\Category::all();
        return view('user.tickets.create', compact('categories'));
    }

    public function ticketsStore(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
            'user_id' => auth()->id(),
            'categorie_id' => $request->category_id,
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function ticketsEdit(string $id): View
    {
        $ticket = Ticket::findOrFail($id);
         $categories = \App\Models\Category::all();
        return view('user.tickets.edit', compact('ticket', 'categories'));
    }

    public function ticketsUpdate(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'categorie_id' => $request->category_id,
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function ticketsDestroy(string $id): RedirectResponse
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('user.tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
