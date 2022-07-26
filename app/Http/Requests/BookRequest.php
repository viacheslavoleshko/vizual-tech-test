<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255|unique:books,name',
            'authors_list'  => 'required|array|min:1',
            'publishers_list'  => 'required|array|min:1',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'name' => [
                        'required',
                        Rule::unique('books')->ignore($this->name, 'name'),
                    ]
                ] + $rules;
            case 'DELETE':
                return [
                    'book' => 'required|integer|exists:books,id',
                ];
        }
    }
}
