<?php
/**
 * Created by IntelliJ IDEA.
 * User: iraklid
 * Date: 17/10/2019
 * Time: 17:17
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
     * i am addding validation only for the 2 params we are going
     * to use, more can be added in feature.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'offset' => 'integer|min:0',
            'limit'  => 'integer|min:1|max:5',
        ];
    }
}
