<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;

class SlidesController extends Controller
{

    /**
     * The image manager instance.
     *
     * @var ImageManager
     */
    protected $images;

    /**
     * Create a new interaction instance.
     *
     * @param  ImageManager  $images
     * @return void
     */
    public function __construct(ImageManager $images)
    {
        $this->images = $images;
    }

    public function edit()
    {
        return view('administrator.slides');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_slide' => 'image|max:4000',
            'second_slide' => 'image|max:4000',
            'third_slide' => 'image|max:4000',
        ]);

        $disk = Storage::disk('public');

        if ($request->hasFile('first_slide')) {
            $file = $request->first_slide;                    
            $url = $disk->put(
                config('client').'/first_slide.jpg', (string) $this->images->make($file->path())->encode()
            );
        }

        if ($request->hasFile('second_slide')) {
            $file = $request->second_slide;                    
            $url = $disk->put(
                config('client').'/second_slide.jpg', (string) $this->images->make($file->path())->encode()
            );
        }

        if ($request->hasFile('third_slide')) {
            $file = $request->third_slide;                    
            $url = $disk->put(
                config('client').'/third_slide.jpg', (string) $this->images->make($file->path())->encode()
            );
        }
        

        return redirect()->back()->with('success', trans('general.x_has_been_updated', ['x' => trans('general.login_slides')]));        
    }
}
