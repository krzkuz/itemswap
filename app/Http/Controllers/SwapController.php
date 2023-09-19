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
                $query->orderBy('is_main', 'desc')->first();
            }])
            ->with(['itemB.images'  => function($query){
                $query->orderBy('is_main', 'desc')->first();
            }])
            ->get();
        $swapsReceived = $user->swapsReceived()
            ->with('ownerB', 'itemA', 'itemB')
            ->with(['itemA.images'  => function($query){
                $query->orderBy('is_main', 'desc')->first();
            }])
            ->with(['itemB.images'  => function($query){
                $query->orderBy('is_main', 'desc')->first();
            }])
            ->get();
        // dd($swapsSent, $swapsReceived);
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
            $query->orderBy('is_main', 'desc')->first();
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

        Swap::create([
            'owner_a' => $ownerA,
            'owner_b' => $ownerB,
            'item_a' => $itemA,
            'item_b' => $itemB
        ]);

        return redirect()->route('home')->with('message', 'You have sent a swap request');
    }

    public function show($id){
        $swap = Swap::with('ownerA', 'ownerB', 'itemA', 'itemB')
        ->with(['itemA.images'  => function($query){
            $query->orderBy('is_main', 'desc')->first();
        }])
        ->with(['itemB.images'  => function($query){
            $query->orderBy('is_main', 'desc')->first();
        }])
        ->find($id);

        return view('swaps.show', [
            'swap' => $swap
        ]);
        // $ownerA = $swap->ownerA;
        // $ownerB = $swap->ownerB;
        // $itemA = $swap->itemA;
        // $itemB = $swap->itemB;
        // $itemAImages = $itemA->images;
        // $itemBImages = $itemB->images;



    }
}
