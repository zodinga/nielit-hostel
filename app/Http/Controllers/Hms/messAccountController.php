<?php

namespace App\Http\Controllers\Hms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\hmsModel\messAccount;
use Session;

class messAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messAccounts=messAccount::orderby('date','desc')->paginate(10);
        $income=$messAccounts->sum('income');
        $expense=$messAccounts->sum('expense');

        return view('hms.messAccounts.index')->with('messAccounts',$messAccounts)->withIncome($income)->withExpense($expense);
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
        $this->validate($request,array(
            'date'=>'required|date',
            'amount'=>'required|numeric',
            'narration'=>'required',
            ));

        $messAccount=new messAccount;
        $messAccount->date=$request->date;
        $messAccount->expense=$request->amount;
        $messAccount->narration=$request->narration;

        $messAccount->save();

        Session::flash('success','Expense made successfully');

        return redirect()->route('messAccount.index');
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
