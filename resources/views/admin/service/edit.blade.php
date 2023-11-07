@extends('layouts.admin')

@section('title', 'সেবা সম্পাদনা করুন')
@section('content-header', 'সেবা সম্পাদনা করুন')

@section('content')

    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('services.update', $data) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="show_sl">আপনি কত তম সিরিয়ালে দেখবেন ?</label>
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
                    <label for="title">শিরোনাম <span class="text-danger"> * </span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="শিরোনাম" value="{{ old('title', $data->title) }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_description">ছোট বিবরণ <span class="text-danger"> * </span></label>
                    <input type="text" name="short_description"
                        class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                        placeholder="ছোট বিবরণ" value="{{ old('short_description', $data->short_description) }}">
                    @error('short_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="link">লিঙ্ক <span class="text-danger"> * </span></label>
                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"
                        id="link" placeholder="লিঙ্ক" value="{{ old('link', $data->link) }}">
                    @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="app_link">অ্যাপ লিঙ্ক <span class="text-danger"> * </span></label>
                    <input type="text" name="app_link" class="form-control @error('app_link') is-invalid @enderror"
                        id="app_link" placeholder="লিঙ্ক" value="{{ old('app_link', $data->app_link) }}">
                    @error('app_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">ছবি <span class="text-danger"> * <small class="text-danger">( নির্বাচিত ফাইলের
                                আকার 2MB এর নিচে হতে হবে )</small></span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">ছবি নির্বাচন করুন</label>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="long_description">দীর্ঘ বিবরণ</label>
                    <textarea name="long_description" id="editor" class="form-control @error('long_description') is-invalid @enderror">{{ old('long_description', $data->long_description) }}</textarea>
                    @error('long_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <div class="form-group">
                    <label for="sheba_praptir_somoy">সেবা প্রাপ্তির সময় <span class="text-danger"> * </span></label>
                    <input type="text" name="sheba_praptir_somoy"
                        class="form-control @error('sheba_praptir_somoy') is-invalid @enderror" id="sheba_praptir_somoy"
                        placeholder="Link" value="{{ old('sheba_praptir_somoy', $data->sheba_praptir_somoy) }}">
                    @error('sheba_praptir_somoy')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="proyojoniyo_fee">প্রয়োজনীয় ফি <span class="text-danger"> * </span></label>
                    <input type="text" name="proyojoniyo_fee"
                        class="form-control @error('proyojoniyo_fee') is-invalid @enderror" id="proyojoniyo_fee"
                        placeholder="Link" value="{{ old('proyojoniyo_fee', $data->proyojoniyo_fee) }}">
                    @error('proyojoniyo_fee')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="proyojoniyo_isthan">সেবা প্রাপ্তির স্থান <span class="text-danger"> * </span></label>
                    <input type="text" name="proyojoniyo_isthan"
                        class="form-control @error('proyojoniyo_isthan') is-invalid @enderror" id="proyojoniyo_isthan"
                        placeholder="Link" value="{{ old('proyojoniyo_isthan', $data->proyojoniyo_isthan) }}">
                    @error('proyojoniyo_isthan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dayetto_praptto_kormokortta">দায়িত্বপ্রাপ্ত কর্মকর্তা</label>
                    <textarea name="dayetto_praptto_kormokortta" id="dayetto_praptto_kormokortta_editor"
                        class="form-control @error('dayetto_praptto_kormokortta') is-invalid @enderror">{{ $data->dayetto_praptto_kormokortta }}</textarea>
                    @error('dayetto_praptto_kormokortta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#dayetto_praptto_kormokortta_editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <div class="form-group">
                    <label for="proyojoniyo_kagojpotro">প্রয়োজনীয় কাগজপত্র</label>
                    <textarea name="proyojoniyo_kagojpotro" id="proyojoniyo_kagojpotro_editor"
                        class="form-control @error('proyojoniyo_kagojpotro') is-invalid @enderror">{{ old('proyojoniyo_kagojpotro', $data->proyojoniyo_kagojpotro) }}</textarea>
                    @error('proyojoniyo_kagojpotro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#proyojoniyo_kagojpotro_editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>

                <div class="form-group">
                    <label for="songlistho_aino_bodhi">সংশ্লিষ্ট আইন ও বিধি</label>
                    <textarea name="songlistho_aino_bodhi" id="songlistho_aino_bodhi_editor"
                        class="form-control @error('songlistho_aino_bodhi') is-invalid @enderror">{{ old('songlistho_aino_bodhi', $data->songlistho_aino_bodhi) }}</textarea>
                    @error('songlistho_aino_bodhi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#songlistho_aino_bodhi_editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>


                <div class="form-group">
                    <label for="sheba_prodane_bertho">সেবা প্রদানে ব্যর্থ হলে প্রতিকারকারী কর্মকর্তা</label>
                    <textarea name="sheba_prodane_bertho" id="sheba_prodane_bertho_editor"
                        class="form-control @error('sheba_prodane_bertho') is-invalid @enderror">{{ old('sheba_prodane_bertho', $data->sheba_prodane_bertho) }}</textarea>
                    @error('sheba_prodane_bertho')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#sheba_prodane_bertho_editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>


                <div class="form-group">
                    <label for="sheba_prodane_proyojoniyo_link">সেবা প্রদানে প্রয়োজনীয় লিংক</label>
                    <textarea name="sheba_prodane_proyojoniyo_link" id="sheba_prodane_proyojoniyo_link_editor"
                        class="form-control @error('sheba_prodane_proyojoniyo_link') is-invalid @enderror">{{ old('sheba_prodane_proyojoniyo_link', $data->sheba_prodane_proyojoniyo_link) }}</textarea>
                    @error('sheba_prodane_proyojoniyo_link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#sheba_prodane_proyojoniyo_link_editor'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>



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
                    
                    <a href="{{ route('services.index') }}" class="btn btn-danger">বাতিল করুন</a>
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
