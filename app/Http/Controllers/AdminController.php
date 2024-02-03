<?php

namespace App\Http\Controllers;

use App\Models\ApplicationApplicant;
use App\Models\ApplicationUseService;
use App\Models\ContactUs;
use App\Models\ContractConclusion;
use App\Models\InformationAboutShipment;
use App\Models\QualityControl;
use App\Models\Vacancy;
use App\Traits\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.index');
    }

    public function setCookie($cookie)
    {
        if ($cookie == 'darkMode') {
            Cookie::queue('darkMode', true);
        } elseif ($cookie == 'lightMode') {
            Cookie::queue('darkMode', false);
        }
        return back();
    }

}
