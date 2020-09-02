@extends('layouts.app') @section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Choose Flowchart</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Flowchart</button>
                    </div>
                </div>
                <div class="card-body">
                    @if ($flowchart)
                        <div class="form-group">
                            <label>Which flowchart you want to be displayed?</label>
                            <select class="form-control" id="mySelect" onchange="fun()">
                                @foreach ($flowchart as $item)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>
            @if ($flowchart)
                <div class="card">
                    <div class="card-header">
                        <h4>Flowchart</h4>
                        <div class="card-header-action">
                            <a href="" class="btn btn-primary" id="add-obj">Add Object</a>
                            
                            {{-- <form action="{{ route('destroy-flow') }}" id="form-delete" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input id="item-id" type="hidden" name="id" value="">
                                <button type="submit" onclick="this.form.submit(); this.disabled=true; this.innerHTML='Mengirim…';" class="btn btn-danger"> Delete Object </button>
                            </form> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="diagram"
                        style="width:1540px; height:600px; background-color: #DAE4E4;">

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Flowchart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('store-flowchart') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Flowchart Name</label>
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="name" name="name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/gojs/release/go.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var itemId = document.getElementById("mySelect").value;
    var url = '{{ route("add-flow", ["flowchart" => ":id"]) }}';
        url = url.replace(':id', itemId);
    document.getElementById("add-obj").href = url;

</script>
<script type="text/javascript">
	var result = {!! json_encode($flowchart->toArray()) !!};

    var $ = go.GraphObject.make;

    var diagram = $(go.Diagram, "diagram",
    {
      "undoManager.isEnabled": true,
      layout: $(go.TreeLayout,
                { angle: 90, layerSpacing: 35 })
    });
    diagram.nodeTemplate =
        $(go.Node, "Auto",
        new go.Binding("location", "loc", go.Point.parse),
        $(go.Shape, "Ellipse",
            { strokeWidth: 2, fill: "white" },
            new go.Binding("figure", "figure")
          ),
        $(go.TextBlock,
            { margin: 12, stroke: "black", font: "bold 16px sans-serif" },
            new go.Binding("text", "key"),
            new go.Binding("url", "url"),
            new go.Binding("aksi", "aksi")),
        {
            click: function(e, obj) {
                if (obj.part.data.aksi) {
                    alert("show: " + encodeURIComponent(obj.part.data.aksi));
                }
                if (obj.part.data.url) {
                    window.open("http://" + encodeURIComponent(obj.part.data.url));
                }
            }
        });
    
    diagram.linkTemplate =
        $(go.Link,
        { routing: go.Link.Orthogonal, corner: 5 },
        $(go.Shape));
    var nodeDataArray = [];
    var linkDataArray = [];
    result.forEach(function(result) {
        if (result.id == itemId) {
            result.obyek.forEach(function(obyek) {
                if (obyek.action_type == 2) {
                    var currentNode = {
                        'key': obyek.name,
                        'figure': obyek.type,
                        'url': obyek.action
                    }
                    var currentLink = {
                        'from': obyek.parent,
                        'to': obyek.name
                    }
                    nodeDataArray.push(currentNode);
                    linkDataArray.push(currentLink);
                }else if(obyek.action_type == 3){
                    var currentNode = {
                        'key': obyek.name,
                        'figure': obyek.type,
                        'aksi': obyek.action
                    }
                    var currentLink = {
                        'from': obyek.parent,
                        'to': obyek.name
                    }
                    nodeDataArray.push(currentNode);
                    linkDataArray.push(currentLink);
                }else{
                    var currentNode = {
                        'key': obyek.name,
                        'figure': obyek.type
                    }
                    var currentLink = {
                        'from': obyek.parent,
                        'to': obyek.name
                    }
                    nodeDataArray.push(currentNode);
                    linkDataArray.push(currentLink);
                }
                console.log(linkDataArray);
            });
        }
    });
    diagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);

    function fun() {
        itemId = document.getElementById("mySelect").value;
        var nodeDataArray = [];
        var linkDataArray = [];
        result.forEach(function(result) {
            if (result.id == itemId) {
                result.obyek.forEach(function(obyek) {
                    if (obyek.action_type == 2) {
                        var currentNode = {
                            'key': obyek.name,
                            'figure': obyek.type,
                            'url': obyek.action
                        }
                        var currentLink = {
                            'from': obyek.parent,
                            'to': obyek.name
                        }
                        nodeDataArray.push(currentNode);
                        linkDataArray.push(currentLink);
                    }else if(obyek.action_type == 3){
                        var currentNode = {
                            'key': obyek.name,
                            'figure': obyek.type,
                            'aksi': obyek.action
                        }
                        var currentLink = {
                            'from': obyek.parent,
                            'to': obyek.name
                        }
                        nodeDataArray.push(currentNode);
                        linkDataArray.push(currentLink);
                    }else{
                        var currentNode = {
                            'key': obyek.name,
                            'figure': obyek.type
                        }
                        var currentLink = {
                            'from': obyek.parent,
                            'to': obyek.name
                        }
                        nodeDataArray.push(currentNode);
                        linkDataArray.push(currentLink);
                    }
                    console.log(linkDataArray);
                });
            }
        });
        diagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
    }
</script>

@stop