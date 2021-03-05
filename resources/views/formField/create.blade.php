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
                            <form role="form" action="{{route('formFieldStore')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type">
                                            <option value="text">Text</option>
                                            <option value="number">Number</option>
                                            <option value="email">Email</option>
                                            <option value="select">Select</option>
                                            <option value="radio">Radio</option>
                                            <option value="checkbox">CheckBox</option>
                                        </select>

                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('label_name') ? 'has-error' : '' }}">
                                        <label for="labelName">Label Name</label>
                                        <input type="text" value="{{old('label_name')}}" class="form-control" name="label_name" id="labelName" placeholder="Enter Label Name" required>
                                        <span class="text-danger">{{ $errors->first('label_name') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('mandatory') ? 'has-error' : '' }}">
                                        <label for="mandatory">Mandatory</label>
                                        <input class="form-check-input" style="margin-left: 0px !important;" type="checkbox" name="mandatory" id="mandatory">
                                        <span class="text-danger">{{ $errors->first('mandatory') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('option') ? 'has-error' : '' }}">
                                        <label for="option">Option <small> use comma (,) for separate value</small></label>
                                        <input class="form-control"  value="{{old('option')}}" type="text" name="option" id="option">
                                        <span class="text-danger">{{ $errors->first('option') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('min_value') ? 'has-error' : '' }}">
                                        <label for="minValue">Min Value</label>
                                        <input class="form-control" type="number" value="{{old('min_value')}}" name="min_value" id="minValue">
                                        <span class="text-danger">{{ $errors->first('min_value') }}</span>

                                    </div>
                                    <div class="form-group {{ $errors->has('max_value') ? 'has-error' : '' }}">
                                        <label for="maxValue">Max Value</label>
                                        <input class="form-control" value="{{old('max_value')}}" type="number" name="max_value" id="maxValue">
                                        <span class="text-danger">{{ $errors->first('max_value') }}</span>

                                    </div>
                                    <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                                        <label for="length">Length</label>
                                        <input class="form-control" value="{{old('length')}}" type="number" name="length" id="length">
                                        <span class="text-danger">{{ $errors->first('length') }}</span>

                                    </div>

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