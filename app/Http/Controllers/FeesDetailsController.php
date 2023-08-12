<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\AdmissionModel;
use App\Models\ClassesModel;
use App\Models\CreateClass;
use App\Models\FeeReceiptModel;
use App\Models\FeesDetailsModel;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeesDetailsController extends Controller
{
    public function feesReceipts() {
        return view('pages.fees.fees-receipts');
    }

    public function feePaying(Request $req) {

        Validator::make($req->all(), [
                "id" => ["required", "numeric"],
                "annualFee" => ["required", "numeric"],
                "feesPaid" => ["required", "numeric"],
                "balance" => ["required", "numeric"],
                "paying" => ["required", "numeric"],
        ])->validate();

        $paying = $req->paying + $req->feesPaid;
        $balance = $req->annualFee - $paying;

        $data = [
            "student" => $req->student,
            "year" => $req->year,
            "class" => $req->class,
            "amt_paid" => $req->paying,
            "receipt_no" => $req->receipt_no
        ];

        $receipt = FeeReceiptModel::create($data);

        if(isset($receipt->id)) {
            if(CreateClass::where("id", $req->id)->update([
                "paid" =>$paying,
                "balance" => $balance
               ]) > 0) {
                return response()->json(["msg" => "success"]);
            } else {
                return response()->json(["msg" => "failed"]);
            }
        } else {
            return response()->json(["msg" => "failed"]);
        }
        
    }

    public function receiptCancellation() {
        return view('pages.fees.receipt-cancellation');
    }
    public function feesArrears() {

        return view('pages.fees.fees-arrears')->with([
            'years' => AcademicYearModel::get(),
            'classes' => ClassesModel::get(),
        ]);
        
    }

    public function submitFeesArrears(Request $req) {

        $details = CreateClass::where(['year' => $req->year, 'standard' => $req->class])->get();
        foreach($details as $detail) {
            $detail['student'] = $detail->getStudent;
        }
        
        $pdf = PDF::loadView('pdfs.classwisefees', ["fees" => $details, 
            'year' => AcademicYearModel::where("id", $req->year)->first()->year, 
            'class' => ClassesModel::where('id', $req->class)->first()->name
        ]);

        return $pdf->stream("Classwise Fees Arrears".'.pdf');
    }

    public function dayBook() {
        return view('pages.fees.day-book');
    }
    public function daybookSubmit(Request $req) {

        $receipts = '';

        if($req->section == 1) {
            $receipts =  FeeReceiptModel::whereDate('created_at', '=', $req->date)->where('class', '>', 0)->where('class', '<', 11)->get();
        } else {
            $receipts =  FeeReceiptModel::whereDate('created_at', '=', $req->date)->where('class', '>', 10)->get();
        }

       
       
       $total = 0;
       foreach($receipts as $receipt) {
            $receipt['student'] = $receipt->studentDetail;
            $receipt['class'] = $receipt->classes->name;
            $total = $total + $receipt->amt_paid;
       }

       $pdf = PDF::loadView('pdfs.daybook', ["receipts" => $receipts, 
            'date' => date('d-m-Y', strtotime($req->date)),
            'section' => $req->section == 1 ? "PRIMARY" : "HIGHER",
        ]);

        return $pdf->stream("Day Book".$req->section == 1 ? "PRIMARY" : "HIGHER".'.pdf');

    }

    public function feesRegister() {

        return view('pages.fees.fees-register')->with([
            'years' => AcademicYearModel::get(),
            'classes' => ClassesModel::get(),
        ]);
    }

    public function pdfFeesRegister(Request $req) {

       $fees = FeeReceiptModel::where(['year' => $req->year, 'class' => $req->class])->get();

       $year_id = '';

       if((int)date("m") >= 6) {
        $crr = date("Y");
        $nxt = date("Y")[2].date("Y")[3];
        $year_id = $crr."-".(int)$nxt+1;
        } else {
            $crr = date("Y")-1;
            $nxt = date("Y")[2].date("Y")[3];
            $year_id = $crr."-".(int)$nxt;
        }

       $year = AcademicYearModel::where('year', $year_id)->first();

        foreach($fees as $fee) {
            $fee['student'] = $fee->studentDetail;

            $fee['type'] = $fee->student->year == $year->id ? 'NEW' : 'OLD';
        }

       $totalAmt = FeesDetailsModel::where(['year' => $req->year, 'class' => $req->class])->first()->amt_per_annum;

       $pdf = PDF::loadView('pdfs.feesregister', ["fees" => $fees, 'amount' => $totalAmt]);

       return $pdf->stream("Fees Register.pdf");
    }

    public function receiptDatewise() {
        return view('pages.fees.receipt-datewise');
    }

    public function receiptToday(Request $req) {
        $receipts = '';

        if($req->section == 1) {
            $receipts =  FeeReceiptModel::whereDate('created_at', '=', $req->date)->where('class', '>', 0)->where('class', '<', 11)->get();
        } else if($req->section == 2) {
            $receipts =  FeeReceiptModel::whereDate('created_at', '=', $req->date)->where('class', '>', 10)->get();
        } else {
            $receipts =  FeeReceiptModel::whereDate('created_at', '=', $req->date)->get();
        }

       $total = 0;
       foreach($receipts as $receipt) {
            $receipt['student'] = $receipt->studentDetail;
            $receipt['class'] = $receipt->classes->name;
            $total = $total + $receipt->amt_paid;
       }

       $name = '';

       if($req->section == 1) {
           $name = "PRIMARY";
       } else if($req->section == 2) {
           $name = "HIGHER";
       } else if($req->section == 0){
           $name = "";
       }

       $d = date('d-m-Y', strtotime($req->date));

       $pdf = PDF::loadView('pdfs.datewisereceipt', ["fees" => $receipts, 
            'date' => $d,
            'section' => $name,
        ]);

        return $pdf->stream("Datewise Receipt $name ($d).pdf");
    }

    public function receiptBetweenDates(Request $req) {
        $receipts = '';
        if($req->section == 1) {
            $receipts =  FeeReceiptModel::whereDate('created_at', '>=', $req->from_date)->whereDate('created_at', '<=', $req->to_date)->where('class', '>', 0)->where('class', '<', 11)->get();
        } else if($req->section == 2) {
            $receipts =  FeeReceiptModel::whereDate('created_at', '>=', $req->from_date)->whereDate('created_at', '<=', $req->to_date)->where('class', '>', 10)->get();
        } else {
            $receipts =  FeeReceiptModel::whereDate('created_at', '>=', $req->from_date)->whereDate('created_at', '<=', $req->to_date)->get();
        }

       $total = 0;
       foreach($receipts as $receipt) {
            $receipt['student'] = $receipt->studentDetail;
            $receipt['class'] = $receipt->classes->name;
            $total = $total + $receipt->amt_paid;
       }

       $name = '';

       if($req->section == 1) {
           $name = "PRIMARY";
       } else if($req->section == 2) {
           $name = "HIGHER";
       } else {
           $name = "";
       }

       $from_d = date('d-m-Y', strtotime($req->from_date));
       $to_d = date('d-m-Y', strtotime($req->to_date));

       $pdf = PDF::loadView('pdfs.datewisereceipt', ["fees" => $receipts, 
            'date' => $from_d,
            'section' => $name,
            'to_date' => $to_d,
        ]);
        
        return $pdf->stream("Datewise Receipt $name ($from_d / $to_d) .pdf");
    }

    public function duplicateReceipt() {
        return view('pages.fees.duplicate-receipt')->with([
            "years" => AcademicYearModel::get()
        ]);
    }

    public function stdReceiptID(Request $req) {

        $receipts = FeeReceiptModel::where("student", $req->id)->get();

        foreach($receipts as $r) {
            $r['class'] = $r->classes->name;
            $r['year'] = $r->years->year;
        }
       
        if(!isset($receipts[0])) {
            return redirect()->back();
        }

        $student = AdmissionModel::where("id", $receipts[0]->student)->withTrashed()->first();

        return view("pages.fees.receipts-std")->with([
            "receipts" => $receipts,
            "student" => $student
        ]);
    }

    public function getDuplicate(Request $req) {
        
        $receipt = FeeReceiptModel::where("id", $req->id)->first();

        $fees = FeesDetailsModel::where(["year" => $receipt->year, "class" => $receipt->class])->get();
        foreach($fees as $fee) {
            $fee['fee_head'] = $fee->feeHead->desc;
        }
        $tpb = CreateClass::select("total", "paid", "balance")->where(["year" => $receipt->year, "standard" => $receipt->class])->first();
        $receipt['class'] = $receipt->classes->name;
        $receipt['year'] = $receipt->years->year;
        $student = AdmissionModel::where("id", $receipt->student)->withTrashed()->first();

        $pdf = PDF::loadView('pdfs.duplicate-receipt', [
            "receipt" => $receipt,
            "student" => $student,
            "fees" => $fees,
            "tpb" => $tpb

        ]);

        return $pdf->stream("Duplicate Receipt.pdf");
    }
}
