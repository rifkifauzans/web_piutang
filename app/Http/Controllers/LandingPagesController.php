<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPagesController extends Controller
{
    public function LandingPages()
    {
        return view('landingpages.landingpages');
    }

    public function partnerPages()
    {
        return view('partner.employeePages');
    }

}
