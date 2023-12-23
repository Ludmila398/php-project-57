<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('Label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = new Label();
        return view('Label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabelRequest $request)
    {
        $data = $request->validated();

        Label::create($data);

        flash(__('messages.label.created'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('Label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabelRequest $request, Label $label)
    {
        $data = $request->validated();

        $label->update($data);

        flash(__('messages.label.modified'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('messages.label.deleted.error'))->error();
        } else {
            $label->delete();

            flash(__('messages.label.deleted'))->success();
        };

        return redirect()->route('labels.index');
    }
}
