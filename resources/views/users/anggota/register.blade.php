@extends('layouts.user')

@section('content')
<section class="section">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-3">Daftar Anggota Perpustakaan</h2>
                            <p class="text-muted">Lengkapi form di bawah ini untuk mendaftar sebagai anggota perpustakaan</p>
                        </div>

                        <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select @error('id_jenis_anggota') is-invalid @enderror" 
                                                id="id_jenis_anggota" name="id_jenis_anggota">
                                            <option value="">Pilih Jenis Anggota</option>
                                            @foreach($jenisAnggota as $jenis)
                                                <option value="{{ $jenis->id_jenis_anggota }}" 
                                                    {{ old('id_jenis_anggota') == $jenis->id_jenis_anggota ? 'selected' : '' }}>
                                                    {{ $jenis->jenis_anggota }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label>Jenis Anggota</label>
                                        @error('id_jenis_anggota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror"
                                               id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota') }}"
                                               placeholder="Nama Lengkap">
                                        <label>Nama Lengkap</label>
                                        @error('nama_anggota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                               id="tempat" name="tempat" value="{{ old('tempat') }}"
                                               placeholder="Tempat Lahir">
                                        <label>Tempat Lahir</label>
                                        @error('tempat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                               id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                        <label>Tanggal Lahir</label>
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                                  id="alamat" name="alamat" style="height: 100px"
                                                  placeholder="Alamat">{{ old('alamat') }}</textarea>
                                        <label>Alamat Lengkap</label>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control @error('no_telp') is-invalid @enderror"
                                               id="no_telp" name="no_telp" value="{{ old('no_telp') }}"
                                               placeholder="Nomor Telepon">
                                        <label>Nomor Telepon</label>
                                        @error('no_telp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}"
                                               placeholder="Email">
                                        <label>Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                               id="username" name="username" value="{{ old('username') }}"
                                               placeholder="Username">
                                        <label>Username</label>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" placeholder="Password">
                                        <label>Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control"
                                               id="password_confirmation" name="password_confirmation"
                                               placeholder="Konfirmasi Password">
                                        <label>Konfirmasi Password</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                               id="foto" name="foto" accept="image/*">
                                        <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 10MB</small>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
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
document.getElementById('foto').addEventListener('change', function() {
    const fileSize = this.files[0].size / 1024 / 1024; // dalam MB
    if (fileSize > 10) {
        alert('Ukuran file terlalu besar. Maksimal 10MB');
        this.value = '';
    }
});
</script>
@endsection 