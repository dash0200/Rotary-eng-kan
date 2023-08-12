<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\GeneralReceiptModel;
use Illuminate\Http\Request;
use PDF;

class GeneralReceiptController extends Controller
{
    public function generalReceipts() {
        return view('pages.general-receipts.general-receipts')->with([
            "years" => AcademicYearModel::get()
        ]);
    }
    public function receipt(Request $req) {
        $req->validate([
            "date" => ["required", "date"],
            "amount" => ["required", "numeric", "gt:0"],
        ]);
        $data = [
            "date" => $req->date,
            "amount" => $req->amount,
            "year" => $req->year,
            "cause" => $req->cause,
        ];

        $receipt = GeneralReceiptModel::create($data);

        
        return redirect()->route('general.singleRece', ['id' => $receipt->id]);
    }

    public function singleRece(Request $req) {
        $receipt = GeneralReceiptModel::where('id', $req->id)->first();
        $pdf = PDF::loadView("pdfs.receipt", [
            "receipt" => $receipt
        ]);
        return $pdf->stream("General reciept.pdf");
    }

    public function getReceipt(Request $req) {
        $receipts = GeneralReceiptModel::where("date", $req->date)->get();
        $pdf = PDF::loadView("pdfs.general-receipt", [
            "receipts" => $receipts
        ]);

        return $pdf->stream("General reciept.pdf");
    }

    public function dayBook() {
        return view('pages.general-receipts.day-book');
    }


    public function datewise() {
        return view('pages.general-receipts.datewise');
    }

    public function datewiseGetReceipt(Request $req) {
        
        $receipts = GeneralReceiptModel::where("date", ">=", $req->from)->where("date", "<=", $req->to)->get();

        $pdf = PDF::loadView("pdfs.general-receipt", [
            "receipts" => $receipts,
            "from" => $req->from,
            "to" => $req->to,
        ]);

        return $pdf->stream("General reciept.pdf");
    }
}
