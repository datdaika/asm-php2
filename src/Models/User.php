<?php 

namespace Admin\asm\Models;

use Admin\asm\Commons\Model;

class User extends Model
{
    protected string $tableName = 'users';

    public function findByEmail($email)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAssociative();
    }

    public function create($data)
    {
        // Xây dựng truy vấn INSERT
        $query = $this->queryBuilder
            ->insert($this->tableName)
            ->values([
                'name' => '?',
                'email' => '?',
                'password' => '?'
            ]);

        // Thực thi truy vấn với các tham số tương ứng
        return $query->setParameter(0, $data['name'])
            ->setParameter(1, $data['email'])
            ->setParameter(2, $data['password'])
            ->executeStatement();
    }
}