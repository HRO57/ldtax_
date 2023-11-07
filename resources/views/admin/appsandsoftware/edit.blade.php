@extends('layouts.admin')

@section('title', 'অ্যাপ এবং সফ্টওয়্যার সম্পাদনা করুন')
@section('content-header', 'অ্যাপ এবং সফ্টওয়্যার সম্পাদনা করুন')

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('apps-and-softwares.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="show_sl">আপনি কত তম সিরিয়ালে দেখবেন ? ?</label>
                    <input type="text" name="show_sl" class="form-control @error('show_sl') is-invalid @enderror"
                        id="show_sl" placeholder="আপনি কত তম সিরিয়ালে দেখবেন ?"
                        value="{{ old('show_sl', $data->show_sl) }}">
                    @error('show_sl')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">শিরোনাম দেখান<span class="text-danger"> * </span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="শিরোনাম লিখুন" value="{{ old('title', $data->title) }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">ছবি<span class="text-danger"> * <small class="text-danger">( নির্বাচিত ফাইলের আকার
                                2MB এর নিচে হতে হবে )</small></span></label>
                    <div class="custom-file">
                        <input type="file"  class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">ছবি নির্বাচন করুন</label>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="link">লিঙ্ক<span class="text-danger"> * </span></label>
                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"
                        id="link" placeholder="লিঙ্ক" value="{{ old('link', $data->link) }}">
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">প্রকার<span class="text-danger"> * </span></label>
                    <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                        <option value="1" {{ old('type', $data->type) === 1 ? 'selected' : '' }}>জমি কেন্দ্রিক তথ্য</option>
                        <option value="2" {{ old('type', $data->type) === 2 ? 'selected' : '' }}>জমির সফটওয়্যার
                        </option>
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">স্ট্যাটাস</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                        <option value="1" {{ old('status', $data->status) === 1 ? 'selected' : '' }}>সক্রিয়</option>
                        <option value="0" {{ old('status', $data->status) === 0 ? 'selected' : '' }}>নিষ্ক্রিয়
                        </option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-5">
                    <a href="{{ route('apps-and-softwares.index') }}" class="btn btn-danger">বাতিল করুন</a>
                    <button class="btn btn-primary" type="submit">হালনাগাদ করুন</button>
                </div>
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
