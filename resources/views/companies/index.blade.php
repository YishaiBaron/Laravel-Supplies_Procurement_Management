@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers list</div>
                    <br />
                    @if($message = Session::get('success'))
                    <div class="alert alert-success">
                     <p>{{$message}}</p>
                    </div>
                    @endif

                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th rowspan="2">Customers</th>
                                <th colspan="1">Phone Number</th>
                                <th colspan="1">Chain</th>
                                <th colspan="1">Address</th>

                                <th colspan="1">Diversities</th>
                                <th colspan="1">Edit</th>                    
                                <th colspan="1">Delete</th>



                            </tr>
                            <tr>
                          
                            </tr>
                            @foreach ($companies as $company)
                                @foreach ($company->employees as $employee)
                                    <tr>
                                        <td>
                                        @if ($loop->iteration == 1)
                                            <b>{{ $company->name }}: {{$company->employees->count()}} diversities</b>
                                        @endif
                                        </td>
                                        <td>
                                            @if ($loop->iteration == 1)
                                            {{ $company->phone_number }}
                                        @endif
                                        </td>
                                        <td>
                                            @if ($loop->iteration == 1)
                                            {{ $company->chain }}
                                        @endif
                                        </td>
                                        <td>
                                            @if ($loop->iteration == 1)
                                            {{ $company->address }}
                                        @endif
                                        </td>
                                       
                                        <td>{{ $employee->name }}</td>


                                        
                                            <td>
                                                @if ($loop->iteration == 1)

                                                <a href="{{action('CompaniesController@edit', $company['id'])}}" class="btn btn-warning">Edit</a></td>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($loop->iteration == 1)

                                            <form method="post" class="delete_form" action="{{action('CompaniesController@destroy', $company['id'])}}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                               </form>
                                               @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
         $('.delete_form').on('submit', function(){
          if(confirm("Are you sure you want to delete it?"))
          {
           return true;
          }
          else
          {
           return false;
          }
         });
        });
        </script>
@endsection
