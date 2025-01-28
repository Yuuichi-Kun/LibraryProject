@extends('layouts.user')

@section('content')
<section class="books-catalog section">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center mb-5">
            <h2>Katalog Buku</h2>
            <p>Temukan Koleksi Buku Kami</p>
        </div>

        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form action="{{ route('books.index') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" name="search" 
                               placeholder="Cari judul buku, pengarang, atau kata kunci..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Books Grid -->
        <div class="row gy-4">
            @forelse($books as $book)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <a href="{{ route('book.show', $book->id_pustaka) }}" class="text-decoration-none">
                            <div class="book-cover">
                                @if($book->gambar)
                                    <img src="{{ asset($book->gambar) }}" class="card-img-top" 
                                         alt="{{ $book->judul_pustaka }}"
                                         style="height: 300px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default-book.png') }}" 
                                         class="card-img-top" alt="Default Book Image"
                                         style="height: 300px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ Str::limit($book->judul_pustaka, 50) }}</h5>
                                <p class="card-text text-muted">
                                    <small>
                                        <strong>Pengarang:</strong> {{ $book->pengarang->nama_pengarang ?? 'Tidak ada data' }}<br>
                                        <strong>Penerbit:</strong> {{ $book->penerbit->nama_penerbit ?? 'Tidak ada data' }}<br>
                                        <strong>Tahun:</strong> {{ $book->tahun_terbit }}
                                    </small>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Tidak ada buku yang ditemukan.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.books-catalog {
    padding: 80px 0;
    min-height: 100vh;
}
.card {
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.card:hover {
    transform: translateY(-5px);
}
.search-form .form-control {
    border-radius: 50px 0 0 50px;
    padding: 10px 20px;
}
.search-form .btn {
    border-radius: 0 50px 50px 0;
    padding: 10px 30px;
}
</style>
@endsection 