@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @livewire('delegation-form', ['delegateType' => $delegateType])
        </div>
    </div>
@endsection
