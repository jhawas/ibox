<?php

namespace App\Http\Controllers;

use App\TypeOfCharge;
use Illuminate\Http\Request;

class TypeOfChargeController extends Controller
{
    public $page = 'Type of Charges';
    public $description = 'List of ';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeOfCharges = TypeOfCharge::all();
        return view('admin.typeOfCharges.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfCharges' => $typeOfCharges
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeOfCharges.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typeOfCharge = new TypeOfCharge;
        $typeOfCharge->code = $request->code;
        $typeOfCharge->description = $request->description;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->save();
        return redirect()->route('typeOfCharges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfCharge $typeOfCharge)
    {
        return view('admin.typeOfCharges.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfCharge' => $typeOfCharge,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfCharge $typeOfCharge)
    {
        return view('admin.typeOfCharges.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'typeOfCharge' => $typeOfCharge,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfCharge $typeOfCharge)
    {
        $typeOfCharge->code = $request->code;
        $typeOfCharge->description = $request->description;
        $typeOfCharge->price = $request->price;
        $typeOfCharge->save();
        return redirect()->route('typeOfCharges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeOfCharge  $typeOfCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfCharge $typeOfCharge)
    {
        $typeOfCharge->delete();
        return redirect()->route('typeOfCharges.index');
    }
}
