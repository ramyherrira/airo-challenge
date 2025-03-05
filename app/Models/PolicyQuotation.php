<?php

namespace App\Models;

use App\Util\MoneyFormatter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Money\Currency;
use Money\Money;

class PolicyQuotation extends Model
{
    /** @use HasFactory<\Database\Factories\PolicyQuotationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'total',
        'start_date',
        'end_date',
        'currency_id',
        'age_list',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:Y-m-d',
            'end_date' => 'datetime:Y-m-d',
            'age_list' => 'array',
        ];
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn(string $value, array $attributes) => new Money(
                $value * 100, 
                new Currency($attributes['currency_id'])
            ),
            set: fn (Money $value) => MoneyFormatter::format($value),
        );
    }
}
