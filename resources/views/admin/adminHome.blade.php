@extends('layouts.admin')

@section('content')
<div class="pagetitle">
      <h1>Library Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Library Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">

            <!-- Books Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total Books</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalBooks }}</h6>
                      <span class="text-{{ $bookIncrease > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ number_format($bookIncrease, 1) }}%</span> 
                      <span class="text-muted small pt-2 ps-1">this month</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Members Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Active Members</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalMembers }}</h6>
                      <span class="text-{{ $memberIncrease > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ number_format($memberIncrease, 1) }}%</span>
                      <span class="text-muted small pt-2 ps-1">this month</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Borrowed Books Card -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Borrowed Books</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-arrow-up"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $borrowedBooks }}</h6>
                      <span class="text-{{ $borrowIncrease > 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ number_format($borrowIncrease, 1) }}%</span>
                      <span class="text-muted small pt-2 ps-1">this month</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recent Borrows -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Recent Borrows</h5>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Member</th>
                        <th scope="col">Book Title</th>
                        <th scope="col">Borrow Date</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentBorrows as $borrow)
                      <tr>
                        <th scope="row"><a href="#">#{{ $borrow->id_transaksi }}</a></th>
                        <td>{{ $borrow->anggota->nama_anggota }}</td>
                        <td><a href="#" class="text-primary">{{ $borrow->pustaka->judul_pustaka }}</a></td>
                        <td>{{ $borrow->tgl_pinjam_formatted }}</td>
                        <td>{{ $borrow->tgl_kembali_formatted }}</td>
                        <td>
                          @if($borrow->tgl_pengembalian)
                            <span class="badge bg-info">Returned</span>
                          @elseif($borrow->isOverdue())
                            <span class="badge bg-danger">Overdue</span>
                          @else
                            <span class="badge bg-success">On Time</span>
                          @endif
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center">No recent borrows</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Popular Books -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Most Popular Books</h5>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Times Borrowed</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($popularBooks as $book)
                      <tr>
                        <th scope="row">
                          <a href="#">
                            @if($book->gambar)
                              <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul_pustaka }}">
                            @else
                              <img src="{{ asset('assets/img/no-cover.jpg') }}" alt="No Cover">
                            @endif
                          </a>
                        </th>
                        <td><a href="#" class="text-primary fw-bold">{{ $book->judul_pustaka }}</a></td>
                        <td>{{ $book->pengarang->nama_pengarang }}</td>
                        <td>{{ $book->ddc->ddc }}</td>
                        <td class="fw-bold">{{ $book->transaksi_count }}</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5" class="text-center">No books borrowed yet</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- Recent Activity -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent Activity</h5>
              <div class="activity">
                @forelse($recentActivities as $activity)
                  <div class="activity-item d-flex">
                    <div class="activite-label">{{ $activity->created_at->diffForHumans() }}</div>
                    <i class='bi bi-circle-fill activity-badge 
                      {{ $activity->status_approval == "approved" ? "text-success" : 
                        ($activity->status_approval == "rejected" ? "text-danger" : "text-warning") }} 
                      align-self-start'></i>
                    <div class="activity-content">
                      {{ $activity->anggota->nama_anggota }} 
                      @if($activity->status_approval == 'pending')
                        requested to borrow
                      @elseif($activity->status_approval == 'approved')
                        borrowed
                      @else
                        was rejected to borrow
                      @endif
                      <a href="#" class="fw-bold text-dark">{{ $activity->pustaka->judul_pustaka }}</a>
                    </div>
                  </div>
                @empty
                  <div class="text-center py-3">No recent activities</div>
                @endforelse
              </div>
            </div>
          </div>

          <!-- Due Returns -->
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Due Returns Today</h5>
              <div class="news">
                @forelse($dueReturns as $return)
                  <div class="post-item clearfix">
                    <h4><a href="#">{{ $return->pustaka->judul_pustaka }}</a></h4>
                    <p>
                      Borrowed by: {{ $return->anggota->nama_anggota }}<br>
                      Due: {{ $return->tgl_kembali_formatted }}
                    </p>
                  </div>
                @empty
                  <div class="text-center py-3">No books due today</div>
                @endforelse
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection
