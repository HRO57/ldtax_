@extends('layouts.admin')

@section('title', 'মেনু তৈরি করুন')
@section('content-header', 'মেনু তৈরি করুন')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <style>
        @media (max-width: 767px) {
            .content-header h1 {
                text-align: center;
            }
        }
    </style>

@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('menu-lists.store') }}" method="POST">
                @csrf

                {{-- <div class="form-group">
                    <label for="show_sl">আপনি কত তম সিরিয়ালে দেখবেন ?</label>
                    <input type="text" name="show_sl" class="form-control @error('show_sl') is-invalid @enderror"
                        id="show_sl" placeholder="সিরিয়াল লিখুন" value="{{ old('show_sl') }}">
                    @error('show_sl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <label for="is_main">মেনুর ধরণ <span class="text-danger">*</span></label>
                    <select name="is_main" class="form-control" required onchange="toggleParentMenu(this)">
                        <option value="1">প্যারেন্ট মেনু</option>
                        <option value="0">চাইল্ড মেনু</option>
                    </select>
                </div>

                <div id="parentMenuSelect" style="display: none;">
                    <div class="form-group">
                        <label for="parent_id">প্যারেন্ট মেনু নির্বাচন করুন </label>
                        <select name="parent_id" class="form-control">
                            <option value="" selected disabled>প্যারেন্ট মেনু নির্বাচন করুন</option>
                            @foreach ($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->id }}">{{ $parentMenu->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">শিরোনাম <span class="text-danger"> * </span> </label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="শিরোনাম লিখুন" value="{{ old('title') }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="link">লিঙ্ক <span class="text-danger"> * </span></label>
                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"
                        id="link" placeholder="লিঙ্ক লিখুন" value="{{ old('link') }}">
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">স্ট্যাটাস</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                        <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>সক্রিয়</option>
                        <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-5">
                    
                <a  href="{{ route('menu-lists.index') }}" class="btn btn-danger">বাতিল করুন</a>
                <button type="submit" class="btn btn-primary">তৈরি করুন</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function toggleParentMenu(selectElement) {
            var parentMenuSelect = document.getElementById('parentMenuSelect');
            if (selectElement.value === '0') {
                parentMenuSelect.style.display = 'block';
            } else {
                parentMenuSelect.style.display = 'none';
            }
        }
    </script>
@endsection
