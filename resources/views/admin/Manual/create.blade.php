@extends('layouts.admin')

@section('title', 'ভূমি মন্ত্রণালয়ের ম্যানুয়াল সমূহ তৈরি করুন')
@section('content-header', 'ভূমি মন্ত্রণালয়ের ম্যানুয়াল সমূহ তৈরি করুন')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('manuals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">বিষয় <span class="text-danger"> * </span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="বিষয় লিখুন" value="{{ old('title') }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="manual_pdf">আইন PDF <span class="text-danger">*</span></label>
                    <input type="file" name="manual_pdf" accept="application/pdf"
                        class="form-control-file @error('manual_pdf') is-invalid @enderror" id="manual_pdf">
                    @error('manual_pdf')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="manual_doc">আইন DOC <span class="text-danger">*</span></label>
                    <input type="file" name="manual_doc"
                        class="form-control-file @error('manual_doc') is-invalid @enderror" id="manual_doc">
                    @error('manual_doc')
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
                <a href="{{ route('manuals.index') }}" class="btn btn-danger">বাতিল করুন</a>
                <button class="btn btn-primary" type="submit">তৈরি করুন</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
