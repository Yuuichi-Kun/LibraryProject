@extends('layouts.user')

@section('content')
<section class="section">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="card-title mb-0">Riwayat Transaksi</h2>
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
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksi as $index => $t)
                                        <tr>
                                            <td>{{ $transaksi->firstItem() + $index }}</td>
                                            <td>{{ $t->pustaka->judul_pustaka }}</td>
                                            <td>{{ $t->tgl_pinjam_formatted }}</td>
                                            <td>{{ $t->tgl_kembali_formatted }}</td>
                                            <td>
                                                @if($t->status_approval == 'pending')
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                @elseif($t->status_approval == 'approved')
                                                    @if($t->tgl_pengembalian)
                                                        <span class="badge bg-info">Dikembalikan</span>
                                                    @elseif($t->isOverdue())
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    @else
                                                        <span class="badge bg-primary">Dipinjam</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-danger" 
                                                          data-bs-toggle="tooltip" 
                                                          title="{{ $t->reject_reason }}">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $t->tgl_pengembalian_formatted }}</td>
                                            <td>
                                                @if($t->status_approval == 'rejected')
                                                    <i class="bi bi-info-circle text-danger" 
                                                       data-bs-toggle="tooltip" 
                                                       title="{{ $t->reject_reason }}"></i>
                                                    {{ Str::limit($t->reject_reason, 30) }}
                                                @elseif($t->isOverdue() && !$t->tgl_pengembalian)
                                                    <span class="text-danger">
                                                        Terlambat {{ now()->diffInDays($t->tgl_kembali) }} hari
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                Belum ada riwayat transaksi
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