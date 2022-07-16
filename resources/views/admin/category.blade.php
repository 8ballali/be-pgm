@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
  <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Category</h4>
  <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
        <li class="breadcrumb-item text-muted active" aria-current="page">Category</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add Category</button>
<!-- End Button Modal -->
<div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Add Category
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
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- End Modal Add Employee -->
<br>
<br>
<!-- Table Employee -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Category Table</h4>

        <div class="table-responsive">
          <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($category as $c)
              <tr>
                <td>{{$c->name}}</td>
                <td>
                  {{$c->department->name}}
                  <!-- @foreach ($department as $dep)
                  @if($dep->id == $c->dept_id)
                  {{$dep->name}}
                  @endif
                  @endforeach -->

                </td>
                <td class="d-flex flex-row">
                  <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button" data-toggle="modal" data-target="#editModal{{$c->id }}">
                    <span class="btn-label"><i class="far fa-edit"></i></span>
                  </a>
                  <form method="post" action="{{ route('category.destroy', $c->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                      <i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              <!-- Modal Edit -->
              <div id="editModal{{$c->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div id="modals" class="modal-header modal-colored-header ">
                      <h4 class="modal-title" id="warning-header-modalLabel">Edit Employee
                      </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                      <form role="form text-left" method="post" action="{{ route('category.update', $c->id) }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Name</label>
                          <div>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{$c->name}}">
                          </div>
                        </div>
                        <div class="form-group">
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
                              <option value="{{$dept->id}}" @if ($c->dept_id == $dept->id) selected @endif>{{$dept->name}}</option>
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
