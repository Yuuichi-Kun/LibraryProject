<section class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden">
    <header class="p-6 bg-gray-50 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <div class="p-6">
        <form method="post" action="{{ route('password.update') }}" class="mt-4">
            @csrf
            @method('put')

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               id="current_password" name="current_password" placeholder="Current Password">
                        <label for="current_password">Current Password</label>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="New Password">
                        <label for="password">New Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Confirm New Password">
                        <label for="password_confirmation">Confirm New Password</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success py-2 px-3 mb-0 me-3">
                        <i class="fas fa-check-circle me-2"></i>Password updated successfully
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-key me-2"></i>Update Password
                </button>
            </div>
        </form>
    </div>
</section>
