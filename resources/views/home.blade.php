@extends('setup.master')

@section('content')
<!-- Page Content -->
<div class="content container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-body">
                    <h4>Welcome to {{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Page Content -->
@endsection
