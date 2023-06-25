@php
    $nominal = $method==='GET' ? 'GET':'POST';
@endphp

<form {{ $id ? 'id="'.$id.'"':''  }} action="{{ $action }}" method="{{ $nominal }}" class="col-md-12 form-{{ $template }}{{ $classes ? ' '.$classes:''  }}" enctype="multipart/form-data">
    @csrf
    @foreach ($elements as $element)
        <div class="row pb-3">
            <div class="col-md-4">
                <div class="d-flex">
                    <div class="form-label">
                        {{ $element->getLabel() }}
                    </div>
                    <div class="form-info">
                        {!! $element->getInfos() !!}
                    </div>
                </div>
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
