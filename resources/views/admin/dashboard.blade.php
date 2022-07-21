@extends('layouts.app')
@section('content')
@section('page')
    <div class="col-12 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard </h4>

    </div>
@endsection
<div class="container-fluid">
    <!-- ********************* -->
    <!-- Start First Cards -->
    <!-- ********************* -->
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">
                                {{$memo}}
                            </h2>
                            <span
                                class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Received</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Memo</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                            {{$finished_memo}}
                        </h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Finished Memo
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="check-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">
                                {{$complaints}}
                            </h2>
                            <span
                                class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Received</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Complaint</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="inbox"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                            {{$finished_complaints}}
                        </h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Finished Complaint
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="check-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status Product</h4>
                    <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                    <ul class="list-style-none mb-0">

                        <li class="mt-3">
                            <i class="fas fa-circle text-danger font-10 mr-2"></i>
                            <span class="text-muted">Booked</span>
                            <span class="text-dark float-right font-weight-medium">
                                {{$booked_products}}
                            </span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                            <span class="text-muted">Available</span>
                            <span class="text-dark float-right font-weight-medium">
                                {{$available_products}}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h4 class="card-title mb-0">Earning Statistics</h4>
                        <div class="ml-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="#">Insert</a>
                                    <a class="dropdown-item" href="#">Update</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-4 mb-5">
                        <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                    </div>
                    <ul class="list-inline text-center mt-4 mb-0">
                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
