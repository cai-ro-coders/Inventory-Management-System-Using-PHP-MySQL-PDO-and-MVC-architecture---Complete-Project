<?php
class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all() {
        return $this->db->fetchAll("SELECT * FROM {$this->table} ORDER BY id DESC");
    }

    public function find($id) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?", [$id]);
    }

    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $params = array_values($data);
        $this->db->query("INSERT INTO {$this->table} ({$columns}) VALUES ({$values})", $params);
        return $this->db->getConnection()->lastInsertId();
    }

    public function update($id, $data) {
        $sets = implode(' = ?, ', array_keys($data)) . ' = ?';
        $params = array_values($data);
        $params[] = $id;
        return $this->db->query("UPDATE {$this->table} SET {$sets} WHERE {$this->primaryKey} = ?", $params);
    }

    public function delete($id) {
        return $this->db->query("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?", [$id]);
    }

    public function count() {
        return $this->db->count("SELECT COUNT(*) FROM {$this->table}");
    }

    public function where($column, $value) {
        return $this->db->fetchAll("SELECT * FROM {$this->table} WHERE {$column} = ?", [$value]);
    }

    public function whereFirst($column, $value) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE {$column} = ? LIMIT 1", [$value]);
    }

    public function paginate($page = 1, $limit = 10, $search = '', $searchFields = []) {
        $offset = ($page - 1) * $limit;
        $where = '';
        $params = [];
        if ($search && !empty($searchFields)) {
            $conditions = [];
            foreach ($searchFields as $field) {
                $conditions[] = "$field LIKE ?";
                $params[] = "%$search%";
            }
            $where = "WHERE " . implode(' OR ', $conditions);
        }
        $total = $this->db->count("SELECT COUNT(*) FROM {$this->table} {$where}", $params);
        $data = $this->db->fetchAll("SELECT * FROM {$this->table} {$where} ORDER BY id DESC LIMIT $limit OFFSET $offset", $params);
        $pagination = Helper::paginate($total, $page, $limit, '');
        return compact('data', 'pagination');
    }
}
