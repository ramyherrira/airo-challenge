<?php

namespace App\Http\Requests;

use App\Rules\AgeList;
use App\Rules\Currency;
use Carbon\CarbonImmutable;
use Money\Currency as MoneyCurrency;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuotationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age' => [
                'required',
                new AgeList(),
            ],
            'currency_id' => [
                'required',
                new Currency(),
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d',
                'after:start_date',
            ],
        ];
    }

    public function getCurrency()
    {
        return new MoneyCurrency($this->currency_id);
    }

    public function getStartDate()
    {
        return new CarbonImmutable($this->start_date);
    }

    public function getEndDate()
    {
        return new CarbonImmutable($this->end_date);
    }

    public function getFormattedAgeList(): array
    {
        return explode(',', trim($this->age, ','));
    }
}
