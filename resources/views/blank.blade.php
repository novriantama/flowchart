@extends('layouts.app') @section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Flowchart</h4>
                    <div class="card-header-action">
                        <a href="{{ route('add-flow') }}" class="btn btn-primary">Add Flow</a>
                        
                        <form action="{{ route('destroy-flow') }}" id="form-delete" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input id="item-id" type="hidden" name="id" value="">
                            <button type="submit" onclick="this.form.submit(); this.disabled=true; this.innerHTML='Mengirim…';" class="btn btn-danger"> Delete Flowchart </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mermaid text-center">
                        graph TD
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($chart as $item)
                            @if ($i == 1)
                                @switch($item->type_id)
                                    @case(1)
        
                            {{$item->id}}([{{$item->chart_name}}])
                            {{$item->id}}
                                        @break
                                    @case(2)
        
                            {{$item->id}}({{$item->chart_name}})
                            {{$item->id}} 
                                        @break
                                    @case(3)
        
                            {{$item->id}}{ {{$item->chart_name}} }
                            {{$item->id}} 
                                        @break
                                    @case(4)
        
                            {{$item->id}}[/{{$item->chart_name}}/]
                            {{$item->id}} 
                                        @break
                                    @case(5)
        
                            {{$item->id}}[[{{$item->chart_name}}]]
                            {{$item->id}} 
                                        @break
                                    @case(6)
        
                            {{$item->id}}(({{$item->chart_name}}))
                            {{$item->id}}
                                        @break
                                    @default
                                        
                                @endswitch
                            @else
                                @switch($item->type_id)
                                    @case(1)
        
                            {{$item->id}}([{{$item->chart_name}}])
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @case(2)
        
                            {{$item->id}}({{$item->chart_name}})
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @case(3)
        
                            {{$item->id}}{ {{$item->chart_name}} }
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @case(4)
        
                            {{$item->id}}[/{{$item->chart_name}}/]
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @case(5)
        
                            {{$item->id}}[[{{$item->chart_name}}]]
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @case(6)
        
                            {{$item->id}}(({{$item->chart_name}}))
                            {{$item->previous_chart}} -->@if ($item->flowline_name)|{{$item->flowline_name}}|@endif {{$item->id}}
                                        @break
                                    @default
                                        
                                @endswitch
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        @foreach ($chart as $item)
                            @switch($item->action_type)
                                @case(2)
        
                            click {{$item->id}} "{{$item->action}}" "a link"
                                    @break
                                @case(3)
                                
                            click {{$item->id}} showFullFirstSquad "{{$item->action}}"
                                    @break
                                @default
                                    
                            @endswitch
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    var chart = {!! json_encode($chart->toArray()) !!};

    mermaid.initialize({
        startOnLoad: true, securityLevel: 'loose', logLevel: 1
    });
    function showFullFirstSquad(elemName) {
    var action;
    for (var i = 0; i < chart.length; i++){
        if (chart[i].id == elemName){
            action = chart[i].action;
        }
    }
        alert(action);
    }
    
    // mermaid.mermaidAPI.initialize({
    //     startOnLoad:true, securityLevel: 'loose', logLevel: 1
    // });
    
    
    // $(function(){
    //     // Example of using the API
    //     var element = document.querySelector("#graphDiv");

    //     var insertSvg = function(svgCode, bindFunctions){
    //         element.innerHTML = svgCode;
    //         bindFunctions();
    //     };

    //     var graphDefinition = 'graph TD\n0(Christmas)\n0--> 2(Go shopping)\n --> 3{Let me think}\n3 -->|One| 4[Laptop]\n3 -->|Two| 5(iPhone)\n3 -->|Three| 6[fa:fa-car Car]\n6--> 7(Bugatti)\nclick 2 "http://www.github.com" "This is a link"\nclick 4 showFullFirstSquad "test"\n';
    //     var graph = mermaid.mermaidAPI.render('graphDiv0', graphDefinition, insertSvg);
    // });


    // function showFullFirstSquad(elemName) {
    //     alert(elemName);
    // }
    // function onNodeClick(nodeId){
    //     alert(nodeId);
    // }
    // var graphDefinition = 'graph TD\nA[Christmas] -->|Get money| B(Go shopping)\nB --> C{Let me think}\nC -->|One| D[Laptop]\nC -->|Two| E[iPhone]\nC -->|Three| F[fa:fa-car Car]\nclick B "http://www.github.com" "This is a link"\nclick D showFullFirstSquad "test"\n';
</script>

@stop