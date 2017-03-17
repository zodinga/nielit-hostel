<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\Hosteller;
use App\hmsModel\admitFee;
use App\hmsModel\roomRent;
use App\hmsModel\messFee;
use Session;

class DischargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('discharge');
        $hostellers=Hosteller::where('leave_date','=',NULL)->orWhere('status','=',1)->paginate(10);
        return view('hms.discharges.index')->withHostellers($hostellers);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $hosteller=Hosteller::find($id);
        $admitFees=admitFee::where('hosteller_id',$id)->get();
        $roomRents=roomRent::where('hosteller_id',$id)->orderby('from')->get();
        $messFees=messFee::where('hosteller_id',$id)->orderby('month_year')->get();

        //Admit fee pending
        $admit_pending="";
        if(!$admitFees->first())
            $admit_pending="Not paid";
        //

        //calculate room rent pending
        $admit=$hosteller->admitFee;
        if($hosteller->messFee)
        $mess=$hosteller->messFee->get();

        if($hosteller->roomRent)
        $room=$hosteller->roomRent->get();

        $admit_year=(int)date('y',strtotime($hosteller->admission_date));
        $admit_month=(int)date('m',strtotime($hosteller->admission_date));

        if($admit_month<6){
            $time = strtotime('1/1/'.$admit_year);
            $start = date('Y-m-d',$time);
        }
        else{
            $time = strtotime('7/1/'.$admit_year);

            $start = date('Y-m-d',$time);
        }

        $today=date(\Carbon\Carbon::now());
        
        if(date('m',strtotime($today))<6){
            $time = strtotime('6/30/'.date('Y',strtotime($today)));
            $end = date('Y-m-d',$time);
        }
        else{
            $time = strtotime('12/31/'.date('Y',strtotime($today)));
            $end = date('Y-m-d',$time);
        }

        $pending="";

        if($roomRents->first())
        {
            while(date('m/Y',strtotime($start))!=date('m/Y',strtotime($roomRents->first()->from))){
            $pending=$pending.date('m/Y',strtotime($start))." to ".date('m/Y',strtotime( "+5 month", strtotime( $start ) )).', ';
            $start=date('m/d/Y',strtotime( "+6 month", strtotime( $start ) )); 
            }
        
        
            
            $i=0;
            foreach($roomRents as $roomRent)
                $rent[$i++]=$roomRent->from;

            $j=0;

            while(date('Y',strtotime( $start ))<=date('Y',strtotime($today)))
            {
                if($i==1 && date('Y',strtotime( $start ))===date('Y',strtotime($today)) && date('m/Y',strtotime( $start ))==date('m/Y',strtotime( $rent[0] )))
                    break;
                if($j<$i)
                {
                    if(date('m/Y',strtotime($start))==date('m/Y',strtotime($rent[$j])))
                    {
                        $j++;
                        $start=date('m/d/Y',strtotime( "+6 month", strtotime( $start ) ));
                    }
                    else
                    {
                        $pending=$pending.date('m/Y',strtotime($start)).' to '.date('m/Y',strtotime( "+5 month", strtotime( $start ))).', ';
                        $start=date('m/d/Y',strtotime( "+6 month", strtotime( $start ) ));
                    }
                }

            }
        }
        else{
            while(date('m',strtotime( $start ))<=date('m',strtotime($today))&&date('Y',strtotime( $start ))<=date('Y',strtotime($today)))
            {
                $pending=$pending.date('m/Y',strtotime($start)).' to '.date('m/Y',strtotime( "+5 month", strtotime( $start ))).', ';
                $start=date('m/d/Y',strtotime( "+6 month", strtotime( $start ) ));
            }
        }
        //end calculate room rent pending

        //calculate mess fee pending
        $mess_pending="";

        $start=date('Y-m-d',strtotime($hosteller->admission_date));
        if($messFees->first())
        {


            while(date('m/Y',strtotime($start))-date('m/Y',strtotime($messFees->first()->month_year))>0){
                $mess_pending=$mess_pending.', '.date('m/Y',strtotime($start));
                $start=date('m/d/Y',strtotime( "+1 month", strtotime( $start ) ));
            }

            $i=0;
            foreach($messFees as $messFee)
                $mess[$i++]=$messFee->month_year;
            
            $j=0;

            for(;date('m/Y',strtotime($start))<=date('m/Y',strtotime($today));)
            {
                if($j<$i)
                {
                    if(date('m/Y',strtotime($start))==date('m/Y',strtotime($mess[$j])))
                    {
                        $j++;
                        $start=date('m/d/Y',strtotime( "+1 month", strtotime( $start ) ));
                    }
                    else
                    {
                        $mess_pending=$mess_pending.', '.date('m/Y',strtotime($start));
                        $start=date('m/d/Y',strtotime( "+1 month", strtotime( $start ) ));
                    }
                }
            }
        }
        else{
            for(;date('m/Y',strtotime($start))<=date('m/Y',strtotime($today));)
            {
                $mess_pending=$mess_pending.date('m/Y',strtotime($start)).', ';
                $start=date('m/d/Y',strtotime( "+1 month", strtotime( $start ) ));

            }
        }
        //end calculate mess fee pending
        
        return view('hms.discharges.show')->withHosteller($hosteller)
                                            ->with('admitFees',$admitFees)
                                            ->with('roomRents',$roomRents)
                                            ->with('admit_pending',$admit_pending)
                                            ->with('messFees',$messFees)
                                            ->withPending($pending)
                                            ->with('mess_pending',$mess_pending);
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
