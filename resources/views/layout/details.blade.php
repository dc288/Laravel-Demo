@extends('layout.main');
@section('main-sec')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
<br>
<div class="container mt-5">


    <div class="d-flex justify-content-between align-items-center">
        <a class="btn btn-primary ms-auto" href="{{ route('form.create') }}">+ New User</a>
    </div>
 <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($m as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>{{ $m->firstname }}</td>
                <td>{{ $m->lastname }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ $m->Gender == 'male' ? "Male" : "" }}
                    {{ $m->Gender == 'female' ? "Female" : "" }}
                    {{ $m->Gender == 'other' ? "Others" : "" }}
                </td>
                <td>{{ $m->address }}</td>
                <td>{{ $m->phoneno }}</td>
                <td>{{ $m->age }}</td>
                <td>  <a class='btn btn-dark ms-auto' href='{{ route('file.show',['id'=>$m->id]) }}' target='_blank'>File</a></td>
                <td>  <a class='btn btn-success ms-auto' href='{{ route('form.edit',['id'=>$m->id]) }}'>Edit</a></td>
                <td>  <a class='btn btn-danger ms-auto' href='{{ route('form.delete',['id'=>$m->id]) }}'>Delete</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
</div>
</body>
</html>
@endsection
