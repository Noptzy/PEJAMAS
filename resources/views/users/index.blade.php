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
                <td>
                <button type="button" class="btn btn-secondary">Edit</button>
                    
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

@endsection
