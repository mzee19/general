<?php

namespace App\Http\Controllers;

use App\Employee;
use App\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formFields = FormField::all();

        return view('employee.create', compact('formFields','columnNames'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = FormField::all();
        $validator = [];
        foreach ($formFields as $formField) {
            $required = $formField->mandatory == 1 ? 'required' : 'nullable';
            $minValue = $formField->min_value > 0 ? 'min:'.$formField->min_value : '';
            $maxValue = $formField->max_value > 0 ? 'max:'.$formField->max_value : '';
            $length = $formField->length > 0 ? 'max:'.$formField->length : '';
            $validator = Validator::make($request->all() , [
                $formField->name => $required|$minValue|$maxValue|$length,
            ]);
        }

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $employee = new Employee;
        $employee->employee_data = json_encode($request->except('_token'));
        $employee->save();
        return redirect()->route('employeeIndex')->with('success', 'Employee added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $formFields = FormField::all();
        return view('employee.update',compact('employee', 'formFields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $formFields = FormField::all();
        $validator = [];
        foreach ($formFields as $formField) {
            $required = $formField->mandatory == 1 ? 'required' : 'nullable';
            $minValue = $formField->min_value > 0 ? 'min:'.$formField->min_value : '';
            $maxValue = $formField->max_value > 0 ? 'max:'.$formField->max_value : '';
            $length = $formField->length > 0 ? 'max:'.$formField->length : '';
            $validator = Validator::make($request->all() , [
                $formField->name => $required|$minValue|$maxValue|$length,
            ]);
        }

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $employee->employee_data = json_encode($request->except('_token'));
        $employee->save();
        return redirect()->route('employeeIndex')->with('success', 'Employee Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employeeIndex')->with('success', 'Employee deleted');

    }
}
