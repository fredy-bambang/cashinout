<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dailytransaction;
use Amranidev\Ajaxis\Ajaxis;
use URL;
use Carbon\Carbon;

/**
 * Class DailytransactionController.
 *
 * @author  The scaffold-interface created at 2017-01-14 03:45:22pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class DailytransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo $request->dateStart.'<br>';
        // echo Carbon::createFromFormat('m/d/Y', $request->dateStart)->toDateString();
        $title = 'Index - Transaksi Harian';
        $dailytransactions = Dailytransaction::orderBy('created_at', 'desc');

        if ($request->has('dateStart')) {
            $dailytransactions = $dailytransactions->whereDate('created_at', '>=', Carbon::createFromFormat('m/d/Y', $request->dateStart)->toDateString()); //Carbon::createFromFormat('m/d/Y', $request->dateStart)
        }

        if ($request->has('dateEnd')) {
            $dailytransactions = $dailytransactions->whereDate('created_at', '<=', Carbon::createFromFormat('m/d/Y', $request->dateEnd)->toDateString());
        }

        if ($request->has('inOut')) {
            $dailytransactions = $dailytransactions->where('inOut', '=', $request->inOut);
        }

        $dailytransactions = $dailytransactions->paginate(50);
        $dailyFilterIn = $dailytransactions->sum('cost');
        $dailyIn = Dailytransaction::where('created_at', '>=', Carbon::today())
                    ->where('InOut', '=', config('enums.InOutStatus.In'))
                    ->sum('cost');
        $dailyOut = Dailytransaction::where('created_at', '>=', Carbon::today())
                    ->where('InOut', '=', config('enums.InOutStatus.Out'))
                    ->sum('cost');
        return view('dailytransaction.index',compact('dailytransactions','title', 'dailyIn', 'dailyOut'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - Transaksi Harian';
        
        return view('dailytransaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dailytransaction = new Dailytransaction();

        
        $dailytransaction->Description = $request->Description;

        
        $dailytransaction->Cost = $request->Cost;

        
        $dailytransaction->InOut = $request->InOut;

        
        
        $dailytransaction->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new dailytransaction has been created !!']);

        return redirect('dailytransaction');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - dailytransaction';

        if($request->ajax())
        {
            return URL::to('dailytransaction/'.$id);
        }

        $dailytransaction = Dailytransaction::findOrfail($id);
        return view('dailytransaction.show',compact('title','dailytransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - dailytransaction';
        if($request->ajax())
        {
            return URL::to('dailytransaction/'. $id . '/edit');
        }

        
        $dailytransaction = Dailytransaction::findOrfail($id);
        return view('dailytransaction.edit',compact('title','dailytransaction'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $dailytransaction = Dailytransaction::findOrfail($id);
    	
        $dailytransaction->Description = $request->Description;
        
        $dailytransaction->Cost = $request->Cost;
        
        $dailytransaction->InOut = $request->InOut;
        
        
        $dailytransaction->save();

        return redirect('dailytransaction');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/dailytransaction/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$dailytransaction = Dailytransaction::findOrfail($id);
     	$dailytransaction->delete();
        return URL::to('dailytransaction');
    }
}
