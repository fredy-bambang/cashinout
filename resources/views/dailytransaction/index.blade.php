@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Transaksi Harian
    </h1>
    <form class = 'col s3' method = 'get' action = '{!!url("dailytransaction")!!}/create'>
        <button class = 'btn btn-primary' type = 'submit'>Buat Transaksi Harian</button>
    </form>
    <br>
    <br>
    <b>Informasi Hari Ini</b> - 
    <b>Penerimaan : </b> <span style="color:blue">{{ number_format($dailyIn, 2, '.', ',') }}</span> |
    <b>Pengeluaran : </b><span style="color:red">{{ number_format($dailyOut, 2, '.', ',') }}</span> |
    <b>Selisih : </b><span style="color:green">{{ number_format($dailyIn - $dailyOut, 2, '.', ',') }}</span>
    <form class="form-inline" action = '{!! url("dailytransaction") !!}'>
        <div class="form-group">
            <label for="date1">Tanggal Mulai</label>
            <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right tanggal" name="dateStart" value={{ Request::get('dateStart') }}>
            </div>
        </div>
        <div class="form-group">
            <label for="date2">Tanggal Akhir</label>
            <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right tanggal" name="dateEnd" value={{ Request::get('dateEnd') }}>
            </div>
        </div>
        <div class="form-group">
            <label for="date2">Masuk / Bayar</label>
            <select class="form-control" id="InOut" name = "inOut">
                <option value="">Semua</option>
                @foreach(config('enums.InOut') as $key=>$value)
                    <option value="{{$key}}" {!!Request::get('inOut') == $key ? 'selected' : '' !!}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <button class = 'btn btn-primary' type = 'submit'>Filter</button>
    </form>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Deskripsi</th>
            <th>Biaya</th>
            <th>Pemasukan / Pengeluaran</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            @foreach($dailytransactions as $dailytransaction) 
            <tr>
                <td>{!!$dailytransaction->Description!!}</td>
                <td style="text-align:right">{!! number_format($dailytransaction->Cost, 2, '.', ',') !!}</td>
                <td>{!!$dailytransaction->InOut == 'In' ? 'Pemasukan' : 'Pengeluaran' !!}</td>
                <td>{!!
                        $dailytransaction
                        ->created_at
                        {{-- ->setTimezone(config('enums.TIMEZONE')) --}}
                        ->format('d-m-Y H:m:s') 
                    !!}
                </td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/dailytransaction/{!!$dailytransaction->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/dailytransaction/{!!$dailytransaction->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/dailytransaction/{!!$dailytransaction->id!!}'><i class = 'material-icons'>info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $dailytransactions->render() !!}

</section>
@endsection