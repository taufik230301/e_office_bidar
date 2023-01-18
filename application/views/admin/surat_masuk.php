<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/components/header')?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('edit')) {?>
    <script>
    swal({
        title: "Berhasil Diedit!",
        text: "Surat Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php }?>

    <?php if ($this->session->flashdata('delete')) {?>
    <script>
    swal({
        title: "Berhasil Dihapus!",
        text: "Surat Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php }?>

    <?php if ($this->session->flashdata('input')) {?>
    <script>
    swal({
        title: "Berhasil Ditambahakan!",
        text: "Surat Berhasil Diarsipkan!",
        icon: "success"
    });
    </script>
    <?php }?>

    <?php if ($this->session->flashdata('eror')) {?>
    <script>
    swal({
        title: "Eror!",
        text: "Terjadi Kesalahan Dalam Proses data!",
        icon: "error"
    });
    </script>
    <?php }?>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?=base_url();?>assets/admin/dist/img/AdminLTELogo.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view('admin/components/navbar')?>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view('admin/components/sidebar')?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Surat Masuk</h1>
                            <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Tambah Data
                            </button>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Surat Masuk</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">


                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Surat Masuk</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Perihal</th>
                                                        <th>Nomor Surat</th>
                                                        <th>Instansi Pengirim</th>
                                                        <th>File Surat</th>
                                                        <th>File Lembar Disposisi</th>
                                                        <th>Tanggal Surat</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                $id = 0;
                                                foreach ($surat as $i)
                                                :
                                                    $id++;
                                                    $perihal = $i['perihal'];
                                                    $id_surat = $i['id_surat'];
                                                    $nomor_surat = $i['nomor_surat'];
                                                    $instansi_pengirim = $i['instansi_pengirim'];
                                                    $file_surat = $i['file_surat'];
                                                    $file_nota_dinas = $i['file_nota_dinas'];
                                                    $file_lembar_disposisi = $i['file_lembar_disposisi'];
                                                    $tanggal_surat = $i['tanggal_surat'];
                                                    $status_surat = $i['status_surat'];
                                                    $keterangan = $i['keterangan'];

                                                    ?>
                                                    <tr>
                                                        <td><?=$id?></td>
                                                        <td><?=$perihal?></td>
                                                        <td><?=$nomor_surat?></td>
                                                        <td><?=$instansi_pengirim?></td>
                                                        <td><a target="_blank" class="btn btn-primary m-2"
                                                                href="<?=base_url();?>assets/file_surat/<?=$file_surat?>">Unduh</a>
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#ubah_file_surat<?=$id?>"
                                                                class="btn btn-warning m-2">Ubah</button>
                                                        </td>
                                                        <td><a target="_blank" class="btn btn-primary m-2"
                                                                href="<?=base_url();?>assets/file_lembar_disposisi/<?=$file_lembar_disposisi?>">Unduh</a>
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#ubah_file_lembar_disposisi<?=$id?>"
                                                                class="btn btn-warning m-2">Ubah</button>
                                                        </td>
                                                        <td><?=$tanggal_surat?></td>
                                                        <td><?=$keterangan?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary m-2"
                                                                data-toggle="modal"
                                                                data-target="#edit_data_surat<?=$id?>">Edit</button>

                                                            <button type="button" class="btn btn-danger m-2"
                                                                data-toggle="modal"
                                                                data-target="#hapus_surat<?=$id?>">Hapus</button>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="hapus_surat<?=$id?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                                        Surat
                                                                        Masuk
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Anda Yakin Akan Menghapus Surat ini ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tidak</button>

                                                                    <form
                                                                        action="<?=base_url();?>Surat_Masuk/hapus_surat"
                                                                        method="POST">
                                                                        <input type="text" id="id_surat" name="id_surat"
                                                                            value="<?=$id_surat?>" hidden>
                                                                        <input type="text" class="form-control"
                                                                            id="file_surat_old" name="file_surat_old"
                                                                            value="<?=$file_surat?>" hidden>
                                                                        <input type="text" class="form-control"
                                                                            id="file_lembar_disposisi_old"
                                                                            name="file_lembar_disposisi_old"
                                                                            value="<?=$file_lembar_disposisi?>" hidden>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Ya</button>

                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="edit_data_surat<?=$id?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah
                                                                        Data
                                                                        Surat Masuk
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="<?=base_url();?>Surat_Masuk/edit_surat"
                                                                        method="post" enctype="multipart/form-data">

                                                                        <input type="text" id="id_surat" name="id_surat"
                                                                            value="<?=$id_surat?>" hidden>

                                                                        <div class="form-group">
                                                                            <label for="perihal">Perihal</label>
                                                                            <input type="text" class="form-control"
                                                                                id="perihal" name="perihal"
                                                                                value="<?=$perihal?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nomor_surat">Nomor Surat</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nomor_surat" name="nomor_surat"
                                                                                value="<?=$nomor_surat?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="instansi_pengirim">Instansi
                                                                                Pengirim</label>
                                                                            <input type="text" class="form-control"
                                                                                id="instansi_pengirim"
                                                                                name="instansi_pengirim"
                                                                                value="<?=$instansi_pengirim?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tanggal_surat">Tanggal
                                                                                Surat</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tanggal_surat" name="tanggal_surat"
                                                                                value="<?=$tanggal_surat?>">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="keterangan">Keterangan</label>
                                                                            <textarea class="form-control"
                                                                                id="keterangan" name="keterangan"
                                                                                rows="2"><?=$keterangan?></textarea>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="ubah_file_lembar_disposisi<?=$id?>"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah
                                                                        File
                                                                        Lembar Disposisi
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="<?=base_url();?>Surat_Masuk/edit_file_lembar_disposisi"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <input type="text" id="id_surat" name="id_surat"
                                                                            value="<?=$id_surat?>" hidden>
                                                                        <div class="form-group">
                                                                            <label for="file_lembar_disposisi">File
                                                                                Lembar Disposisi</label>
                                                                            <input type="file" class="form-control"
                                                                                id="file_lembar_disposisi"
                                                                                name="file_lembar_disposisi" required>
                                                                            <input type="text" class="form-control"
                                                                                id="file_lembar_disposisi_old"
                                                                                name="file_lembar_disposisi_old"
                                                                                value="<?=$file_lembar_disposisi?>"
                                                                                hidden>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="ubah_file_surat<?=$id?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Ubah
                                                                        File
                                                                        Surat
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="<?=base_url();?>Surat_Masuk/edit_file_surat"
                                                                        method="post" enctype="multipart/form-data">

                                                                        <div class="form-group">
                                                                            <label for="file_surat">File
                                                                                Surat</label>
                                                                            <input type="file" class="form-control"
                                                                                id="file_surat" name="file_surat"
                                                                                required>
                                                                            <input type="text" id="id_surat"
                                                                                name="id_surat" value="<?=$id_surat?>"
                                                                                hidden>
                                                                            <input type="text" class="form-control"
                                                                                id="file_surat_old"
                                                                                name="file_surat_old"
                                                                                value="<?=$file_surat?>" hidden>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach?>
                                                </tbody>
                                            </table>
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data
                                                                Surat Masuk
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?=base_url();?>Surat_Masuk/tambahkan_surat"
                                                                enctype="multipart/form-data" method="post">
                                                                <div class="form-group">
                                                                    <label for="perihal">Perihal</label>
                                                                    <input type="text" class="form-control" id="perihal"
                                                                        name="perihal" aria-describedby="emailHelp">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nomor_surat">Nomor
                                                                        Surat</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_surat" name="nomor_surat">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nomor_agenda">Nomor
                                                                        Agenda</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nomor_agenda" name="nomor_agenda">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_surat">Tanggal
                                                                        Surat</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tanggal_surat" name="tanggal_surat">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="instansi_pengirim">Instansi
                                                                        Pengirim</label>
                                                                    <input type="text" class="form-control"
                                                                        id="instansi_pengirim" name="instansi_pengirim">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="file_lembar_disposisi">File Lembar
                                                                        Disposisi</label>
                                                                    <input type="file" class="form-control"
                                                                        id="file_lembar_disposisi"
                                                                        name="file_lembar_disposisi">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="file_surat">File Surat</label>
                                                                    <input type="file" class="form-control"
                                                                        id="file_surat" name="file_surat">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="keterangan">Keterangan</label>
                                                                    <textarea class="form-control" id="keterangan"
                                                                        name="keterangan" rows="2"></textarea>
                                                                </div>

                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php $this->load->view('admin/components/js')?>
</body>

</html>