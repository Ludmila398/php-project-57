@extends('layouts.main')

@section('content')

<div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.create status') }}</h1>
        <div>
            {{ Form::open(['route' => 'task_statuses.store']) }}
            <div>
                {{ Form::label("name", __('strings.name')) }}
            </div>
            <div class="mt-2">
                {{ Form::text('name', old('name'), ['class' => 'rounded border border-gray-300 w-1/3 p-2', 'value' => old('name')]) }}
            </div>
            @error('name')
            <div class="text-rose-600">
                {{ $message }}
            </div>
            @enderror
            <div class="mt-2">
                {{ Form::submit(__('strings.create'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection