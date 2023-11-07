@extends('layouts.admin')

@section('title', 'আইন-ও-বিধি সম্পাদনা করুন')
@section('content-header', 'আইন-ও-বিধি সম্পাদনা করুন')

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

            <form action="{{ route('vhumi_sheba_forms.update', $data) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">বিষয় <span class="text-danger"> * </span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="বিষয় লিখুন" value="{{ old('title', $data->title) }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vhumi_sheba_form_pdf">আইন PDF <span class="text-danger">*</span></label>
                    <input type="file" name="vhumi_sheba_form_pdf" accept="application/pdf"
                        class="form-control-file @error('vhumi_sheba_form_pdf') is-invalid @enderror"
                        id="vhumi_sheba_form_pdf">
                    @error('vhumi_sheba_form_pdf')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">স্ট্যাটাস</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                        <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>সক্রিয়</option>
                        <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                
                <a href="{{ route('vhumi_sheba_forms.index') }}" class="btn btn-danger">বাতিল করুন</a>
                <button class="btn btn-primary" type="submit">হালনাগাদ করুন</button>
                
            </form>
        </div>
    </div>
@endsection
