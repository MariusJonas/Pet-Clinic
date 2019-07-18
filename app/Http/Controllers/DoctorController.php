<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;
use Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all()->sortBy('surname');
        return view('doctor.index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');
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
                'name' => ['required', 'min:3', 'max:64'],
                'surname' => ['required', 'min:3', 'max:64'],
                'category' => ['required', 'min:3', 'max:32'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('doctor.create')->withErrors($validator);
        }
     
        
        $doctor = new Doctor;
        $doctor->name = $request->name;
        $doctor->surname = $request->surname;
        $doctor->category = $request->category;
        $doctor->save();
        return redirect()->route('doctor.index')->with('success_message', 'New doctor was added to our team.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', ['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required', 'min:3', 'max:64'],
            'surname' => ['required', 'min:3', 'max:64'],
            'category' => ['required', 'min:3', 'max:32'],
        ]
    );

    if ($validator->fails()) {
        $request->flash();
        return redirect()->route('doctor.edit', [$doctor])->withErrors($validator);
    }
        
        $doctor->name = $request->name;
        $doctor->surname = $request->surname;
        $doctor->category = $request->category;
        $doctor->save();
        return redirect()->route('doctor.index')->with('success_message', 'Doctor info was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        if( $doctor->doctor_pets->count() > 0) {
            return redirect()->route('doctor.index')->with('info_message', 'Can\'t delete doctor, he has pets.');
        }
        $doctor->delete();
        return redirect()->route('doctor.index')->with('success_message', 'Doctor was left our team.');
    }
}
