@extends('layouts.mainlayout')

@section('content')

<?php
use App\Models\User;

use App\Models\Config;
use App\Models\District;
use App\Models\Regency;
use App\Models\SaksiData;
use App\Models\Tps;
use App\Models\Village;
use Illuminate\Support\Facades\DB;

$config = Config::all()->first();
$regency = District::where('regency_id', $config['regencies_id'])->get();
$kota = Regency::where('id', $config['regencies_id'])->first();
$dpt = District::where('regency_id', $config['regencies_id'])->sum('dpt');
$tps = Tps::count();
?>
<div class="row">

    <div class="row">
        <div class="col-lg-12">
            <center>
                <h1 class="page-title mt-1 mb-0" style="font-size: 70px">QUICK COUNT
                </h1>
            </center>
        </div>

        <div class="col-lg-12">
            <div id="marquee1" class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-danger text-white rounded-0">Enumerator</button>
                </div>
                <div class="form-control bg-dark" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    <marquee id="cobamarq1">
                        @foreach ($marquee as $mq)
                        <?php $kecamatan2 =  District::where('id', $mq['districts'])->first(); ?>
                        <?php $kelurahan =  Village::where('id', $mq['villages'])->first(); ?>
                        <?php $tps =  Tps::where('id', $mq['tps_id'])->first(); ?>
                        <span class="text-success">▼ </span><span class="text-white"
                            style="font-size: 20px;">{{$mq['name']}} Kecamatan {{$kecamatan2 ['name']}}, Kelurahan
                            {{$kelurahan['name']}}, TPS {{$tps['number']}}</span>
                        @endforeach
                    </marquee>


                </div>
            </div>
            <div class="card" style="margin-bottom: 1rem">
                <div class="card-header bg-info-gradient">
                    <h3 class="card-title text-white">Suara TPS Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-6">
                            <div class="container" style="margin-left: 3%; margin-top: 2.5%;">
                                <div class="text-center fs-2 mb-3 fw-bold">SUARA MASUK</div>
                                <div class="text-center">Progress {{substr($realcount,0,5)}}% dari 100%</div>
                                <div class="text-center mt-2 mb-2"><span
                                        class="badge bg-success">{{$total_incoming_vote}} / {{$dpt}}</span></div>
                                <div id="chart-pie2" class="chartsh h-100 w-100"></div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $pas)
                            <div class="row mt-2">
                                <div class="col-lg col-md col-sm col-xl mb-3">
                                    <div class="card" style="margin-bottom: 0px;">
                                        <div class="card-body">
                                            <div class="row me-auto">
                                                <div class="col-4">
                                                    <div class="counter-icon box-shadow-secondary brround candidate-name text-white "
                                                        style="margin-bottom: 0; background-color: {{$pas->color}};">
                                                        {{$i++}}
                                                    </div>
                                                </div>
                                                <div class="col me-auto">
                                                    <h6 class="">{{$pas->candidate}} </h6>
                                                    <h6 class="">{{$pas->deputy_candidate}} </h6>
                                                    <?php
                                                    $voice = 0;
                                                    ?>
                                                    @foreach ($pas->quicksaksidata as $dataTps)
                                                    <?php
                                                    $voice += $dataTps->voice;
                                                    ?>
                                                    @endforeach
                                                    <h3 class="mb-2 number-font">{{ $voice }} suara</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <?php $count = 1; ?>
                    @foreach ($kecamatan as $item)
                    <div class="carousel-item <?php if ($count++ == 1) : ?><?= 'active' ?><?php endif; ?>">
                        <div class="fw-bold fs-3 mb-3">
                            KECAMATAN {{$item['name']}}
                        </div>

                        <div class="row">
                            <?php $i = 1; ?>
                            @foreach ($paslon as $psl)
                            <?php
                            $pasln = SaksiData::join('districts', 'districts.id', '=', 'saksi_data.district_id')->where('saksi_data.district_id', $item['id'])->where('saksi_data.paslon_id', $psl->id)->get();
                            $jumlah = 0;
                            foreach ($pasln as $pas) {
                                $jumlah += $pas->voice;
                            }

                            $persen = substr($jumlah / $item->dpt * 100, 0, 3);

                            ?>
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header justify-content-center"
                                        style="background-color:{{$psl->color}}">
                                        <h3 style="margin-bottom: 0;" class="fw-bold text-white">{{$psl->candidate}} -
                                            <br> {{$psl->deputy_candidate}}</h3>
                                    </div>
                                    <div class="card-body" style="padding: 10px;">
                                        <div class="row">
                                            <div class="col">
                                                <img src="{{asset('storage/'. $psl['picture'])}}" width="125px"
                                                    height="125px" style="object-fit: cover;" alt="">
                                            </div>
                                            <div class="col text-center my-auto fs-1 fw-bold">
                                                {{$persen}}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $jumlah = 0;
                            ?>
                            @endforeach
                            <?php $i = 1; ?>

                        </div>
                    </div>

                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Suara TPS Quick Count (Seluruh Kelurahan)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-white align-middle">Kecamatan</th>
                                            <th class="text-white align-middle">Sumber Kelurahan</th>
                                            <th class="text-white align-middle">Total TPS</th>
                                            <th class="text-white align-middle">Quick Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($district_quick as $item)
                                        <?php $count_tps = Tps::where('villages_id',(string)$item['id'])->count(); ?>
                                        <?php $count_tps_quick = Tps::where('villages_id',(string)$item['id'])->where('quick_count', 1)->count(); ?>
                                        <?php $kecc = District::where('id', $item['district_id'])->first(); ?>
                                        <tr @if ( $count_tps_quick  > 0)
                                            style="background-color: rgb(80,78, 78); color :white;" @else  @endif>
                                            <td class="align-middle text">
                                                {{$kecc['name']}}
                                            </td>
                                            <td class="align-middle">
                                                <a href="modaltpsQuick2" class="modaltpsQuick2 @if ( $count_tps_quick  > 0)
                                         text-white
                                                    @else text-dark
                                                @endif" id="Cek" data-id="{{$item['id']}}" data-bs-toggle="modal" id=""
                                                    data-bs-target="#modaltpsQuick2">{{$item['name']}}</a>
                                            </td>
                                            <td class="align-middle">{{$count_tps}}</td>
                                            <td class="align-middle">@if ( $count_tps_quick  > 0)
                                                {{$count_tps_quick}}
                                                @else
                                                0
                                                @endif</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="https://quickcount.rekapitung.id" class="btn btn-block btn-success">PELAJARI METODOLOGI QUICK COUNT REKAPITUNG</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modaltpsQuick2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-white" id="container-tps-quick2">

        </div>
    </div>
</div>

@endsection
