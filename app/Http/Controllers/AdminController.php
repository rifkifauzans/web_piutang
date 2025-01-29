<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fields;
use App\Models\Employees;
use App\Models\Partners;
use App\Models\Contracts;
use App\Models\Region;
use App\Models\Payment;

class AdminController extends Controller
{
    public function admin()
    {
        $fields = Fields::count();
        $employees = Employees::count();
        $partners = Partners::count();
        $contracts = Contracts::count();
        $region = Region::count();
        $payment = Payment::count();

        $data = array(
            'fields' => $fields,
            'employees' => $employees,
            'partners' => $partners,
            'contracts' => $contracts,
            'region' => $region,
            'payment' => $payment,
        );

        return view('admin.home', $data);
    }
}
