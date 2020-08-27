@extends('layouts.app') @section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store-flow') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Flowchart Type</label>
                            <select class="form-control" name="type_id">
                                @foreach ($type as $item)
                                    <option value={{ $item->id }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="chart_name">
                        </div>

                        @if ($cnt > 0)
                            <div class="form-group">
                                <label>Flowline Name</label>
                                <input type="text" class="form-control" name="flowline_name">
                            </div>
                            <div class="form-group">
                                <label>Prev Chart</label>
                                <select class="form-control" name="previous_chart">
                                    @foreach ($chart as $item)
                                        <option value={{ $item->id }}>{{ $item->chart_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Action</label>
                            <select class="form-control" name="action_type">
                                <option value=1 selected>No Action</option>
                                <option value=2>Link Href</option>
                                <option value=3>Alert</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label>Action Value (link or any string if a link need a full link example : http://www.github.com)</label>
                            <input type="text" class="form-control" name="action">
                        </div>
                </div>
                    <div class="card-footer text-right">
                        <button type="submit" onclick="this.form.submit(); this.disabled=true; this.innerHTML='Sending..';" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop