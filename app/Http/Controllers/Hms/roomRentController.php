<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\Hosteller;
use App\hmsModel\roomRent;
use App\hmsModel\Account;
use Session;

class roomRentController extends Controller
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
        return view('hms.roomRents.index')->withHostellers($hostellers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $hosteller=Hosteller::find($id);
        $roomRents=roomRent::where('hosteller_id',$id)->orderby('date')->get();

        return view('hms.roomRents.create')->withHosteller($hosteller)->with('roomRents',$roomRents);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(date("m",strtotime($request->from)));
         $this->validate($request,array(
            'hosteller_id'=>'required',
            'date'=>'required|date',
            'from'=>'required|date',
            'to'=>'required|date',
            'amount'=>'required|numeric',
            ));

        $roomRent=new roomRent;
        $roomRent->hosteller_id=$request->hosteller_id;
        $roomRent->date=$request->date;
        $roomRent->receipt_no=$request->receipt_no;
        $roomRent->from=date("y/m/d",strtotime($request->from));
        $roomRent->to=date("y/m/d",strtotime($request->to));
        $roomRent->amount=$request->amount;
        $roomRent->remarks=$request->remarks;

        $roomRent->save();

        $account=new Account;
        $account->date=$request->date;
        $account->income=$request->amount;
        $account->narration="Room rent of ". $roomRent->hosteller->name;

        $account->save();

        Session::flash('success','Room Rent paid successfully');

        return redirect()->route('roomRent.index');
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
