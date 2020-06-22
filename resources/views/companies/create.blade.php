@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Customer

                    </div>

                    <div class="panel-body">
                            <form method="post" class="form-horizontal"  id="dynamic_form">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('chain') ? ' has-error' : '' }}">
                                <label for="chain" class="col-md-4 control-label">Chain</label>

                                <div class="col-md-6">
                                    <input id="chain" type="text" class="form-control" name="chain" value="{{ old('chain') }}" required autofocus>

                                    @if ($errors->has('chain'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('chain') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr />

<h4> Diversities:</h4>

                            <div class="form-group">
                             <span id="result"></span>
                                 <table class="table table-bordered table-striped" id="user_table">
                               <thead>
                                <tr>
                                    <th width="35%">Name</th>
                                    <th width="30%">Action</th>
                                </tr>
                               </thead>
                               <tbody>
                
                               </tbody>
                               <tfoot>
                                <tr>
                   
                                </tr>
                               </tfoot>
                           </table>
                           <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />

                   </div>







                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
        
         var count = 1;
        
         dynamic_field(count);
        
         function dynamic_field(number)
         {
          html = '<tr>';
                html += '<td><input type="text" name="nameDiversity[]" class="form-control" required autofocus/></td>';
                if(number > 1)
                {
                    html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                }
                else
                {   
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
         }
        
         $(document).on('click', '#add', function(){
          count++;
          dynamic_field(count);
         });
        
         $(document).on('click', '.remove', function(){
          count--;
          $(this).closest("tr").remove();
         });
        
         $('#dynamic_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'{{ route("companies.store") }}',
                    method:'post',
                    data:$(this).serialize(),
                    dataType:'json',
                    beforeSend:function(){
                        $('#save').attr('disabled','disabled');
                    },
                    success:function(data)
                    {
                        if(data.error)
                        {
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<p>'+data.error[count]+'</p>';
                            }
                            $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        }
                        else
                        {
                            window.location=data.url;

                            dynamic_field(1);
                            $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
}

                        $('#save').attr('disabled', false);
                    }
                })
         });
        
        });
        </script>
        

@endsection
