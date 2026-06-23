<?php

namespace Controllers;

use Models\Cycle;
use Models\Log;
use Helpers\Auth;
use Helpers\Response;
use Helpers\Flash;
use Models\Database;

class CycleController
{
    private ?Cycle $cycle = null;
    private ?Log $log = null;

    public function __construct($db)
    {
        if ($db instanceof Database) {
            $this->cycle = new Cycle($db);
            $this->log = new Log($db);
        }
    }

    private function cycle(): Cycle
    {
        if ($this->cycle === null) {
            $this->cycle = new Cycle(Database::instance());
        }

        return $this->cycle;
    }

    private function log(): Log
    {
        if ($this->log === null) {
            $this->log = new Log(Database::instance());
        }

        return $this->log;
    }

    public function dashboard()
    {
        Auth::requireLogin();

        $userId = Auth::id();

        $cycles = $this->cycle()->all($userId);

        $latest = $this->cycle()->latest($userId);

        // Ambil SEMUA log milik user (lintas siklus), bukan hanya siklus terbaru
        $logs = $this->log()->forUser($userId);

        require __DIR__ . '/../Views/dashboard.php';
    }

    public function insights()
    {
        Auth::requireLogin();

        $userId = Auth::id();

        $logs = $this->log()->forUser($userId);

        require __DIR__ . '/../Views/insights.php';
    }

    public function store()
    {
        Auth::requireLogin();

        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);

        $startDate = $_POST['start_date'] ?? date('Y-m-d');

        // Durasi siklus wajar: 21-45 hari, default 28
        $cycleLength = (int) ($_POST['cycle_length'] ?? 28);
        if ($cycleLength < 21)
            $cycleLength = 21;
        if ($cycleLength > 45)
            $cycleLength = 45;

        // Durasi menstruasi wajar: 2-10 hari, default 5
        $periodLength = (int) ($_POST['period_length'] ?? 5);
        if ($periodLength < 2)
            $periodLength = 5; // jaga-jaga kalau terkirim 0/kosong
        if ($periodLength > 10)
            $periodLength = 10;

        // Durasi menstruasi tidak boleh lebih panjang dari durasi siklus
        if ($periodLength >= $cycleLength) {
            $periodLength = max(2, intdiv($cycleLength, 4));
        }

        $id = $this->cycle()->create(
            Auth::id(),
            $startDate,
            $cycleLength,
            $periodLength
        );

        if ($isAjax) {
            Response::json([
                'status' => 'ok',
                'message' => 'Data siklus berhasil disimpan.',
                'day_number' => 1,
                'cycle' => [
                    'id' => $id,
                    'start_date' => $startDate,
                    'cycle_length' => $cycleLength,
                    'period_length' => $periodLength
                ]
            ], 201);
        }

        Flash::success("Data siklus berhasil disimpan.");

        Response::redirect('/dashboard');
    }

    public function storeLog()
    {
        Auth::requireLogin();

        $userId = Auth::id();
        $date = $_POST['date'] ?? date('Y-m-d');

        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);

        $existingCount = $this->log()->countForUserDate($userId, $date);

        // Maksimal 2 log per hari
        if ($existingCount >= 2) {
            $msg = "Batas harian tercapai. Maksimal 2 log menstruasi per hari.";

            if ($isAjax) {
                Response::json([
                    'status' => 'error',
                    'message' => $msg
                ], 422);
            }

            Flash::error($msg);
            Response::redirect('/dashboard');
        }

        $symptoms = $_POST['symptoms'] ?? [];

        if (!is_array($symptoms)) {
            $symptoms = [];
        }

        $id = $this->log()->create(
            (int) $_POST['cycle_id'],
            $date,
            $_POST['mood'],
            $symptoms,
            $_POST['notes'] ?? '',
            (int) ($_POST['energy'] ?? 3)
        );

        $dayNumber = $existingCount + 1; // urutan simpan hari ini: 1 atau 2

        if ($isAjax) {
            Response::json([
                'status' => 'ok',
                'message' => 'Log berhasil ditambahkan.',
                'day_number' => $dayNumber,
                'log' => [
                    'id' => $id,
                    'cycle_id' => (int) $_POST['cycle_id'],
                    'date' => $date,
                    'mood' => $_POST['mood'],
                    'symptoms' => $symptoms,
                    'notes' => $_POST['notes'] ?? '',
                    'energy' => (int) ($_POST['energy'] ?? 3)
                ]
            ], 201);
        }

        Flash::success("Log berhasil ditambahkan. (Menstruasi Day {$dayNumber})");

        Response::redirect('/dashboard');
    }
    public function deleteCycle()
    {
        Auth::requireLogin();

        $this->cycle()->delete(
            (int) $_POST['id']
        );

        Flash::success("Siklus berhasil dihapus.");

        Response::redirect('/dashboard');
    }

    public function deleteLog()
    {
        Auth::requireLogin();

        $this->log()->delete(
            (int) $_POST['id']
        );

        Flash::success("Log berhasil dihapus.");

        Response::redirect('/dashboard');
    }
}