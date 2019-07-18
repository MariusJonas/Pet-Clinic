@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Pet</div>

                <div class="card-body">
                    <form action="{{route('pet.update', [$pet])}}" method="post">
                        Pet:<input type="text" name="type" value="{{old('type', $pet->type)}}"><br>
                        Species:<input type="text" name="species" value="{{old('species', $pet->species)}}"><br>
                        Birth Date:<input type="text" name="birth_date" value="{{old('birth_date', $pet->birth_date)}}"><br>
                        Pet Document:<input type="text" name="document" value="{{old('document', $pet->document)}}"><br>
                        Owner:<input type="text" name="owner" value="{{old('owner', $pet->owner)}}"><br>
                        Owner Contacts: <textarea name="owner_contacts" cols="30" rows="10" id="summernote1">{{old('owner_contacts', $pet->owner_contacts)}}</textarea>
                        History: <textarea name="history" cols="30" rows="10" id="summernote">{{old('history', $pet->history)}}</textarea><br>
                        Doctor: 
                        <select name="doctor_id">
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if($doctor->id == old('doctor_id',$pet->doctor_id)) selected @endif>{{$doctor->name}} {{$doctor->surname}}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <button type="submit">ADD</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote1').summernote();
        });
</script>
@endsection
