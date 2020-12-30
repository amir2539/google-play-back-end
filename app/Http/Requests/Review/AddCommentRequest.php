<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AddCommentRequest
 * @package App\Http\Requests\Review
 *
 * @property string $app
 * @property string $review
 * @property string $sentiment
 * @property string $sentiment_polarity
 * @property string $sentiment_subjectivity
 */
class AddCommentRequest extends FormRequest
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
            'app' => 'required|string|min:1|exists:apps,name',
            'review' => 'required|string|min:3',
            'sentiment' => 'required|string',
            'sentiment_polarity' => 'required|numeric',
            'sentiment_subjectivity' => 'required|numeric',
        ];
    }
}
