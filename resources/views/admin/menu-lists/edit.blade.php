@extends('layouts.admin')

@section('title', 'মেনু সম্পাদনা করুন')
@section('content-header', 'মেনু সম্পাদনা করুন')

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
            <form action="{{ route('menu-lists.update', $menuList->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- <div class="form-group">
                    <label for="show_sl">আপনি কত তম সিরিয়ালে দেখবেন ?</label>
                    <input type="text" name="show_sl" class="form-control" value="{{ $menuList->show_sl }}" required>
                </div> --}}

                <div class="form-group">
                    <label for="title">শিরোনাম <span class="text-danger"> * </span></label>
                    <input type="text" name="title" class="form-control" value="{{ $menuList->title }}" required>
                </div>

                <div class="form-group">
                    <label for="link">লিঙ্ক <span class="text-danger"> * </span></label>
                    <input type="text" name="link" class="form-control" value="{{ $menuList->link }}" required>
                </div>


                <div class="form-group">
                    <label for="is_main">প্রধান <span class="text-danger"> * </span></label>
                    <select name="is_main" class="form-control" required>
                        <option value="1" {{ $menuList->is_main ? 'selected' : '' }}>হ্যাঁ</option>
                        <option value="0" {{ !$menuList->is_main ? 'selected' : '' }}>না</option>
                    </select>
                </div>

                @if ($menuList->is_main == 0)
                    <div class="form-group">
                        <label for="parent_id">প্যারেন্ট মেনু নির্বাচন করুন <span class="text-danger"> * </span></label>
                        <select name="parent_id" class="form-control">
                            <option value="" selected disabled>প্যারেন্ট মেনু নির্বাচন করুন</option>
                            @foreach ($parentMenus as $parentMenu)
                                <option value="{{ $parentMenu->id }}"
                                    {{ $menuList->parent_id == $parentMenu->id ? 'selected' : '' }}>
                                    {{ $parentMenu->title }} <!-- Added this line to display parent menu title -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">স্ট্যাটাস</label>
                        <select name="status" class="form-control" required>
                            <option value="1" {{ $menuList->status == 1 ? 'selected' : '' }}>সক্রিয়</option>
                            <option value="0" {{ $menuList->status == 0 ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                        </select>
                    </div>
                @endif
                
                <div class="mb-5">

                    <a href="{{ route('menu-lists.index') }}" class="btn btn-danger">বাতিল করুন</a>
                    <button type="submit" class="btn btn-primary">হালনাগাদ করুন</button>
                    
                </div>

            </form>
        </div>
    </div>
@endsection
