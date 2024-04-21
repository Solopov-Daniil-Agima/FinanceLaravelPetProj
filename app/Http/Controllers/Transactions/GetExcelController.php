<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GetInfoService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;

class GetExcelController extends Controller
{
    public function getExcelFile(Request $request, GetInfoService $service)
    {
        return Excel::download(new DataExport($service->getExcelData($request->post('user_id'))), 'test.xlsx');
    }
}
