@php
    $nominal = $method==='GET' ? 'GET':'POST';
@endphp

<form {{ $id ? 'id="'.$id.'"':''  }} action="{{ $action }}" method="{{ $nominal }}" class="col-md-12 form-{{ $template }}{{ $classes ? ' '.$classes:''  }}">
    @method($method)
    @csrf
    @foreach ($elements as $element)
        <div class="row pb-3">
            <div class="col-md-4">
                {{ $element->getLabel() }}
            </div>
            <div class="col-md-8">
                {{ $element->render() }}
            </div>
        </div> 
    @endforeach
    @if ($submit)
        <div class="row">
            <div class="action-btns">
               {{ $submit->render() }}
            </div>
        </div>
    @endif
</form>