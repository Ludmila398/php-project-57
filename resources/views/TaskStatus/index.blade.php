@extends('layouts.main')

@section('content')

<div class="grid col-span-full">
        <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.statuses') }}</h1>

        @auth
            <div>
                <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('strings.create status') }}
                </a>
            </div>
        @endauth

        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('strings.name') }}</th>
                <th>{{ __('strings.data created') }}</th>
                @auth
                    <th>{{ __('strings.actions') }}</th>
                @endauth
            </tr>
            </thead>
            <tbody>

            @foreach($taskStatuses as $taskStatus)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                    <td>
                    @auth
                        <a data-method="delete" data-confirm="{{ __('strings.are you sure') }}" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', $taskStatus->id) }}">{{ __('strings.delete') }}</a>

                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $taskStatus->id) }}">{{ __('strings.edit') }}</a>
                    @endauth
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@endsection