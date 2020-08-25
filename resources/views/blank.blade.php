@extends('layouts.app') @section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Blank Page</h1>
        </div>

        <div class="section-body">
            <div class="mermaid">
                graph TD
                    A[Christmas] -->|Get money| B(Go shopping)
                    B --> C{Let me think}
                    C -->|One| D[Laptop]
                    C -->|Two| E[iPhone]
                    C -->|Three| F[fa:fa-car Car]
                    click B "http://www.github.com" "This is a link"
                    click D showFullFirstSquad "test"
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
<script>
    mermaid.initialize({
        startOnLoad: true, securityLevel: 'loose', logLevel: 1
    });
    function showFullFirstSquad(elemName) {
        console.log('show ' + elemName);
    }
    function onNodeClick(nodeId){
        alert(nodeId);
    }
</script>

@stop