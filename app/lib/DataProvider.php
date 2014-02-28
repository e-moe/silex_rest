<?php
namespace lib;

class DataProvider
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    private $dbName = 'address';

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }

    public function getAllAddresses()
    {
        $sql = "SELECT * FROM `$this->dbName`";
        $data = $this->db->fetchAll($sql);
        return is_array($data) ? $data : array();
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getAddress($id)
    {
        $sql = "SELECT * FROM `$this->dbName` WHERE `id` = ?";
        $data = $this->db->fetchAssoc($sql, array($id));
        return is_array($data) ? $data : null;
    }

    /**
     * @param array $data
     * @return int|null
     */
    public function addAddress(array $data)
    {
        $inserted = $this->db->insert($this->dbName, $data);
        if ($inserted) {
            return $this->db->lastInsertId();
        }
        return null;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateAddress($id, array $data)
    {
        return (bool) $this->db->update($this->dbName, $data, array('id' => $id));
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeAddress($id)
    {
        return (bool)$this->db->delete($this->dbName, array('id' => $id));
    }
}
