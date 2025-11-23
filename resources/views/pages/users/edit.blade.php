@extends('layouts.portal.master')
@section('content')
@php
    if(isset($user) && $user->hasRole('root')){
        session()->now('warning', __('alerts.users.warning.user_is_root'));
    }
@endphp

<div class="content-card">
    <div class="content-card-top">
        <div class="content-card-header">
            <div class="content-card-title">{{ __('forms.users.header') }}</div>
        </div>
    </div>
    <div class="content-card-body container">
        {{ $form->render() }}
    </div>
</div>

@php
    $i = 0;
@endphp
@foreach($employments as $header => $employment)
@php
    $i++;
    $style = '';
    if($i === 1){
        $style = ' style="display: none;"';
    }
@endphp
<div class="content-card employment-card"{!! $style !!}>
    <div class="content-card-top">
        <div class="content-card-header">
            <div class="content-card-title">{{ $header }}</div>
        </div>
    </div>
    <div class="content-card-body container">
        {{ $employment->render() }}
    </div>
</div>

@endforeach

@endsection
@push('scripts')
<script type="text/javascript">
    $(document).on('click', '.add-employment', function () {
        $(document).find('.employment-card:first').show();
    });

    $(document).on('click', '.delete-employment', function (e) {
        let link = $(this).attr('href');
        e.preventDefault();
        $.confirm(
            'Czy na pewno zawieścić tą kampanię? Użytkownicy przestaną widzieć cele przypisane w ramach tej kampanii, a administratorzy nie będą mogli dodawać nowych celów.',
            null,
            function() {
                $.overlay('show');
                window.location.href = link;
            }
        );
    });
</script>
@endpush
