<?php

namespace App\Models;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Model;
use Config\Database;

class HomeModel extends Model
{
    /**
     * @var BaseConnection $connection DB コネクション。
     */
    private BaseConnection $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = Database::connect();
    }

    public function getSessionCount(): int
    {
        return $this->connection->table('ci_sessions')->countAll();
    }
}
