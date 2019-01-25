<?php

namespace App\Http\Controllers;

use App\Cashier;
use App\PatientRecord;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public $page = 'Cashier';
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
    public function selection()
    {
        $patientRecords = PatientRecord::all();
        return view('admin.cashiers.selection', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecords' => $patientRecords
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSelection(Request $request)
    {
        return redirect()->route('cashiers.index', $request->patientRecord);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print(Cashier $cashier)
    {
        return view('admin.cashiers.print', [
            'cashier' => $cashier
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientRecord $patientRecord)
    {
        // return $patientRecord->billings;
        return view('admin.cashiers.index', [
            'page' => $this->page,
            'description' => $this->description . $this->page,
            'patientRecord' => $patientRecord,
            // 'totalBill' => $patientRecord->billings->sum('total'),
            'billings' => $patientRecord->billings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PatientRecord $patientRecord)
    {
        $cashier = new Cashier;
        $cashier->patient_record_id = $patientRecord->id;
        $cashier->total = $request->bill;
        $cashier->amount = $request->amount;
        $cashier->change = $request->bill - $request->amount;
        $cashier->save();
        return redirect()->route('cashiers.print', $cashier);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}
