<?php

namespace App\Http\Controllers;

use App\TypeOfCharge;
use Illuminate\Http\Request;

class MedicineTypeController extends Controller
{
    public $page = 'Medicine Types';
    public $description = 'List of all ';

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
        $medicineTypes = TypeOfCharge::where('type_id', 1)->get();
        return view('admin.medicineTypes.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineTypes' => $medicineTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medicineTypes.create', [
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
        $medicineType = new TypeOfCharge;
        // medicine id
        $medicineType->type_id = 1;

        $medicineType->code = $request->code;
        $medicineType->description = $request->description;
        $medicineType->price = $request->price;
        $medicineType->save();
        return redirect()->route('medicineTypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function show(TypeOfCharge $medicineType)
    {
        return view('admin.medicineTypes.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineType' => $medicineType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeOfCharge $medicineType)
    {
        return view('admin.medicineTypes.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineType' => $medicineType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeOfCharge $medicineType)
    {
        $medicineType->code = $request->code;
        $medicineType->description = $request->description;
        $medicineType->price = $request->price;
        $medicineType->save();
        return redirect()->route('medicineTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineType  $medicineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeOfCharge $medicineType)
    {
        $medicineType->delete();
        return redirect()->route('medicineTypes.index');
    }
}
