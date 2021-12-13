<?php

namespace Libs\Database;

use PDOException;

class UserTable
{
    private $db = null;

    function __construct(MySQL $db)
    {
        $this->db = $db->connect();
    }

    function insert($data)
    {
        try {
            $query = "INSERT INTO users (
                     name, email, phone, address, password, role_id, created_at ) 
                     VALUES (
                     :name, :email, :phone, :address, :password, :role_id, NOW() )";

            $stmt = $this->db->prepare($query);
            $stmt->execute($data);

            echo "<br>" . $this->db->lastInsertId();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function getAll()
    {
        try {
            $query = "SELECT users.*, roles.name AS role, roles.value 
            FROM users LEFT JOIN roles 
            ON users.role_id = roles.id";

            $stmt = $this->db->query($query);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function findByEmailAndPassword($email, $password)
    {
        $query = "SELECT users.*, roles.value, roles.name AS role 
            FROM users LEFT JOIN roles
            ON users.role_id = roles.id
            WHERE email = :email 
            AND password = :password";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "email" => $email,
            "password" => $password
        ]);

        $row = $stmt->fetch();

        return $row ?? false;
    }

    function updatePhoto($id, $name)
    {
        $query = "UPDATE users SET photo = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "name" => $name,
            "id" => $id
        ]);

        return $stmt->rowCount();
    }

    function suspend($id)
    {
        $query = "UPDATE users SET suspended = 1, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "id" => $id
        ]);

        return $stmt->rowCount();
    }

    function unsuspend($id)
    {
        $query = "UPDATE users SET suspended = 0, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            "id" => $id
        ]);

        return $stmt->rowCount();
    }

    function changeRole($id, $role_id)
    {
        $query = "UPDATE users SET role_id = :role_id, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            "id" => $id,
            "role_id" => $role_id
        ]);

        return $stmt->rowCount();
    }

    function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->execute([
            "id" => $id
        ]);

        return $stmt->rowCount();
    }
}
