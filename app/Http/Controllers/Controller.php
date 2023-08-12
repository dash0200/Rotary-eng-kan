<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\AdmissionModel;
use App\Models\ClassesModel;
use App\Models\CreateClass;
use App\Models\DistrictModel;
use App\Models\FeesDetailsModel;
use App\Models\StatesModel;
use App\Models\SubdistrictModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use LDAP\Result;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getWord(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees : '') . $paise;
    }

    public function getStuddent(Request $req)
    {

        $student = AdmissionModel::where('id', $req->id)->withTrashed()->first();
        $student['doy'] = $student->date_of_adm->format("Y");
        $student['dob1'] = $student->dob->format("d-m-Y");

        $standard = CreateClass::where("student", $req->id)->orderBy("id", "DESC")->first();
        $fees = FeesDetailsModel::select("fee_head", "amount")->where(["year" => $standard->year, "class" => $standard->standard])->get();

        foreach ($fees as $fee) {
            $fee["name"] = $fee->feeHead->desc;
        }

        $standard["std"] = $standard->standardClass;
        $standard['yr'] = $standard->acaYear;

        $stds = CreateClass::where("student", $req->id)->orderBy("id", "DESC")->get();

        foreach ($stds as $std) {

            $std['fees'] = FeesDetailsModel::select("fee_head", "amount")->where(["year" => $std->year, "class" => $std->standard])->get();

            foreach ($std['fees'] as $fee) {
                $fee["name"] = $fee->feeHead->desc;
            }

            $std["std"] = $std->standardClass;
            $std["yr"] = $std->acaYear;
        }

        return response()->json([$student, $standard, $fees, "prev" => $stds]);
    }

    public function getStdId(Request $req)
    {
        if (!isset($req->term)) {
            return response()->json();
        }
        $q = $req->term;
        
        $students = AdmissionModel::select('id', 'date_of_adm', 'sts', 'name', 'fname', 'mname', 'lname')->where("name", "LIKE", "%" . $q . "%")
        ->orWhere("fname", "LIKE", "%" . $q . "%")
        ->orWhere("mname", "LIKE", "%" . $q . "%")
        ->orWhere("lname", "LIKE", "%" . $q . "%")
        ->orWhere("id", "LIKE", "%" . $q . "%")
        ->orWhere("date_of_adm", "LIKE", "%" . $q . "%")
        ->orWhere("sts", "LIKE", "%" . $q . "%")
        ->limit(5)->withTrashed()->get();

        $student = array();

        foreach ($students as $std) {
            $student[] = array(
                'id' => $std->id,
                'text' => $std->id . "-" . $std->sts . ", " . $std->name . ", " . $std->fname . ", " . $std->lname . ", (" . $std->date_of_adm->format("d-m-Y") . ")"
            );
        }

        return response()->json($student);
    }

    public function getAdmStd(Request $req)
    {
        $student = AdmissionModel::where("id", $req->id)->withTrashed()->first();
        $student["doy"] = $student->date_of_adm->format("Y-m-d");
        $student["dobf"] = $student->dob->format("Y-m-d");

        $student['state'] = $student->district->state->state;
        $student['dist'] = $student->district->district;

        return response()->json($student);
    }

    public function dashboard() {

        $totalStudents = AdmissionModel::get()->count();

        $nurseryStudents = CreateClass::where("standard", 1)->get()->count();
        
        $year = '';

        if((int)date("m") >= 4) {
            $crr = date("Y");
            $nxt = date("Y")[2].date("Y")[3];
            $year = $crr."-".(int)$nxt+1;
        } else {
            $crr = date("Y")-1;
            $nxt = date("Y")[2].date("Y")[3];
            $year = $crr."-".(int)$nxt;
        }

        $year = AcademicYearModel::where('year', $year)->first();
        
        $nurseryStudents = CreateClass::where(["standard" => 1, 'year' => $year->id])->get()->count();
        $lkgStudents = CreateClass::where(["standard" => 2, 'year' => $year->id])->get()->count();
        $ukgStudents = CreateClass::where(["standard" => 3, 'year' => $year->id])->get()->count();
        $firstStudents = CreateClass::where(["standard" => 4, 'year' => $year->id])->get()->count();
        $secondStudents = CreateClass::where(["standard" => 5, 'year' => $year->id])->get()->count();
        $thirdStudents = CreateClass::where(["standard" => 6, 'year' => $year->id])->get()->count();
        $fourthStudents = CreateClass::where(["standard" => 7, 'year' => $year->id])->get()->count();
        $fifthStudents = CreateClass::where(["standard" => 8, 'year' => $year->id])->get()->count();
        $sixthStudents = CreateClass::where(["standard" => 9, 'year' => $year->id])->get()->count();
        $seventhStudents = CreateClass::where(["standard" => 10, 'year' => $year->id])->get()->count();
        $eighthStudents = CreateClass::where(["standard" => 11, 'year' => $year->id])->get()->count();
        $ninethStudents = CreateClass::where(["standard" => 12, 'year' => $year->id])->get()->count();
        $tenthStudents = CreateClass::where(["standard" => 12, 'year' => $year->id])->get()->count();

        $totalStudentThisYear = CreateClass::where(["year" => $year->id])->count();
        
        $newAdmission = AdmissionModel::where('year', $year->id)->get()->count();

        return view('dashboard')->with([
            "students" => $totalStudents,

            'nursery' => $nurseryStudents,
            "lkg" => $lkgStudents,
            "ukg" => $ukgStudents,
            "first" => $firstStudents,
            "second" => $secondStudents,
            "third" => $thirdStudents,
            "fourth" => $fourthStudents,
            "fifth" => $fifthStudents,
            "sixth" => $sixthStudents,
            "seventh" => $seventhStudents,
            "eighth" => $eighthStudents,
            "nineth" => $ninethStudents,
            "tenth" => $tenthStudents,

            "year" => $year->year,

            'totalStudentThisYear' => $totalStudentThisYear,

            'newAdmission' => $newAdmission
        ]);
    }

    public function getCurrentAcadmicYear() {
        
        $crr = date("Y");
        $nxt = date("Y")[2].date("Y")[3];
        $year = $crr."-".(int)$nxt+1;
        return $year;
        
    }

    public function moneyFormatIndia($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    public function state()
    {
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Bihar',
            'Chhattisgarh',
            'Goa',
            'Gujarat',
            'Haryana',
            'Himachal Pradesh',
            'Jharkhand',
            'Karnataka',
            'Kerala',
            'Madhya Pradesh',
            'Maharashtra',
            'Manipur',
            'Meghalaya',
            'Mizoram',
            'Nagaland',
            'Odisha',
            'Punjab',
            'Rajasthan',
            'Sikkim',
            'Tamil Nadu',
            'Telangana',
            'Tripura',
            'Uttar Pradesh',
            'Uttarakhand Dehradun ',
            'Gairsain ',
            'West Bengal'
        ];

        for ($i = 0; $i < count($states); $i++) {
            $s = StatesModel::where('name', $states[$i])->first();

            if ($s == null) {
                StatesModel::create(['name' => $states[$i]]);
            }
        }

        return redirect()->back();
    }

    public function district()
    {
        $district = [
            "Bagalkot",
            "Ballari (Bellary)",
            "Belagavi (Belgaum)",
            "Bengaluru (Bangalore) Rural",
            "Bengaluru (Bangalore) Urban",
            "Bidar",
            "Chamarajanagar",
            "Chikballapur",
            "Chikkamagaluru (Chikmagalur)",
            "Chitradurga",
            "Dakshina Kannada",
            "Davangere",
            "Dharwad",
            "Hubli",
            "Gadag",
            "Hassan",
            "Haveri",
            "Kalaburagi (Gulbarga)",
            "Kodagu",
            "Kolar",
            "Koppal",
            "Mandya",
            "Mysuru (Mysore)",
            "Raichur",
            "Ramanagara",
            "Shivamogga (Shimoga)",
            "Tumakuru (Tumkur)",
            "Udupi",
            "Uttara Kannada (Karwar)",
            "Vijayapura (Bijapur)",
            "Yadgir",
        ];

        for ($i = 0; $i < count($district); $i++) {
            $s = DistrictModel::where('name', $district[$i])->first();

            if ($s == null) {
                DistrictModel::create(['name' => $district[$i], 'state' => 11]);
            }
        }

        return redirect()->back();
    }

    public function subDist()
    {

        $subDist = [
            "district_1" => [
                "Jamkhandi",
                "Badami",
                "Hungund",
                "Mudhol",
                "Bagalkot",
                "Bilgi",
                "Mahalingpur",
            ],
            "district_2" => [
                "Hadagalli",
                "Hagaribommanahalli",
                "Hospet",
                "Siruguppa",
                "Bellary",
                "Sandur",
                "Kudligi",
            ],

            "district_3" => [
                "Athani",
                "Bailhongal",
                "Belagavi",
                "Chikkodi",
                "Gokak",
                "Hukkeri",
                "Khanapur",
                "Raibag",
                "Ramdurg",
                "Soudatti",
                "Kittur",
                "Nippani",
                "Kagawad",
                "Mudalagi",
                "Yaragatii",
            ],

            "district_4" => [
                "Dod Ballapur",
                "Hosakote ",
                "Nelamangala ",
                "Devanahalli ",
            ],

            "district_6" => [
                "Aurad",
                "Basavakalyan",
                "Bhalki",
                "Bidar",
                "Humnabad",
            ],

            "district_7" => [
                "Kollegal",
                "Chamarajanagar",
                "Gundlupet",
                "Yelandur",
            ],

            "district_19" => [
                "Kolar",
                "Bangarpet",
                "Malur",
                "Mulbagilu",
                "Srinivaspura",
                "Kolar Gold Fields",
            ],
            "district_18" => [
                "Somvarpet",
                "Virajpet",
                "Madikeri",
            ],
            "district_17" => [
                "Kalaburagi",
                "Aland",
                "Jewargi",
                "Afzalpur",
                "Kalagi",
                "Kamalapur",
                "Shahbad",
                "Yadrami",
            ],
            "district_16" => [
                "Byadgi",
                "Hangal",
                "Haveri",
                "Hirekerur",
                "Ranebennur",
                "Savanur",
                "Shiggaon",
            ],
            "district_15" => [
                "Alur",
                "Arkalgud",
                "Arsikere",
                "Belur",
                "Channarayapatna",
                "Hassan",
                "Hole Narsipur",
                "Sakleshpur",
            ],
            "district_14" => [
                "Gadag",
                "Ron",
                "Shirhatti",
                "Mundargi",
                "Nargund",
            ],
            "district_13" => [
                "Hubli Dharwad",
                "Dharwad",
                "Navalgund",
                "Kundgol",
                "Kalghatgi",
                "Hubli",
            ],
            "district_12" => [
                "Davanagere",
                "Channagiri",
                "Harapanahalli",
                "Harihar",
                "Honnali",
                "Jagalur",
            ],
            "district_11" => [
                "Mangalore",
                "Bantval",
                "Puttur",
                "Beltangadi",
                "Sulya",
            ],
            "district_10" => [
                "Chitradurga",
                "Challakere",
                "Hiriyur",
                "Hosadurga",
                "Holalkere",
                "Molakalmuru",
            ],
            "district_9" => [
                "Chikmagalur",
                "Kadur",
                "Tarikere",
                "Mudigere",
                "Koppa",
                "Narasimharajapura",
                "Sringeri",
            ],
            "district_8" => [
                "Chintamani",
                "Gauribidanur",
                "Sidlaghatta",
                "Chikkaballapura",
                "Bagepalli",
                "Gudibanda",
            ],

            "district_30" => [
                "Shorapur",
                "Shahpur",
                "Yadgir",
            ],
            "district_29" => [
                "Kanamadi",
                "Bijjaragi",
                "Alaginal",
                "Gonasagi",
                "Kallakavatagi",
                "Hubanur",
                "Indiranagar",
                "Yatnal",
                "Takkalaki",
                "Jalageri",
                "Arakeri",
                "Siddapura",
                "Baratagi",
                "Hanchinal",
                "Itangihal",
                "Lohagaon",
                "Sevalalnagar",
                "Dhanaragi",
                "Siddapur",
                "Malakandevarahatti",
                "Somadevarahatti",
                "Babanagar",
                "Honawad",
                "Kotyal",
                "Tajapur",
                "Harnal",
                "Ratnapura",
                "Tikota",
                "Rampur",
            ],
            "district_28" => [
                "Karwar",
                "Supa",
                "Haliyal",
                "Yellapur",
                "Mundgod",
                "Sirsi",
                "Ankola",
                "Kumta",
                "Siddapur",
                "Honavar",
                "Bhatka",
            ],
            "district_27" => [
                "Udupi",
                "Kapu",
                "Brahmavara",
                "Kundapura",
                "Byndoor",
                "Karkala",
                "Hebri",
            ],
            "district_26" => [
                "Chikkanayakanahalli",
                "Gubbi",
                "Koratagere",
                "Kunigal",
                "Madhugiri",
                "Pavagada",
                "Sira",
                "Tiptur",
                "Tumkur",
                "Turuvekere",
            ],
            "district_25" => [
                "Shimoga",
                "Bhadravati",
                "Shikarpur",
                "Sagar",
                "Sorab",
                "Tirthahalli",
                "Hosanagara",
            ],
            "district_24" => [
                "Kanakapura",
                "Ramanagara",
                "Channapatna",
                "Magadi",
            ],
            "district_23" => [
                "Raichur",
                "Sindhnur",
                "Lingsugur",
                "Manvi",
                "Devadurga",
            ],
            "district_22" => [
                "Mysore",
                "Nanjangud",
                "Tirumakudal-Narsipur",
                "Hunsur",
                "Heggadadevankote",
                "Krishnarajanagara",
                "Piriyapatna",
            ],
            "district_21" => [
                "Mandya",
                "Maddur",
                "Malavalli",
                "Krishnarajpet",
                "Nagamangala",
                "Pandavapura",
                "Shrirangapattana",
            ],
            "district_20" => [
                "Yelburga",
                "Kushtagi",
                "Gangavathi",
                "Koppal",
                "Karatagi",
                "Kukanoor",
                "Kanakagiri",
            ],
        ];

        foreach ($subDist as $sub) {

            for ($j = 0; $j < count(array_keys($subDist)); $j++) {
                $key = array_keys($subDist)[$j];
                // dd($key);

                for ($i = 0; $i < count($subDist[$key]); $i++) {
                    $id = explode("_", $key)[1];
                    $s = SubdistrictModel::where('name', $subDist[$key][$i])->first();

                    if ($s == null) {
                        SubdistrictModel::create(['name' => $subDist[$key][$i], 'district' => $id]);
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function acaYear()
    {

        $from = 1950;
        $to = 1951;

        for ($i = 0; $i < 200; $i++) {
            $tt = str_split($to + $i);

            $aca_year = $from + $i . "-" . $tt[2] . $tt[3];
            $s = AcademicYearModel::where('year', $aca_year)->first();
            if ($s == null) {
                AcademicYearModel::create(['year' => $aca_year]);
            }
        }
        return redirect()->back();
    }

    public function classes()
    {

        for ($i = 0; $i <= 12; $i++) {
            switch ($i) {
                case 0:
                    $std = "NURSERY";
                    break;
                case 1:
                    $std = "LKG";
                    break;
                case 2:
                    $std = "UKG";
                    break;
                case 3:
                    $std = "1ST";
                    break;
                case 4:
                    $std = "2ND";
                    break;
                case 5:
                    $std = "3RD";
                    break;
                case 6:
                    $std = "4TH";
                    break;
                case 7:
                    $std = "5TH";
                    break;
                case 8:
                    $std = "6TH";
                    break;
                case 9:
                    $std = "7TH";
                    break;
                case 10:
                    $std = "8TH";
                    break;
                case 11:
                    $std = "9TH";
                    break;
                case 12:
                    $std = "10TH";
                    break;
            }

            ClassesModel::create(["name" => $std]);
        }
        return redirect()->back();
    }

public function checkReg(Request $req){
        $exist = AdmissionModel::where('reg', $req->sts)->first();

        if($exist){
            return response()->json(['status'=>200, 'info' => $exist->name.' '.$exist->fname.' '.$exist->lname]);
        }

        return response()->json(['status'=>404]);
    }
}
