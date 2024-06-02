<?php
include_once 'Config/koneksi.php'; // Sertakan file koneksi

class UserModel
{
    public function __construct($koneksi)
    {
        $koneksi = new Koneksi();
        $this->koneksi = $koneksi->getKoneksi();
        $this->table = 'users';
        $this->fillable = ['nama', 'username', 'email', 'role', 'password'];
    }

    public function getByUsername($username)
    {
        // Example query to get user by username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->koneksi->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function all()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->koneksi->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $result->free();
        return $data;
    }

    public function find($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $result = $this->koneksi->query($query);
        return $result->fetch_assoc();
    }

    public function add($data)
    {
        // Filter the input data to only include fillable fields
        $filteredData = array_intersect_key($data, array_flip($this->fillable));

        // Prepare columns and values for the SQL statement
        $columns = implode(", ", array_keys($filteredData));
        $values = implode("', '", array_map([$this->koneksi, 'real_escape_string'], array_values($filteredData)));

        // Construct the SQL insert query
        $query = "INSERT INTO $this->table ($columns) VALUES ('$values')";

        // Execute the query
        if ($this->koneksi->query($query) === TRUE) {
            return $this->koneksi->insert_id;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = $id";
        $this->koneksi->query($query);
    }

    public function update($data)
    {
        $id = $data['id'];
        unset($data['id']);
        $filteredData = array_intersect_key($data, array_flip($this->fillable));
        $set = "";
        foreach ($filteredData as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE $this->table SET $set WHERE id = $id";
        $this->koneksi->query($query);

        return $this->koneksi->affected_rows;
    }
}
