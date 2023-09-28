<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy($id){
        $image = Image::find($id);
        if(!$image){
            return redirect()->back()->with('message', 'Image not found');
        }
        if($image->item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }     
        $image->delete();
        return redirect()->back()->with('message', 'Image successfully deleted');
    }

    public function mainPicture($id){
        $image = Image::find($id);
        if(!$image){
            return redirect()->back()->with('message', 'Image not found');
        }
        if($image->item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }       

        $itemId = $image->item->id;
        $images = Image::where('item_id', $itemId)->get();
        foreach($images as $img){
            if($img->is_main){
                $img->is_main = false;
                $img->save();
            }
        }

        $image->is_main = true;
        $image->save();
        return redirect()->back()->with('message', 'Image set as main successfully');
    }
}
