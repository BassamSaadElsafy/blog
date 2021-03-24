<?php

namespace App\Http\Requests;

use App\Rules\MAX_POST_ALLOWED;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

        $post_rules = [
            'image'         => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png'],
            "description"   => ["required", "min:10"],
            "user_id"       => ["required", "exists:users,id", new MAX_POST_ALLOWED],
        ];

        if ($this->getMethod() == 'POST') {

            $post_rules += ['title'    => ["required", "min:3", "unique:posts"] ];

        }else {

            $post_rules += ["title"    => ["required", "min:3", "unique:posts,id," . $this->post->id] ];

        }

        return $post_rules;

    }

    public function messages()
    {
        return [
            'title.required'       => 'you must fill title field',
            'title.min'            => 'post title must be at least 3 characters',
            'description.required' => 'you must fill description field',
            'description.min'      => 'post description must be at least 10 characters',
            'user_id.required'     => 'Post Creator must be selected from the list',
            'user_id.in'           => 'Post Creator is not valid!',
            'post_img.required'    => 'Post Image is mandatory!',
            'post_img.file'        => 'Post Image must be file!',
            'post_img.mimes'       => 'Post Image must be jpeg or png type!',
        ];

    }
}
