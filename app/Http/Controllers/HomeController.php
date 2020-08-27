<?php

namespace App\Http\Controllers;

use App\FlowchartModel;
use App\FlowchartTypeModel;
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
        $chart = FlowchartModel::with('tipe')->get();
        return view('blank', compact('title', 'chart'));
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
    public function createFlow()
    {
        //
        $title = 'Add FlowChart';
        $type = FlowchartTypeModel::get();
        $cnt = FlowchartModel::count();
        $chart = FlowchartModel::get();
        return view('addFlow', compact('title', 'type', 'cnt', 'chart'));
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

    public function storeFlow(Request $request)
    {
        $cnt = FlowchartModel::count();

        $requestData = $request->only([
            'type_id',
            'chart_name',
            'flowline_name',
            'previous_chart',
            'action_type',
            'action'
        ]);
        $validator;
        if ($cnt > 0) {
            $validator = Validator::make($requestData,[
                'type_id' => 'required|integer',
                'chart_name' => 'required|string',
                'flowline_name' => 'nullable|string',
                'previous_chart' => 'required|integer',
                'action_type' => 'nullable|integer',
                'action' => 'nullable|string'
            ]);
        }else {
            $validator = Validator::make($requestData,[
                'type_id' => 'required|integer',
                'chart_name' => 'required|string',
                'flowline_name' => 'nullable|string',
                'previous_chart' => 'nullable|integer',
                'action_type' => 'nullable|integer',
                'action' => 'nullable|string'
            ]);
        }

        if ($validator->passes()) {
            $flowchart = FlowchartModel::create($requestData);
            
            if ($flowchart) {
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
