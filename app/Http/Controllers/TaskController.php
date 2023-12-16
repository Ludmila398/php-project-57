<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::pluck('name', 'id');

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
    public function store(StoreTaskRequest $request)
    {
        $request->validated();

        $data = $request->except('labels');
        $data['created_by_id'] = optional(auth()->user())->id;

        $labels = collect($request->input('labels'))
        ->filter(fn($label) => $label !== null);

        $task = Task::create($data);

        $task->labels()->attach($labels);

        flash(__('messages.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $labels = $task->labels;

        return view('Task.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users = User::select('name', 'id')->pluck('name', 'id');
        $taskLabels = $task->labels;
        $labels = Label::select('name', 'id')->pluck('name', 'id');

        return view('Task.edit', compact('task', 'taskStatuses', 'users', 'labels', 'taskLabels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request->validated();

        $data = $request->except('labels');

        $labels = collect($request->input('labels'))
            ->filter(fn($label) => $label !== null);

        $task->update($data);

        $task->labels()->sync($labels);

        flash(__('messages.task.updated'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash(__('messages.task.deleted'), 'success');

        return redirect()->route('tasks.index');
    }
}
