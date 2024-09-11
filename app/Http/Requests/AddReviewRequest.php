<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;

class AddReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $this->redirect = url()->previous() . '#review-div';
        return [
            'service_rating' => ['required', 'integer', 'between:1,5', 'min:1'],
            'quality_rating' => ['required', 'integer', 'between:1,5', 'min:1'],
            'cleanliness_rating' => ['required', 'integer', 'between:1,5', 'min:1'],
            'pricing_rating' => ['required', 'integer', 'between:1,5', 'min:1'],
            'review' => ['required', 'min:5']
        ];
    }
    public function failedAuthorization()
    {
        throw new AuthorizationException('لا تمتلك صلاحية إضافة مراجعة، فضلًا سجل دخولك للموقع');
    }
}
