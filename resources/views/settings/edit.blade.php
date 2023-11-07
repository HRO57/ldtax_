@extends('layouts.admin')

@section('title', 'সেটিংস হালনাগাদ করুন')
@section('content-header', 'সেটিংস হালনাগাদ করুন')

@section('css')

<style>
    @import url('https://fonts.maateen.me/kalpurush/font.css');
    body {
        font-family: 'Kalpurush', Arial, sans-serif !important;
    }
</style>
    
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('settings.update') }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="application_name">অ্যাপ্লিকেশন নাম</label>
                <input type="text" name="application_name" class="form-control @error('application_name') is-invalid @enderror" id="application_name" placeholder="অ্যাপ্লিকেশন নাম" value="{{ @$setting->application_name }}">
                @error('application_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="application_logo">লোগো <span class="text-danger"><small class="text-danger font-sm">( নির্বাচিত ফাইলের আকার 2MB এর নিচে হতে হবে )</small></span> </label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="application_logo" id="application_logo">
                    <label class="custom-file-label" for="application_logo">লোগো নির্বাচন করুন</label>
                </div>
                @error('application_logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="application_slider_limit">অ্যাপ্লিকেশন স্লোগান</label>
                <input type="text" name="application_title" class="form-control @error('application_title') is-invalid @enderror" id="application_title" placeholder="অ্যাপ্লিকেশন স্লোগান" value="{{ @$setting->application_title }}">
                @error('application_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="application_slider_limit">অ্যাপ্লিকেশন স্লাইডার সীমাবদ্ধতা</label>
                <input type="number" name="application_slider_limit" class="form-control @error('application_slider_limit') is-invalid @enderror" id="application_slider_limit" placeholder="অ্যাপ্লিকেশন স্লাইডার সীমাবদ্ধতা" value="{{ @$setting->application_slider_limit }}">
                @error('application_slider_limit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="application_main_menu_limit">অ্যাপ্লিকেশন মেনু সীমাবদ্ধতা</label>
                <input type="number" name="application_main_menu_limit" class="form-control @error('application_main_menu_limit') is-invalid @enderror" id="application_main_menu_limit" placeholder="অ্যাপ্লিকেশন মেনু সীমাবদ্ধতা" value="{{ @$setting->application_main_menu_limit }}">
                @error('application_main_menu_limit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

          
            <button type="submit" class="btn btn-primary">হালনাগাদ করুন</button>
        </form>
    </div>
</div>
@endsection
