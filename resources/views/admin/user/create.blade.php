@extends('layout.backend.app',[
'title' => 'Manage User',
'pageTitle' =>'Manage User',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
@if(session()->get('error'))
<div class="notify">

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif


<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Add User</h5>
    </div>
    <div class="card-body">
        <form id="createForm" action="{{ route('user.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" required=id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="p">Password</label>
                <input type="password" required="" id="p" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="r">Role</label>
                <select name="role" id="r" class="form-control">
                    <option disabled="">- PILIH ROLE -</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            <a href="{{ route('user.index') }}" class="btn btn-md btn-secondary">back</a>

        </form>

    </div>
</div>
@endsection