<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        $user = Auth::user();
        $counts = [
            'books' => $user->books()->count(),
            'collections' => $user->collections()->count(),
            'devices' => $user->devices()->count()
        ];

        $lastestBooks = $user->books()->orderBy('created_at', 'desc')->limit(6)->get();

        if(!empty($request->get('search')))
        {
            $search = mb_strtolower($request->get('search'));
            $books = $user->books()->whereRaw('lower(title) like ?', ["%$search%"])
                                   ->orWhereRaw('lower(authors) like ?', ["%$search%"])
                                   ->orWhereRaw('lower(tags) like ?', ["%$search%"])
                                   ->orWhereRaw('lower(comments) like ?', ["%$search%"])->get();
            $collections = $user->collections()->whereRaw('lower(name) like ?', ["%$search%"])->get();
        }

        return view('home', compact('counts', 'lastestBooks', 'books', 'collections', 'search'));
    }
}
