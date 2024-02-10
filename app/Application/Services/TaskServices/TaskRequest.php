<?php

namespace App\Application\Services\TaskServices;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_name' => 'required|string|max:255',
            'is_completed' => 'boolean',
        ];
    }
}
