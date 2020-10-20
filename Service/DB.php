<?php
namespace Localhost\Service;

class DB
{
    protected \PDO $connect;

    public function __construct()
    {
        $this->connect = new \PDO('mysql:dbname=insta;host=localhost:3306', 'root', 'root');
    }

    public function executeAll($sql, $options = [])
    {
        $statement = $this->connect->prepare($sql);
        $statement->execute($options);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute($sql, $options = [])
    {
        $statement = $this->connect->prepare($sql);
        $statement->execute($options);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert($sql, $values = [])
    {
        $statement = $this->connect->prepare($sql);
        $statement->execute($values);
    }

    public function select($sql)
    {
        $statement = $this->connect->query($sql);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectOne($sql, $options)
    {
        $statement = $this->connect->prepare($sql);
        $statement->execute($options);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($sql, $options = [])
    {
        $statement = $this->connect->prepare($sql);
        $statement->execute($options);
    }
}