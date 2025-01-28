@extends('layouts.user')

@section('content')
<section class="section">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-3">Form Peminjaman Buku</h2>
                            <p class="text-muted">Silakan lengkapi form berikut untuk mengajukan peminjaman buku</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="book-details mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($pustaka->gambar)
                                        <img src="{{ asset($pustaka->gambar) }}" class="img-fluid rounded" alt="{{ $pustaka->judul_pustaka }}">
                                    @else
                                        <img src="{{ asset('assets/img/default-book.png') }}" class="img-fluid rounded" alt="Default Book Image">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h4 class="mb-3">{{ $pustaka->judul_pustaka }}</h4>
                                    <p><strong>Pengarang:</strong> {{ $pustaka->pengarang->nama_pengarang }}</p>
                                    <p><strong>Penerbit:</strong> {{ $pustaka->penerbit->nama_penerbit }}</p>
                                    <p><strong>Tahun Terbit:</strong> {{ $pustaka->tahun_terbit }}</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_pustaka" value="{{ $pustaka->id_pustaka }}">
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" 
                                               id="tgl_pinjam" name="tgl_pinjam" 
                                               min="{{ date('Y-m-d') }}" 
                                               value="{{ old('tgl_pinjam', date('Y-m-d')) }}">
                                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                                        @error('tgl_pinjam')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror" 
                                               id="tgl_kembali" name="tgl_kembali" 
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               value="{{ old('tgl_kembali', date('Y-m-d', strtotime('+7 days'))) }}">
                                        <label for="tgl_kembali">Tanggal Kembali</label>
                                        @error('tgl_kembali')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-book me-2"></i>Ajukan Peminjaman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('tgl_pinjam').addEventListener('change', function() {
    const tglPinjam = new Date(this.value);
    const minKembali = new Date(tglPinjam);
    minKembali.setDate(minKembali.getDate() + 1);
    
    const tglKembaliInput = document.getElementById('tgl_kembali');
    tglKembaliInput.min = minKembali.toISOString().split('T')[0];
    
    if (new Date(tglKembaliInput.value) <= tglPinjam) {
        tglKembaliInput.value = minKembali.toISOString().split('T')[0];
    }
});
</script>
@endsection