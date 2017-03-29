<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\Room;
use App\hmsModel\Hosteller;
use App\Course;
use Session;
use Schema;

class HostellerController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Schema::getColumnListing('hostellers'));
        $courses=Course::pluck('name','id');
        
        $rooms=Room::where('building','=','Boys')->get();  
        $grooms=Room::where('building','=','Girls')->get(); 

        $room_vacant=Room::where('building','=','Boys');
        $room_vacant=$room_vacant->where(function ($query) {
                $query->where('hosteller_1_id','=',0)
                      ->orWhere('hosteller_2_id','=',0);
            });
        $room_vacant=$room_vacant->orderby('id')->pluck('room_no','id');

        return view('hms.hostellers.create')
                    ->withCourses($courses)
                    ->withRoom_vacant($room_vacant)
                    ->withRooms($rooms)
                    ->withGrooms($grooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'building'=>'required',
            'room'=>'required|numeric',
            'course_id'=>'required|numeric',
            'phone'=>'required',
            'guardian'=>'required',
            'guardian_phone'=>'required',
            'admission_date'=>'required|date',
            ));

        
        $hosteller=new Hosteller;
        $hosteller->name=$request->name;
        $hosteller->course_id=$request->course_id;
        $hosteller->phone=$request->phone;
        $hosteller->guardian=$request->guardian;
        $hosteller->guardian_phone=$request->guardian_phone;
        $hosteller->admission_date=$request->admission_date;
        $hosteller->status=1;
        $hosteller->remarks=$request->remarks;

        $hosteller->save();

        $hosteller=Hosteller::orderby('id','desc')->first();
        $room=Room::find($request->room);
        if($room->hosteller_1_id<1)
            $room->hosteller_1_id=$hosteller->id;
        else if($room->hosteller_2_id<1)
            $room->hosteller_2_id=$hosteller->id;

        $room->save();

        Session::flash('success',$request->name.' Admitted');

        return redirect()->route('admissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hosteller=Hosteller::find($id);

        return view('hms.hostellers.show')->withHosteller($hosteller);
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
