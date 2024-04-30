<?php

namespace App\Http\Controllers\Transactions;

use App\Exports\DataExport;
use App\Http\Controllers\Controller;
use App\Services\GetInfoService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GetExcelController extends Controller
{
    public function getExcelFile(Request $request, GetInfoService $service)
    {
        return Excel::download(new DataExport($service->getExcelData($request->post('user_id'))), 'История расходов и доходов пользователя.xlsx');
    }
}
