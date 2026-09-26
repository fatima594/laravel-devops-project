<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class ContactRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required',
        ];
    }

    /**
     * Custom validation messages (اختياري لكن جميل)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email.',
            'message.required' => 'Message is required.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ];
    }

    /**
     * Verify reCAPTCHA with Google after normal validation
     */
    protected function passedValidation(): void
    {
        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret'   => config('services.recaptcha.secret_key'),
                'response' => $this->input('g-recaptcha-response'),
                'remoteip' => $this->ip(),
            ]
        );

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            abort(
                response()->json([
                    'message' => 'reCAPTCHA verification failed.',
                    'errors' => [
                        'g-recaptcha-response' => [
                            'reCAPTCHA verification failed. Please try again.'
                        ]
                    ]
                ], 422)
            );
        }
    }
}
