<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuotationRequest;
use App\Http\Resources\QuotationResource;

class CreateQuotationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateQuotationRequest $request): QuotationResource
    {
        return new QuotationResource((object) [
            'amount' => 117.00,
            'currency_id' => 'EUR',
            'id' => 1,
        ]);
    }
}
