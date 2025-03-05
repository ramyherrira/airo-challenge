<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuotationRequest;
use App\Http\Resources\QuotationResource;
use App\Models\PolicyQuotation;
use App\Services\PolicyCalculator;

class CreateQuotationController extends Controller
{
    public function __construct(protected PolicyCalculator $policyCalculator) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateQuotationRequest $request): QuotationResource
    {
        $amount = $this->policyCalculator->calculate(
            $request->getCurrency(),
            $request->getStartDate(),
            $request->getEndDate(),
            $request->getFormattedAgeList(),
        );

        $quotation = PolicyQuotation::create([
            'total' => $amount,
            'start_date' => $request->getStartDate(),
            'end_date' => $request->getEndDate(),
            'currency_id' => $request->getCurrency(),
            'age_list' => $request->getFormattedAgeList(),
        ]);

        return new QuotationResource($quotation);
    }
}
