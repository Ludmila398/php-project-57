<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Label;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->pluck('name', 'id');
        $taskStatuses = TaskStatus::select('name', 'id')->pluck('name', 'id');

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->orderBy('id')
            ->paginate(15);

            return view('Task.index', [
                'tasks' => $tasks,
                'users' => $users,
                'taskStatuses' => $taskStatuses,
                'activeFilter' => request()->get('filter', [
                    'status_id' => '',
                    'assigned_to_id' => '',
                    'created_by_id' => ''
                ])]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatuses = TaskStatus::select('name', 'id')->pluck('name', 'id');
        $users = User::select('name', 'id')->pluck('name', 'id');
        $labels = Label::select('name', 'id')->pluck('name', 'id');

        return view('Task.create', compact('taskStatuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
