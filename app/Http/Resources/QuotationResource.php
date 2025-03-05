<?php

namespace App\Http\Resources;

use App\Util\MoneyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total' => MoneyFormatter::format($this->total),
            'currency_id' => $this->currency_id,
            'quotation_id' => $this->id,
        ];
    }
}
