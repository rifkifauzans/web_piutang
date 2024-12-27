<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fields;
use App\Models\Employees;
use App\Models\Partners;
use App\Models\Contracts;

class AdminController extends Controller
{
    public function admin()
    {
        $fields = Fields::count();
        $employees = Employees::count();
        $partners = Partners::count();
        $contracts = Contracts::count();

        $data = array(
            'fields' => $fields,
            'employees' => $employees,
            'partners' => $partners,
            'contracts' => $contracts,
        );

        return view('admin.home', $data);
    }
}
