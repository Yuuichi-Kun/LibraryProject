<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pustaka;
use App\Models\Perpustakaan;
use App\Models\Anggota;
use App\Models\Transaksi;

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
        // Get total books count and percentage increase
        $totalBooks = Pustaka::count();
        $lastMonthBooks = Pustaka::where('created_at', '>=', now()->subMonth())->count();
        $bookIncrease = $totalBooks > 0 ? ($lastMonthBooks / $totalBooks) * 100 : 0;

        // Get active members count and percentage increase
        $totalMembers = Anggota::where('fa', 'Y')->count();
        $lastMonthMembers = Anggota::where('fa', 'Y')
            ->where('created_at', '>=', now()->subMonth())
            ->count();
        $memberIncrease = $totalMembers > 0 ? ($lastMonthMembers / $totalMembers) * 100 : 0;

        // Get borrowed books this month
        $borrowedBooks = Transaksi::whereNull('tgl_pengembalian')
            ->where('status_approval', 'approved')
            ->count();
        $lastMonthBorrowed = Transaksi::whereNull('tgl_pengembalian')
            ->where('status_approval', 'approved')
            ->where('created_at', '>=', now()->subMonth())
            ->count();
        $borrowIncrease = $borrowedBooks > 0 ? ($lastMonthBorrowed / $borrowedBooks) * 100 : 0;

        // Get recent borrows
        $recentBorrows = Transaksi::with(['pustaka', 'anggota'])
            ->where('status_approval', 'approved')
            ->latest()
            ->take(5)
            ->get();

        // Get popular books
        $popularBooks = Pustaka::withCount(['transaksi' => function($query) {
                $query->where('status_approval', 'approved');
            }])
            ->orderByDesc('transaksi_count')
            ->take(5)
            ->get();

        // Get recent activities
        $recentActivities = Transaksi::with(['pustaka', 'anggota'])
            ->latest()
            ->take(5)
            ->get();

        // Get due returns today
        $dueReturns = Transaksi::with(['pustaka', 'anggota'])
            ->whereNull('tgl_pengembalian')
            ->where('status_approval', 'approved')
            ->whereDate('tgl_kembali', now())
            ->get();

        return view('admin.adminHome', compact(
            'totalBooks',
            'bookIncrease',
            'totalMembers',
            'memberIncrease',
            'borrowedBooks',
            'borrowIncrease',
            'recentBorrows',
            'popularBooks',
            'recentActivities',
            'dueReturns'
        ));
    }

    public function showBook($id)
    {
        $book = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])
                       ->findOrFail($id);
        
        return view('users.book-detail', compact('book'));
    }
}
