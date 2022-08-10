<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-Modal-Ajax</title>
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- sweet alert -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 

</head>

<body>
    <div class="container p-3 ">
        <!-- header -->
        <div class="row text-center mt-3">
            <div class="col">
                <h1>
                    Belajar CRUD-Modal-Ajax
                </h1>
            </div>
        </div>

        <!-- data hewan  -->
        <div id="DataHewan">
        </div>

    </div>

    <!-- Modal Popup untuk Tambah Data -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-tambah">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Hewan</label>
                            <input type="text" class="form-control" id="hewan" name="hewan" placeholder="Nama Hewan" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Jenis Hewan</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                <option value="">Pilih Jenis Hewan</option>
                                <option value="Karnivora">Karnivora</option>
                                <option value="Herbivora">Herbiovora</option>
                                <option value="Omnivora">Omnivora</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Popup untuk Edit Data -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-edit">
                    <div class="modal-body">
                        <div id="data-edit">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Popup untuk Hapus Data -->
    <div class="modal fade" id="ModalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form-delete">
                    <div class="modal-body">
                        <input type="hidden" name="idHewan" id="idHewan">
                        Yakin Hapus Data ?
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success" name="submit">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- cdn bootsrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            //menampilkan data hewan
            var dataHewan = "data_hewan.php";
            $('#DataHewan').load(dataHewan);

            //melakukan penambahan data
            $('#form-tambah').submit(function(e) {
                e.preventDefault();
                var dataform = $("#form-tambah").serialize();
                $.ajax({
                    url: "api/tambah.php",
                    type: "POST",
                    data: dataform,
                    success: function(result) {
                        var obj = JSON.parse(result);
                        if (obj.nilai === 1) {
                            Swal.fire(obj.error);
                            $("#form-tambah").trigger("reset");
                            $('#ModalAdd').modal('hide');
                            $('#DataHewan').load(dataHewan);
                        } else {
                            Swal.fire(obj.error);
                        }
                    }
                })
            })

            //menampilkan data yang akan diedit
            $(document).on('click', '#edit', function(e) {
                e.preventDefault();
                $("#ModalEdit").modal('show');
                $.post('edit_data.php', {
                        id: $(this).attr('data-id')
                    },
                    function(html) {
                        $("#data-edit").html(html);
                    }
                );
            });

            //melakukan update data yang diedit
            $("#form-edit").submit(function(e) {
                e.preventDefault();
                var dataform = $("#form-edit").serialize();
                $.ajax({
                    url: "api/update.php",
                    type: "POST",
                    data: dataform,
                    success: function(result) {
                        var obj = JSON.parse(result);
                        if (obj.nilai === 1) {
                            Swal.fire(obj.error);
                            $('#ModalEdit').modal('hide');
                            $('#DataHewan').load(dataHewan);
                        } else {
                            Swal.fire(obj.error);
                        }
                    }
                });
            });

            //menampilkan konfirmasi data yang akan dihapus
            $(document).on('click', '.open-ModalHapus', function() {
                var idHewan = $(this).attr('data-id');
                $(".modal-body #idHewan").val( idHewan );
            });

            //melakukan penghapusan data
            $('#form-delete').submit(function(e) {
                e.preventDefault();
                var dataform = $("#form-delete").serialize();
                $.ajax({
                    url: "api/delete.php",
                    type: "POST",
                    data: dataform,
                    success: function(result) {
                        var obj = JSON.parse(result);
                        if (obj.nilai === 1) {
                            Swal.fire(obj.error);
                            $('#ModalHapus').modal('hide');
                            $('#DataHewan').load(dataHewan);
                        } else {
                            Swal.fire(obj.error);
                        }
                    }
                })
            })

        })
    </script>
</body>

</html>