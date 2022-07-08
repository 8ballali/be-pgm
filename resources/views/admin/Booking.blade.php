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
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add
    Memo</button>
<!-- End Button Modal -->
{{-- <div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div id="modals" class="modal-header modal-colored-header ">
                <h4 class="modal-title" id="warning-header-modalLabel">Add Memo
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form text-left" method="post" action="{{ route('memo.store') }}"
                    enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sender</label>
                        <div>
                            <select name='employee_id_pengirim' readonly="readonly" class='form-control'>
                                <option value="{{$employee->id}}">{{$employee->name}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Receiver</label>
                        <div>
                            <select name='employee_id_penerima' class='form-control'>
                                @foreach($employee_name as $em)
                                <option hidden value="">
                                    <center>-- Pilih --</center>
                                </option>
                                <option value="{{$em->id}}">{{$em->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Meeting Tittle</label>
                        <div>
                            <select name='meeting_id' class='form-control'>
                                @foreach($meeting as $met)
                                <option hidden value="">
                                    <center>-- Pilih --</center>
                                </option>
                                <option value="{{$met->id}}">{{$met->judul}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Memo Tittle</label>
                        <div>
                            <input class="form-control" name="judul" placeholder="Memo Tittle"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description</label>
                        <div>
                            <textarea class="form-control" name="deskripsi" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Date</label>
                        <div>
                            <input type="date" class="form-control" name="tanggal" placeholder="date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Status</label>
                        <div>
                            <input type="text" class="form-control" name="status" placeholder="status" value="Terkirim" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button id="btn" type="submit" class="btn btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div> --}}
        <!-- /.modal-content -->
    {{-- </div> --}}
    <!-- /.modal-dialog -->
{{-- </div> --}}
<!-- End Modal Add Employee -->
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
                                <th>Action</th>
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
                                @if ($b->bukti == null)
                                <td>Bukti belom di upload</td>
                                @elseif ($b->bukti)
                                <td><img src="{{ url('storage').'/'.$b->bukti }}" height="40px" width="40px" />
                                @endif
                                <td class="d-flex flex-row">
                                    <a id="detail" class="btn btn-circle btn-lg btn-info  text-white" type="button"
                                        href="{{ url('/memo/history/'.$b->id) }}">
                                        <span class="btn-label"><i class="fa fa-info"></i></span>
                                    </a>
                                </td>
                            </tr>
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
