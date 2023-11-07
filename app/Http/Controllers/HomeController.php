<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Order;
use App\Models\Notice;

use App\Models\Slider;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Ayinbidhi;
use App\Models\RecentUpdate;
use Illuminate\Http\Request;
use App\Models\FestiableImage;
use App\Models\PoripotroProggapon;
use Illuminate\Support\Facades\DB;
use App\Models\LandRelatedMediaLink;
use App\Models\LandRelatedVideoLink;
use App\Models\LandServiceAndSoftware;
use App\Models\VerificationOfLandInformation;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::count();
        $serviceCount = Service::count();
        $noticesCount = Notice::count();
        $verificationOfLandInformationCount = VerificationOfLandInformation::count();
        $appsAndSoftwaresCount = LandServiceAndSoftware::count();
        $faqsCount = Faq::count();
        $landRelatedMediaLinksCount = LandRelatedMediaLink::count();
        $festivalsImagesCount = FestiableImage::count(); // Add this line
        $landVideoLinksCount = LandRelatedVideoLink::count(); // Add this line
        $recentUpdatesCount = RecentUpdate::count();
        $AyinbidhiCount = Ayinbidhi::count();
        $PoripotroProggaponCount = PoripotroProggapon::count();

        //---------------- To controll & show Chart ---------------------

        $visitor = DB::table('visitors')->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $visitor->keys();
        $data = $visitor->values();

        //---------------- To controll & show Chart ---------------------


        return view('home', compact(
            'sliders',
            'serviceCount',
            'noticesCount',
            'verificationOfLandInformationCount',
            'appsAndSoftwaresCount',
            'faqsCount',
            'landRelatedMediaLinksCount',
            'festivalsImagesCount',
            'landVideoLinksCount',
            'recentUpdatesCount',
            'AyinbidhiCount',
            'PoripotroProggaponCount',
            'labels',
             'data'
        ));
    }
}
