<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\AdmissionModel;
use App\Models\BonafiedCertificateModel;
use App\Models\CasteCertificateModel;
use App\Models\CertifyModel;
use App\Models\CharacterModel;
use App\Models\ClassesModel;
use App\Models\CreateClass;
use App\Models\StudyCertificate;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
    public function certificate() {

        return view('pages.certificate.certificate')->with(['years' => AcademicYearModel::get()]);
    }

        public function studyCertificate(Request $req) {

            $exist = StudyCertificate::where("student", $req->id)->first();
            $print = false;

            $adm = AdmissionModel::where('id', $req->id)->withTrashed()->first();
            
            if($exist !== null) {
                $print = true;
                $std = StudyCertificate::where("student", $req->id)->first();

                $student = $std->studentDetails;

                $std_from = $std->from_stdy;         
                $std_to = $std->to_stdy;       
                
                $from_year = $std->from_year;
                $to_year = $std->to_year;

                $caste = $student->stdCast->name;
                $subCaste = $student->subCaste == null ? '-' : $student->subCaste->name;

                $Rstd_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
                $Rfrom_year = $Rstd_from==null?'':$Rstd_from->acaYear->year;
                $Rstd_from = $Rstd_from==null?'':$Rstd_from->standardClass->name;
    
                $Rstd_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
                $Rto_year = $Rstd_to==null?'':$Rstd_to->acaYear->year;
                $Rstd_to = $Rstd_to==null?'':$Rstd_to->standardClass->name;

                return view("pages.certificate.study")->with([
                    "student" => $student,
                    "std_from" => $std_from,
                    "std_to" => $std_to,
                    "from_year" => $from_year,
                    "to_year" => $to_year,
                    "caste" => $caste,
                    "subCaste" => $subCaste,
                    'classes' => ClassesModel::get(),
                    'years' => AcademicYearModel::get(),
                    "print" => $print,

                    'Rfrom_year' => $Rfrom_year,
                    'Rstd_from' => $Rstd_from,
                    'Rto_year'=>$Rto_year,
                    'Rstd_to' =>$Rstd_to

                ]);
            }


            $student = AdmissionModel::where("id", $req->id)->withTrashed()->first();

            $std_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
            if($std_from == null) {
                return view("pages.certificate.study")->with([
                    "student" => $student,
                    "std_from" => null,
                    "std_to" => null,
                    "from_year" => null,
                    "to_year" => null,
                    "caste" => null,
                    "subCaste" => null,
                    'classes' => ClassesModel::get(),
                    'years' => AcademicYearModel::get(),
                    "print" => $print,
                    'Rfrom_year' => null,
                    'Rstd_from' => null,
                    'Rto_year'=>null,
                    'Rstd_to' =>null
                ]);
            }
            $from_year = $adm->acaYear->year;
            $std_from = $adm->classes->name;

            $std_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            $to_year = $std_to==null?'':$std_to->acaYear->year;
            $std_to = $std_to==null?'':$std_to->standardClass->name;
            
            $caste = $student->stdCast->name;
            $subCaste = $student->subCaste == null ? '-' : $student->subCaste->name;

            $Rstd_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
            $Rfrom_year = $adm->acaYear->year;
            $Rstd_from = $adm->classes->name;

            $Rstd_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            $Rto_year = $Rstd_to==null?'':$Rstd_to->acaYear->year;
            $Rstd_to = $Rstd_to==null?'':$Rstd_to->standardClass->name;

            
            return view("pages.certificate.study")->with([
                "student" => $student,
                "std_from" => $std_from,
                "std_to" => $std_to,
                "from_year" => $from_year,
                "to_year" => $to_year,
                "caste" => $caste,
                "subCaste" => $subCaste,
                'classes' => ClassesModel::get(),
                'years' => AcademicYearModel::get(),
                "print" => $print,
                'Rfrom_year' => $Rfrom_year,
                'Rstd_from' => $Rstd_from,
                'Rto_year'=>$Rto_year,
                'Rstd_to' =>$Rstd_to
            ]);
        }

        public function saveStudyCertificate(Request $req) {
            $data = [
                "student"=>$req->id,
                "from_stdy"=>$req->std_from,
                "to_stdy"=> $req->std_to,
                "from_year"=> $req->from_year,
                "to_year"=>$req->to_year,
                "mother_lang"=>$req->mt,
                // 'cast' => $req->cast,
                // 'subcast' => $req->subcast,
                // 'religion' => $req->religion,
            ];

            $exist = StudyCertificate::where("student", $req->id)->first();

            if($exist == null) {
                StudyCertificate::create($data);
            } else {
                StudyCertificate::where("student", $req->id)->update($data);
            }

            return response()->json([
                'msg' => 'success'
            ]);

        }

        public function pdfStudyCertificate(Request $req) {

            $stdcert = StudyCertificate::where("student", $req->id)->first();
            $student = $stdcert->studentDetails;
            $caste = $student->stdCast->name;
            $subCaste = $student->subCaste == null ? "-" : $student->subCaste->name;
            $pdf = PDF::loadView('pdfs.study', ["study" => $stdcert, "student" => $student, 'caste' => $caste, "subCaste" => $subCaste]);
            return $pdf->stream($stdcert->student.'.pdf');
        }

        public function pdfStudyCertificate2(Request $req) {

            $stdcert = StudyCertificate::where("student", $req->id)->first();
            $student = $stdcert->studentDetails;
            // dd($student);
            $caste = $student->stdCast->name;
            $subCaste = $student->subCaste == null ? "-" : $student->subCaste->name;

            $pdf = PDF::loadView('pdfs.study2', ["study" => $stdcert, "student" => $student, 'caste' => $caste, "subCaste" => $subCaste]);
            return $pdf->stream($stdcert->student.'.pdf');
        }

        public function bonafiedCertificate(Request $req) {
            $exist = BonafiedCertificateModel::where("student", $req->id)->first();
            $print = false;

            if($exist !== null) {
                $print = true;

                $bon = BonafiedCertificateModel::where("student", $req->id)->first();
                $standard = $bon->studying_in;
                $acaYear = $bon->year;
                $student = $bon->studentDetails;

                $Rstd = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
                $RacaYear = $Rstd==null?'':$Rstd->acaYear->year;
                $Rstandard = $Rstd==null?'':$Rstd->standardClass->name;

                return view("pages.certificate.bonafied")->with([
                    "student" => $student,
                    "standard" => $standard,
                    "acaYear" => $acaYear,
                    'classes' => ClassesModel::get(),
                    'years' => AcademicYearModel::get(),
                    "print" => $print,

                    "RacaYear" => $RacaYear,
                    "Rstandard" => $Rstandard

                ]);
            }


            $student = AdmissionModel::where("id", $req->id)->withTrashed()->first();

            $std = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            if($std == null) {
                return view("pages.certificate.bonafied")->with([
                    "student" => $student,
                    "standard" => null,
                    "acaYear" => null,
                    'classes' => ClassesModel::get(),
                    'years' => AcademicYearModel::get(),
                    "print" => $print,
                    "RacaYear" => null,
                    "Rstandard" => null
                ]);
            }
            $acaYear = $std->acaYear->year;
            $standard = $std->standardClass->name;

            $Rstd = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            $RacaYear = $Rstd->acaYear->year;
            $Rstandard = $Rstd->standardClass->name;

            return view("pages.certificate.bonafied")->with([
                "student" => $student,
                "standard" => $standard,
                "acaYear" => $acaYear,
                'classes' => ClassesModel::get(),
                'years' => AcademicYearModel::get(),
                "print" => $print,

                "RacaYear" => $RacaYear,
                "Rstandard" => $Rstandard
            ]);
        }

        public function saveBonafied(Request $req) {
            $data = [
                "student" => $req->id,
                "studying_in" => $req->std,
                "year" => $req->year,
            ];

            $exist = BonafiedCertificateModel::where("student", $req->id)->first();

            if($exist == null) {
                BonafiedCertificateModel::create($data);
            } else {
                BonafiedCertificateModel::where("student", $req->id)->update($data);
            }

            return response()->json([
                'msg' => 'success'
            ]);

        }

        public function pdfBonafied(Request $req) {

            $bonfied = BonafiedCertificateModel::where("student", $req->id)->first();
            $student = $bonfied->studentDetails;


            $pdf = PDF::loadView('pdfs.bonafied', ["bonfied" => $bonfied, "student" => $student]);
            return $pdf->stream($bonfied->student.'.pdf');
        }


        public function casteCertificate(Request $req) {
            $exist = CasteCertificateModel::where("student", $req->id)->first();
            $print = false;

            if($exist !== null) {
                $print = true;

                $studying_in = CasteCertificateModel::where("student", $req->id)->first()->studying_in;

                $Rstudying_in = CreateClass::where("student", $req->id)->orderby("id", "DESC")->first();
                $Rstudying_in = $Rstudying_in==null?'':$Rstudying_in->standardClass->name;

                return view("pages.certificate.caste")->with([
                    'studying_in' => $studying_in,
                    'classes' => ClassesModel::get(),
                    'print' => $print,
                    'id' => $req->id,

                    'Rstudying_in' => $Rstudying_in
                ]);
            }

            $studying_in = CreateClass::where("student", $req->id)->orderby("id", "DESC")->first();
            $studying_in = $studying_in==null?'':$studying_in->standardClass->name;

           return view("pages.certificate.caste")->with([
            'studying_in' => $studying_in,
            'classes' => ClassesModel::get(),
            'print' => $print,
            'Rstudying_in' => '',
            'id' => $req->id
           ]);
        }

        public function saveCaste(Request $req) {
            $data = [
                'student' => $req->id,
                'studying_in' => $req->std
            ];
            $exist = CasteCertificateModel::where("student", $req->id)->first();

            if($exist == null) {
                CasteCertificateModel::create($data);
            } else {
                CasteCertificateModel::where("student", $req->id)->update($data);
            }

            return response()->json([
                'msg' => 'success'
            ]);
        }

        public function castePDF(Request $req) {

            $casteC = CasteCertificateModel::where('student', $req->id)->first();

            $student = AdmissionModel::where("id", $req->id)->withTrashed()->first();
            $caste = $student->stdCast->name;
            $subCaste = $student->subCaste == null ? "-" : $student->subCaste->name;

            // $std = CreateClass::where("student",$req->id)->orderBy("id", "DESC")->first();

            $pdf = PDF::loadView('pdfs.caste', ["student" => $student, 
            // 'std' => $std, 
            'caste' => $caste, 'subCaste' => $subCaste, 'cert' => $casteC]);
            return $pdf->stream($student->id.'.pdf');
        }
        
        public function characterCertificate(Request $req) {
            
       
            $exist = CharacterModel::where("student", $req->id)->first();
            $print = false;

            if($exist !== null) {
                $print = true;
                $char = CharacterModel::where("student", $req->id)->first();
                
                $std_from = $char->studied_from;
                $std_to = $char->studied_to;
    
                $from_year = $char->year_from;
                $to_year = $char->year_to;

                $student = $char->studentDetails;

                $Rstd_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
                $Rfrom_year = $Rstd_from==null?'':$Rstd_from->acaYear->year;
                $Rstd_from = $Rstd_from==null?'':$Rstd_from->standardClass->name;
    
                $Rstd_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
                $Rto_year = $Rstd_to==null?'':$Rstd_to->acaYear->year;
                $Rstd_to = $Rstd_to==null?'':$Rstd_to->standardClass->name;

                return view("pages.certificate.character")->with([
                    "student" => $student,
                    "std_from" => $std_from,
                    "std_to" => $std_to,
                    "from_year" => $from_year,
                    "to_year" => $to_year,
                    'classes' => ClassesModel::get(),
                    'years' => AcademicYearModel::get(),
                    "print" => $print,

                    'Rfrom_year' => $Rfrom_year,
                    'Rstd_from' => $Rstd_from,
                    'Rto_year' => $Rto_year,
                    'Rstd_to' => $Rstd_to

                ]);
            }

            $student = AdmissionModel::where("id", $req->id)->withTrashed()->first();

            $std_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
            $from_year = $std_from==null?'':$std_from->acaYear->year;
            $std_from = $std_from==null?'':$std_from->standardClass->name;

            $std_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            $to_year = $std_to==null?'':$std_to->acaYear->year;
            $std_to = $std_to==null?'':$std_to->standardClass->name;

            $Rstd_from = CreateClass::where("student", "$req->id")->orderBy('id', 'ASC')->first();
            $Rfrom_year = $Rstd_from==null?'':$Rstd_from->acaYear->year;
            $Rstd_from = $Rstd_from==null?'':$Rstd_from->standardClass->name;

            $Rstd_to = CreateClass::where("student", "$req->id")->orderBy('id', 'DESC')->first();
            $Rto_year = $Rstd_to==null?'':$Rstd_to->acaYear->year;
            $Rstd_to = $Rstd_to==null?'':$Rstd_to->standardClass->name;
            
            return view("pages.certificate.character")->with([
                "student" => $student,
                "std_from" => $std_from,
                "std_to" => $std_to,
                "from_year" => $from_year,
                "to_year" => $to_year,
                'classes' => ClassesModel::get(),
                'years' => AcademicYearModel::get(),
                "print" => $print,

                'Rfrom_year' => $Rfrom_year,
                'Rto_year' => $Rto_year,

                'Rstd_from' => $Rstd_from,
                'Rstd_to' => $Rstd_to
            ]);
        }

        public function saveCharacterCertificate(Request $req) {
            $data = [
                "student" => $req->id,
                "studied_from" => $req->std_from,
                "studied_to" => $req->std_to    ,
                "year_from" =>  $req->from_year,
                "year_to" => $req->to_year,
            ];

            $exist = CharacterModel::where("student", $req->id)->first();

            if($exist == null) {
                CharacterModel::create($data);
            } else {
                CharacterModel::where("student", $req->id)->update($data);
            }

            return response()->json([
                'msg' => 'success'
            ]);

        }

        public function pdfCHaracter(Request $req) {
            $stdcert = CharacterModel::where("student", $req->id)->first();
            $student = $stdcert->studentDetails;

            $pdf = PDF::loadView('pdfs.character', ["study" => $stdcert, "student" => $student]);
            return $pdf->stream($stdcert->student.'.pdf');
        }

        public function certificateCertificate(Request $req) {

            $exist = CertifyModel::where("student", $req->id)->first();
            $print = false;

            if($exist !== null) {
                $print = true;
                $studying_in = CertifyModel::where("student", $req->id)->first()->studying_in;

                $Rstudying_in = CreateClass::where("student", $req->id)->orderby("id", "DESC")->first();
                $Rstudying_in = $Rstudying_in==null?'':$Rstudying_in->standardClass->name;

                return view("pages.certificate.certify")->with([
                    'studying_in' => $studying_in,
                    'classes' => ClassesModel::get(),
                    'print' => $print,
                    'id' => $req->id,

                    'Rstudying_in' => $Rstudying_in
                ]);
            }

            $studying_in = CreateClass::where("student", $req->id)->orderby("id", "DESC")->first();
            $studying_in = $studying_in==null?'':$studying_in->standardClass->name;

            $Rstudying_in = CreateClass::where("student", $req->id)->orderby("id", "DESC")->first();
            $Rstudying_in = $Rstudying_in==null?'':$Rstudying_in->standardClass->name;

            return view("pages.certificate.certify")->with([
                'studying_in' => $studying_in,
                'classes' => ClassesModel::get(),
                'print' => $print,
                'id' => $req->id,

                'Rstudying_in' => $Rstudying_in
            ]);
        }

        public function saveCertificate(Request $req) {
            $data = [
                'student' => $req->id,
                'studying_in' => $req->std
            ];

            $exist = CertifyModel::where("student", $req->id)->first();

            if($exist == null) {
                CertifyModel::create($data);
            } else {
                CertifyModel::where("student", $req->id)->update($data);
            }

            return response()->json([
                'msg' => 'success'
            ]);
            
        }

        public function pdfCertify(Request $req) {
      
            $cert = CertifyModel::where("student", $req->id)->first();
            $std = AdmissionModel::where("id", $req->id)->withTrashed()->first();
            $dobWord = Controller::getWord($std->dob->format("d")) ."- ".$std->dob->format("F")." - ".Controller::getWord($std->dob->format("Y"));
            $pdf = PDF::loadView('pdfs.certify', ["cert" => $cert, "student" => $std, 'dobWord' => $dobWord]);
            return $pdf->stream($cert->student.'.pdf');
        }
}
