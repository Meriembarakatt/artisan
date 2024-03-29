<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class articleRequest extends FormRequest
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
            'designation' => 'required|max:255',
            'prix_ht' => 'required|numeric',
            'qte' => 'required|numeric',
            'stock' => 'required|numeric',
            'sousfamille_id' => 'required|exists:sous_familles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
       
        ];
    }
}
