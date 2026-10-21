<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],

            'delivery_method' => [
                'required',
                Rule::in(['personal', 'office']),
            ],

            'payment_method' => [
                'required',
                Rule::in(['cash_on_delivery', 'unicredit']),
            ],

            'city' => [
                'exclude_unless:delivery_method,personal',
                'required',
                'string',
                'max:255',
            ],

            'billing_address' => [
                'exclude_unless:delivery_method,personal',
                'required',
                'string',
                'max:255',
            ],

            'office_list' => [
                'exclude_unless:delivery_method,office',
                'required',
                'string',
                'max:255',
            ],

            'request_invoice' => ['sometimes', 'boolean'],

            'company_name' => [
                'exclude_unless:request_invoice,1',
                'required',
                'string',
                'max:255',
            ],

            'company_mol' => [
                'exclude_unless:request_invoice,1',
                'required',
                'string',
                'max:255',
            ],

            'company_bulstat' => [
                'exclude_unless:request_invoice,1',
                'required',
                'string',
                'max:255',
            ],

            'company_address' => [
                'exclude_unless:request_invoice,1',
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required' => 'Моля, въведете вашето име.',
            'lname.required' => 'Моля, въведете вашата фамилия.',
            'phone.required' => 'Моля, въведете телефонен номер.',
            'email.required' => 'Моля, въведете имейл адрес.',
            'email.email' => 'Моля, въведете валиден имейл адрес.',

            'delivery_method.required' => 'Моля, изберете начин на доставка.',
            'delivery_method.in' => 'Избраният начин на доставка е невалиден.',

            'payment_method.required' => 'Моля, изберете начин на плащане.',
            'payment_method.in' => 'Избраният начин на плащане е невалиден.',

            'city.required' => 'Моля, изберете град.',
            'billing_address.required' => 'Моля, въведете адрес за доставка.',
            'office_list.required' => 'Моля, изберете офис на Еконт.',

            'company_name.required' => 'Моля, въведете името на фирмата.',
            'company_mol.required' => 'Моля, въведете името на МОЛ.',
            'company_bulstat.required' => 'Моля, въведете ЕИК / Булстат.',
            'company_address.required' => 'Моля, въведете адреса на фирмата.',
        ];
    }
}
