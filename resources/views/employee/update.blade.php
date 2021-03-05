@extends('layouts.app')

@section('content')
    <style>
        .opacity-5 {
            opacity:1!important;
        }
        .top-z-index {
            z-index: 0;
            top: 5px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('employeeUpdate',$employee->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @foreach($formFields as $index => $formField)
                                        @php
                                            $employeeDetail = json_decode($employee->employee_data, true)
                                        @endphp
                                        <div class="form-group {{ $errors->has($formField->name) ? 'has-error' : '' }}">
                                            <label for="">{{$formField->label_name}}</label>
                                            @if(($formField->type == 'text' || $formField->type == 'number' || $formField->type == 'email'))
                                                <input type="{{$formField->type}}" min="{{$formField->min_value}}" max="{{$formField->max_value || $formField->length}}" class="form-control"
                                                       name="{{$formField->name}}" id="labelName" value="{{$employeeDetail[$formField->name]}}" placeholder="Enter {{$formField->label_name}}"
                                                        {{$formField->mandatory ==true ? 'required' : ''}}>
                                                <span class="text-danger">{{ $errors->first($formField->name) }}</span>
                                            @endif

                                            @if(($formField->type == 'select'))
                                                @php
                                                    $getOptions = explode(',',$formField->option);
                                                @endphp
                                                <select class="form-control" name="{{$formField->name}}">
                                                    @foreach($getOptions as $option)
                                                        <option value="{{$option}}" {{$employeeDetail[$formField->name] == $option ? 'selected' : ''}}>{{$option}}</option>
                                                    @endforeach
                                                </select>
                                            @endif

                                            @if(($formField->type == 'radio'))
                                                @php
                                                    $getOptions = explode(',',$formField->option);
                                                @endphp
                                                @foreach($getOptions as $index => $option)
                                                    <br><input class="custom-control-input ml-4 position-relative opacity-5 top-z-index" type="radio"
                                                               id="{{$formField->name.$index}}" name="{{$formField->name}}" {{$employeeDetail[$formField->name] == $option ? 'checked' : ''}}
                                                    >
                                                    <label class="ml-2">{{$option}}</label>
                                                @endforeach
                                            @endif

                                            @if($formField->type == 'checkbox')
                                                <input class="form-check-input ml-4"
                                                       type="checkbox" name="{{$formField->name}}" id="{{$formField->name}}" {{$employeeDetail[$formField->name] == 'on' ? 'checked' : ''}}>
                                            @endif


                                            <span class="text-danger">{{ $errors->first($formField->name) }}</span>
                                        </div>
                                    @endforeach()

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection()