<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DeviceType;

class DeviceRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|regex:/^.+@kindle\.com$/i',
            'type' => 'required|in:'.implode(',', array_keys(DeviceType::getAllDeviceName()))
        ];
    }
}
