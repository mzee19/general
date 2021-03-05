<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FormField;
use Validator;

class FormFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formFields = FormField::latest()->get();

        return view('formField.index', compact('formFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formField.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:text,number,email,select,radio,checkbox',
            'label_name' => 'required',
            'min_value' => 'nullable|integer',
            'max_value' => 'nullable|integer|gt:min_value',
            'length' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'type' => $request->type,
                'label_name' => $request->label_name,
                'min_value' => $request->min_value,
                'max_value' => $request->max_value,
                'length' => $request->length,
                'option' => $request->option,
                'mandatory' => $request->has('mandatory'),
            ];

            $formField = FormField::create($data);

            return redirect()->route('formFieldIndex')->with('success', 'Field is added successfully');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormField $formField)
    {
        return view('formField.update', compact('formField'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormField $formField)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:text,number,email,select,radio,checkbox',
            'label_name' => 'required',
            'min_value' => 'nullable|integer',
            'max_value' => 'nullable|integer|gt:min_value',
            'length' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $data = [
                'type' => $request->type,
                'label_name' => $request->label_name,
                'min_value' => $request->min_value,
                'max_value' => $request->max_value,
                'length' => $request->length,
                'option' => $request->option,
                'mandatory' => $request->has('mandatory'),
            ];

            $formField->update($data);

            return redirect()->route('formFieldIndex')->with('success', 'Field is update successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormField $formField)
    {
        $formField->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Record Delete successfully'
        ]);
    }
}
