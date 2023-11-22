@extends('backend/layouts.template')
@section('titlepage')
Penilaian Kinerja Guru
@endsection
@section('title')
Penilaian
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-primary" role="alert">{{ session('success')}}</div>
@endif

@if(session()->has('loginError'))
<div class="alert alert-danger" role="alert">{{ session('loginError')}}</div>
@endif
<div id="success_message"></div>

<?php
if (count($walii) < 1) {
    ?>
    <h1 class="text-danger">Silahkan Isi Identitas Diri Anda !!!!</h1>
    <a href="{{route('profile')}}" class="btn btn-outline-primary w-100 me-1 btn-sm">Isi Data Diri</a>
<?php
} else {
    ?>
    <form action="{{route('nilaiguru')}}" method="get" class="mb-4" >
        <div class="row">
            <div class="mb-3">
                <label class="form-label">Nama Guru</label>
                <div class="w-100">
                    <div class="w-100">
                        <select name="user_id" class="user_id form-control theSelect" id="user_id">
                            <option selected disabled>Pilih Guru</option>
                            @foreach ($dataguru as $item)
                            <option value="{{ $item->user_id }}" {{ $item->user_id == $user[0]->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <span class="text-danger error-text user_id_error"></span>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary w-100 me-1 btn-sm">Nilai</button>
    </form>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 row-cols-xxl-5 g-4">
@foreach ($oke as $item => $data)
@if($dt <= manipulasiTanggal($data[0]->deadline,'+1','months'))
    <div class="col penilaian" style="width: 300px;">
        <div class="card h-100">
            @if($data[0]->image == null)
            <img src="{{asset('public/backend/img/background/sekolah2.jpeg')}}" class="card-img-top sh-25" alt="card image">
            @else
            <img src="images/{{$data[0]->image}}" class="card-img-top sh-25" alt="card image">
            @endif
            <div class="card-body">
                <h5 class="heading mb-2">
                    <a href="Quiz.Detail.html" class="body-link">
                        <?php $bulan =  date('F', strtotime($data[0]->tanggal)); 
                        $tahun =  date('Y', strtotime($data[0]->tanggal));?>
                        <span class="clamp-line" data-line="5">{{$data[0]->nama_penilaian}} Bulan {{$bulan}} {{$tahun}}</span>
                    </a>
                </h5>
                <!-- <div class="mb-3 text-muted sh-8 clamp-line" data-line="3">
                    Pie fruitcake jelly beans. Candy tootsie chocolate croissant jujubes icing chocolate croissant jujubes icing macaroon croissant.
                </div> -->
                <div class="row g-0 align-items-center mb-1">
                    <div class="col ">
                        <div class="row g-0">
                            <div class="col">
                                <div class="text-alternate sh-4 d-flex align-items-center lh-1-25">Jumlah</div>
                            </div>
                            <div class="col-auto">
                                <div class="sh-4 d-flex align-items-center text-alternate"><?php $jumlah = count($data); echo $jumlah ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0 align-items-center mb-4">
                    <div class="col">
                        <div class="row g-0">
                            <div class="col">
                                <div class="text-alternate sh-4 d-flex align-items-center lh-1-25">Tanggal</div>
                            </div>
                            <div class="col-auto">
                                <div class="sh-4 d-flex align-items-center text-alternate">{{$data[0]->tanggal}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0 align-items-center mb-4">
                    <div class="col">
                        <div class="row g-0">
                            <div class="col">
                                <div class="text-alternate sh-4 d-flex align-items-center lh-1-25">Deadline</div>
                            </div>
                            <div class="col-auto">
                                <div class="sh-4 d-flex align-items-center text-alternate">{{$data[0]->deadline}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row g-0 align-items-center mb-4">
                    <div class="col-auto">
                        <div class="sw-3 sh-4 d-flex justify-content-center align-items-center">
                            <i data-acorn-icon="graduation" class="text-primary"></i>
                        </div>
                    </div>
                    <div class="col ps-3">
                        <div class="row g-0">
                            <div class="col">
                                <div class="text-alternate sh-4 d-flex align-items-center lh-1-25">Level</div>
                            </div>
                            <div class="col-auto">
                                <div class="sh-4 d-flex align-items-center text-alternate">Beginner</div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php
                
                if (cekPenilaianWali($data[0]->id_penilaian, Auth::user()->id,$user[0]->id, $data[0]->id)) {
                    ?>
                <div class="d-flex flex-row justify-content-between w-100 w-sm-50 w-xl-100">
                    <a href="{{ route('detailkinerjaguru', [$data[0]->id_penilaian,$user[0]->id]) }}" class="btn btn-outline-primary w-100 me-1 btn-sm disabled">Sudah Di Isi</a>
                </div>
                    <?php
                    
                }else {
                    ?>
                    <div class="d-flex flex-row justify-content-between w-100 w-sm-50 w-xl-100">
                        <?php
                        if($dt < $data[0]->tanggal){
                            ?>
                        <a href="{{ route('detailkinerjawali', [$data[0]->id_penilaian,$user[0]->id,$data[0]->id]) }}" class="btn btn-outline-primary w-100 me-1 btn-sm disabled">Belum Boleh</a>
                        <?php
                        }elseif($dt > $data[0]->deadline){
                            ?>
                            <a href="{{ route('detailkinerjawali', [$data[0]->id_penilaian,$user[0]->id,$data[0]->id]) }}" class="btn btn-outline-primary w-100 me-1 btn-sm disabled">Sudah Lewat</a>
                            <?php
                        }elseif($dt >= $data[0]->tanggal && $dt <= $data[0]->deadline){
                            ?>
                            <a href="{{ route('detailkinerjawali', [$data[0]->id_penilaian,$user[0]->id,$data[0]->id]) }}" class="btn btn-outline-primary w-100 me-1 btn-sm">Start</a>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                
                ?>
            </div>
        </div>
    </div>
    @endif
@endforeach
</div>
<?php
}
?>
@section('js')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script>
		$(".theSelect").select2({
      theme: 'bootstrap4',
    });
	</script>
@endsection
@endsection