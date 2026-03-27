@props([
    'label',
    'value',
    'valueClass' => '',
])

<div class="col-6 col-xl-3">
    <div class="content-card content-card-sm h-100">
        <div class="content-card-body">
            <div class="text-muted small">{{ $label }}</div>
            <div @class(['fs-3 fw-bold', $valueClass])>{{ $value }}</div>
        </div>
    </div>
</div>
