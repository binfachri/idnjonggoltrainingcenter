<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <!-- bootsrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
 
    <?php
        require 'koneksi.php';
 
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           
            $id_kelas = $_GET['id'];
 
            $sql = "SELECT * FROM tb_kelas WHERE id_kelas = $id_kelas";
 
            $ambil_data = $koneksi->query($sql);
            // jika berhasil menjalankan query
            if ($ambil_data) {
                // cek apakah data ada
                if ($ambil_data->num_rows > 0) {
                    // masukkan data ke dalam variable data
                    $data = $ambil_data->fetch_assoc();
                } else {
                    echo "Data tidak ditemukan";
                    die();
                }
               
            } else {
                echo "Gagal menjalankan query. Error :" . $koneksi->error;
            }
           
        }
       
    ?>
 
 <div class="container">
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?= $data['id_kelas'] ?>">
        <table>

           <div class="form-group row">
           	<label class="col-1 col-form-label">Nama kelas</label> 
           	<div class="col-10">
           		<input class="form-control form-control-sm" type="text" name="kelas" value="<?= $data['nama_kelas'] ?>" placeholder="Nama kelas">
           	</div>
           </div>
            
            
           <div class="form-group row">
           	<label class="col-1 col-form-label">Keterangan kelas</label>
           	<div class="col-10">
           		<textarea class="form-control form-control-sm" name="keterangan" cols="30" rows="10" placeholder="Keterangan siswa" required><?= $data['keterangan_kelas'] ?></textarea>
           	</div>   
           </div>
               
               
            <input class="btn btn-primary" type="submit" name="SIMPAN" required>
            <a class="btn btn-success" href="tampilkelas.php"  >LIHAT DATA</a>
               
               
                
            
        </table>
    </form>
 </div>
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<!-- bootstrap script -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
 
<?php
    // jika dapat request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
        // cek data apakah sudah didefinisikan atau belum
        if (!isset($_POST['kelas']) && !isset($_POST['keterangan'])) {
 
            echo "Data belum didefinisikan";   
        }
        // cek apakah data kosong
        if (empty($_POST['kelas']) && empty($_POST['keterangan'])) {
 
            echo "Lengkapi data";
        } else {
           
            // data untuk disimpan
            $kelas    = $_POST['kelas'];
            $keterangan  = $_POST['keterangan'];
            $idkelas = $_POST['id'];
          
        }
 
        $sql = "UPDATE tb_kelas SET nama_kelas = '".$kelas."', keterangan_kelas = '".$keterangan."' WHERE id_kelas = '".$idkelas."'";
 
        echo ($koneksi->query($sql) === TRUE) ? header("location:tampilkelas.php") : "Gagal memperbarui data. Error message : " . $koneksi->error;
 
        $koneksi->close();
    }
 
?>