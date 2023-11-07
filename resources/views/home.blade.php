@extends('layouts.admin')

@section('content-header', 'অ্যাডমিন ড্যাশবোর্ডে স্বাগতম')

<style>
    @import url('https://fonts.maateen.me/kalpurush/font.css');

    /* ----- Adding content-header style -----*/
    
    .container-fluid {
        padding: 2px;
        height: 30px;
        margin-top: 1%;
    }

    .others-border {
        border: 1px solid #7EAFCB;
        padding: 1rem;
        border-radius: 5px;
    }

    .green-border {
        border: 1px solid #9ccaa7;
        padding: 1rem;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #0f633d;
    }

    body {
        font-family: 'Kalpurush', Arial, sans-serif !important;
    }

    @media (max-width: 768px) {

        .small-box.green-border {
            margin-bottom: 10px;
            /* Adjust as needed */
            padding: 15px;
            /* Add some padding for spacing */
        }

        .small-box.green-border p {
            text-align: center;
        }

        .content-header h1 {
            text-align: center;
        }
    }

    /*------ Adding burger-button icons or elements here ------*/

    .fixed-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        /* Change this to your desired background color */
        z-index: 1000;
        /* Adjust the z-index as needed */
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
        /* Add a border at the bottom if desired */
    }

    .burger-buttons {
        display: flex;
        gap: 20px;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="fixed-header">
                <div class="burger-buttons">
                    <!-- Add your burger button icons or elements here -->
                    <div class="burger-button text-success"><i class="fa-solid fa-bars"></i></div>
                </div>
                <!-- You can add additional content or buttons on the right side of the header if needed -->
            </div>

            <!------- Services Information ------->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-2">
                <div class="others-border">
                    <div class="inner">
                        <p class="text-center"><img src="{{ asset('uploads/legal-agreement-contract-paper-icon.png') }}"
                                alt="Your Logo" style="width: 20px; height: 20px;color: #1B379A;">মোট ভূমিসেবা সংখ্যা</p>
                        <h3 class="text-center" style="color: #1B379A;">{{ bnNum($serviceCount) }}</h3>
                    </div>
                </div>
            </div>


            <!------- App & Software Information ------->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-2">
                <div class="others-border" style="border: 1px solid #7ECBA1;">
                    <div class="inner">
                        <p class="text-center"><img src="{{ asset('uploads/legal-agreement-contract-paper-icon.png') }}"
                                alt="Your Logo"
                                style="width: 20px; height: 20px; filter: brightness(0.5) hue-rotate(260deg);">সর্বমোট জমির
                            তথ্য ও
                            সফটওয়্যার</p>
                        <h3 class="text-center" style="color: #7ECBA1;">{{ bnNum($appsAndSoftwaresCount) }}</h3>
                    </div>
                </div>
            </div>

            <!------- FAQs Information ------->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-2">
                <div class="others-border" style="border: 1px solid #FF9EE5;">
                    <div class="inner">
                        <p class="text-center">
                            <img src="{{ asset('uploads/legal-agreement-contract-paper-icon.png') }}" alt="Your Logo"
                                style="width: 20px; height: 20px; filter: brightness(0.7) hue-rotate(50deg);">
                            সর্বমোট আইন ও বিধি
                        </p>
                        <h3 class="text-center" style="color: #FF9EE5;">{{ bnNum($AyinbidhiCount) }}</h3>
                    </div>
                </div>
            </div>

            <!------- Slider Information ------->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-2">
                <div class="others-border" style="border: 1px solid #EC8E00;">
                    <div class="inner">
                        <p class="text-center"><img src="{{ asset('uploads/legal-agreement-contract-paper-icon.png') }}"
                                alt="Your Logo"
                                style="width: 20px; height: 20px; filter: hue-rotate(150deg);">পরিপত্র/প্রজ্ঞাপন</p>
                        <h3 class="text-center" style="color: #EC8E00;">{{ bnNum($PoripotroProggaponCount) }}</h3>

                    </div>
                    {{-- <div class="icon mb-3">
                        <i class="ion ion-ios-albums"></i>
                    </div> --}}
                    {{-- <div class="text-center mt-3">
                        <a href="{{ route('poripotro_proggapons.index') }}" class="text-dark">এক্টিভ স্লাইডার দেখুন <br>
                            <i class="fa-solid fa-arrow-right ml-3 text-success"></i>
                        </a>
                    </div> --}}
                </div>
            </div>

            <!------- Add the canvas element for the Visitor Chart ------->

            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-6 mt-4">
                <div class="">
                    <canvas id="myChart" height="100px"></canvas>
                    {{-- <h1 class="text-center display-5 mt-5">শীঘ্রই আসবে</h1>
                    <h5 class="text-center display-5">VISITOR CHART</h5> --}}
                    {{-- <canvas id="horizontalBar"></canvas> --}}
                </div>
            </div>

            <!------- Notice Information ------->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mt-4">
                <div class="green-border">
                    <div class="inner">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="mb-2">
                                <b>নোটিশসমূহ</b>
                            </div>
                            <div>
                                <i class="fa-solid fa-circle-question" style="color: #007A43"></i>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('notices.store') }}" class="text-dark">নোটিশ যুক্ত করুন <br>
                                <i class="fa-solid fa-arrow-right ml-3 text-success"></i>
                            </a>
                        </div>
                        {{-- <h3 class="text-success text-center">{{ bnNum($noticesCount) }}</h3> --}}
                        {{-- <p class="text-center">নোটিশসমূহ</p> --}}
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('notices.index') }}" class="btn btn-success">
                            সকল নোটিশসমূহ
                            <i class="fa-solid fa-arrow-right ml-3"></i>
                        </a>
                    </div>

                </div>
            </div>
            <!-------Start জমি সংক্রান্ত মিডিয়া লিঙ্ক Information ------->

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4" style="margin-bottom: 40px;">
                <div class="small-box green-border">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="mb-2">
                            <b>জমি সংক্রান্ত মিডিয়া লিঙ্ক</b>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-question text-success"></i>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" target="_blank"
                                    href="https://mutation.land.gov.bd/">ই-নামজারি আবেদন</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" target="_blank" href="https://ldtax.gov.bd/">ভূমি উন্নয়ন
                                    কর</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" target="_blank" href="https://www.eporcha.gov.bd/  ">আর.এস
                                    খতিয়ান</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" target="_blank"
                                    href="http://devlsgportal.mysoftheaven.com/services/service-details/3">হোল্ডিং ট্যাকিং
                                    সফটওয়্যার</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('land-related-media-links.index') }}" class="btn btn-success">
                            সকল মিডিয়া লিঙ্ক সমূহ<i class="fa-solid fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-------End of জমি সংক্রান্ত মিডিয়া লিঙ্ক Information ------->

            <!-------Start প্রকল্প সম্পর্কিত Information ------->


            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mt-4" style="margin-bottom: 40px;">
                <div class="small-box green-border">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="mb-2">
                            <b class="">প্রকল্প সম্পর্কিত</b>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-question text-success"></i>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;"
                                    href="{{ route('prokolpo_sarsongkheps.index') }}">প্রকল্প
                                    সারসংক্ষেপ</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" href="{{ route('uddessho_lokkhos.index') }}">উদ্দেশ্যে ও
                                    লক্ষ্য</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" href="{{ route('prokolper_outputs.index') }}">প্রকল্পের
                                    আউটপুট</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <div>
                            <p><a style="text-decoration: none;" href="{{ route('nagoriker_subidhas.index') }}">নাগরিকের
                                    সুবিধা</a></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-arrow-right text-success"></i>
                        </div>

                    </div>

                    <div class="text-center mt-3">
                        <a href="http://devlsgportal.mysoftheaven.com/" target="_blank" class="btn btn-success">
                            আরও তথ্য দেখুন<i class="fa-solid fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-------End of প্রকল্প সম্পর্কিত Information ------->

        </div>
    </div>
@endsection



{{---------------- To show DataBase in HomePage --------------------}}
{{---------------- If any chnage need Go to HomeController --------------------}}

@section('js') 
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
      var labels =  {{ Illuminate\Support\Js::from($labels) }};
      var users =  {{ Illuminate\Support\Js::from($data) }};
  
      const data = {
        labels: labels,
        datasets: [{
          label: 'পরিদর্শক চার্ট',
          backgroundColor: '#0f633d',
          borderColor: '#0f633d',
          data: users,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>
@endsection
{{-- 
<script>
    new Chart(document.getElementById("horizontalBar"), {
        "type": "horizontalBar",
        "data": {
            "labels": ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey"],
            "datasets": [{
                "label": "My First Dataset",
                "data": [22, 33, 55, 12, 86, 23, 14],
                "fill": false,
                "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                    "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                ],
                "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)",
                    "rgb(201, 203, 207)"
                ],
                "borderWidth": 1
            }]
        },
        "options": {
            "scales": {
                "xAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });
</script> --}}
