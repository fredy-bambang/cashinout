@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show dailytransaction
    </h1>
    <br>
    <form method = 'get' action = '{!!url("dailytransaction")!!}'>
        <button class = 'btn btn-primary'>dailytransaction Index</button>
    </form>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>Description : </i></b>
                </td>
                <td>{!!$dailytransaction->Description!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>Cost : </i></b>
                </td>
                <td>{!!$dailytransaction->Cost!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>InOut : </i></b>
                </td>
                <td>{!!$dailytransaction->InOut!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection