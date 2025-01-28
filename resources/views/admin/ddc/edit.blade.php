@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Edit DDC</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit DDC</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ddc.update', $ddc->id_ddc) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Rak</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_rak" required>
                                    <option value="">Pilih Rak</option>
                                    @foreach($raks as $rak)
                                        <option value="{{ $rak->id_rak }}" {{ $ddc->id_rak == $rak->id_rak ? 'selected' : '' }}>
                                            {{ $rak->rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode DDC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_ddc" value="{{ $ddc->kode_ddc }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">DDC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ddc" value="{{ $ddc->ddc }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan">{{ $ddc->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('ddc.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 