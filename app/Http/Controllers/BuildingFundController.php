<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildingFundController extends Controller
{
    public function receipt() {
        return view('pages.building-fund.building-fund-receipt');
    }
    public function duplicateReceipt() {
        return view('pages.building-fund.building-duplicate-receipt');
    }
    public function dailyReport() {
        return view('pages.building-fund.daily-report');
    }
    public function report() {
        return view('pages.building-fund.building-fund-report');
    }
    public function receiptDeletion() {
        return view('pages.building-fund.building-fund-receipt-deletion');
    }
}
