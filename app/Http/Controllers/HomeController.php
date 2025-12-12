<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::select('id', 'name')->get();

        $query = Blog::query();

        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;

            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        $blogs = $query->with('categories')->with([
            'favoredBy' => function ($query) {
                $query->where('user_id', auth()->id());
            }
        ])->paginate(5);


        return view('home', compact('blogs', 'categories'));
    }

    public function back_blogs_index()
    {
        return redirect()->route('blogs.index');
    }
    public function back_categories_index()
    {
        return redirect()->route('categories.index');
    }
}
