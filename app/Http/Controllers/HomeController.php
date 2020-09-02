<?php

namespace App\Http\Controllers;

use App\FlowchartModel;
use App\ObjectModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Validator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Flowchart';
        $flowchart = FlowchartModel::with('obyek')->get();
        return view('blank', compact('title', 'flowchart'));
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
    public function createFlow($flowchart)
    {
        //
        $title = 'Add Object';
        $chart = ObjectModel::where('flowchart_id', '=', $flowchart)->get();
        return view('addFlow', compact('title', 'chart', 'flowchart'));
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

    public function storeFlowchart(Request $request)
    {
        $requestData = $request->only([
            'name'
        ]);
        $validator = Validator::make($requestData,[
            'name' => 'required|string'
        ]);
        

        if ($validator->passes()) {
            $flowchart = FlowchartModel::create($requestData);
            
            if ($flowchart) {
                return redirect()->back()->with(['successMessage' => "Success"]);
            }
            return redirect()->back()->with(['errorMessage' => 'Failed']);
        }
        return redirect()->back()
            ->withInput()
            ->withErrors($validator)
            ->with(['errorMessage' => 'Data not valid']);
    }

    public function storeFlow(Request $request)
    {

        $requestData = $request->only([
            'flowchart_id',
            'name',
            'type',
            'parent',
            'action_type',
            'action'
        ]);
        $validator = Validator::make($requestData,[
            'flowchart_id' => 'required',
            'name' => 'required|string',
            'type' => 'required|string',
            'parent' => 'nullable|string',
            'action_type' => 'nullable|integer',
            'action' => 'nullable|string'
        ]);

        if ($validator->passes()) {
            $object = ObjectModel::create($requestData);
            
            if ($object) {
                return redirect()->route('index')->with(['successMessage' => "Success"]);
            }
            return redirect()->back()->with(['errorMessage' => 'Failed']);
        }
        return redirect()->back()
            ->withInput()
            ->withErrors($validator)
            ->with(['errorMessage' => 'Data not valid']);

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
    public function destroyFlow()
    {
        //
        $del = FlowchartModel::truncate();
        if ($del) {
            return redirect()->route('index')->with(['successMessage' => "Success"]);
        }
    }
}
