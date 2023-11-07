@extends('layouts.admin')

@section('title', 'সেবা বিবরণ')
@section('content-header', 'সেবা বিবরণ')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">সেবা তথ্যঃ</h5>
            <div class="table-responsive"> <!-- Wrap table in a responsive container -->
                <table class="table table-bordered">
                    <tbody>

                        @if ($service->show_sl)
                            <tr>
                                <th>আপনি কত তম সিরিয়ালে দেখবেন ?</th>
                                <td>{{ $service->show_sl }}</td>
                            </tr>
                        @endif

                        @if ($service->title)
                            <tr>
                                <th>শিরোনাম</th>
                                <td>{{ $service->title }}</td>
                            </tr>
                        @endif

                        @if ($service->short_description)
                            <tr>
                                <th>ছোট বিবরণ</th>
                                <td>{{ $service->short_description }}</td>
                            </tr>
                        @endif

                        @if ($service->link)
                            <tr>
                                <th>লিংক</th>
                                <td>{{ $service->link }}</td>
                            </tr>
                        @endif

                          @if ($service->app_link)
                            <tr>
                                <th>অ্যাপ লিংক</th>
                                <td>{{ $service->app_link }}</td>
                            </tr>
                        @endif

                        @if ($service->long_description)
                            <tr>
                                <th>দীর্ঘ বিবরণ</th>
                                <td>{ !! $service->long_description !!}</td>
                            </tr>
                        @endif

                        @if ($service->sheba_praptir_somoy)
                            <tr>
                                <th>সেবা প্রাপ্তির সময়</th>
                                <td>{{ $service->sheba_praptir_somoy }}</td>
                            </tr>
                        @endif

                        @if ($service->proyojoniyo_fee)
                            <tr>
                                <th>প্রয়োজনীয় ফি</th>
                                <td>{{ $service->proyojoniyo_fee }}</td>
                            </tr>
                        @endif

                        @if ($service->proyojoniyo_isthan)
                            <tr>
                                <th>সেবা প্রাপ্তির স্থান</th>
                                <td>{{ $service->proyojoniyo_isthan }}</td>
                            </tr>
                        @endif

                        @if ($service->dayetto_praptto_kormokortta)
                            <tr>
                                <th>দায়িত্বপ্রাপ্ত কর্মকর্তা</th>
                                <td>{{ $service->dayetto_praptto_kormokortta }}</td>
                            </tr>
                        @endif

                        @if ($service->proyojoniyo_kagojpotro)
                            <tr>
                                <th>প্রয়োজনীয় কাগজপত্র</th>
                                <td>{!! $service->proyojoniyo_kagojpotro !!}</td>
                            </tr>
                        @endif

                        @if ($service->songlistho_aino_bodhi)
                            <tr>
                                <th>সংশ্লিষ্ট আইন ও বিধি</th>
                                <td>{!! $service->songlistho_aino_bodhi !!}</td>
                            </tr>
                        @endif

                        @if ($service->sheba_prodane_bertho)
                            <tr>
                                <th>সেবা প্রদানে ব্যর্থ হলে প্রতিকারকারী কর্মকর্তা</th>
                                <td>{!! $service->sheba_prodane_bertho !!}</td>
                            </tr>
                        @endif

                        @if ($service->sheba_prodane_proyojoniyo_link)
                            <tr>
                                <th>সেবা প্রদানে প্রয়োজনীয় লিংক</th>
                                <td>{!! $service->sheba_prodane_proyojoniyo_link !!}</td>
                            </tr>
                        @endif

                        @if ($service->image)
                            <tr>
                                <th>ছবি</th>
                                <td>
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                        class="img-thumbnail" width="200">
                                </td>
                            </tr>
                        @endif

                        @if ($service->status)
                            <tr>
                                <th>স্ট্যাটাস</th>
                                <td>
                                    <span class="p-3 badge badge-{{ $service->status ? 'success' : 'danger' }}">
                                        {{ $service->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                        <!-- You can add more fields as needed -->
                    </tbody>
                </table>
            </div>
            <a href="{{ route('services.index') }}" class="btn btn-primary">তালিকায় ফিরে যান</a>
        </div>
    </div>
@endsection
