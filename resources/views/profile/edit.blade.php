@extends('layouts.adminApp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body text-center p-5">
                    <div class="position-relative mb-4 mx-auto" style="width: 150px;">
                        @if(Auth::user()->avatar)
                            <img class="rounded-circle border-4 border-primary" 
                                 src="/avatars/{{ Auth::user()->avatar }}" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img class="rounded-circle border-4 border-primary" 
                                 src="{{ asset('/img/default_profile.png') }}" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <button class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0"
                                data-bs-toggle="modal" data-bs-target="#avatarModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-4">{{ Auth::user()->email }}</p>
                    <div class="d-grid">
                        <button class="btn btn-outline-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash-alt me-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Profile Information Form -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user-edit me-2 text-primary"></i>
                        Profile Information
                    </h5>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Form -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-lock me-2 text-primary"></i>
                        Security Settings
                    </h5>
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Avatar Upload Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Update Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="avatar-preview" 
                                 src="{{ Auth::user()->avatar ? '/avatars/'.Auth::user()->avatar : asset('/img/default_profile.png') }}"
                                 class="rounded-circle border-4 border-light shadow"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Choose Image</label>
                        <input type="file" class="form-control" name="avatar" id="avatar-input" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Upload New Picture
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-danger text-white">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                    <h5 class="fw-bold">Are you sure?</h5>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview avatar image before upload
    document.getElementById('avatar-input').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endpush
@endsection
