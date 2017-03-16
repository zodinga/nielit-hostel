<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\Hosteller;
use App\hmsModel\messFee;
use App\hmsModel\messAccount;
use Session;

class messFeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostellers=Hosteller::where('leave_date','=',NULL)->orWhere('status','=',1)->paginate(10);
        return view('hms.messFees.index')->withHostellers($hostellers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hosteller=Hosteller::find($id);
        $messFees=messFee::where('hosteller_id',$id)->orderby('date')->get();

        return view('hms.messFees.create')->withHosteller($hosteller)->with('messFees',$messFees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(date("Y",strtotime($request->month_year)));
         $this->validate($request,array(
            'hosteller_id'=>'required',
            'date'=>'required|date',
            'month_year'=>'required|date',
            'amount'=>'required|numeric',
            ));

        $messFee=new messFee;
        $messFee->hosteller_id=$request->hosteller_id;
        $messFee->date=$request->date;
        $messFee->receipt_no=$request->receipt_no;
        $messFee->month_year=date("y/m/d",strtotime($request->month_year));
        $messFee->amount=$request->amount;
        $messFee->remarks=$request->remarks;

        $messFee->save();

        $messAccount=new messAccount;
        $messAccount->date=$request->date;
        $messAccount->income=$request->amount;
        $messAccount->narration="Mess fee of ". $messFee->hosteller->name;

        $messAccount->save();

        Session::flash('success','Mess Fee of '.$messFee->hosteller->name.' paid successfully');

        return redirect()->route('messFee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
