<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class roti extends Database {

    // Method untuk input data mahasiswa
    public function inputroti($data){
        // Mengambil data dari parameter $data
        $kode     = $data['kode'];
        $Nama     = $data['nama varian roti'];
        $varian   = $data['varian roti'];
        $toping   = $data['topi roti'];
        $jumlah   = $data['jumlah box roti'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status pesanan'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_mahasiswa (kode_roti, nama_varian_roti, varian_roti, jumlah_box_roti, alamat, provinsi, email, telp, status_mhs) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $kode, $nama, $varian, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllMahasiswa(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT id_mhs, nim_mhs, nama_mhs, nama_prodi, nama_provinsi, alamat, email, telp, status_mhs 
                  FROM tb_mahasiswa
                  JOIN tb_prodi ON prodi_mhs = kode_prodi
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $mahasiswa = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $mahasiswa[] = [
                    'id' => $row['id_roti'],
                    'kode' => $row['kode_roti'],
                    'nama' => $row['nama_varian_roti'],
                    'toping' => $row['toping_roti'],
                    'prodi' => $row['jumlah_box_roti'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_pesanan']
                ];
            }
        }
        // Mengembalikan array data mahasiswa
        return $mahasiswa;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateroti($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_mahasiswa WHERE id_mhs = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_roti'],
                'kode' => $row['kode_roti'],
                'nama' => $row['nama_varian_roti'],
                'varian' => $row['varian_roti'],
                'toping' => $row['toping_roti'],
                'jumlah' => $row['jumlah_box_roti'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['provinsi'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_mhs']
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editroti($data){
        // Mengambil data dari parameter $data
        $id      = $data['id'];
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $varian   = $data['varian'];
        $toping  = $data['toping'];
        $jumlah   = $data['jumlah'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_roti SET kode_roti = ?, nama_varian_roti = ?, varian_roti = ?,  toping_roti = ?,  jumlah_box_roti = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_mhs = ? WHERE id_mhs = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi", $kode, $nama, $varian,  $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
    public function deleteroti($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchroti($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_roti, kode_roti, nama_varian_roti, varian_roti, nama_toping_roti, jumlah_box_roti, nama_provinsi, alamat, email, telp, status_pesanan
                  FROM tb_roti
                  JOIN tb_prodi ON prodi_mhs = kode_roti
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE kode_roti LIKE ? OR nama_varian_roti LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $mahasiswa = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $mahasiswa[] = [
                    'id' => $row['id_roti'],
                    'kode' => $row['kode_roti'],
                    'nama' => $row['nama_varian_roti'],
                    'toping' => $row['toping_roti'],
                    'jumlah' => $row['jumlah_box_roti'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_pesanan']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $mahasiswa;
    }

}

?>