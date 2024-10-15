<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve all blogs with their user relationship
        $blogs = Blog::with('user')->get();

        // Pass blogs to the dashboard view
        return view('dashboard', compact('blogs'));
    }
}
