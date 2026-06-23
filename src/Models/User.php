<?php

namespace Models;

class User
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(
        string $name,
        string $email,
        string $password
    ): int {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $row = $this->db->fetch(

            "INSERT INTO users
            (
                name,
                email,
                password,
                created_at
            )

            VALUES
            (
                :name,
                :email,
                :password,
                NOW()
            )

            RETURNING id",

            [

                'name'=>$name,

                'email'=>strtolower(trim($email)),

                'password'=>$hash

            ]

        );

        return (int)($row['id'] ?? 0);
    }

    public function find(int $id)
    {
        return $this->db->fetch(

            "SELECT *

            FROM users

            WHERE id=:id",

            [

                'id'=>$id

            ]

        );
    }

    public function findByEmail(string $email)
    {
        return $this->db->fetch(

            "SELECT *

            FROM users

            WHERE email=:email",

            [

                'email'=>strtolower(trim($email))

            ]

        );
    }

    public function all(): array
    {
        return $this->db->fetchAll(

            "SELECT

            id,
            name,
            email,
            created_at

            FROM users

            ORDER BY id DESC"

        );
    }

    public function update(
        int $id,
        string $name,
        string $email
    ): bool {

        return $this->db->execute(

            "UPDATE users

            SET

            name=:name,

            email=:email

            WHERE id=:id",

            [

                'id'=>$id,

                'name'=>$name,

                'email'=>$email

            ]

        )>0;
    }

    public function delete(int $id): bool
    {
        return $this->db->execute(

            "DELETE FROM users

            WHERE id=:id",

            [

                'id'=>$id

            ]

        )>0;
    }
}
