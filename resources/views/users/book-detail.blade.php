@extends('layouts.user')

@section('content')
<section class="book-detail section" data-aos="fade-up" data-aos-delay="100" style="margin-top: 70px;">
  <div class="container" data-aos="fade-up">
    <div class="row gy-4">
      <div class="col-lg-4">
        <div class="book-image">
          @if($book->gambar)
            <img src="{{ asset($book->gambar) }}" class="img-fluid" alt="{{ $book->judul_pustaka }}">
          @else
            <img src="{{ asset('assets/img/default-book.png') }}" class="img-fluid" alt="Default Book Image">
          @endif
        </div>
      </div>
      
      <div class="col-lg-8">
        <div class="book-info">
          <h2>{{ $book->judul_pustaka }}</h2>
          <div class="book-meta">
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Pengarang:</strong> {{ $book->pengarang->nama_pengarang }}</p>
            <p><strong>Penerbit:</strong> {{ $book->penerbit->nama_penerbit }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
            <p><strong>Format:</strong> {{ $book->format->format }}</p>
            <p><strong>Kategori DDC:</strong> {{ $book->ddc->ddc }}</p>
            <p><strong>Keyword:</strong> {{ $book->keyword }}</p>
          </div>
          
          <div class="book-description mt-4">
            <h4>Keterangan Fisik</h4>
            <p>{{ $book->keterangan_fisik ?: 'Tidak ada keterangan' }}</p>
            
            <h4>Keterangan Tambahan</h4>
            <p>{{ $book->keterangan_tambahan ?: 'Tidak ada keterangan' }}</p>
            
            <h4>Abstraksi</h4>
            <p>{{ $book->abstraksi ?: 'Tidak ada abstraksi' }}</p>
          </div>
          
          <div class="book-availability mt-4">
            <h4>Informasi Ketersediaan</h4>
            <p><strong>Status:</strong> {{ $book->fp == 1 ? 'Tersedia' : 'Tidak Tersedia' }}</p>
            <p><strong>Jumlah Dipinjam:</strong> {{ $book->jml_pinjam }} kali</p>
          </div>
          
          <div class="row">
          <div class="mt-4">
            <a href="{{ route('transaksi.create', $book->id_pustaka) }}" class="btn btn-primary">Pinjam Buku</a>
          </div>
          <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection 