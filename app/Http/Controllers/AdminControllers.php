<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;

class AdminControllers extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function categoriesIndex(): View
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function categoriesCreate(): View
    {
        return view('admin.categories.create');
    }

    public function categoriesStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function categoriesEdit(string $id): View
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function categoriesUpdate(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function categoriesDestroy(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function ticketsIndex(): View
    {
        $tickets = Ticket::all();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function ticketsEdit(string $id): View
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::where('role', 'agent')->get();
        return view('admin.tickets.edit', compact('ticket', 'users'));
    }

    public function ticketsUpdate(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:open,closed,pending',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'status' => $request->status,
            'agent_id' => $request->agent_id,
        ]);

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket updated successfully.');
    }
}
