<?php
    require_once "api/koneksi.php";

    $id = $_REQUEST['id'];

    $result = mysqli_query($conn, "SELECT * FROM tb_hewan WHERE id='$id'");
    while ($data = mysqli_fetch_assoc($result)) {
?>

    <form method="post" id="form-edit">
        <input type="hidden" name="id" id="id" readonly value="<?php echo $data['id']; ?>" />
        <div class="form-group" style="padding-bottom: 20px;">
            <label for="nama">Nama Hewan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $data['nama_hewan']; ?>" required />
        </div>
        <div class="form-group" style="padding-bottom: 20px;">
            <label for="jenis">Jenis Hewan</label>
            <select class="form-select" id="jenis" name="jenis" required>
                <option value="Karnivora" <?php if($data['jenis_hewan']=="Karnivora") {echo "selected"; } ?>>Karnivora</option>
                <option value="Herbivora" <?php if($data['jenis_hewan']=="Herbivora") {echo "selected"; } ?>>Herbiovora</option>
                <option value="Omnivora" <?php if($data['jenis_hewan']=="Omnivora") {echo "selected"; } ?>>Omnivora</option>
            </select>
        </div>
    </form>

<?php
    }
?>