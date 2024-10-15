<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Create the blog and assign the user_id from the authenticated user
        Blog::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => Auth::id(),  // Using Auth facade for user ID
        ]);

        // Redirect to the blog index page
        return redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if the user is an admin or the owner of the blog
        if (Auth::user()->role === 'admin' || Auth::id() === $blog->user_id) {
            return view('blogs.edit', compact('blog'));
        }

        return redirect()->route('blogs.index')->with('error', 'Unauthorized!');
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        // Update the blog with new data
        $blog->update($validatedData);

        return redirect()->route('blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Check if the user is an admin or the owner of the blog
        if (Auth::user()->role === 'admin' || Auth::id() === $blog->user_id) {
            $blog->delete();
            return redirect()->route('blogs.index');
        }

        return redirect()->route('blogs.index')->with('error', 'Unauthorized!');
    }
}

