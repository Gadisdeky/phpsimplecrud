<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class roti extends Database {

    // Method untuk input data roti
    public function inputroti($data){
        // Mengambil data dari parameter $data
        $kode     = $data['kode'];
        $nama     = $data['nama_varian_roti'];
        $varian   = $data['varian_roti'];
        $toping   = $data['toping_roti'];
        $jumlah   = $data['jumlah_box_roti'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status_pesanan'];

        // Menyiapkan query SQL untuk insert data
        $query = "INSERT INTO tb_roti 
                  (kode_roti, nama_varian_roti, varian_roti, toping_roti, jumlah_box_roti, alamat, provinsi, email, telp, status_pesanan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return false;
        }

        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssss", $kode, $nama, $varian, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Method untuk mengambil semua data roti
    public function getAllroti(){
        $query = "SELECT r.id_roti, r.kode_roti, r.nama_varian_roti, r.toping_roti, r.jumlah_box_roti, 
                         r.alamat, r.email, r.telp, r.status_pesanan, p.nama_provinsi
                  FROM tb_roti r
                  JOIN tb_provinsi p ON r.provinsi = p.id_provinsi";
        $result = $this->conn->query($query);

        $roti = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $roti[] = [
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

        return $roti;
    }

    // Method untuk mengambil data roti berdasarkan ID
    public function getUpdateroti($id){
        $query = "SELECT * FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
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
                'status' => $row['status_pesanan']
            ];
        }
        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data roti
    public function editroti($data){
        $id       = $data['id'];
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $varian   = $data['varian'];
        $toping   = $data['toping'];
        $jumlah   = $data['jumlah'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        $query = "UPDATE tb_roti 
                  SET kode_roti = ?, nama_varian_roti = ?, varian_roti = ?, toping_roti = ?, 
                      jumlah_box_roti = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_pesanan = ? 
                  WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssssssssssi", $kode, $nama, $varian, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data roti
    public function deleteroti($id){
        $query = "DELETE FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mencari data roti berdasarkan kata kunci
    public function searchroti($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT r.id_roti, r.kode_roti, r.nama_varian_roti, r.varian_roti, r.toping_roti, 
                         r.jumlah_box_roti, p.nama_provinsi, r.alamat, r.email, r.telp, r.status_pesanan
                  FROM tb_roti r
                  JOIN tb_provinsi p ON r.provinsi = p.id_provinsi
                  WHERE r.kode_roti LIKE ? OR r.nama_varian_roti LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return [];
        }
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $roti = [];

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $roti[] = [
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
        return $roti;
    }

}

?>
