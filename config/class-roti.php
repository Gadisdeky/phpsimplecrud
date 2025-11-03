<?php 

include_once 'db-config.php';

class roti extends Database {

    // Input data roti
    public function inputroti($data){
        $kode     = $data['kode'] ?? '';
        $nama     = $data['nama_varian_roti'] ?? '';
        $toping   = $data['toping_roti'] ?? '';
        $jumlah   = $data['jumlah_box_roti'] ?? '';
        $alamat   = $data['alamat'] ?? '';
        // ✅ Pastikan Provinsi integer
        $provinsi = isset($data['provinsi']) && is_numeric($data['provinsi']) ? (int)$data['provinsi'] : 0;
        $email    = $data['email'] ?? '';
        $telp     = $data['telp'] ?? '';
        // ✅ Pastikan Status_Pesanan integer
        $status   = isset($data['status_pesanan']) && is_numeric($data['status_pesanan']) ? (int)$data['status_pesanan'] : 0;

        $query = "INSERT INTO tb_roti 
                  (Kode_roti, Nama_Varian_roti, Toping_roti, Jumlah_box_roti, Alamat, Provinsi, Email, Telp, Status_pesanan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssssssiss", $kode, $nama, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // Get semua data roti
    public function getAllroti(){
        $query = "SELECT * FROM tb_roti";
        $result = $this->conn->query($query);

        $roti = [];
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $roti[] = $row;
            }
        }
        return $roti;
    }

    // Get data roti berdasarkan ID
    public function getUpdateroti($id){
        $query = "SELECT * FROM tb_roti WHERE id_roti = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = ($result->num_rows > 0) ? $result->fetch_assoc() : false;
        $stmt->close();
        return $data;
    }

    // Edit roti
    public function editroti($data){
        $id       = $data['id'];
        $kode     = $data['kode'];
        $nama     = $data['nama_varian_roti'];
        $toping   = $data['toping_roti'];
        $jumlah   = $data['jumlah_box_roti'];
        $alamat   = $data['alamat'];
        // ✅ Pastikan Provinsi integer
        $provinsi = isset($data['provinsi']) && is_numeric($data['provinsi']) ? (int)$data['provinsi'] : 0;
        $email    = $data['email'];
        $telp     = $data['telp'];
        // ✅ Pastikan Status_Pesanan integer
        $status   = isset($data['status_pesanan']) && is_numeric($data['status_pesanan']) ? (int)$data['status_pesanan'] : 0;

        $query = "UPDATE tb_roti 
                  SET Kode_roti = ?, Nama_Varian_roti = ?, Toping_roti = ?, Jumlah_box_roti = ?, Alamat = ?, Provinsi = ?, Email = ?, Telp = ?, Status_pesanan = ?
                  WHERE id_roti = ?";

        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssssssissi", $kode, $nama, $toping, $jumlah, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Delete roti
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

}
?>
