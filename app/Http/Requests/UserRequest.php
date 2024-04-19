<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // a user can register themself in which 
        // case the role will be client.
        if ( ! isset(Request()->role) || Request()->role == "client") {
            return true;
        }

        // if the requested role for the new user is 
        // admin then the requesting user must be
        // admin too.
        if (Request()->role == "admin") {

            if ( ! Auth()->user()) {
                return false;
            }

            if (Auth()->user()->role == "admin") {
                return true;
            }
        }

        // how did we get here??
        // take the safe route..
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'role'      => 'nullable|string|in:client,admin',
            "email"     => "required|email",
            'password'  => "nullable|string|min:8|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/",
            'comment'   => 'nullable|string',
        ];

    }


    public function messages(): array
    {
        return [
            'password.regex'        => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
    
}
