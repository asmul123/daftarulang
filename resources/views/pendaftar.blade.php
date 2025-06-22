<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Daftar Ulang - SPMB SMKN 1 GARUT 2025</title>
    
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/app.css">
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.png" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <img src="{{ url('/') }}/assets/images/logo.png" alt="" srcset="">
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            
            
                <li class='sidebar-title'>Main Menu</li>            
            
                <li class="sidebar-item  ">
                    <a href="{{ url('/pendaftar') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>Beranda</span>
                    </a>
                    
                </li>
                <li class="sidebar-item  ">
                  <form action="{{ url('/') }}/logout" method="POST" id="form-logout">
                      @csrf
                      <a href="javascript:;" onclick="parentNode.submit();" class="sidebar-link">
                          <i data-feather="log-out" width="20"></i> 
                          <span>Keluar</span>
                      </a>
                      </form>
                    
                </li>
         
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            
<div class="main-content container-fluid">
<!-- Contextual classes start -->
<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Biodata Calon Murid</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>Nomor Pendaftaran</td>
                <td>:</td>
                <td>{{ auth()->user()->nomor_pendaftaran; }}</td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ auth()->user()->name; }}</td>
              </tr>
              <tr>
                <td>Asal Sekolah</td>
                <td>:</td>
                <td>{{ $pendaftar->asal_sekolah; }}</td>
              </tr>
              @php
                $diterimadi = explode(" - ", $pendaftar->pilihan_diterima);                
              @endphp
              <tr>
                <td>Jalur Pendaftaran</td>
                <td>:</td>
                <td>{{ $diterimadi['2']; }}</td>
              </tr>
              <tr>
                <td>Pilihan Program Keahlian</td>
                <td>:</td>
                <td>{{ $diterimadi['1']; }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        
      <div class="card-header">
        <h4 class="card-title">Berkas Persyaratan</h4>
        @if (session('success'))
        <div class="alert alert-light-success color-warning">{{ session('success') }}</div>
        @endif
      </div>
      <div class="card-body">
                <!-- table contextual / colored -->
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th>NO</th>
                        <th>BERKAS PENDAFTARAN</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>BUKTI PENDAFTARAN</td>
                        <td>
                          @php
                          $upload = 0;
                          $cek_file_1 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '1');
                          $file_1 = $cek_file_1->count();
                          @endphp
                          @if($file_1 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_1->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_1 >= 1)
                          @php                          
                          $file_1_id = $cek_file_1->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_1_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#default">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Bukti Pendaftaran</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="1">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>BUKTI KELULUSAN</td>
                        <td>
                          @php
                          $cek_file_2 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '2');
                          $file_2 = $cek_file_2->count();
                          @endphp
                          @if($file_2 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_2->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_2 >= 1)
                          @php                          
                          $file_2_id = $cek_file_2->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_2_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-2">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Bukti Kelulusan</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="2">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>SCREENSHOOT FOLLOW <a href="https://www.instagram.com/smkn1garut_official?igsh=aDE4eDdzaGxqeG9v" target="_blank">INSTAGRAM</a></td>
                        <td>
                          @php
                          $cek_file_3 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '3');
                          $file_3 = $cek_file_3->count();
                          @endphp
                          @if($file_3 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_3->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_3 >= 1)
                          @php                          
                          $file_3_id = $cek_file_3->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_3_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-3">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Tangkapan Layar Follow Instagram</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="3">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>SCREENSHOOT FOLLOW <a href="https://www.tiktok.com/@smkn1garut_official?_t=ZS-8xKTIgiOdNa&_r=1" target="_blank">Tiktok</a></td>
                        <td>
                          @php
                          $cek_file_4 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '4');
                          $file_4 = $cek_file_4->count();
                          @endphp
                          @if($file_4 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_4->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_4 >= 1)
                          @php                          
                          $file_4_id = $cek_file_4->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_4_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-4">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Tangkapan Layar Follow Tiktok</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="4">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>SCREENSHOOT SUBSCRIBE <a href="https://youtube.com/@smkn1garuttv?si=FWC92h08W58zwLkC" target="_blank">Youtube</a></td>
                        <td>
                          @php
                          $cek_file_5 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '5');
                          $file_5 = $cek_file_5->count();
                          @endphp
                          @if($file_5 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_5->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_5 >= 1)
                          @php                          
                          $file_5_id = $cek_file_5->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_5_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-5">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Tangkapan Layar Subscribe Youtube</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="5">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>PAS PHOTO LATAR BELAKANG MERAH (MENGGUNAKAN SERAGAM SMP)</td>
                        <td>
                          @php
                          $cek_file_6 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '6');
                          $file_6 = $cek_file_6->count();
                          @endphp
                          @if($file_6 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_6->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_6 >= 1)
                          @php                          
                          $file_6_id = $cek_file_6->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_6_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-6">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Foto</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="6">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        *pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>SURAT PERNYATAAN DITANDA TANGAN DI ATAS MATERAI </td>
                        <td>
                          @php
                          $cek_file_7 = App\Models\File::where('user_id', auth()->user()->id)->where('jenis_file', '7');
                          $file_7 = $cek_file_7->count();
                          @endphp
                          @if($file_7 >= 1)
                          @php $upload++; @endphp
                            <a href="{{ url('storage/'.$cek_file_7->first()->file) }}" class="badge bg-primary">Lihat Berkas</a>
                          @else
                            <span class="badge bg-warning">Belum Diunggah</span>
                          @endif
                        </td>
                        <td>
                          <!-- Button trigger for basic modal -->
                          @if($file_7 >= 1)
                          @php                          
                          $file_7_id = $cek_file_7->first()->id;
                          @endphp
                            <a href="{{ url('/pendaftar/create?act=hapus&id='.$file_7_id) }}" class="btn btn-outline-danger block" onclick="return confirm('Yakin Akan Menghapus Berkas')">
                            Hapus
                            </a>
                          @else
                            <button type="button" class="btn btn-outline-primary block" data-toggle="modal" data-target="#persyaratan-7">
                            Unggah
                            </button>
                          @endif

                            <!--Basic Modal -->
                            <div class="modal fade text-left" id="persyaratan-7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                            aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel1">Unggah Surat Pernyataan</h5>
                                            <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form class="form form-horizontal" method="POST" action={{ url('/pendaftar') }} enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="inputGroupFileAddon01"><i data-feather="upload"></i></span>
                                                        <div class="form-file">
                                                            <input type="hidden" name="jenis_file" value="7">
                                                            <input type="file" class="form-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                                                            <label class="form-file-label" for="inputGroupFile01">
                                                                <span class="form-file-text">Pilih Berkas...</span>
                                                                <span class="form-file-button">Jelajahi</span>
                                                            </label>                                                    
                                                          </div>
                                                        </div>
                                                        <a href="{{ url('assets/files/') }}/SURAT PERNYATAAN KESIAPAN ORANGTUA SISWA BARU.pdf" target="_blank">Unduh Format</a>
                                                        <br>*pdf/gambar max (2 MB)
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                              <i class="bx bx-check d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Unggah</span>
                                            </button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>                
                  @if ($upload == 7)
                  @php
                    $prodi = App\Models\Wag::where('program_keahlian', $diterimadi['1'])->first()->wag;
                  @endphp
                  <div><a href="{{ $prodi }}" target="_blank" class="badge bg-success float">Masuk Ke Grup WA</a></div>
                  @endif
              </div>
            </div>
          </div>
        </div>
        <!-- Contextual classes end -->
        
      </div> 

</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-left">
                        <p>2025 &copy; SMKN 1 GARUT</p>
                    </div>
                    <div class="float-right">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by PPLG</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ url('/') }}/assets/js/feather-icons/feather.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ url('/') }}/assets/js/app.js"></script>
    
    <script src="{{ url('/') }}/assets/js/main.js"></script>
</body>
</html>
