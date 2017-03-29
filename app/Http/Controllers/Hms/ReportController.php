<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Schema;
use Excel;
use App\hmsModel\Hosteller;
use App\Course;
use Session;

class ReportController extends Controller
{
    public function index()
    {
        return view('hms.reports.index');
    }

    public function custom()
    {
    	$hosteller_table=Schema::getColumnListing('hostellers');
    	$distinct=Hosteller::select('course_id')->distinct()->get();
    	$distinct=$distinct->pluck('course_id')->toArray();
    	
    	$courses=Course::whereIn('id',$distinct)->pluck('name','id');

        return view('hms.reports.custom')->with('hosteller_table',$hosteller_table)->withCourses($courses);
    }

    public function custom_export(Request $request)
    {
    	$hosteller_fields=Schema::getColumnListing('hostellers');
    	$fields=array();

    	foreach($hosteller_fields as $field )
    	{
    		if($request->get($field)=='on'){
    			if($field=='id')
    				array_push($fields,'hostellers.id');
    			else if($field=='name')
    				array_push($fields,'hostellers.name');
    			else if($field=='course_id')
    				array_push($fields,'courses.name as course');
    			else
    			array_push($fields,$field);
    		}
    	}
    	if(empty($fields))
    		{
    			Session::flash('unsuccess','Select required fields');
    			return back();
    		}
    	else
    		$hostellers = Hosteller::join('courses', 'hostellers.course_id', '=', 'courses.id')
            	->select($fields);
        //dd($hostellers->get());

        if($request->has('h_name'))
        	$hostellers->where('hostellers.name','like','%'.$request->h_name.'%');
        if($request->has('h_course_id'))
        	$hostellers->where('hostellers.course_id','like','%'.$request->h_course_id.'%');

        $hostellers=$hostellers->get();

        Excel::create("Hosteller",function($excel) use($hostellers){
             $excel->setTitle('Report');
             $excel->setCreator('Samuel')
              ->setCompany('NIELIT');


            $excel->sheet('Hosteller',function($sheet) use($hostellers){
                $sheet->fromArray($hostellers);
                $sheet->setOrientation('landscape');
                $sheet->freezeFirstRow();
            });
        })->export('xlsx');

        return back();
    }
}
