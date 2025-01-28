<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="row g-4">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" placeholder="Your Name"
                       value="{{ old('name', $user->name) }}">
                <label for="name">Full Name</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" placeholder="name@example.com"
                       value="{{ old('email', $user->email) }}">
                <label for="email">Email Address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success py-2 px-3 mb-0 me-3">
                <i class="fas fa-check-circle me-2"></i>Profile updated successfully
            </div>
        @endif
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-2"></i>Save Changes
        </button>
    </div>
</form>