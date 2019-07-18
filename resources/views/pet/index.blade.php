@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Pets List
                    <span class="order-type">Sort by Date:</span>
                    <a href="{{route('pet.sort', 'date')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#deb887" d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg>
                    </a>
                    <a href="{{route('pet.sort', 'date-desc')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#deb887" d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>
                    </a>

                    <span class="order-type">Sort by Species:</span>
                    <a href="{{route('pet.sort', 'spec')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#deb887" d="M20 12l-1.41-1.41L13 16.17V4h-2v12.17l-5.58-5.59L4 12l8 8 8-8z"/></svg>
                    </a>
                    <a href="{{route('pet.sort', 'spec-desc')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path fill="#deb887" d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>
                    </a>

                    <form class="filter" action="{{route('pet.index')}}" method="get">
                    
                    <input type="text" name="start" id="start">
                    <input type="text" name="end" id="end">
                    <button type="submit" id="filter-button">Filter</button>
                    
                    </form>


                </div>

                <div class="card-body">
                    @foreach ($pets as $pet)
                    {{$pet->type}} {{$pet->species}} {{$pet->birth_date}} DOCTOR: {{$pet->pets_doctor->name}} {{$pet->pets_doctor->surname}}
                    <a style="font-family:Arial, Helvetica, sans-serif; text-decoration:none; color:crimson; font-size: 13px;" href="{{route('pet.edit', [$pet])}}">
                        [EDIT]
                    </a>
                    <form style="display: inline-block;"; action="{{route('pet.destroy', [$pet])}}" method="post">
                        <button style="font-family:Arial, Helvetica, sans-serif; border:none; background:transparent; color:crimson; font-size: 13px; cursor:pointer;" type="submit">[DELETE]</button>
                        @csrf
                    </form>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
$(document).on("click", "#filter-button", function(e){
    e.preventDefault();
    axios.post("{{route('pet.index')}}", {
    start: $("#start").val(),
    end: $("#end").val()
  })
  .then(function (response) {
    console.log(response);
    var pets = response.data.result;
    var chunk = '';
    pets.forEach(function(element) {

        chunk += ''+element.type+' '+element.species+' '+element.birth_date+' DOCTOR: '+element.doctorName+' '+element.doctorSurname+'<br>';
    });


    // console.log(pets);

    $(".card-body").empty().html(chunk);


  })
  .catch(function (error) {
    console.log(error);
  });


    console.log("klikas");
});


});





  </script>

@endsection
