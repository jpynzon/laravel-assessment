<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
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

    public function show($id)
    {
        try {
            $item = Item::findOrFail($id);
            return response()->json(['item' => $item], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Item not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $item = Item::findOrFail($id);
            $item->name = $request->input('name');
            $item->description = $request->input('description');
            $item->save();

            return response()->json(['item' => $item], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Item not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return response()->json(['message' => 'Item deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Item not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete item'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}