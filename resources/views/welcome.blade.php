@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('pagination.welcome') }}</div>

                <div class="panel-body">
                    <div class="panel-body">
                        Por favor <a href="{{ url('/login') }}">{{ trans('auth.login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
