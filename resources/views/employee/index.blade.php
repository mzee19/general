@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
          @if(Session('success'))
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                              aria-hidden="true">×</span></button>
                  <strong>Success:</strong>&nbsp; {{ Session('success') }} </div>

          @endif
        <div class="card-header">
          <h3 class="card-title">Employee</h3>
          <div class="card-tools">
              <a href="{{route('employeeCreate')}}" class="btn btn-primary">Add Employee</a>
            {{--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">--}}
              {{--<i class="fas fa-minus"></i></button>--}}
            {{--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">--}}
              {{--<i class="fas fa-times"></i></button>--}}
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Employee Name
                      </th>
                      <th style="width: 30%">
                          Employee Email
                      </th>
                      <th>
                          Employee Designation
                      </th>
                      <th style="width: 10%" class="text-center">
                          Employee Type
                      </th>
                      <th style="width: 20%">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($employees as $index => $employee)
                    @php
                        $employeeDetail = json_decode($employee->employee_data, true)
                    @endphp
                  <tr>
                      <td>
                          {{$index+1}}
                      </td>
                      <td>
                          {{ $employeeDetail['Employee_Name'] ?? ' ' }}
                      </td>
                      <td>
                          {{ $employeeDetail['Employee_Email'] ?? ' ' }}
                      </td>
                      <td class="project_progress">
                          {{ $employeeDetail['Employee_Designation'] ?? ' ' }}
                      </td>
                      <td class="project-state">
                          {{ $employeeDetail['Employee_Type'] ?? ' ' }}
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="{{route('employeeEdit',$employee->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="{{route('employeeDelete',$employee->id)}}" onclick="deleteForm({{$employee}})">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
                @endforeach()
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>



</section>

</div>

@endsection()


@section('after-script')
<script>
    function deleteForm(form) {
        $.ajax(
            {
                url: "form-field/"+form.id+ '/delete',
                type: 'get',
                dataType: "JSON",
                success: function (response)
                {
                    if(response.status == 1 ) {
                        window.location.reload()
                    }
                    else{
                        alert(response.message)
                    }
                }
            });

    }
</script>

@endsection()