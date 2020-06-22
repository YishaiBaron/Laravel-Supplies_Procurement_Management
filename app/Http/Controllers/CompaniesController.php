<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;

use Validator;



use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
            $companies = Company::all();
        
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


        
  


        if($request->ajax())



    

        {
            $company = Company::create([

                'id' =>  $request->id,
                'name' => $request->get('name'),
                'phone_number' => $request->get('phone_number'),
                'chain' => $request->get('chain'),
                'address' => $request->get('address'),
    
            ]
            );
    
        
         $rules = array(
          'nameDiversity.*'  => 'required',

         );
         $error = Validator::make($request->all(), $rules);
         if($error->fails())
         {
          return response()->json([
           'error'  => $error->errors()->all()
          ]);
         }


      $nameDiversity = $request->input('nameDiversity');
         //$nameDiversity = $request->get(nameDiversity);
    //        error_log($request->get('nameDiversity'));

         for($count = 0; $count < count($nameDiversity); $count++)
         {
         // $data = array(

            $company->employees()->create([
                'name' => $nameDiversity[$count]
            ]);

     

         }


                                                 
      
      
         return response()->json([
          'success'  => 'Data Added successfully.',
          'url'=> url('/companies')
         ]);
         

        }
       






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
    public function edit($id)
    {
        //
        $company = Company::find($id);
        return view('companies.edit', compact('company', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    =>  'required',
            'phone_number'     =>  'required',
            'chain'    =>  'required',
            'address'     =>  'required'
            
        ]);
        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->phone_number = $request->get('phone_number');
        $company->chain = $request->get('chain');
        $company->address = $request->get('address');

        $employees = $request->input('employees');  //here scores is the input array param 




        foreach($employees as $id => $row){
          //  error_log($row['id']);

          //  error_log($row['name']);

            $locale = Employee::find($row['id']);
            $locale->name = $row['name'];

            $locale->save();

        }

        

        $company->save();



        return redirect()->route('companies.index')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      

        $company = Company::find($id);
        $company->employees()->delete();
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Data Deleted');
    }

    public function destroyDiversity($id)
    {
        $employee = Employee::find($id);

        $employee->delete();
        return redirect()->route('companies.index')->with('success', 'Data Deleted');

    }
    
   

  
    
}
