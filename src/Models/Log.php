<?php

namespace Models;

class Log
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db=$db;
    }

    public function create(

        int $cycleId,

        string $date,

        string $mood,

        array $symptoms,

        string $notes,

        int $energy

    ): int {

        $this->db->execute(

            "INSERT INTO logs
            (
                cycle_id,
                log_date,
                mood,
                symptoms,
                notes,
                energy,
                created_at
            )

            VALUES
            (
                :cycle,
                :date,
                :mood,
                :symptoms,
                :notes,
                :energy,
                NOW()
            )",

            [

                'cycle'=>$cycleId,

                'date'=>$date,

                'mood'=>$mood,

                'symptoms'=>json_encode($symptoms),

                'notes'=>$notes,

                'energy'=>$energy

            ]

        );

        return (int)$this->db->lastInsertId();
    }

    public function forCycle(int $cycleId): array
    {
        $logs=$this->db->fetchAll(

            "SELECT

            id,

            cycle_id,

            log_date AS date,

            mood,

            symptoms,

            notes,

            energy

            FROM logs

            WHERE cycle_id=:cycle

            ORDER BY log_date DESC",

            [

                'cycle'=>$cycleId

            ]

        );

        foreach($logs as &$log){

            $log['symptoms']=json_decode(
                $log['symptoms'] ?? '[]',
                true
            );

        }

        return $logs;
    }

    public function forUser(int $userId): array
    {
        $logs=$this->db->fetchAll(

            "SELECT

            logs.id,

            logs.cycle_id,

            logs.log_date AS date,

            logs.mood,

            logs.symptoms,

            logs.notes,

            logs.energy

            FROM logs

            INNER JOIN cycles ON cycles.id = logs.cycle_id

            WHERE cycles.user_id=:user

            ORDER BY logs.log_date DESC",

            [

                'user'=>$userId

            ]

        );

        foreach($logs as &$log){

            $log['symptoms']=json_decode(
                $log['symptoms'] ?? '[]',
                true
            );

        }

        return $logs;
    }

    public function delete(int $id): bool
    {
        return $this->db->execute(

            "DELETE FROM logs

            WHERE id=:id",

            [

                'id'=>$id

            ]

        )>0;
    }
}