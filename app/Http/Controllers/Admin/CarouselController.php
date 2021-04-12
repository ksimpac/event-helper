<?php

namespace app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Carousel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    private $carouselPath = 'public/image/carousel';

    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $path = $data['image']->store($this->carouselPath);
        Carousel::create(['path' => $path]);
        return redirect()->route('admin.carousel.index');
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $oldPath = Carousel::findOrFail($id)->path;
        $data = $this->validation($request);
        Storage::delete($oldPath);
        $path = $data['image']->store($this->carouselPath);
        Carousel::where('id', $id)->update(['path' => $path]);
        return redirect()->route('admin.carousel.index');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $oldPath = $carousel->path;
        Storage::delete($oldPath);
        $carousel->delete();
        return redirect()->route('admin.carousel.index');
    }

    private function validation(Request $request)
    {
        $data = $request->validate([
            'image' => [
                Rule::requiredIf(Route::currentRouteName() == 'admin.carousel.create'),
                'image', "dimensions:width=1999,height=664"
            ],
        ]);

        return $data;
    }
}
