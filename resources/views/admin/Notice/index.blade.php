@extends('layouts.admin')

@section('title', 'নোটিশ তালিকা')
@section('content-header', 'ভূমি সংক্রান্ত নোটিশ তালিকা')
@section('content-actions')
    <a href="{{ route('notices.create') }}" class="btn btn-success">তৈরি করুন</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <style>
        @import url('https://fonts.maateen.me/kalpurush/font.css');

        @media (max-width: 576px) {
            .table-responsive {
                overflow-x: auto;
            }
        }

        body {
            font-family: 'Kalpurush', Arial, sans-serif !important;
        }
    </style>
@endsection
@section('content')
    <div class="card slider-list">
        <div class="table-responsive card-body p-0 mb-3"> <!-- Wrap table in a responsive container -->
            <table class="table">
                <thead>
                    <tr class="">
                        <th>সিরিয়াল</th>
                        <th>প্রধান</th>
                        <th>নোটিশ</th>
                        <th>PDF ফাইল</th>
                        <th>স্ট্যাটাস</th>
                        <th>প্রক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $item)
                        <tr>
                            <td>{{ bnNum($rank++) }}</td>
                            <td>{{ $item->is_top ? 'হ্যাঁ' : 'না' }}</td>
                            <td>{{ $item->notice }}</td>
                            <td>
                                <a href="{{ Storage::url($item->notice_pdf) }}" target="_blank">পিডিএফ দেখুন</a>
                            </td>
                            <td>
                                <span
                                    class="p-2 mt-1 right badge badge-{{ $item->status ? 'success' : 'danger' }}">{{ $item->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </span>
                            </td>

                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('notices.edit', $item) }}" class="btn btn-primary btn-sm"><i
                                        class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-delete ml-1"
                                    data-url="{{ route('notices.destroy', $item) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center d-flex justify-content-center align-items-center">তথ্য
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
                    text: "আপনি কি সত্যিই এই বিজ্ঞপ্তিটি মুছতে চান?",
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
                });
            })
        })
    </script>
@endsection
