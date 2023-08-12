<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\AdmissionModel;
use App\Models\CasteModel;
use App\Models\CategoriesModel;
use App\Models\ClassesModel;
use App\Models\CreateClass;
use App\Models\FeesDetailsModel;
use App\Models\FeesHeadModel;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    public function castDetails() {
        return view('pages.reports.cast-details')->with([
            "cats" => CategoriesModel::get()
        ]);
    }

    public function catAssocCast(Request $req) {
        $casts = '';
        $cat = "";
        if($req->cat == 'all') {
            $casts = CasteModel::get();
            $cat = "ALL";
        } else {
           $cat = CategoriesModel::where("id", $req->cat)->first()->name;
            $casts = CasteModel::where("cat" , $req->cat)->get();
        }

        $pdf = PDF::loadView('pdfs.cast-details', [
            "casts" => $casts,
            "cat" => $cat
        ]);

        return $pdf->stream("Duplicate Receipt.pdf");
    }


    public function feesStructure(Request $req) {
        $nursery = "";
        $ukg = "";
        $lkg = "";
        $first = "";
        $second = "";
        $third = "";
        $fourth = "";
        $fifth = "";
        $sixth = "";
        $seventh = "";
        $eighth = "";
        $ninth = "";
        $tenth = "";
        $yr = "";
        if($req->year !== null){
            $nursery = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 1])->orderBy("fee_head", "ASC")->get();
            $ukg = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 2])->orderBy("fee_head", "ASC")->get();
            $lkg = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 3])->orderBy("fee_head", "ASC")->get();
            $first = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 4])->orderBy("fee_head", "ASC")->get();
            $second = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 5])->orderBy("fee_head", "ASC")->get();
            $third = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 6])->orderBy("fee_head", "ASC")->get();
            $fourth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 7])->orderBy("fee_head", "ASC")->get();
            $fifth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 8])->orderBy("fee_head", "ASC")->get();
            $sixth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 9])->orderBy("fee_head", "ASC")->get();
            $seventh = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 10])->orderBy("fee_head", "ASC")->get();
            $eighth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 11])->orderBy("fee_head", "ASC")->get();
            $ninth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 12])->orderBy("fee_head", "ASC")->get();
            $tenth = FeesDetailsModel::select("fee_head","amount", "class", "amt_per_annum")->where(["year"=>$req->year, "class" => 13])->orderBy("fee_head", "ASC")->get();
            $yr = AcademicYearModel::where('id', $req->year)->first()->year;
        } else {
            $nursery = ["0"];
            $ukg = ["0"];
            $lkg = ["0"];
            $first = ["0"];
            $second = ["0"];
            $third = ["0"];
            $fourth = ["0"];
            $fifth = ["0"];
            $sixth = ["0"];
            $seventh = ["0"];
            $eighth = ["0"];
            $ninth = ["0"];
            $tenth = ["0"];
            $yr = "Select Academic Year";
        }
        return view('pages.reports.fees-structure')->with([
            "heads" => FeesHeadModel::get(),
            "years" => AcademicYearModel::get(),
            "nursery" => $nursery,
            "ukg" => $ukg,
            "lkg" => $lkg,
            "first" => $first,
            "second" => $second,
            "third" => $third,
            "fourth" => $fourth,
            "fifth" => $fifth,
            "sixth" => $sixth,
            "seventh" => $seventh,
            "eighth" => $eighth,
            "ninth" => $ninth,
            "tenth" => $tenth,
            "yr" => $yr
        ]);
    }


    public function generalRegister() {
        return view('pages.reports.general-register');
    }


    public function classDetails() {
        return view('pages.reports.class-details')->with([
            'classes' => ClassesModel::get(),
            'years' => AcademicYearModel::get(),
        ]);
    }

    public function detailsClass(Request $req) {
        $details = [];

        if ($req->critic == 'BOTH') {
            $details = AdmissionModel::select("id", "name", "fname", "mname", "lname", "dob", "caste")
                ->where(['year' => $req->year, 'class' => $req->class])->withTrashed()
                ->get();
    
            $dd = CreateClass::where(['year' => $req->year, 'standard' => $req->class])->get();
            foreach ($dd as $d) {
                $details[] = AdmissionModel::select("id", "name", "fname", "mname", "lname", "dob", "caste")
                    ->where('id', $d->student)->withTrashed()
                    ->first(); 
            }

            foreach($details as $det){
                $det['caste'] = $det['caste'] == null ? '' : CasteModel::where('id', $det['caste'])->first(['name'])->name;
            }
        }

        if($req->critic == 'IN'){
            $details = AdmissionModel::select("id", "name", "fname", "mname", "lname", "dob", "caste")
            ->where(['year' => $req->year, 'class' => $req->class])
            ->get();

            $dd = CreateClass::where(['year' => $req->year, 'standard' => $req->class])->get();
            foreach ($dd as $d) {
            $details[] = AdmissionModel::select("id", "name", "fname", "mname", "lname", "dob", "caste")
                ->where('id', $d->student)
                ->first(); 
            }

            foreach($details as $det){
                $det['caste'] = $det['caste'] == null ? '' : CasteModel::where('id', $det['caste'])->first(['name'])->name;
            }
        }

        if($req->critic == 'OUT'){
            $details = AdmissionModel::select("id", "name", "fname", "mname", "lname", "dob", "caste")
            ->where(['year' => $req->year, 'class' => $req->class])->onlyTrashed()
            ->get();

            foreach($details as $det){
                $det['caste'] = $det['caste'] == null ? '' : CasteModel::where('id', $det['caste'])->first(['name'])->name;
            }
        }
    
        $year = AcademicYearModel::where("id", $req->year)->first()->year;
        $class = ClassesModel::where("id", $req->class)->first()->name;
        
        $pdf = PDF::loadView('pdfs.class-details', [
            "details" => $details->unique(),
            "class" => $class,
            "year" => $year,
        ]);
    

        return $pdf->stream("Class Details.pdf");

    }
}
