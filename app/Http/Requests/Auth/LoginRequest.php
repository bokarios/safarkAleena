<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request {

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
			'email' => 'required|email',
      'password' => 'required',
		];
	}

	public function messages()
	{
		return [
			'email.required' => 'حقل البريد الالكتروني فارغ',
			'email.email' => 'الرجاء ادخال بريد الكتروني صحيح',
      'password.required' => 'حقل كلمة المرور فارغ',
		];
	}

}
