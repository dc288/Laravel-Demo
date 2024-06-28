@extends('layout.main');
@section('main-sec')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<br><br>
<h2 class="container ">{{ $title }}</h2>
<form name="myForm" class="container " method="post" action="{{ $url }}" enctype="multipart/form-data">
    @csrf
<label for="firstname" class="col-sm-2 col-form-label text-end">First Name <span class="text-danger">*</span>:</label>
<input  type="text" name="firstname" value="{{ $fi ? $fi->firstname : "" }}" >
  <span class="error text-danger">
    @error('firstname')
    {{ $message }}
    @enderror
  </span>
  <br><br>
  <label for="lastname" class="col-sm-2 col-form-label text-end">Last Name<span class="text-danger">*</span>:</label><input  type="text" name="lastname" value="{{ $fi ? $fi->lastname : "" }}" >
  <span class="error text-danger">
    @error('lastname')
    {{ $message }}
    @enderror
  </span>
  <br><br>
  <label for="phoneno" class="col-sm-2 col-form-label text-end">Phone Number<span class="text-danger">*</span>:</label><input type="text" name="phoneno" value="{{ $fi ? $fi->phoneno : "" }}" >
  <span class="error text-danger">
    @error('phoneno')
    {{ $message }}
    @enderror
  </span>
  <br><br>
  <label for="dob" class="col-sm-2 col-form-label text-end">Date Of Birth<span class="text-danger">*</span>:</label><input type="date"  name="dob" value="{{ $fi!=null ? $fi->dob : "" }}" >
  <span class="error text-danger">
    @error('dob')
    {{ $message }}
@enderror</span>
  <br><br>
  <label for="address" class="col-sm-2 col-form-label text-end">Address<span class="text-danger">*</span>:</label><input type="text"  name="address" value="{{ $fi? $fi->address : "" }}" >
  <span class="error text-danger">
    @error('address')
    {{ $message }}
    @enderror
  </span>
  <br><br>
  <label for="email" class="col-sm-2 col-form-label text-end">E-mail<span class="text-danger">*</span>:</label><input type="email"  name="email" value="{{ $fi ? $fi->email : "" }}" >
  <span class="error text-danger">
    @error('email')
    {{ $message }}
@enderror</span>
  <br><br>
  <label for="gender" class="col-sm-2 col-form-label text-end">Gender<span class="text-danger">*</span>:</label>
  <input  type="radio" name="gender" value="female" {{ $fi ? ($fi->Gender == "female" ? "checked" : "") : "" }}>Female
  <input  type="radio" name="gender" value="male" {{ $fi ? ($fi->Gender == "male" ? "checked" : "") : "" }}>Male
  <input  type="radio" name="gender" value="other" {{ $fi ? ($fi->Gender == "other" ? "checked" : "") : "" }}>Other
  <span class="error text-danger">
    @error('gender')
        {{ $message }}
    @enderror
  </span>
  <br><br>
  <div class="mb-3 row">
    <label for="fileToUpload" class="col-sm-2 col-form-label text-end">Identity-card(PDF) <span class="text-danger">*</span>:</label>
    <div class="col-sm-10">
        <div class="input-group">
            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" accept="application/pdf" >
        @if ($fi!=null)
        <a class='btn btn-primary ms-auto' href='{{ route('file.show',['id'=>$fi->id]) }}' target='_blank'>File</a>
        @endif
    </div>
        <span class="error text-danger">
            @error('fileToUpload')
                {{ $message }}
            @enderror
          </span>
    </div>
</div>
  <input class="btn btn-primary" type="submit"  name="submit" value="Submit">
 <br><br>
</form>
</body>
</html>
@endsection
