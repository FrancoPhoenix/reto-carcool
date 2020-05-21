@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <team-component api-url="{{ route('players.index') }}"></team-component>
                </div>
            </div>
        </div>
    </div>
@endsection
