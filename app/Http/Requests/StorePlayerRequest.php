<?php

namespace App\Http\Requests;

use App\Models\Player;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'pseudo'  => [
                'nullable',
                'string',
                Rule::unique(Player::class, 'pseudo'),
            ],
            'name'    => [
                'required',
                'string',
            ],
            'surname' => [
                'required',
                'string',
            ],
            'photo'   => [
                'required',
                'file',
                'image',
            ],
        ];
    }
}
