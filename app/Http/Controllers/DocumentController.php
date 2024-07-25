<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Office;
use App\Models\QuickResponseCode;
use App\Models\Signatory;
use App\Models\Status;
use App\Models\ActivityLog; // Make sure to include this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;



class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('user', 'documentType', 'status')->get();
        return view('documents.index', compact('documents'));
        
    }

    public function create()
    {
        $documentTypes = DocumentType::all();
        $offices = Office::all();
        return view('documents.create', compact('documentTypes', 'offices'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'document_type' => 'required|exists:document_types,id',
            'document_file' => 'required|file|mimes:pdf,doc,docx',
            'signatories' => 'required|array',
            'signatories.*' => 'exists:offices,id',
        ]);
    
        $document = Document::create([
            'user_id' => Auth::id(),
            'DT_ID' => $validatedData['document_type'],
            'Description' => $validatedData['description'],
            'Status_ID' => 1, // Assuming 1 is the 'Pending' status
            'Date_Created' => now(),
            'Document_File' => $request->file('document_file')->store('documents', 'public'),
        ]);
        
 

        $localIP = env('APP_URL', 'http://192.168.0.122:8000');
        $qrCodeUrl = $localIP . '/qrcode/scan/' . $document->id;
        $qrCode = QrCode::format('svg')->size(200)->generate($qrCodeUrl);
        $qrCodePath = 'qrcodes/' . $document->id . '.svg';
        Storage::disk('public')->put($qrCodePath, $qrCode);
        
        
        $qrcode = QuickResponseCode::create([
            'Docu_ID' => $document->id,
            'QR_Image' => $qrCodePath,
            'Date_Created' => now(),
            'Usage_Count' => 0,
        ]);
    
        foreach ($validatedData['signatories'] as $officeId) {
            Signatory::create([
                'QRC_ID' => $qrcode->id,
                'Office_ID' => $officeId,
                'Status_ID' => 1, // Assuming 1 is the 'Pending' status
                'Received_Date' => null,
                'Signed_Date' => null,
            ]);
        }
    
        return redirect()->route('documents.index')->with('success', 'Document uploaded and QR code generated.');
    } 

    public function show($id)
    {
        $document = Document::with([
            'user', 
            'documentType', 
            'status', 
            'qrcode.signatories.office', 
            'qrcode.signatories.status'
        ])->findOrFail($id);
        
        return view('documents.show', compact('document'));
    }
    
    public function scan($qrcode)
    {
        $qrCode = QuickResponseCode::find($qrcode);
        if (!$qrCode) {
            return redirect()->back()->with('error', 'Invalid QR Code');
        }
    
        $document = $qrCode->document;
    
        return view('documents.scan', compact('qrCode', 'document'));
    }
    

    public function verify(Request $request, $id)
    {
        Log::info('Verifying Office PIN:', ['office_pin' => $request->office_pin]);
    
        $validatedData = $request->validate([
            'office_pin' => 'required|string',
        ]);
    
        $office = Office::where('Office_Pin', $validatedData['office_pin'])->first();
    
        if (!$office) {
            Log::error('Invalid Office PIN:', ['office_pin' => $request->office_pin]);
            return redirect()->back()->withErrors(['office_pin' => 'Invalid Office PIN']);
        }
    
        $qrcode = QuickResponseCode::findOrFail($id);
        $signatory = Signatory::where('QRC_ID', $qrcode->id)->where('Office_ID', $office->id)->first();
    
        if (!$signatory) {
            Log::error('Signatory not found:', ['QRC_ID' => $qrcode->id, 'Office_ID' => $office->id]);
            return redirect()->back()->withErrors(['office_pin' => 'Signatory not found for the given QR code and Office.']);
        }
    
        Log::info('Signatory found:', ['signatory' => $signatory]);
    
        // Update the status of the signatory and log the activity
        if ($signatory->Status_ID == 1) {
            $signatory->update([
                'Status_ID' => 2, // Assuming 2 is the 'Received by Office' status
                'Received_Date' => now(),
            ]);
            ActivityLog::create([
                'Docu_ID' => $signatory->QRC_ID,
                'Sign_ID' => $signatory->id,
                'action' => 'Received',
                'Timestamp' => now(),
            ]);
        } elseif ($signatory->Status_ID == 2) {
            $signatory->update([
                'Status_ID' => 3, // Assuming 3 is the 'Approved by Office' status
                'Signed_Date' => now(),
            ]);
            ActivityLog::create([
                'Docu_ID' => $signatory->QRC_ID,
                'Sign_ID' => $signatory->id,
                'action' => 'Approved',
                'Timestamp' => now(),
            ]);
        }
    
        Log::info('Signatory status updated:', ['signatory' => $signatory]);
    
        // Check if all signatories have approved the document
        $allApproved = Signatory::where('QRC_ID', $qrcode->id)->where('Status_ID', '<', 3)->doesntExist();
    
        if ($allApproved) {
            $document = $qrcode->document;
            $document->update([
                'Status_ID' => 3, // Assuming 3 is the 'Approved' status
                'Date_Approved' => now(),
            ]);
            ActivityLog::create([
                'Docu_ID' => $document->id,
                'Sign_ID' => null,
                'action' => 'Fully Approved',
                'Timestamp' => now(),
            ]);
        }
    
        $qrcode->increment('Usage_Count');
    
        Log::info('Signatory status updated successfully.');
    
        return redirect()->route('confirmation')->with('success', 'Signatory status updated.');
    }
}