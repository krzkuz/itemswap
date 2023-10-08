<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class ImageController extends Controller
{
    public function destroy(int $id) : RedirectResponse {
        $image = Image::find($id);
        if(!$image){
            return redirect()
                ->back()
                ->with('message', 'Image not found');
        }
        if($image->item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }     
        $image->delete();

        return redirect()
            ->back()
            ->with('message', 'Image successfully deleted');
    }

    public function mainPicture(int $id) : RedirectResponse {
        $image = Image::find($id);
        if(!$image){
            return redirect()
                ->back()
                ->with('message', 'Image not found');
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

        return redirect()
            ->back()
            ->with('message', 'Image set as main successfully');
    }
}
