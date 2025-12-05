<?php
/**
 * OrderModel.php
 * Semua operasi CRUD order + filtering + summary dashboard.
 */

class OrderModel
{
    private $db;
    private $table = "orders";

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Buat order baru, return insert_id
     */
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
            (user_id, product_code, target_number, price_cost, price_selling, status, digiflazz_ref, tokoku_ref, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $data['user_id'],
            $data['product_code'],
            $data['target_number'],
            $data['price_cost'],
            $data['price_selling'],
            $data['status'],
            $data['digiflazz_ref'],
            $data['tokoku_ref']
        ]);

        return $this->db->lastInsertId();
    }

    /**
     * Cari order berdasarkan ref_id dari Digiflazz
     */
    public function findByRefId($refId)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table}
            WHERE digiflazz_ref = ?
            LIMIT 1
        ");
        $stmt->execute([$refId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil list order user (search + filter + pagination)
     */
    public function list($userId, $search = null, $status = null, $startDate = null, $endDate = null, $limit = 10, $offset = 0)
    {
        $where = ["user_id = :uid"];
        $params = ['uid' => $userId];

        if ($search) {
            $where[] = "(product_code LIKE :s OR target_number LIKE :s)";
            $params['s'] = "%{$search}%";
        }

        if ($status) {
            $where[] = "status = :st";
            $params['st'] = $status;
        }

        if ($startDate && $endDate) {
            $where[] = "DATE(created_at) BETWEEN :sd AND :ed";
            $params['sd'] = $startDate;
            $params['ed'] = $endDate;
        }

        $whereSQL = implode(" AND ", $where);

        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE $whereSQL
            ORDER BY id DESC
            LIMIT $limit OFFSET $offset
        ");
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Detail order, validasi pemilik
     */
    public function detail($userId, $orderId)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM {$this->table}
            WHERE id = ? AND user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$orderId, $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update status order
     */
    public function updateStatusAtomic($orderId, $newStatus)
{
    $stmt = $this->db->prepare("
        UPDATE {$this->table}
        SET status = ?, updated_at = NOW()
        WHERE id = ?
        AND (
            (status = 'pending')
            OR (status = 'failed' AND ? = 'success')
        )
    ");

    $stmt->execute([$newStatus, $orderId, $newStatus]);

    return $stmt->rowCount(); // 1 = updated, 0 = blocked
}
    /**
     * Simpan reference Tokoku
     */
    public function updateTokokuRef($orderId, $ref)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET tokoku_ref = ?, updated_at = NOW()
            WHERE id = ?
        ");
        return $stmt->execute([$ref, $orderId]);
    }

    /**
     * Simpan ref Digiflazz setelah generate (opsional)
     */
    public function updateDigiflazzRef($orderId, $ref)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET digiflazz_ref = ?, updated_at = NOW()
            WHERE id = ?
        ");
        return $stmt->execute([$ref, $orderId]);
    }

    /**
     * Dashboard summary: total, sukses, pending, gagal
     */
    public function countSummary($userId)
    {
        $result = [
            'total' => 0,
            'success' => 0,
            'failed' => 0,
            'pending' => 0
        ];

        foreach (['success', 'failed', 'pending'] as $st) {
            $stmt = $this->db->prepare("
                SELECT COUNT(*)
                FROM {$this->table}
                WHERE user_id = ? AND status = ?
            ");
            $stmt->execute([$userId, $st]);
            $result[$st] = $stmt->fetchColumn();
        }

        $stmt = $this->db->prepare("
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        $result['total'] = $stmt->fetchColumn();

        return $result;
    }
}
