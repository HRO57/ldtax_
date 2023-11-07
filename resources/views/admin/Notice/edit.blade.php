@extends('layouts.admin')

@section('title', 'নোটিশ সম্পাদনা করুন')
@section('content-header', 'নোটিশ সম্পাদনা করুন')

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

        <form action="{{ route('notices.update', $data) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="show_sl">আপনি কত তম সিরিয়ালে দেখবেন ?</label>
                <input type="text" value="{{ old('show_sl', $data->show_sl) }}" required name="show_sl" class="form-control @error('show_sl') is-invalid @enderror" id="show_sl" placeholder="সিরিয়াল লিখুন" value="{{ old('show_sl') }}">
                @error('show_sl')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_top">প্রধান <span class="text-danger"> * </span></label>
                <select name="is_top" class="form-control @error('is_top') is-invalid @enderror" id="is_top">
                    <option value="1" {{ old('is_top') === 1 ? 'selected' : '' }}>হ্যাঁ</option>
                    <option value="0" {{ old('is_top') === 0 ? 'selected' : '' }}>না</option>
                </select>
                @error('is_top')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notice">বিজ্ঞপ্তি <span class="text-danger"> * </span></label>
                <textarea name="notice" class="form-control @error('notice') is-invalid @enderror" id="notice" rows="4" placeholder="Enter Notice">{{ old(' notice', $data->notice) }}</textarea>
                @error('notice')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notice_pdf">PDF <span class="text-danger">*</span></label>
                <input type="file" name="notice_pdf" accept="application/pdf" class="form-control-file @error('notice_pdf') is-invalid @enderror" id="notice_pdf">
                @error('notice_pdf')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
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
                
                <a href="{{ route('notices.index') }}" class="btn btn-danger">বাতিল করুন</a>
                <button class="btn btn-primary" type="submit">হালনাগাদ করুন</button>
                
            </div>

        </form>
    </div>
</div>
@endsection