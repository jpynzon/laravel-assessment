<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        // Fetch all items from the database
        $items = Item::all();
        
        // Return items as JSON response
        return response()->json($items);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new item entry
        Item::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        // Return a success response
        return response()->json(['status' => 'success', 'message' => 'Item added successfully.']);
    }
}
