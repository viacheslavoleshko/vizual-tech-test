<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    private ?Book $book;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->book = $this->route('book');
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
            'name' => 'required|max:255|unique:books,name,'.$this->book->id,
            'authors_list'  => 'required|array|min:1',
            'publishers_list'  => 'required|array|min:1',
        ];
    }
}
