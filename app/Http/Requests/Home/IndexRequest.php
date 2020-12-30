<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 *
 * @package App\Http\Requests\Home
 *
 * @property string $orderby
 * @property string $order
 * @property int $per_page
 * @property  int $page
 * @property string $filter
 * @property string $filter_value
 * @property string $search
 */
class IndexRequest extends FormRequest
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
            'orderby'      => 'nullable|string',
            'order'        => 'nullable|string',
            'per_page'     => 'nullable|integer',
            'filter'       => 'nullable|string',
            'filter_value' => 'nullable|string',
            'search'       => 'nullable|string'
        ];
    }
}
