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
                    @if(session()->has('successMessage'))
                        <div class="alert alert-success"><strong>{{ session('successMessage') }}</strong></div>
                    @elseif(session()->has('errorMessage'))
                        <div class="alert alert-danger"><strong>{{ session('errorMessage') }}</strong></div>
                    @endif
                    <form action="{{ route('store-flow') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Flowchart Type</label>
                            <select class="form-control" name="type">
                                <option value="Circle">Terminal</option>
                                <option value="Diamond">Decision</option>
                                <option value="Rectangle">Process</option>
                                <option value="File">Comment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        
                        <div class="form-group">
                            <label>Parent</label>
                            <select class="form-control" name="parent">
                                <option>No Parent</option>
                                @foreach ($chart as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Action</label>
                            <select class="form-control" name="action_type">
                                <option value=1 selected>No Action</option>
                                <option value=2>Link Href</option>
                                <option value=3>Alert</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <label>Action Value (link or any string, link example : www.github.com)</label>
                            <input type="text" class="form-control" name="action">
                        </div>
                        <input type="hidden" name="flowchart_id" value={{$flowchart}}>
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