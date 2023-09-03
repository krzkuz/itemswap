<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(){
        return view('items.index', [
            'items' => Item::all(),
        ]);
    }

    public function show(Item $item){
        return view('items.show', [
            'item' => $item
        ]);
    }

    public function manage(){ 
        return view('items.manage', [
            'items' => auth()->user()->items()->get()
        ]);
    }

    public function create(){
        return view('items.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
        
        $formFields['user_id'] = auth()->id();

        Item::create($formFields);
        return redirect('/')->with('message', 'You have created a listing');
    }
}
