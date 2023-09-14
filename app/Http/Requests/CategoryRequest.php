<?php

namespace App\Http\Requests;

use App\Rules\FilterInputs;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'between:3,255', 'unique:categories,name,' . $this->id, new FilterInputs(['php', 'laravel'])],
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'description' => 'nullable|min:2',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width:100px,min_height:100px',
            'status' => 'required|in:active,inactive',
        ];
    }
}
