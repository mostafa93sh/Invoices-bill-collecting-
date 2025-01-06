<?php

namespace App\Http\Controllers;

use App\Models\Invoices_details;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = Invoices_Details::where('id_Invoice',$id)->get();
        $attachments  = Invoices_attachments::where('invoice_id',$id)->get();

        return view('invoices.details_invoices',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoices = Invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number,$file_name)

    {
        $contents= public_path('attachments/'.$invoice_number.'/'.$file_name);
        return response()->download( $contents);
    }
    public function open_file($invoice_number,$file_name)

    {
        // $files = Storage::disk('public_uploads')->get($invoice_number.'/'.$file_name);
            $files = public_path('attachments/'.$invoice_number.'/'.$file_name);
        return response()->file($files);
    }
}
