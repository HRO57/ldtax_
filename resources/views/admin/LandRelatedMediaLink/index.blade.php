@extends('layouts.admin')

@section('title', 'মিডিয়া-লিঙ্ক তালিকা')
@section('content-header', 'ভূমি সংক্রান্ত প্রয়োজনীয় ওয়েবসাইট')

@section('content-actions')
    <a href="{{ route('land-related-media-links.create') }}" class="btn btn-success">তৈরি করুন</a>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <style>
        /* Additional CSS for responsiveness */
        @media (max-width: 576px) {
            .table-responsive {
                overflow-x: auto;
            }
        }

        /* Additional CSS to style links as buttons */
        .btn-link {
            background-color: transparent;
            border: none;
            padding: 0;
        }

        /* Style the type badge */
        .badge-secondary {
            background-color: #53dab9;
            color: black;
        }

        .badge-warning {
            background-color: #ffc107;
        }
    </style>
@endsection
@section('content')
    <div class="card slider-list">
        <div class="card-body table-responsive p-0 mb-3"> <!-- Wrap table in a responsive container -->
            <table class="table">
                <thead>
                    <tr class="">
                        {{-- <th>ID</th> --}}
                        <th>সিরিয়াল</th>
                        <th>শিরোনাম</th>
                        <th>লিঙ্ক</th>
                        <th>ধরণ</th>
                        <th>স্ট্যাটাস</th>
                        {{-- <th>Created At</th>
                        <th>Updated At</th> --}}
                        <th class="text-center">প্রক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="">
                            {{-- <td>{{$loop->index+1}}</td> --}}
                            <td>{{ bnNum($rank++) }}</td>
                            <td>{{ $item->title }}</td>
                            <td><a href="{{ Str::startsWith($item->link, ['http://', 'https://']) ? $item->link : asset(Storage::url($item->link)) }}"
                                    target="_blank">{{ $item->link }}</a></td>

                            <td>
                                <span
                                    class="p-2 mt-1 right badge badge-{{ $item->type === 1 ? 'secondary' : 'warning' }}">{{ $item->type == 1 ? 'সেবা ওয়েবলিংক' : 'তথ্যের অধিকার' }}</span>
                            </td>

                            <td>
                                <span class="p-2 mt-1 right badge badge-{{ $item->status ? 'success' : 'danger' }}">
                                    {{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </span>
                            </td>
                            {{-- <td>{{$item->created_at->format('Y-m-d H:i:s')}}</td>
                        <td>{{$item->updated_at->format('Y-m-d H:i:s')}}</td> --}}

                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('land-related-media-links.edit', $item) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete ml-1"
                                    data-url="{{ route('land-related-media-links.destroy', $item) }}"><i
                                        class="fas fa-trash"></i></button>
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
                    text: "আপনি কি সত্যিই এই ভূমি-সম্পর্কিত মিডিয়া লিঙ্কটি মুছতে চান?",
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
