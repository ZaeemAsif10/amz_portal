@extends('setup.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Customers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive mt-5">
                    <table class="table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="customerTable">
                            @if (count($data['users']) > 0)
                                @foreach ($data['users'] as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-success btn-sm btn_status"
                                                data="{{ $user->id }}">Change
                                                Status</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //status update
            $('#customerTable').on('click', '.btn_status', function() {

                var id = $(this).attr('data');
                $('.btn_status').text('Wait...');
                $(".btn_status").prop("disabled", true);
                // alert(id);

                $.ajax({
                    url: '{{ url('/customers-status') }}',
                    type: 'get',
                    async: false,
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        if (response.status == 200) {
                            $('.btn_status').text('Change Status');
                            $(".btn_status").prop("disabled", false);
                            alert(response.message);
                            // toastr.success(response.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $('.btn_status').text('Change Status');
                            $(".btn_status").prop("disabled", false);
                        }

                    },
                    error: function() {
                        toastr.error('something went wrong');
                        $('.btn_status').text('Change Status');
                        $(".btn_status").prop("disabled", false);
                    }

                });

            });
        });
    </script>
@endsection
