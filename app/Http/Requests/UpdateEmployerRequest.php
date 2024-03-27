<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'matricule' => [Rule::unique('employers')->ignore(request()->id)],
            'name' => ['required','min:4'],
            'image' => ['nullable'],
            'sexe' => ['required', 'in:b,g'],
            'birthday' => ['required', 'date', 'before:' . date('Y-m-d', strtotime('21 years ago'))],
            'address' => ['nullable'],
            'joined_at' => ['required', 'date'],
            'salary' => ['nullable', 'integer'],
            'civility' => ['required', 'in:célibataire,marié,divorcé,mariée'],
            'poste' => ['nullable'/*, 'exists:postes,id'*/]
        ];
    }
}
