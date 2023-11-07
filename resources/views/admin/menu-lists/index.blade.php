@extends('layouts.admin')

@section('title', 'মেনু তালিকা')
@section('content-header', 'মেনু তালিকা')
@section('content-actions')
    <a href="{{ route('menu-lists.create') }}" class="btn btn-success">তৈরি করুন</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        @import url('https://fonts.maateen.me/kalpurush/font.css');

        body {
            font-family: 'Kalpurush', Arial, sans-serif !important;
        }
        @media (max-width: 767px) {
            .content-header h1 {
                text-align: center;
            }
        }
    </style>
@endsection
@section('content')
    <div class="card menu-list">
        {{-- <div class="card-body"> --}}
        <div class="table-responsive card-body p-0 mb-3"> <!-- Add this div for responsiveness -->
            <table class="table">
                <thead>
                    <tr class="">
                        {{-- <th>সিরিয়াল</th> --}}
                        <th>শিরোনাম</th>
                        <th>প্রধান</th>
                        <th>লিঙ্ক</th>
                        <th>স্ট্যাটাস</th>
                        <th>প্যারেন্ট মেনু</th>
                        <th class="text-center">প্রক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $key => $item)
                        <tr class="">
                            {{-- <td>{{ bnNum($rank++) }}</td> --}}
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->is_main ? 'প্যারেন্ট মেনু' : 'চাইল্ড মেনু' }}</td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <span
                                    class="p-2 mt-1 text-center right badge badge-{{ $item->status ? 'success' : 'danger' }}">{{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            <td>
                                @if (!$item->is_main)
                                    @if ($item->parent)
                                        {{ $item->parent->title }}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('menu-lists.edit', $item) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete ml-1"
                                    data-url="{{ route('menu-lists.destroy', $item) }}"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center d-flex justify-content-center align-items-center">তথ্য
                                পাওয়া যাচ্ছে না!</td>
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
                    text: "আপনি কি সত্যিই এই মেনু মুছে দিতে চান?",
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
                            });
                        });
                    }
                });
            });
        });
    </script>
@endsection
