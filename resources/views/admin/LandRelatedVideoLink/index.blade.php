@extends('layouts.admin')

@section('title', 'ভিডিও-লিঙ্ক তালিকা')
@section('content-header', 'ভিডিও-লিঙ্ক তালিকা')

@section('content-actions')
    <a href="{{ route('land-related-video-links.create') }}" class="btn btn-success">তৈরি করুন</a>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <style>
        @media (max-width: 767px) {
            .btn-group {
                display: block;
            }

            .btn-group .btn {
                margin-bottom: 5px;
            }
            .content-header h1 {
                text-align: center;
            }
        }
    </style>

@endsection
@section('content')
    <div class="card slider-list">
        <div class="card-body table-responsive p-0 mb-3">
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>সিরিয়াল</th>
                        <th>শিরোনাম</th>
                        <th>ইউটিউব ভিডিও লিঙ্ক</th>
                        <th>স্ট্যাটাস</th>
                        {{-- <th>Created At</th>
                    <th>Updated At</th> --}}
                        <th>প্রক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="">
                            {{-- <td>{{ $loop->index + 1 }}</td> --}}
                            <td>{{ bnNum($rank++) }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->link }}</td>
                            <td>
                                <span
                                    class="p-2 mt-1 right badge badge-{{ $item->status ? 'success' : 'danger' }}">{{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span>
                            </td>
                            {{-- <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td> --}}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('land-related-video-links.edit', $item) }}" class="btn btn-primary"><i
                                            class="fas fa-edit"></i></a>

                                    <button class="btn btn-danger btn-delete ml-1"
                                        data-url="{{ route('land-related-video-links.destroy', $item) }}"><i
                                            class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center d-flex justify-content-center align-items-center">তথ্য
                                পাওয়া যাচ্ছে না!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mb-5 mr-4 d-flex justify-content-end align-items-center">
            {{ $data->render() }}
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
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'আপনি কি নিশ্চিত?',
                        text: "আপনি কি সত্যিই এই জমি সংক্রান্ত ভিডিও লিঙ্ক মুছে দিতে চান?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'হ্যাঁ, এটা মুছে ফেলুন!',
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
                    })
                })
            })
        </script>
    @endsection
