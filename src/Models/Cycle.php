<?php

namespace Models;

class Cycle
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db=$db;
    }

    public function create(
        int $userId,
        string $startDate,
        int $cycleLength,
        int $periodLength
    ): int {

        $this->db->execute(

            "INSERT INTO cycles
            (
                user_id,
                start_date,
                cycle_length,
                period_length,
                created_at
            )

            VALUES
            (
                :user,
                :start,
                :cycle,
                :period,
                NOW()
            )",

            [

                'user'=>$userId,

                'start'=>$startDate,

                'cycle'=>$cycleLength,

                'period'=>$periodLength

            ]

        );

        return (int)$this->db->lastInsertId();
    }

    public function all(int $userId): array
    {
        return $this->db->fetchAll(

            "SELECT *

            FROM cycles

            WHERE user_id=:user

            ORDER BY start_date DESC",

            [

                'user'=>$userId

            ]

        );
    }

    public function latest(int $userId)
    {
        return $this->db->fetch(

            "SELECT *

            FROM cycles

            WHERE user_id=:user

            ORDER BY start_date DESC

            LIMIT 1",

            [

                'user'=>$userId

            ]

        );
    }

    public function find(int $id)
    {
        return $this->db->fetch(

            "SELECT *

            FROM cycles

            WHERE id=:id",

            [

                'id'=>$id

            ]

        );
    }

    public function delete(int $id): bool
    {
        return $this->db->execute(

            "DELETE FROM cycles

            WHERE id=:id",

            [

                'id'=>$id

            ]

        )>0;
    }
}