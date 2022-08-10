<div class="card mt-5 mb-3">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-target="#ModalAdd" data-bs-toggle="modal"> Tambah Data</button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hewan</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "api/koneksi.php";

                $i = 0;
                $result = mysqli_query($conn, "SELECT * FROM tb_hewan");

                if (mysqli_num_rows($result) != 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        $i++;
                ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $data['nama_hewan']; ?></td>
                            <td><?php echo $data['jenis_hewan']; ?></td>
                            <td>
                                <a href="#" id="edit" data-id="<?php echo $data['id']; ?>" class="btn btn-success">Edit</a>
                                <a href="#ModalHapus" data-id="<?php echo $data['id']; ?>" class="open-ModalHapus btn btn-danger" data-bs-toggle="modal">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-center"><i>Tidak Ada Data</i></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>