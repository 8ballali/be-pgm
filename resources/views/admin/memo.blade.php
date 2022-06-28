@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
  <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Memos</h4>
  <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
        <li class="breadcrumb-item text-muted active" aria-current="page">Memos</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
{{-- <button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add Complaint</button> --}}
<!-- End Button Modal -->
{{-- <div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Add Complaint
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form role="form text-left" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="message-text" class="col-form-label">Name</label>
            <div>
              <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Departemen</label>
            <div>
              <select name='dept_id' class='form-control'>
                @foreach($department as $dept)
                <option hidden value="">
                  <center>-- Pilih --</center>
                </option>
                <option value="{{$dept->id}}">{{$dept->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group text-center">
            <button id="btn" type="submit" class="btn btn-block">Submit</button>
          </div>
        </form>
      </div> --}}
    {{-- </div> --}}
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
        <h4 class="card-title">Memo Table</h4>

        <div class="table-responsive">
          <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
              <tr>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>Judul Meeting</th>
                <th>Judul Memo</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($memo as $m)
              <tr>

                <td>{{$m->pengirim->name}}</td>
                <td>{{$m->penerima->name}}</td>
                @if ($m->meeting_id)
                <td>{{$m->meeting->judul}}</td>
                @elseif ($m->meeting_id ==null)
                <td><i>none</i></td>
                @endif
                <td>{{$m->judul}}</td>
                <td>{{$m->deskripsi}}</td>
                <td>{{$m->tanggal}}</td>
                <td>{{$m->status}}</td>
                <td>
                  <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button" data-toggle="modal" data-target="#editModal{{$m->id }}">
                    <span class="btn-label"><i class="far fa-edit"></i></span>
                  </a>
                  <form method="post" action="{{ route('category.destroy', $m->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                      <i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              <!-- Modal Edit -->
              <div id="editModal{{$m->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div id="modals" class="modal-header modal-colored-header ">
                      <h4 class="modal-title" id="warning-header-modalLabel">Tindak Lanjut
                      </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                      <form role="form text-left" method="post" action="{{ route('complaint.update', $m->id) }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group">
                            {{-- <label for="message-text" class="col-form-label">Blok</label> --}}
                            <div>
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Status</label>
                                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                                    <option selected>{{$m->status}}</option>
                                    <option value="Terkirim">Terkirim</option>
                                    <option value="Dalam Proses">Dalam Proses</option>
                                    <option value="Terselesaikan">Terselesaikan</option>
                                </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Bukti Tindak Lanjut</label>
                            <div>
                              <input type="file" class="form-control" name="tindak_lanjut">
                              <label><b>*Jika tidak ada kosongkan saja</b></label>
                            </div>
                          </div>
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
