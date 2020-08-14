@extends('layouts.app')

@section('title', '')
@section('content')
    <section class="single-post">
        <div class="container">
            <div class="row">
                <div class="modal-dialog">
                    @include('block.modals.post')
                </div>
            </div>
        </div>
    </section>
@endsection