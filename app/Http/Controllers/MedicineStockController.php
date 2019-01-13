<?php

namespace App\Http\Controllers;

use App\MedicineStock;
use App\MassVolumeType;
use App\MedicineType;
use App\Http\Requests\MedicineStockRequest;
use Illuminate\Http\Request;

class MedicineStockController extends Controller
{
    public $page = 'Medicines';
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
        
        $medicineStocks = MedicineStock::all();
        return view('admin.medicineStocks.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineStocks' => $medicineStocks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicineTypes = MedicineType::all();
        return view('admin.medicineStocks.create', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineTypes' => $medicineTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineStockRequest $request)
    {
        $medicineStock = new MedicineStock;
        $medicineStock->code = $request->code;
        $medicineStock->description = $request->description;
        $medicineStock->medicine_type_id = $request->medicineType;
        $medicineStock->quantity = $request->quantity;
        $medicineStock->price = $request->price;
        $medicineStock->save();
        return redirect()->route('medicineStocks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineStock  $medicineStock
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineStock $medicineStock)
    {
        return view('admin.medicineStocks.show', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineStock' => $medicineStock,
        ]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineStock  $medicineStock
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineStock $medicineStock)
    {
        $medicineTypes = MedicineType::all();
        return view('admin.medicineStocks.edit', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'medicineStock' => $medicineStock,
            'medicineTypes' => $medicineTypes,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineStock  $medicineStock
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineStockRequest $request, MedicineStock $medicineStock)
    {
        $medicineStock->code = $request->code;
        $medicineStock->description = $request->description;
        $medicineStock->medicine_type_id = $request->medicineType;
        $medicineStock->quantity = $request->quantity;
        $medicineStock->price = $request->price;
        $medicineStock->save();
        return redirect()->route('medicineStocks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineStock  $medicineStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineStock $medicineStock)
    {
        $medicineStock->delete();
        return redirect()->route('medicineStocks.index');
    }
}
