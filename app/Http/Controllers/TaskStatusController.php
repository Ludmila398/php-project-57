<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('TaskStatus.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user() === null) {
            abort(403);
        }
        $task_status = new TaskStatus();
        return view('TaskStatus.create', compact('task_status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $request->validated();

        TaskStatus::create($data);

        //flash(__('messages.status.created'), 'success');
        flash(__('messages.status.created'))->success();

        return redirect()->route('task_statuses.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }
        return view('TaskStatus.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        $data = $request->validated();

        $taskStatus->update($data);

        flash(__('messages.status.modified'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if (Auth::user() === null) {
            abort(403);
        }

        if ($taskStatus->tasks()->exists()) {
            flash(__('messages.status.deleted.error'))->error();
        } else {
            $taskStatus->delete();

            flash(__('messages.status.deleted'))->success();
        };

        return redirect()->route('task_statuses.index');
    }
}
