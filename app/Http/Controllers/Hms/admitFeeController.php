<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\Hosteller;
use App\Course;
use App\hmsModel\admitFee;
use App\hmsModel\Account;
use Session;

class admitFeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $hostellers=Hosteller::where('id','>',0);
        if($request->has('name'))
            $hostellers=$hostellers->where('name','like','%'.$request->name.'%');
        if($request->has('course_id'))
        {
            $hostellers=$hostellers->where('course_id','=',$request->course_id);
        }
        if($request->has('year'))
            $hostellers=$hostellers->where('doj','=',$request->year);

        $hostellers=$hostellers->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('hms.admitFees.index')
                    ->withCourses($courses)
                    ->withHostellers($hostellers);
    }
    public function index()
    {

        $hostellers=Hosteller::where('leave_date','=',NULL)->orWhere('status','=',1)->paginate(10);
        //dd($hosteller);
        return view('hms.admitFees.index')->withHostellers($hostellers);
    }

    /**,ml;
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
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,array(
            'hosteller_id'=>'required',
            'date'=>'required|date',
            'amount'=>'required|numeric',
            ));
        $admitFee=new admitFee;
        $admitFee->hosteller_id=$request->hosteller_id;
        $admitFee->date=$request->date;
        $admitFee->receipt_no=$request->receipt_no;
        $admitFee->amount=$request->amount;
        $admitFee->remarks=$request->remarks;

        $admitFee->save();

        $account=new Account;
        $account->date=$request->date;
        $account->income=$request->amount;
        $account->narration="Admission fee of ". $admitFee->hosteller->name;

        $account->save();

        Session::flash('success','Admission Fee paid successfully');

        return redirect()->route('admitFee.index');
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
