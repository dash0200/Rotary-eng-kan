<?php

namespace App\Http\Controllers;

use App\Models\AcademicYearModel;
use App\Models\CasteModel;
use App\Models\CategoriesModel;
use App\Models\ClassesModel;
use App\Models\DistrictModel;
use App\Models\FeesDetailsModel;
use App\Models\FeesHeadModel;
use App\Models\StatesModel;
use App\Models\SubcastModel;
use App\Models\SubdistrictModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MastersController extends Controller
{
    //************** Fee Head** ***************
    public function  saveFeesDesc(Request $req)
    {
        $req->validate([
            'description' => ['required', 'unique:fees_heads,desc']
        ]);

        try {
            FeesHeadModel::create(['desc' => $req->description]);
            return response()->json(['msg' => 'success']);
        } catch (Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }

    public function getFeesDesc()
    {

        try {
            return response()->json(['fees' => FeesHeadModel::get()]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    // public function feeDelete(Request $req) {
    //     try {
    //         FeesHeadModel::where('id', $req->id)->delete();
    //         return response()->json(['msg' => "success"]);
    //     } catch (Exception $e)  {
    //         return response()->json(['error' => $e->getMessage()]);
    //     }
    // }

    public function  updateFee(Request $req)
    {
        try {
            FeesHeadModel::where(['id' => $req->id])->update(['desc' => $req->val]);
            return response()->json(['msg' => "success"]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    //************** Fee Head** ***************


    //************** Fee Details*****************
    public function feesDetails()
    {
        $academicYear = AcademicYearModel::get();
        $classes = ClassesModel::get();
        $fees = FeesHeadModel::orderBy('id')->get();
        return view("pages.masters.fees-details")->with(['years' => $academicYear, 'classes' => $classes, 'fees' => $fees]);
    }

    public function saveDetails(Request $req)
    {
        $year = $req->year;
        $class = $req->clas;
        $tut = $req->tut;

        $exist = FeesDetailsModel::where(['year' => $year, 'class' => $class])->first();

        if ($exist == null) {
            for($i =0; $i<count($req->amounts); $i++) {
                
                $data = [
                    'year' => $year,
                    'class' => $class,
                    'fee_head' => $req->amounts[$i]['id'],
                    'tuition' => $tut,
                    'amount' => $req->amounts[$i]['amt'],
                    'amt_per_annum' => $req->feePerAnnum
                ];

                FeesDetailsModel::create($data);
            }
        } else {
            for($i=0; $i<count($req->amounts); $i++) {

                $data = [
                    'tuition' => $tut,
                    'amount' => $req->amounts[$i]['amt'],
                    'amt_per_annum' => $req->feePerAnnum
                ];
                
                FeesDetailsModel::where(['year' => $year, 'class' => $class, 'fee_head' => $req->amounts[$i]['id']])->update($data);
            }
        }

        return response()->json(['msg'=>'success']);

    }

    public function getDetails(Request $req)
    {
       
        $feeDetails = FeesDetailsModel::where(['year' => $req->year, 'class' => $req->clas])->get();

        
        return response()->json(['feeDetails' => $feeDetails]);
    }
    //************** Fee Details** ***************


    //************** Fee caste** ***************
    public function castDetails()
    {

        return view("pages.masters.cast-details")->with(['cats' => CategoriesModel::get(), 'castes' => CasteModel::select('id', 'name')->get()]);
    }

    public function saveCategory(Request $req)
    {
        try {
            CategoriesModel::create(['name' => $req->name]);
            return response()->json(['msg' => "success"]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getCategories()
    {
        return response()->json(['cats' => CategoriesModel::get()]);
    }

    public function updateCat(Request $req)
    {
        try {
            CategoriesModel::where(['id' => $req->id])->update(['name' => $req->val]);
            return response()->json(['msg' => "success"]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function saveCaste(Request $req)
    {

        try {

            $exist = CasteModel::where([
                'cat' => $req->cat,
                'name' => $req->caste
            ])->first();

            if ($exist == null) {
                CasteModel::create([
                    'cat' => $req->cat,
                    'name' => $req->caste
                ]);
            }
            return response()->json(['msg' => "success"]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function searchCast(Request $req)
    {
        $casts = CasteModel::where('cat', $req->cat)->get();
        return response()->json(['casts' => $casts]);
    }

    public function searchCat(Request $req)
    {
        $cats = CasteModel::where('name', $req->cast)->get();

        foreach ($cats as $cat) {
            $cat['cat_name'] = $cat->category->name;
        }
        return response()->json(['cats' => $cats]);
    }

    public function subCast(Request $req)
    {

        SubcastModel::create(['caste' => $req->cast, 'name' => $req->sub]);

        return response()->json(['caste' => 'success']);
    }

    public function searchSubcast(Request $req)
    {
        $subcats = SubcastModel::where('caste', $req->cast)->get();

        return response()->json(['subCast' => $subcats]);
    }
    //************** Fee Caste** ***************

    public function states() {
        return view("pages.masters.states")->with([
            "states" => StatesModel::get(),
            "dists" => DistrictModel::get(),
        ]);
    }

    public function addState(Request $req) {
        if(StatesModel::where("name", $req->state)->first() == null) {
            StatesModel::create(["name" => $req->state]);
        }
        return redirect()->back();
    }

    public function addDist(Request $req) {

        DistrictModel::create([
            "name" => $req->dist,
            "state" => $req->state
        ]);

        return redirect()->back();
    }

    public function addSub(Request $req) {

        $sub = SubdistrictModel::create([
            "name" => $req->sub,
            "district" => $req->dist
        ]);

        return redirect()->back();
    }
}
