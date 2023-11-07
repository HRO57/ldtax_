@extends('layouts.admin')

@section('title', 'স্লাইডার তালিকা')
@section('content-header', 'স্লাইডার তালিকা')
@section('content-actions')
    <a href="{{ route('sliders.create') }}" class="btn btn-success">তৈরি করুন</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        /* .badge-success {
            color: black;
        }

        .badge-danger {
            color: black;
        } */
    </style>
@endsection
@section('content')
    <div class="card slider-list">
        {{-- <div class="card-body"> --}}
        <div class="card-body table-responsive p-0 mb-3">
            <table class="table">
                <thead>
                    <tr class="">
                        <th>সিরিয়াল</th>
                        <th>শিরোনাম</th>
                        <th>ছবি</th>
                        <th>স্ট্যাটাস</th>
                        <th class="text-center">প্রক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="">
                            <td>{{ bnNum($rank++) }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                
                                <img width="200" height="100" class="slider-img" src="{{ Storage::url($item->image) }}"
                                    alt=""></td>
                            <td>
                                <span
                                    class="p-2 mt-1 right badge badge-{{ $item->status ? 'success' : 'danger' }}">{{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>

                            <td class="text-center d-flex justify-content-center align-items-center">

                                <a href="{{ route('sliders.edit', $item) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete ml-1" data-url="{{ route('sliders.destroy', $item) }}"><i class="fas fa-trash"></i></button>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center d-flex justify-content-center align-items-center">Data is
                                not found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mb-5 mr-4 d-flex justify-content-end align-items-center">
            {{ $data->render() }}
        </div>
        {{-- </div> --}}
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: "আপনি কি সত্যিই এই স্লাইডারটি মুছতে চান?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'হ্যাঁ, মুছে ফেলুন !',
                    cancelButtonText: 'না',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, function(res) {
                            $this.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            })
                        })
                    }
                });
            });
        });
    </script>
@endsection
