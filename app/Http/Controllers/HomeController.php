<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pustaka;

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
        // Hapus middleware auth agar bisa diakses tanpa login
        $latestBooks = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
                         ->orderBy('created_at', 'desc')
                         ->take(3)
                         ->get();
    
        return view('users.home', [
            'latestBooks' => $latestBooks
        ]);
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        return view('admin.adminHome');
    }

    public function showBook($id)
    {
        $book = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
                       ->findOrFail($id);
        
        return view('users.book-detail', compact('book'));
    }
}
