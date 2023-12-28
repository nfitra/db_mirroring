<?php

namespace App\Http\Controllers\API;

use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Invoice extends BaseController
{
    public function store(Request $request)
    {
        $dataArray = json_decode($request->getContent(), true);

        if (count($dataArray) > 500) {
            return $this->sendError('Validation error.');
        }

        $ruleHeader = [
            'docId' => 'required|string|unique:invoice_headers',
            'customerNo' => 'required|string',
            'debtorAcct' => 'required|string',
            'virtualAccountName' => 'required|string',
            'lotNo' => 'required|string',
            'virtualAccountEmail' => 'required|string',
            'docDate' => 'required|string',
            'dueDate' => 'required|string',
            'totalAmount' => 'required|string',
            'prevBill' => 'nullable|string',
            'payFine' => 'nullable|string',
            'details.*' => 'required|array',
        ];

        $ruleDetail = [
            'billId' => 'required|string|unique:invoice_details',
            'billCode' => 'required|string',
            'billNo' => 'required|string',
            'billName' => 'required|string',
            'billShortName' => 'required|string',
            'billDescription' => 'required|string',
            'billAmount' => 'required|string'
        ];

        $errorsArray = [];

        $i = 1;
        foreach ($dataArray as $dataHeader) {
            $validator = Validator::make($dataHeader, $ruleHeader);

            if ($validator->fails()) {
                $errorsArray[isset($dataHeader['docId']) ? $dataHeader['docId'] : $i] = $validator->errors()->toArray();
            }

            $j = 1;
            foreach ($dataHeader['details'] as $dataDetail) {
                $validator = Validator::make($dataDetail, $ruleDetail);
                if ($validator->fails()) {
                    $errorsArray[isset($dataHeader['docId']) ? $dataHeader['docId'] : $i]['details'][isset($dataDetail['billId']) ? $dataDetail['billId'] : $j] = $validator->errors()->toArray();
                }
            }
            $i++;

            if (count($errorsArray) >= 10)
                break;
        }

        if (count($errorsArray) != 0) {
            return $this->sendError('Validation error.', $errorsArray);
        }

        foreach ($dataArray as $dataHeader) {
            $headerCreated = InvoiceHeader::create($dataHeader);
            $headerCreated->details()->createMany($dataHeader['details']);
        }

        return $this->sendResponse('Data invoices stored successfully.');
    }
}
