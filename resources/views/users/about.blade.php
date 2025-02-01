@extends('layouts.user')

@section('content')
<section class="about-library section">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center mb-5">
            <h2>Profil Perpustakaan</h2>
        </div>

        @if($perpustakaan)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nama Perpustakaan</div>
                                <div class="col-md-8">{{ $perpustakaan->nama_perpustakaan }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Pustakawan</div>
                                <div class="col-md-8">{{ $perpustakaan->nama_pustakawan }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Alamat</div>
                                <div class="col-md-8">{{ $perpustakaan->alamat }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Email</div>
                                <div class="col-md-8">{{ $perpustakaan->email }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Website</div>
                                <div class="col-md-8">{{ $perpustakaan->website ?? '-' }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nomor Telepon</div>
                                <div class="col-md-8">{{ $perpustakaan->no_telp }}</div>
                            </div>

                            @if($perpustakaan->keterangan)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Keterangan</div>
                                <div class="col-md-8">{{ $perpustakaan->keterangan }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-info text-center">
            Data perpustakaan belum tersedia.
        </div>
        @endif
    </div>
</section>
@endsection 