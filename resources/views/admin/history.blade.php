@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">History Memo</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted active" aria-current="page">History Memo</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

<br>
<br>
<!-- Table Employee -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">History Table</h4>

                <div class="table-responsive">
                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Judul Memo</th>
                                <th>Catatan</th>
                                <th>Bukti</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $h)
                            <tr>
                                <td>
                                    {{$h->memo->judul}}
                                    <!-- @foreach ($memo as $m)
                  @if($m->id == $h->memo_id)
                  {{$m->judul}}
                  @endif
                  @endforeach -->

                                </td>
                                <td>
                                    {{$h->catatan}}
                                </td>
                                @if ($h->bukti == null)
                                <td>Bukti belom di upload</td>
                                @elseif ($h->bukti)
                                <td>
                                    <a class="fa fa-download" aria-hidden="true"
                                        href="{{ route('history.download', $h->id) }}/" role="button">Download</a>
                                </td>
                                @endif
                                <td>{{Carbon\Carbon::parse($h->updated_at)->format('d F Y')}}</td>
                                <td class="d-flex flex-row">
                                    <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button"
                                        data-toggle="modal" data-target="#editModal{{$h->id }}">
                                        <span class="btn-label"><i class="far fa-edit"></i></span>
                                    </a>



                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div id="editModal{{$h->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div id="modals" class="modal-header modal-colored-header ">
                                            <h4 class="modal-title" id="warning-header-modalLabel">Tindak Lanjut
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form text-left" method="post"
                                                action="{{ route('history.store', $h->id) }}"
                                                enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                {{method_field('PUT')}}
                                                @if ($h->memo->employee_id_penerima == auth()->user()->employee->id)

                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Bukti Tindak
                                                        Lanjut</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="bukti">
                                                        <label><b>*Jika tidak ada kosongkan saja</b></label>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    {{-- <label for="message-text" class="col-form-label">Blok</label> --}}
                                                    <div>
                                                        <label class="mr-sm-2"
                                                            for="inlineFormCustomSelect">Status</label>
                                                        <select class="custom-select mr-sm-2"
                                                            id="inlineFormCustomSelect" name="status">
                                                            <option selected>{{$h->status}}</option>
                                                            <option value="Terkirim">Terkirim</option>
                                                            <option value="Revisi">Revisi</option>
                                                            <option value="Terselesaikan">Terselesaikan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Catatan</label>
                                                    <div>
                                                        <textarea class="form-control" name="catatan"
                                                            placeholder="Catatan"></textarea>
                                                    </div>
                                                </div>
                                                @endif
                                                {{-- <div class="form-group">
                          <label for="message-text" class="col-form-label">Departemen</label>
                          <div>
                            <select name='dept_id' class='form-control'>
                              @foreach($department as $dept)
                              @if($dept->id == $c->dept_id)
                              <option hidden value="{{$dept->id}}">
                                                <center>
                                                    {{$dept->name}}
                                                </center>
                                                </option>
                                                @endif
                                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                                                @endforeach
                                                </select>
                                        </div> --}}
                                    </div>
                                    <div class="form-group text-center">
                                        <button id="btn" type="submit" class="btn btn-block">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- End Modal Edit -->
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
