<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Doctor;
use Illuminate\Http\Request;
use Validator;
use Response;

class PetController extends Controller
{

    public function index(Request $request, $order = 'default')
    {

        $start = $request->get('start', 'none');
        $end = $request->get('end', 'none');
        
        if ($order == 'date') {
            $pets = Pet::all()->sortBy('birth_date');
        }
        elseif ($order == 'date-desc') {
            $pets = Pet::all()->sortByDesc('birth_date');
        }
        elseif ($order == 'spec') {
            $pets = Pet::all()->sortBy('species');
        }
        elseif ($order == 'spec-desc') {
            $pets = Pet::all()->sortByDesc('species');
        }
        elseif ($start != 'none' && $end != 'none') {

            $pets = Pet::where('birth_date', '>=', $start)->where('birth_date', '<=', $end)->get();
        }

        else {
            $pets = Pet::all()->sortBy('type');
        }


        return view('pet.index', ['pets' => $pets]);
    }

   
    public function ajax(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $pets = Pet::where('birth_date', '>=', $start)->where('birth_date', '<=', $end)->get();

        foreach ($pets as $pet) {
            $pet->doctorName = $pet->pets_doctor->name;
            $pet->doctorSurname = $pet->pets_doctor->surname;
        }
        
        return Response::json([
            'result' => $pets
        ], 
            200);
    }

    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('pet.create', ['doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),
        [
            'type' => ['required', 'min:3', 'max:255'],
            'species' => ['required', 'min:3', 'max:20'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'document' => ['required', 'min:3', 'max:20'],
            'owner' => ['required', 'min:3', 'max:255'],
            'owner_contacts' => ['required', 'min:3'],
            'history' => ['required', 'min:3'],
            'doctor_id' => ['required', 'integer'],
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('pet.create')->withErrors($validator);
        }
        
        $pet = new Pet;
        $pet->type = $request->type;
        $pet->species = $request->species;
        $pet->birth_date = $request->birth_date;
        $pet->document = $request->document;
        $pet->owner = $request->owner;
        $pet->owner_contacts = $request->owner_contacts;
        $pet->history = $request->history;
        $pet->doctor_id = $request->doctor_id;
        $pet->save();
        return redirect()->route('pet.index')->with('success_message', 'New pet has arrived.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        $doctors = Doctor::all();
        return view('pet.edit', ['pet' => $pet, 'doctors' => $doctors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        
        $validator = Validator::make($request->all(),
        [
            'type' => ['required', 'min:3', 'max:255'],
            'species' => ['required', 'min:3', 'max:20'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'document' => ['required', 'min:3', 'max:20'],
            'owner' => ['required', 'min:3', 'max:255'],
            'owner_contacts' => ['required', 'min:3'],
            'history' => ['required', 'min:3'],
            'doctor_id' => ['required', 'integer'],
        ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('pet.create')->withErrors($validator);
        }
        
        $pet->type = $request->type;
        $pet->species = $request->species;
        $pet->birth_date = $request->birth_date;
        $pet->document = $request->document;
        $pet->owner = $request->owner;
        $pet->owner_contacts = $request->owner_contacts;
        $pet->history = $request->history;
        $pet->doctor_id = $request->doctor_id;
        $pet->save();
        return redirect()->route('pet.index')->with('success_message', 'Pet info was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pet.index')->with('success_message', 'Pet left our clinic.');
    }
}
