@extends('layouts.user')

@section('content')
<section class="section">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">Daftar Transaksi</h2>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Peminjam</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksi as $index => $t)
                                        <tr>
                                            <td>{{ $transaksi->firstItem() + $index }}</td>
                                            <td>{{ $t->pustaka->judul_pustaka }}</td>
                                            <td>{{ $t->anggota->nama_anggota }}</td>
                                            <td>{{ \Carbon\Carbon::parse($t->tgl_pinjam)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($t->tgl_kembali)->format('d/m/Y') }}</td>
                                            <td>
                                                @if($t->status_approval == 'pending')
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                @elseif($t->status_approval == 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($t->tgl_pengembalian)
                                                    {{ \Carbon\Carbon::parse($t->tgl_pengembalian)->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($t->status_approval == 'approved' && !$t->tgl_pengembalian)
                                                    <form action="{{ route('transaksi.return', ['id' => $t->id_transaksi]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                            Kembalikan
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                Belum ada data transaksi
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            {{ $transaksi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 