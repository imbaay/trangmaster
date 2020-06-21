<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DienthoaiUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'slug'          => 'required|unique:books,slug,'.$this->book,
            'description'   => 'required',
            'noisanxuat_id'     => 'required',
            'danhmuc_id'   => 'required',
            'image_id'      => 'image|max:1000',
            'init_price'    => 'required|numeric',
            'discount_rate' => 'required|numeric|max:100',
            'quantity'      => 'required|numeric'
        ];

    }
    
    public function messages()
    {
        return [
            'noisanxuat_id.required'    => 'Chua dien noi san xuat',
            'danhmuc_id.required'  => 'Chua dien danh muc',
            'image_id.image'        => 'Anh phai co duoi png, jpg, jpeg'
        ];
    }
}
