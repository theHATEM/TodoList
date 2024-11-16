<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TodoItem;
use Validator;

class TodoItemsController extends Controller
{
    public function getAll() {

        $items = TodoItem::all();
        return response()->json($items);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            "name" => "string|required|max:255", 
        ]);
            
        $validatedData['user_id'] = auth()->id(); 

        $newItem = TodoItem::create($validatedData); 

        return response()->json($newItem, 201); 

    }

    public function showAllItems() {
        return response()->json(auth()->user()->todoItems, 200); 
    }

    public function show($id) {
        $foundItem = TodoItem::where('id', $id)->first();

        if ($foundItem) {
            return response()->json($foundItem, 200); 
        }
        return response()->json(['message' => 'Item not found'], 404); 
    }

    public function deleteItem($id) {
        $foundItem = TodoItem::where('id', $id)->first(); 
        if ($foundItem) {
            $foundItem->delete(); 
            return response()->json(['message' => 'Item deleted successfully'], 200); 
        }
        return response()->json(['message' => 'Item not found'], 404); 
    }

    public function updateItem(Request $request, $id) {
        $foundItem = TodoItem::where('id', $id)->first(); 

        if ($foundItem) {
            $request->validate([
                'name' => 'string|max:255|required',
            ]);

            $foundItem->name = $request->name; 
            $foundItem->save(); 
            return response()->json(['message' => 'Item updated successfully', 'item' => $foundItem]);
        }
        return response()->json(['message' => 'Item not found'], 404); 
    }
}
