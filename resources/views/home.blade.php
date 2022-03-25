@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} - <strong>You are {{ auth()->user()->type }}.</strong>

{{--                        TODO Add auth()->user()->type as attribute in model --}}
                    @if(auth()->user()->type == 'admin')
                    <strong><a href="{{route('users.index')}}">Users</a></strong>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
