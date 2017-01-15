@extends('scaffold-interface.layouts.app')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Buat Transaksi Harian
    </h1>
    <form method = 'get' action = '{!!url("dailytransaction")!!}'>
        <button class = 'btn btn-danger'>Index Transaksi Harian</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("dailytransaction")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="Description">Description</label>
            <input id="Description" name = "Description" type="text" class="form-control" autofocus>
        </div>
        <div class="form-group">
            <label for="Cost">Cost</label>
            <input id="Cost" name = "Cost" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="InOut">InOut</label>
            <select class="form-control" id="InOut" name = "InOut">
                @foreach(config('enums.InOut') as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
        <button class = 'btn btn-primary' type ='submit'>Simpan</button>
    </form>
</section>
@endsection