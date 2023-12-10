@extends('layouts.main')

@section('content')

<div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.edit label') }}</h1>
        <div>
            {{ Form::open(['route' => ['labels.update', $label], 'method' => 'patch']) }}
            <div>
                {{ Form::label("name", __('strings.name')) }}
            </div>
            <div class="mt-2">
                {{ Form::text('name', $label->name, ['class' => 'rounded border border-gray-300 w-1/3 p-2', 'value' => old('name')]) }}
            </div>
            @error('name')
            <div class="text-rose-600">
                {{ $message }}
            </div>
            @enderror
            <div class="mt-2">
                {{ Form::label("description", __('strings.description')) }}
            </div>
            <div class="mt-2">
                {{ Form::textarea('description', $label->description, ['class' => 'rounded border border-gray-300 w-1/3 h-32 p-2', 'value' => old('description'), 'rows' => 10, 'cols' => 50]) }}

            </div>
            @error('description')
            <div class="text-rose-600">
                {{ $message }}
            </div>
            @enderror


            <div class="mt-2">
                {{ Form::submit(__('strings.update'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection