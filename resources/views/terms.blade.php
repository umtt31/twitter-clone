@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed error odit officia sunt deserunt veritatis
                sint
                eveniet facilis id molestiae ullam aspernatur itaque, quidem non odio possimus culpa distinctio incidunt.
            </div>
        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
