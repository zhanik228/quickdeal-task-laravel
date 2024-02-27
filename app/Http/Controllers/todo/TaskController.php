<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $createdTask = Task::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
            'todo' => $request->status ?? false,
            'in_progress' => $request->status ?? false,
            'done' => $request->status ?? false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            return $task;
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Task not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required'
            ]);

            $updatedTask = $task->update([
                'title' => $request->title,
                'todo' => $request->status ?? false,
                'in_progress' => $request->status ?? false,
                'done' => $request->status ?? false,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'successfully updated',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Task not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            if ($task->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'successfully deleted'
                ]);
            }

            return response()->json([
                'status' => 'failed',
                'message' => 'Could not delete task'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Task not found'
            ]);
        }
    }
}
