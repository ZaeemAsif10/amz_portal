@extends('setup.master')

@section('title', 'Profile')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">

        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ url('profile_update') }}" method="POST" enctype="multipart/form-data" id="detail_from">
            @csrf
            <input type="hidden" name="profile_id" value="{{ $data['profile']->id }}">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $path = 'public/uploads/profile/' . $data['profile']->image;
                            @endphp

                            @if ($data['profile']->image != '' && File::exists($path))
                                <img src="{{ asset('public/uploads/profile/' . $data['profile']->image) }}"
                                    class="img-fluid rounded-circle mb-3" width="70%" height="70%" alt="No Image">
                            @else
                                <img src="{{ asset('public/assets/whats/profile.png') }}"
                                    class="img-fluid rounded-circle mb-3" width="70%" height="70%" alt="No Image">
                            @endif
                            <input type="file" name="image" class="form-control">
                            <h4 class="mt-4">{{ $data['profile']->name ?? '' }}</h4>
                            <h5 class="mt-4">{{ $data['profile']->email ?? '' }}</h5>
                        </div>
                        <div class="col-md-8"></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Profile</h3>
                        </div>


                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 mt-2">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $data['profile']->name }}" required>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label>Email</label>
                                    <input type="text" name="review_link" class="form-control"
                                        value="{{ $data['profile']->email }}" readonly>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <label for="">Whatsapp Number</label>
                                    <input type="text" name="whats_number" value="{{ $data['profile']->whats_number }}"
                                        class="form-control" readonly>
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /Page Header -->
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
