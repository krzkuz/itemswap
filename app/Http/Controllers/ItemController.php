<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Intervention\Image\Facades\Image as Img;

class ItemController extends Controller
{
    public function index(){
        $currentUserId = auth()->id();
        $items = Item::with('images')->latest()
            ->filter(request(['tag', 'search', 'location']))
            ->paginate(6);

        foreach($items as $item){
            if(strlen($item->name)>50){
                $item->name = substr($item->name, 0, 50) . '...';
            }
        }
        return view('items.index', [
            'items' => $items,
            'currentUserId' => $currentUserId,
        ]);
    }

    public function show(Item $item){
        $currentUserId = auth()->id();

        return view('items.show', [
            'item' => $item,
            'currentUserId' => $currentUserId,
        ]);
    }

    public function manage(){ 
        $currentUserId = auth()->id();
        $items = auth()->user()->items()->latest()
            ->with('images')
            ->paginate(6);

        return view('items.manage', [
            'items' => $items,
            'currentUserId' => $currentUserId,
        ]);
    }

    public function create(){
        $user =  auth()->user();
        if(!$user->first_name){
            return redirect()->route('edit-profile')->with('message', 'You have to add your personal data in order to post a listing');
        }
        return view('items.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,jpg,png'
        ]);        

        $formFields['user_id'] = auth()->id();

        $item = Item::create($formFields);
        if($request->hasFile('images')){
            $firstIteration = true;
            foreach($request->file('images') as $image){
                $originalImagePath = $image->store('images', 'public');
                $croppedImage = Img::make($image);
                $croppedImage->orientate();

                $width = $croppedImage->width();
                $height = $croppedImage->height();
                // Determine the size of the square crop
                $size = min($width, $height);
                // Calculate the crop position (centered)
                $x = ($width - $size) / 2;
                $y = ($height - $size) / 2;
                // Crop the image to a square
                $croppedImage->crop($size, $size, (int)$x, (int)$y)->encode('jpg');

                $croppedImagePath = 'storage/images/cropped/' . uniqid() . '.jpg';
                $croppedImage->save(public_path($croppedImagePath));
                $newImage = new Image([
                    'image_path' => $originalImagePath,
                    'cropped_image_path' => $croppedImagePath
                ]);

                if($firstIteration){
                    $newImage->is_main = true;
                }
                $firstIteration = false;
                $item->images()->save($newImage);
            }
        }

        $tags = explode(',', $formFields['tags']);
        foreach($tags as $tag){
            $newTag = Tag::firstOrCreate(['name' => $tag]);
            $item->tags()->attach($newTag->id);
        }

        if(session('backLink')){
            $link = session('backLink');
            session()->forget('backLink');
            return redirect($link);
        }
        
        return redirect()->route('home')->with('message', 'You have created a listing');
    }

    public function edit(Item $item){
        if($item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $tagNames = $item->tags->pluck('name')->toArray();
        $images = $item->images()->get();
        return view('items.edit', [
            'item' => $item,
            'images' => $images,
            'tags' => implode(',', $tagNames)
        ]);
    }

    public function update(Request $request, Item $item){
        if($item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,jpg,png'
        ]);

        //Delete old tags
        $item->tags()->detach();
        $tags = explode(',', $formFields['tags']);
        foreach($tags as $tag){
            $newTag = Tag::firstOrCreate(['name' => $tag]);
            $item->tags()->attach($newTag->id);
        }

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $originalImagePath = $image->store('images', 'public');
                $croppedImage = Img::make($image);
                $croppedImage->orientate();

                $width = $croppedImage->width();
                $height = $croppedImage->height();
                // Determine the size of the square crop
                $size = min($width, $height);
                // Calculate the crop position (centered)
                $x = ($width - $size) / 2;
                $y = ($height - $size) / 2;
                // Crop the image to a square
                $croppedImage->crop($size, $size, (int)$x, (int)$y)->encode('jpg');

                $croppedImagePath = 'storage/images/cropped/' . uniqid() . '.jpg';
                $croppedImage->save(public_path($croppedImagePath));
                $newImage = new Image([
                    'image_path' => $originalImagePath,
                    'cropped_image_path' => $croppedImagePath
                ]);
                $item->images()->save($newImage);
            }
        }
        
        $item->update($formFields);

        return redirect()->route('show-listing', ['item' => $item->id])->with('message', 'Listing updated successfully');
    }

    public function delete(Item $item){
        if($item->owner->id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $item->delete();
        return redirect()->route('home')->with('message', 'Listing deleted successfully');
    }
}
