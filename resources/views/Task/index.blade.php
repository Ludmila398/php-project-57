@extends('layouts.main')
@section('content')

    <div class="grid col-span-full">
            <h1 class="mb-5 max-w-2xl text-4xl md:text-4xl xl:text-5xl">{{ __('strings.tasks') }}</h1>
            
            <div class="w-full flex items-center">
                <div>
                    {{Form::open(['route' => 'tasks.index', 'method' => 'GET'])}}
                    <div class="flex">
                        <div>
                            {{Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null, ['placeholder' =>  __('strings.status'), 'class' => 'rounded border-gray-300'])}}
                        </div>
                        <div>
                            {{Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' =>  __('strings.author'), 'class' => 'ml-2 rounded border-gray-300'])}}
                        </div>
                        <div>
                            {{Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' =>  __('strings.executor'), 'class' => 'ml-2 rounded border-gray-300'])}}
                        </div>
                        <div>
                            {{ Form::submit( __('strings.apply'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2']) }}
                        </div>    
                    </div>
                    {{Form::close()}}
                </div>    

                @auth
                <div class="ml-auto">
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 whitespace-nowrap">
                        {{ __('strings.create task') }}
                        </a>
                </div>
                @endauth   
                        
            </div>

            <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('strings.status') }}</th>
                <th>{{ __('strings.name') }}</th>
                <th>{{ __('strings.author') }}</th>
                <th>{{ __('strings.executor') }}</th>
                <th>{{ __('strings.data created') }}</th>
                @auth
                    <th>{{ __('strings.actions') }}</th>
                @endauth  
            </tr>
            </thead>
            <tbody>

            @foreach($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td><a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                    <td>{{ $task->createdByUser->name }}</td>
                    <td>{{ $task->assignedToUser->name ?? "" }}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    <td>
                        @auth
                        @if ($task->created_by_id === Auth::id())
                            <a data-method="delete" data-confirm="{{ __('strings.are you sure') }}" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task->id) }}">{{ __('strings.delete') }}</a>
                        @endif
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">{{ __('strings.edit') }}</a>
                        
                        @endauth
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{ $tasks->links() }}
    </div>
  
@endsection