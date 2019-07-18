@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Doctor</div>
                <div class="card-body">
                    <form action="{{route('doctor.update', [$doctor])}}" method="post">
                        Doctor Name:<input type="text" name="name" value="{{old('name', $doctor->name)}}"><br>
                        Doctor Surname:<input type="text" name="surname" value="{{old('surname', $doctor->surname)}}"><br>
                        Category:<input type="text" name="category" value="{{old('category', $doctor->category)}}"><br><br>
                        <button type="submit">EDIT</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
