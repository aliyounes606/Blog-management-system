<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBlogRequest;
use App\Http\Requests\EditBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('categories:id,name')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::select('id', 'name')->get();
        return view('blogs.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBlogRequest $request)
    {
        $validated = $request->validated();

        $filename = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $extension = strtolower($image->extension());

            $filename = time() . rand(1, 1000) . "." . $extension;

            $image->storeAs('uploads', $filename, 'local');
        }

        $blog = Blog::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $filename,
        ]);
        $blog->categories()->sync($request->input('category_ids', []));

        return redirect()->route('blogs.index')->with(['success' => 'The blog was successfully created']);
    }
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::select('id', 'name')->get();
        $data = Blog::find($id);
        if (empty($data)) {
            return redirect()->route('blogs.index')->with(['error' => 'Unable to access data']);
        }
        return view('blogs.edit', compact('data', 'category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();

        $category_ids = $validated['category_ids'];
        unset($validated['category_ids']);

        if ($request->hasFile('image')) {

            if ($blog->image) {
                Storage::disk('local')->delete('uploads/' . $blog->image);
            }

            $image = $request->file('image');
            $extension = strtolower($image->extension());
            $filename = time() . rand(1, 1000) . "." . $extension;
            $image->storeAs('uploads', $filename, 'local');

            $validated['image'] = $filename;

        }

        $blog->update(array_filter([
            'title' => $validated['title'] ?? $blog->title,
            'content' => $validated['content'] ?? $blog->content,
            'image' => $filename ?? $blog->image

        ]));

        $blog->categories()->sync($category_ids);

        return redirect()->route('blogs.index')->with(['success' => 'The blog has been successfully updated.']);
    }


    //soft delete
    public function Softdelete($id)
    {

        Blog::where('id', '=', $id)->delete();
        return redirect()->route('blogs.index')->with(['success' => 'The blog has been temporarily deleted']);
    }
    public function status()
    {
        $blogs = Blog::withTrashed()->select('id', 'title', 'deleted_at')->get();
        return view('blogs.status', compact('blogs'));

    }
    public function restore($id)
    {
        Blog::where('id', '=', $id)->restore();
        return redirect()->route('status')->with(key: ['success' => 'The blog has been successfully restored']);

    }

    public function destroy($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);

        if ($blog->image) {

            $filePath = 'uploads/' . $blog->image;

            if (Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
            }
        }

        $blog->forceDelete();

        return redirect()->route('status')->with(['success' => 'The blog has been successfully deleted']);
    }



    //  دالة المفضلة 
    public function toggleFavor(Request $request, Blog $blog)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $toggleResult = $user->favors()->toggle($blog->id);

        $action = count($toggleResult['attached']) > 0 ? 'added' : 'removed';

        return redirect()->back()->with(
            'success',
            $action === 'added' ? 'The blog has been successfully added to favorites!' : 'The blog has been removed from favorites.'
        );
    }

    public function myFavors()
    {
        $user = Auth::user();

        $favoredBlogs = $user->favors()
            ->with('categories')
            ->get();

        return view('favors', [
            'blogs' => $favoredBlogs,
        ]);
    }
}
