<div class="row">
    @foreach ($elements as $element)
        <div class="col-md-6 col-xs-12">
            {{ $element->render() }}
        </div>
    @endforeach
</div>
