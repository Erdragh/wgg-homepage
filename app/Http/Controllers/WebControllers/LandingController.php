<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Article;

class LandingController extends Controller
{
    /**
     * Index 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $slideCollection = Article::select('title', 'link', 'tags', 'thumbnail', 'published_on')
            // ->orderBy('published_on', 'desc')
            ->inRandomOrder()
            ->take(4)
            ->get();

        $slides = $slideCollection->map(function ($item, $key) {
            $item['thumbnail'] = '!!getImageByName!!'.$item['thumbnail'];
            return $item;
        })->toArray();

        // dd($slides);

        return Inertia::render('Landing', [
            'slides' => $slides
        ]);
    }
}
