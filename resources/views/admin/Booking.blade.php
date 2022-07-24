@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Booking</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted active" aria-current="page">Booking</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
@if (Auth::user()->role_id == 1)
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">
    Add Booking
</button>
<button >
    <a class="fa fa-download" aria-hidden="true"
    href="{{ route('booking.pdf') }}/" role="button">Download PDF</a>
</button>
@endif

<br>
<br>
<!-- Table Employee -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Booking Table</h4>

                <div class="table-responsive">
                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Blok</th>
                                <th>No Kavling</th>
                                <th>Type</th>
                                <th>Luas Tanah</th>
                                <th>Tanah Lebih</th>
                                <th>Status</th>
                                <th>Bukti</th>
                                @if (Auth::user()->role_id == 1)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking as $b)
                            <tr>

                                <td>{{$b->customer->name}}</td>
                                <td>{{$b->product->blok}}</td>
                                <td>{{$b->product->no_kavling}}</td>
                                <td>{{$b->product->type}}</td>
                                <td>{{$b->product->luas_tanah}}</td>
                                <td>{{$b->product->tanah_lebih}}</td>
                                <td>{{$b->status_booking->name}}</td>
                                <td>
                                    <a class="fa fa-download" aria-hidden="true"
                                        href="{{ route('booking.download', $b->id) }}/" role="button">Download</a>
                                </td>
                                @if (Auth::user()->role_id == 1)
                                <td class="d-flex flex-row">
                                    <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button"
                                        data-toggle="modal" data-target="#editModal{{$b->id }}">
                                        <span class="btn-label"><i class="far fa-edit"></i></span>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            <div id="editModal{{$b->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div id="modals" class="modal-header modal-colored-header ">
                                            <h4 class="modal-title" id="warning-header-modalLabel">Check Booking Fee
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form text-left" method="post"
                                                action="{{ route('booking.update', $b->id) }}"
                                                enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                {{method_field('PUT')}}

                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Validasi
                                                        Bukti</label>
                                                    <div>
                                                        <select name='status' class='form-control'>
                                                            @foreach($status as $book)
                                                            @if($book->id == $b->status)
                                                            <option hidden value="{{$book->id}}">
                                                                <center>
                                                                    {{$book->name}}
                                                                </center>
                                                            </option>
                                                            @endif
                                                            <option value="{{$book->id}}" @if ($b->status== $book->id)
                                                                selected @endif>{{$book->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button id="btn" type="submit" class="btn btn-block">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Table Employee -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
@endsection
