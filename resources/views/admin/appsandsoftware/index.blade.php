@extends('layouts.admin')

@section('title', 'জমির তথ্য ও সফটওয়্যার তালিকা')
@section('content-header', 'জমির তথ্য ও সফটওয়্যার তালিকা')
@section('content-actions')
    <a href="{{ route('apps-and-softwares.create') }}" class="btn btn-success">তৈরি করুন</a>
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
        .badge-primary {
            background-color: #007bff;
            color: black;
        }

        .badge-warning {
            background-color: #ffbd03;
        }
    </style>
@endsection
@section('content')
    <div class="card slider-list">
        <div class="card-body table-responsive p-0 mb-3"> <!-- Wrap table in a responsive container -->
            <table class="table">
                <thead>
                    <tr class="">
                        <th>সিরিয়াল</th>
                        <th>শিরোনাম</th>
                        <th>ছবি</th>
                        <th>লিঙ্ক</th>
                        <th>ধরণ</th>
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
                                <img style="max-height: 100px ; max-width:100px" class="slider-img"
                                    src="{{ Storage::url($item->image) }}" alt="">
                            </td>

                            <td>
                                <a href="{{ Str::startsWith($item->link, ['http://', 'https://']) ? $item->link : asset(Storage::url($item->link)) }}"target="_blank">{{ $item->link }}</a>
                            </td>

                            <td>
                                <span class="p-3 right badge badge-{{ $item->type === 1 ? 'primary' : 'warning' }}">
                                    {{ $item->type === 1 ? 'জমি কেন্দ্রিক তথ্য' : 'জমির সফটওয়্যার' }}
                                </span>
                            </td>

                            <td>
                                <span class="p-2 mt-1 right badge badge-{{ $item->status ? 'success' : 'danger' }}">
                                    {{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </span>
                            </td>

                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('apps-and-softwares.edit', $item) }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete btn-sm ml-1"
                                    data-url="{{ route('apps-and-softwares.destroy', $item) }}"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center d-flex justify-content-center align-items-center">তথ্য
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
                });

                swalWithBootstrapButtons.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: 'আপনি কি সত্যিই এই অ্যাপ এবং সফ্টওয়্যার মুছতে চান?',
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
                            });
                        });
                    }
                });
            });
        });
    </script>
@endsection
