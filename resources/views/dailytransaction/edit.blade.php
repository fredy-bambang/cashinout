@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Ubah Transaksi Harian
    </h1>
    <form method = 'get' action = '{!!url("dailytransaction")!!}'>
        <button class = 'btn btn-danger'>Transaksi Harian Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("dailytransaction")!!}/{!!$dailytransaction->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="Description">Description</label>
            <input id="Description" name = "Description" type="text" class="form-control" value="{!!$dailytransaction->
            Description!!}"> 
        </div>
        <div class="form-group">
            <label for="Cost">Cost</label>
            <input id="Cost" name = "Cost" type="text" class="form-control" value="{!!$dailytransaction->
            Cost!!}"> 
        </div>
        <div class="form-group">
            <label for="InOut">InOut</label>
            <select class="form-control" id="InOut" name = "InOut">
                @foreach(config('enums.InOut') as $key=>$value)
                    <option value="{{$key}}" {!!$dailytransaction->InOut == $key ? 'selected' : '' !!}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <button class = 'btn btn-primary' type ='submit'>Update</button>
    </form>
</section>
@endsection