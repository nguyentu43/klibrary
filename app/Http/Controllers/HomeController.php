<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Book, Collection, Device };

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $counts = [
            'books' => Book::count(),
            'collections' => Collection::count(),
            'devices' => Device::count()
        ];

        $books = Book::orderBy('created_at', 'desc')->limit(6)->get();
        return view('home', compact('counts', 'books'));
    }
}
