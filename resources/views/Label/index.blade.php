@extends('layouts.main')

@section('content')

<div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.labels') }}</h1>

        @auth
            <div>
                <a href="{{ route('labels.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('strings.create label') }}
                </a>
            </div>
        @endauth

        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('strings.name') }}</th>
                <th>{{ __('strings.description') }}</th>
                <th>{{ __('strings.data created') }}</th>
                @auth
                    <th>{{ __('strings.actions') }}</th>
                @endauth
            </tr>
            </thead>
            <tbody>

            @foreach($labels as $label)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    <td>
                    @auth
                        <a data-method="delete" data-confirm="{{ __('strings.are you sure') }}" class="text-red-600 hover:text-red-900" href="{{ route('labels.destroy', $label->id) }}">{{ __('strings.delete') }}</a>

                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label->id) }}">{{ __('strings.edit') }}</a>
                    @endauth
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@endsection