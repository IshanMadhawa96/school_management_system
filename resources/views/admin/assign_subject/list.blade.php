
@extends('layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assgin Subject List </h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a href="{{ url('admin/assign_subject/add') }}" class="btn btn-primary">Assgin Subject </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Assgin Subject List </h3>
                  </div>
                <form method="get" action="{{ url('admin/assign_subject/list') }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Class Name</label>
                                <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}"  placeholder="Class Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Subject Name</label>
                                <input type="text" class="form-control" name="subject_name" value="{{ Request::get('subject_name') }}"  placeholder="Subject Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label >Date</label>
                                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}"   placeholder="Date">
                                <div style="color:red">{{ $errors->first('date') }}</div>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 30px">Search</button>
                                <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-success" style="margin-top: 30px">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @include('_message')
            <div class="card">
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>Class Name</th>
                      <th>Subject Name</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($getRecord) > 0)
                        @foreach ($getRecord as $value )
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->subject_name }}</td>
                                <td>
                                    @if( $value->status == 0)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                </td>
                                <td>{{ $value->created_by_name }}</td>
                                <td>{{ date('d-m-Y H:i A'),strtotime($value->created_at) }}</td>
                                <td>
                                    <a href="{{ url('admin/assign_subject/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('admin/assign_subject/edit_single/'.$value->id) }}" class="btn btn-primary">Edit Single</a>
                                    <a href="{{ url('admin/assign_subject/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No records found</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
                <div style="padding:10px; float:right">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
