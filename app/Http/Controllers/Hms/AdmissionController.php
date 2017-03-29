<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Student;
use App\Course;
use App\hmsModel\Room;
use App\hmsModel\Hosteller;
use Session;

class AdmissionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        
        $students=Student::where('id','>',0);
        if($request->has('name'))
            $students=$students->where('name','like','%'.$request->name.'%');
        if($request->has('course_id'))
        {
            $students=$students->where('course_id','=',$request->course_id);
        }
        if($request->has('year'))
            $students=$students->where('doj','=',$request->year);

        $students=$students->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('hms.admissions.index')
                    ->withCourses($courses)
                    ->withStudents($students);
    }

     public function postAssign(Request $request){
        //dd($request->id);
        $student=Student::find($request->id);
        $student->sex=$request->gender;

        $student->save();
        Session::flash('success','Sex assigned successfully!!');

        return redirect()->back();
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::orderby('doj','desc')->orderby('course_id')->paginate(10);
        
        return view('hms.admissions.index')->withStudents($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $student=Student::find($id);
        $sex=$student->sex;
        $rooms=Room::where('id','>',0);  
        if($sex=='M'){
            $room_vacant=Room::where('building','=','Boys');
            $rooms=$rooms->where('building','=','Boys');
        }
        else if($sex=='F'){
            $room_vacant=Room::where('building','=','Girls');
            $rooms=$rooms->where('building','=','Girls');
        }
        $room_vacant=$room_vacant->where(function ($query) {
                $query->where('hosteller_1_id','=',0)
                      ->orWhere('hosteller_2_id','=',0);
            });
        $room_vacant=$room_vacant->orderby('id')->pluck('room_no','id');
        $rooms=$rooms->get();
        
        return view('hms.admissions.create')->withStudent($student)->withSex($sex)->withRoom_vacant($room_vacant)->withRooms($rooms);
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
            'building'=>'required',
            'room'=>'required|numeric',
            'student_id'=>'required|numeric',
            'course_id'=>'required|numeric',
            'phone'=>'required',
            'guardian'=>'required',
            'guardian_phone'=>'required',
            'admission_date'=>'required|date',
            ));

        
        $hosteller=new Hosteller;
        $hosteller->student_id=$request->student_id;
        $hosteller->name=$request->name;
        $hosteller->course_id=$request->course_id;
        $hosteller->phone=$request->phone;
        $hosteller->guardian=$request->guardian;
        $hosteller->guardian_phone=$request->guardian_phone;
        $hosteller->admission_date=$request->admission_date;
        $hosteller->status=1;
        $hosteller->remarks=$request->remarks;

        $hosteller->save();

        $hosteller=Hosteller::where('student_id','=',$request->student_id)->first();
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
