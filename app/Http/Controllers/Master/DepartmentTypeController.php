<?php

namespace employment_bank\Http\Controllers\Master;

use Illuminate\Http\Request;

use employment_bank\Http\Requests;
use employment_bank\Http\Controllers\Controller;
use Validator;
use employment_bank\Models\DepartmentType;
use Illuminate\Database\QueryException;
use Kris\LaravelFormBuilder\FormBuilder;
use Redirect;

class DepartmentTypeController extends Controller{

    private $content  = 'admin.master.departmenttypes.';
    private $route    = 'master.departmenttypes.';

    public function index(){

        $results = DepartmentType::paginate(20);
        return view($this->content.'index', compact('results'));
    }

    public function create(FormBuilder $formBuilder){

   		    $form = $formBuilder->create('employment_bank\Forms\DepartmentTypeForm', [
               'method' => 'POST',
               'url' => route($this->route.'store')
          ])->remove('update');

          return view($this->content.'create', compact('form'));
   	}
      /**
       * Store a newly created resource in storage.
       *
       * @param  Request  $request
       * @return Response
       */
      public function store(Request $request){

        $validator = Validator::make($data = $request->all(), DepartmentType::$rules);
  		  if ($validator->fails())
          return Redirect::back()->withErrors($validator)->withInput();

  		  DepartmentType::create($data);
        return Redirect::route($this->route.'index')->with('message', 'New Department Type has been Added!');
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
          //
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
       public function edit($id, FormBuilder $formBuilder){

   		    $result  = DepartmentType::findOrFail($id);
   		    $form    = $formBuilder->create('employment_bank\Forms\DepartmentTypeForm', [
   			       'method' => 'PUT',
               'model' => $result,
               'url' => route($this->route.'update', $id)
          ])->remove('save');
   		    return view($this->content.'edit', compact('form'));
   	  }

      /**
       * Update the specified resource in storage.
       *
       * @param  Request  $request
       * @param  int  $id
       * @return Response
       */
      public function update(Request $request, $id){

        $model = DepartmentType::findOrFail($id);
        $rules = str_replace(':id', $id, DepartmentType::$rules);
        $validator = Validator::make($data = $request->all(), $rules);
        if ($validator->fails())
          return Redirect::back()->withErrors($validator)->withInput();

        $model->update($data);

        return Redirect::route($this->route.'index')->with('alert-success', 'Data has been Updated!');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id){

        try{
          DepartmentType::destroy($id);
        }catch(QueryException $ex){
          return Redirect::back()->with('alert-warning', 'DepartmentType is in Use!');
        }

        return Redirect::route($this->route.'index')->with('alert-success', 'Successfully Deleted!');

      }
  }
