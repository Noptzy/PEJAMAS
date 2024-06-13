@extends('layouts.app')
@section('content')
<div class="container table-responsive py-5">
    <button type="button" class="btn btn-primary">Tambah Data</button>
    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->role }}</td>
                <td> <button type="button" class="btn btn-secondary">Secondary</button> <button type="button" class="btn btn-danger">Danger</button></td>
            </tr>
        @endforeach

@endsection
