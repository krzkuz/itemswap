<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Swap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SwapController extends Controller
{
    public function all(){
        $user = auth()->user();
        $swapsSent = $user->swapsSent()
            ->with('ownerB', 'itemA', 'itemB')
            ->with(['itemA.images'  => function($query){
                $query->first();
            }])
            ->with(['itemB.images'  => function($query){
                $query->first();
            }])
            ->get();
        $swapsReceived = $user->swapsReceived()
            ->with('ownerB', 'itemA', 'itemB')
            ->with(['itemA.images'  => function($query){
                $query->first();
            }])
            ->with(['itemB.images'  => function($query){
                $query->first();
            }])
            ->get();

        return view('swaps.all', [
            'swapsSent' => $swapsSent,
            'swapsReceived' => $swapsReceived
        ]);
    }

    public function create($itemId){
        $userId = auth()->id();
        $requestedItem = Item::find($itemId);
        $userItems = Item::where('user_id', $userId)
            ->with(['images' => function($query){
            $query->first();
            }])
            ->get();

        return view('swaps.create', [
            'userItems' => $userItems,
            'requestedItem' => $requestedItem
        ]);
    }

    public function store(Request $request){
        $itemB = $request['offeredItemId'];
        $itemA = $request['requestedItemId'];
        $ownerA = $request['requestedItemOwner'];
        $ownerB = auth()->id();

        $swap = Swap::firstOrCreate([
            'owner_a' => $ownerA,
            'owner_b' => $ownerB,
            'item_a' => $itemA,
            'item_b' => $itemB
        ]);

        if($swap->wasRecentlyCreated){
            return redirect()->route('home')->with('message', 'You have sent a swap request');
        }

        return redirect()->back()->with('message', 'You have already sent this swap request');
    }

    public function show($id){
        $swap = Swap::with('ownerA', 'ownerB', 'itemA', 'itemB')
            ->with(['itemA.images'  => function($query){
                $query->first();
            }])
            ->with(['itemB.images'  => function($query){
                $query->first();
            }])
            ->find($id);

        return view('swaps.show', [
            'swap' => $swap
        ]);
    }

    public function confirm($id){
        $swap = Swap::find($id);
        $swap->is_confirmed = true;
        $swap->save();
        
        return redirect()->route('show-swap', ['swap' => $id])->with('message', 'You have confirmed this swap request');
    }
}
