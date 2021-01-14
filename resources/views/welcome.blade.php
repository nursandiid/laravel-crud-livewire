@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    External Library
                </div>

                <div class="card-body">
                    <livewire:external-library />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection