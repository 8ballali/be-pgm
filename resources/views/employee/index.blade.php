@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
  <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Employee</h4>
  <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
        <li class="breadcrumb-item text-muted active" aria-current="page">Employee</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add Employee</button>
<!-- End Button Modal -->
<div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Add Employee
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form role="form text-left" method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <div>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password</label>
            <div>
              <input type="password" class="form-control" name="password" placeholder="password">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Name</label>
            <div>
              <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <div>
              <textarea class="form-control" name="address"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Phone</label>
            <div>
              <input type="text" class="form-control" name="phone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Avatar</label>
            <div>
              <input type="file" class="form-control" name="avatar">
              <label><b>*Jika tidak ada kosongkan saja</b></label>
            </div>
          </div>
          {{-- <div class="form-group">
            <label for="message-text" class="col-form-label">Departemen</label>
            <div>
              <select name='dept_id' class='form-control'>
                @foreach($data_departemen as $dept)
                <option hidden value="">
                  <center>-- Pilih --</center>
                </option>
                <option value="{{$dept->id}}">{{$dept->name}}</option>
                @endforeach
              </select>
            </div>
          </div> --}}
          <div class="form-group text-center">
            <button id="btn" type="submit" class="btn btn-block">Submit</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- End Modal Add Employee -->



<!-- Edit Modal -->
<div id="editmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Edit Employee
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form id="editform" role="form text-left" method="post" action="{{ route('employee.update', '$employee->id') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <div>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password</label>
            <div>
              <input type="password" class="form-control" name="password" id="passworrd" passplaceholder="password">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <div>
              <textarea class="form-control" name="address" id="address"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Phone</label>
            <div>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Avatar</label>
            <div>
              <input type="file" class="form-control" name="avatar" id="avatar">
              <label><b>*Jika tidak ada kosongkan saja</b></label>
            </div>
          </div>
          {{-- <div class="form-group">
            <label for="message-text" class="col-form-label">Departemen</label>
            <div>
              <select name='dept_id' id="dept_id" class='form-control'>
                @foreach($data_departemen as $dept)
                <option hidden value="">
                  <center>-- Pilih --</center>
                </option>
                <option value="{{$dept->id}}">{{$dept->name}}</option>
                @endforeach
              </select>
            </div>
          </div> --}}
          <div class="form-group text-center">
            <button id="btn" type="submit" class="btn btn-block">Submit</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- End Edit Modal -->
<br>
<br>
<!-- Table Employee -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Employee Table</h4>

        <div class="table-responsive">
          <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
              <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Avatar</th>
                <th>Departemen</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($employee as $e)



              <tr>
                <td>{{$e->user->email}}</td>
                <td>{{$e->name}}</td>
                <td>{{$e->address}}</td>
                <td>{{$e->phone}}</td>
                <td><img src="{{ url('storage').'/'.$e->avatar }}" height="40px" width="40px" />
                <td>
                    {{$e->department->name}}
                </td>

                <td>
                <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button" href="#">
                    <span class="btn-label"><i class="far fa-edit"></i></span>
                  </a>
                  <form method="post" action="{{url('employee/delete/'.$e->user_id)}}">
                    @method('DELETE')
                    @csrf
                    @if (Auth::user()->role_id == 1)
                    <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                        <i class="fa fa-trash"></i></button>
                    @endif

                  </form>
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
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#multi_col_order').DataTable();

    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent')
      }

      var data = table.row($tr).data();
      console.log(data);

      $('#email').val(data.email);
      $('#name').val(data.name);
      $('#address').val(data.address);
      $('#phone').val(data.phone);
      $('#avatar').val(data.avatar);
      $('#dept_id').val(data.dept_name);

      $('#editform').attr('action', 'employee/edit/' + data.id);
      $('#editmodal').modal('show');
    });
  });
</script>
@endsection
