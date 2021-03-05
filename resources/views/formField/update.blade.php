@extends('layouts.app')

@section('content')
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
                                <h3 class="card-title">Form Field</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('formFieldUpdate', $formField->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" required>
                                            <option value="text" {{$formField->type == 'text' ? 'selected' : ''}}>Text</option>
                                            <option value="number" {{$formField->type == 'number' ? 'selected' : ''}}>Number</option>
                                            <option value="email" {{$formField->type == 'email' ? 'selected' : ''}}>Email</option>
                                            <option value="select" {{$formField->type == 'select' ? 'selected' : ''}}>Select</option>
                                            <option value="radio" {{$formField->type == 'radio' ? 'selected' : ''}}>Radio</option>
                                            <option value="checkbox" {{$formField->type == 'checkbox' ? 'selected' : ''}}>CheckBox</option>
                                        </select>

                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('label_name') ? 'has-error' : '' }}">
                                        <label for="labelName">Label Name</label>
                                        <input type="text" value="{{ $formField->label_name}}" class="form-control" name="label_name" id="labelName" placeholder="Enter Label Name" required>
                                        <span class="text-danger">{{ $errors->first('label_name') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('mandatory') ? 'has-error' : '' }}">
                                        <label for="mandatory">Mandatory</label>
                                        <input class="form-check-input" {{$formField->mandatory == true ? 'checked' : '' }} style="margin-left: 0px !important;" type="checkbox" name="mandatory" id="mandatory">
                                        <span class="text-danger">{{ $errors->first('mandatory') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('option') ? 'has-error' : '' }}">
                                        <label for="option">Option <small> use comma (,) for separate value</small></label>
                                        <input class="form-control"  value="{{$formField->option}}" type="text" name="option" id="option">
                                        <span class="text-danger">{{ $errors->first('option') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('min_value') ? 'has-error' : '' }}">
                                        <label for="minValue">Min Value</label>
                                        <input class="form-control" type="number" value="{{$formField->min_value}}" name="min_value" id="minValue">
                                        <span class="text-danger">{{ $errors->first('min_value') }}</span>

                                    </div>
                                    <div class="form-group {{ $errors->has('max_value') ? 'has-error' : '' }}">
                                        <label for="maxValue">Max Value</label>
                                        <input class="form-control" value="{{$formField->max_value}}" type="number" name="max_value" id="maxValue">
                                        <span class="text-danger">{{ $errors->first('max_value') }}</span>

                                    </div>
                                    <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                                        <label for="length">Length</label>
                                        <input class="form-control" value="{{$formField->length}}" type="number" name="length" id="length">
                                        <span class="text-danger">{{ $errors->first('length') }}</span>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection()