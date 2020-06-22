
@extends('layouts.app')

@section('content')

<div class="container">
 <div class="col-md-8">
  <br />
  <h1>Edit</h1>
  <br />
  @if(count($errors) > 0)

  <div class="alert alert-danger">
         <ul>
         @foreach($errors->all() as $error)
          <li>{{$error}}</li>
         @endforeach
         </ul>
  @endif
  <form method="post" action="{{action('CompaniesController@update', $id)}}">
   {{csrf_field()}}
   <input type="hidden" name="_method" value="PATCH" />
   <h3>Name:</h3>
   <div class="form-group">
    <input type="text" name="name" class="form-control" value="{{$company->name}}" placeholder="Enter  Name" />
   </div>
   <h3>Phone number:</h3>
   <div class="form-group">
    <input type="text" name="phone_number" class="form-control" value="{{$company->phone_number}}" placeholder="Enter phone number" />
   </div>
   <h3>Chain:</h3>
   <div class="form-group">
    <input type="text" name="chain" class="form-control" value="{{$company->chain}}" placeholder="Enter chain" />
   </div>
   <h3>Address:</h3>
   <div class="form-group">
    <input type="text" name="address" class="form-control" value="{{$company->address}}" placeholder="Enter address" />
   </div>
   
   <h3>Diversities:</h3>
   @foreach ($company->employees as  $index =>  $employee )
   <div class="form-group">
    <tr> 
        <h4>{{ $index+1}}:</h4>
    <td><input type="hidden" name="employees[{{$loop->index}}][id]" value="{{$employee->id}}"></td>
    <td>        <input type="text" name="employees[{{$loop->index}}][name]" value="{{$employee->name}}" class="form-control" placeholder="employee" ></td>
    
    <td>
      
        <form method="post" class="delete_form" action="{{action('CompaniesController@destroyDiversity', $employee['id'])}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" class="btn btn-danger">Delete</button>
           </form>
       </td>

</tr>
    </div>
   @endforeach

   

   <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update" />
    <a href="{{ route('employees.create') }}">   
         <button type="button" class="btn btn-warning">Add Diversity Customer</button>
    </a>

  

   </div>
  </form>
 </div>
</div>
<script>
    
    </script>
@endsection
