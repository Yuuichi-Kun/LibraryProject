@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Manajemen Transaksi</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Transaksi</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
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
                                    <th>Status Approval</th>
                                    <th>Status Peminjaman</th>
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
                                        <td>{{ $t->tgl_pinjam_formatted }}</td>
                                        <td>{{ $t->tgl_kembali_formatted }}</td>
                                        <td>
                                            @if($t->status_approval == 'pending')
                                                <span class="badge bg-warning">Menunggu Persetujuan</span>
                                            @elseif($t->status_approval == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger" 
                                                      data-bs-toggle="tooltip" 
                                                      title="{{ $t->reject_reason }}">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($t->tgl_pengembalian)
                                                <span class="badge bg-info">Dikembalikan</span>
                                            @elseif($t->status_approval == 'approved')
                                                @if($t->isOverdue())
                                                    <span class="badge bg-danger">Terlambat</span>
                                                @else
                                                    <span class="badge bg-primary">Dipinjam</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{ $t->tgl_pengembalian_formatted }}
                                        </td>
                                        <td>
                                            @if($t->status_approval == 'pending')
                                                <form action="{{ route('admin.transaksi.approve', $t->id_transaksi) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Setujui peminjaman ini?')">
                                                        <i class="bi bi-check-circle"></i> Setujui
                                                    </button>
                                                </form>

                                                <button type="button" class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#rejectModal{{ $t->id_transaksi }}">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>

                                                <!-- Modal Reject -->
                                                <div class="modal fade" id="rejectModal{{ $t->id_transaksi }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.transaksi.reject', $t->id_transaksi) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tolak Peminjaman</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="reject_reason" class="form-label">Alasan Penolakan</label>
                                                                        <textarea class="form-control" id="reject_reason" name="reject_reason" 
                                                                                  rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">Tolak Peminjaman</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
@endsection 