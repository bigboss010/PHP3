<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Bài 2
        // Khi sửa một trường như email thì cần phải truyền id để nó bỏ qua check trên db
        // return [
        //     'email' => 'required|email|unique:users,email' . $this->id,
        //     'age' => 'nullable|min:18|max:100|integer',
        //     'avatar' => 'nullable|file|mimes:jpeg,png,jgp|max:2048'
        // ];

        // Bài 3
        // return [
        //     'is_shipping_address_same' => 'required|boolean',
        //     'shipping_address' => 'required_if:is_shipping_address_same,true'    
        // ];

        // Bài 4
        // return [
        //     'user_id' => 'required|exists:users,id',
        //     'vote_star' => 'required|integer|min:1|max:5',
        //     'feedback' => 'required|string|min:50|max:500'
        // ];

        // Bài 5
        // return [
        //     'name' => 'required|min:5|max:20',
        //     'birth_day' => 'required|date_format:d/m/Y',
        //     'province' => 'string|nullable',
        //     'district' => 'required_with:province'
        // ];

        // Bài 6
         return [
            'username' => 'required|unique:users,username',
            'phone_number' => 'nullable|regex:/^(+?[\d\s-()]{7,15})$/'
        ];
    }

    public $id;

    public function setID($id){
        $this->$id = $id;
    }
}
