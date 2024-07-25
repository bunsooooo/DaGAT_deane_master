<?php

namespace App\Http\Controllers;

use App\Models\Signatory;
use App\Models\Office;
use Illuminate\Support\Facades\DB;

class OfficeAnalyticsController extends Controller
{
    public function index()
{
    $analytics = Office::select('offices.Office_Name', 
                                DB::raw('AVG(TIMESTAMPDIFF(DAY, signatories.Received_Date, signatories.Signed_Date)) as avg_processing_time_days'),
                                DB::raw('AVG(TIMESTAMPDIFF(HOUR, signatories.Received_Date, signatories.Signed_Date)) as avg_processing_time_hours'),
                                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, signatories.Received_Date, signatories.Signed_Date)) as avg_processing_time_minutes'),
                                DB::raw('COUNT(signatories.id) as documents_processed'))
                        ->join('signatories', 'offices.id', '=', 'signatories.Office_ID')
                        ->whereNotNull('signatories.Received_Date')
                        ->whereNotNull('signatories.Signed_Date')
                        ->groupBy('offices.Office_Name')
                        ->get();

    $monthlyProcessedDocuments = DB::table('signatories')
        ->select(DB::raw('MONTH(Received_Date) as month'), DB::raw('COUNT(*) as documents_processed'))
        ->whereNotNull('Received_Date')
        ->groupBy(DB::raw('MONTH(Received_Date)'))
        ->orderBy('month')
        ->get()
        ->keyBy('month');

    $months = [
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    $monthlyProcessedDocumentsData = array_fill(0, 12, 0);
    foreach ($monthlyProcessedDocuments as $month => $data) {
        $monthlyProcessedDocumentsData[$month - 1] = $data->documents_processed;
    }

    return view('analytics.index', compact('analytics', 'months', 'monthlyProcessedDocumentsData'));
}

}
