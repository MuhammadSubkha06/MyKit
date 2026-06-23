<?php ob_start();
$userName = htmlspecialchars((new \Models\User($GLOBALS['app']->db()))->find($_SESSION['user_id'])['name'] ?? 'User');
?>

<style>
    /* ===== Dashboard Enhancement Layer ===== */
    .dash-greeting-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        background: linear-gradient(135deg, #fde2f3, #ede4fb);
        color: #be185d;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
    }

    .stat-card.dash-stat {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }
    .stat-card.dash-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(232, 49, 106, 0.12);
    }
    .stat-card.dash-stat .icon-wrap {
        transition: transform 0.22s ease;
    }
    .stat-card.dash-stat:hover .icon-wrap {
        transform: scale(1.1) rotate(-4deg);
    }

    .card.dash-card {
        border-radius: var(--radius-lg, 18px);
        transition: box-shadow 0.25s ease;
    }
    .card.dash-card:hover {
        box-shadow: 0 16px 34px rgba(124, 58, 237, 0.08);
    }

    /* Calendar polish */
    .calendar .cal-day {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .calendar .cal-day:not(.empty):hover {
        transform: scale(1.08);
        box-shadow: 0 4px 10px rgba(232, 49, 106, 0.18);
        z-index: 2;
    }
    .calendar .cal-day.today {
        box-shadow: 0 0 0 2px var(--pk);
    }

    /* Log items */
    .log-item {
        border-radius: 14px;
        padding: 0.85rem 1rem;
        margin-bottom: 0.6rem;
        background: #fff;
        border: 1px solid var(--border2);
        transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    }
    .log-item:hover {
        transform: translateX(3px);
        box-shadow: 0 8px 18px rgba(232, 49, 106, 0.10);
        border-color: rgba(232, 49, 106, 0.2);
    }
    .log-item:last-child { margin-bottom: 0; }

    /* Mood picker polish */
    .mood-pick-option {
        transition: transform 0.15s ease, background 0.15s ease, border-color 0.15s ease;
    }
    .mood-pick-option:hover {
        transform: translateY(-2px);
    }

    /* Progress bar shimmer */
    @keyframes shimmerMove {
        0% { background-position: -200px 0; }
        100% { background-position: 200px 0; }
    }
    .progress-shimmer {
        background-image: linear-gradient(90deg, var(--pk), var(--pu), var(--pk));
        background-size: 200px 100%;
        animation: shimmerMove 3s linear infinite;
    }

    /* Cycle stat box */
    .cycle-stat-box {
        transition: box-shadow 0.2s ease;
    }
    .cycle-stat-box:hover {
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.08);
    }

    .btn-primary.submit-glow {
        background: linear-gradient(135deg, var(--pk), var(--pu));
        border: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary.submit-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(232, 49, 106, 0.28);
    }

    .chart-legend span i {
        display: inline-block;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        margin-right: 4px;
    }
</style>

<div style="background:linear-gradient(170deg,#FFF5F8 0%,#F8F0FF 60%,var(--bg) 100%);padding:2.5rem 0 0">
    <div class="container-lg">

        <!-- ===== Header ===== -->
        <div class="d-flex align-items-start justify-content-between mb-4">
            <div>
                <span class="dash-greeting-badge"><i class="bi bi-calendar3"></i> <?php echo date('l, d F Y'); ?></span>
                <h2 style="font-size:1.6rem;font-weight:700;color:var(--txt);margin:0.5rem 0 0">Halo, <?php echo $userName; ?> 👋
                </h2>
                <p style="font-size:0.875rem;color:var(--txt2);margin:4px 0 0">Berikut ringkasan siklus dan aktivitas
                    kamu hari ini.</p>
            </div>
            <a class="btn btn-outline-secondary btn-sm" href="/insights">
                <i class="bi bi-bar-chart me-1"></i>Lihat Insights
            </a>
        </div>

        <!-- ===== 3 Stat Cards ===== -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card dash-stat d-flex align-items-center gap-3">
                    <div class="icon-wrap" style="background:var(--pk4)">
                        <i class="bi bi-calendar-check" style="color:var(--pk);font-size:1.25rem"></i>
                    </div>
                    <div>
                        <div class="label">Perkiraan Menstruasi Berikutnya</div>
                        <?php if ($latest):
                            $s = new DateTime($latest['start_date']);
                            $nextDate = (clone $s)->modify('+1 month');
                            $next = $nextDate->format('d M Y');
                            $daysLeft = ceil((strtotime($nextDate->format('Y-m-d')) - strtotime(date('Y-m-d'))) / 86400);
                            ?>
                            <div class="value"><?php echo $next; ?></div>
                            <div style="font-size:0.72rem;color:var(--pk);font-weight:600">
                                <?php echo $daysLeft > 0 ? $daysLeft . ' hari lagi' : 'Sekarang!'; ?>
                            </div>
                        <?php else: ?>
                            <div class="value" style="font-size:1rem;color:var(--muted)">Belum ada data</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card dash-stat d-flex align-items-center gap-3">
                    <div class="icon-wrap" style="background:var(--pu4)">
                        <i class="bi bi-arrow-repeat" style="color:var(--pu);font-size:1.25rem"></i>
                    </div>
                    <div>
                        <div class="label">Durasi Siklus</div>
                        <div class="value"><?php echo $latest['cycle_length'] ?? '-'; ?> <span
                                style="font-size:0.9rem;font-weight:400;color:var(--muted)">hari</span></div>
                        <div style="font-size:0.72rem;color:var(--muted)">Rata-rata normal: 21–35 hari</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card dash-stat d-flex align-items-center gap-3">
                    <div class="icon-wrap" style="background:var(--te4)">
                        <i class="bi bi-droplet-half" style="color:var(--te);font-size:1.25rem"></i>
                    </div>
                    <div>
                        <div class="label">Durasi Menstruasi</div>
                        <div class="value"><?php echo $latest['period_length'] ?? '-'; ?> <span
                                style="font-size:0.9rem;font-weight:400;color:var(--muted)">hari</span></div>
                        <div style="font-size:0.72rem;color:var(--muted)">Rata-rata normal: 3–7 hari</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-lg py-4">
    <div class="row g-4">

        <!-- ===== Left Column ===== -->
        <div class="col-lg-7">

            <!-- Calendar Card -->
            <div class="card dash-card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="font-weight:700;font-size:1rem;margin:0">
                        <i class="bi bi-calendar3 me-2" style="color:var(--pk)"></i>Kalender <?php echo date('F Y'); ?>
                    </h5>
                    <div style="display:flex;gap:10px;font-size:0.68rem;flex-wrap:wrap">
                        <span><span
                                style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#C2185B;margin-right:4px"></span>Deras</span>
                        <span><span
                                style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--pk);margin-right:4px"></span>Sedang</span>
                        <span><span
                                style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--pk2);margin-right:4px"></span>Ringan</span>
                    </div>
                </div>

                <!-- Day headers -->
                <div class="calendar mb-2">
                    <?php foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $d): ?>
                        <div class="cal-header"><?php echo $d; ?></div>
                    <?php endforeach; ?>
                </div>

                <!-- Days -->
                <div class="calendar">
                    <?php
                    $today = new DateTime();
                    $first = new DateTime($today->format('Y-m-01'));
                    $startWeek = (int) $first->format('w');
                    $daysInMonth = (int) $first->format('t');
                    for ($i = 0; $i < $startWeek; $i++)
                        echo '<div class="cal-day empty"></div>';
                    for ($d = 1; $d <= $daysInMonth; $d++) {
                        $cur = (clone $first)->setDate((int) $first->format('Y'), (int) $first->format('m'), $d);
                        $cls = '';
                        if ((int) $today->format('j') === $d)
                            $cls = 'today';
                        if ($latest) {
                            $s = new DateTime($latest['start_date']);
                            $periodLen = max(intval($latest['period_length']), 1);
                            $periodEnd = (clone $s)->modify('+' . ($periodLen - 1) . ' day');
                            // Hanya tandai rentang tanggal menstruasi yang sebenarnya (1x per siklus, tidak berulang tiap minggu)
                            if ($cur >= $s && $cur <= $periodEnd) {
                                $diff = (int) $s->diff($cur)->format('%a');
                                $posRatio = $periodLen > 1 ? $diff / ($periodLen - 1) : 0;
                                if ($posRatio < 0.4) {
                                    $flowCls = 'period-day-heavy';   // awal periode, biasanya lebih deras
                                } elseif ($posRatio < 0.75) {
                                    $flowCls = 'period-day-medium';
                                } else {
                                    $flowCls = 'period-day-light';   // akhir periode, biasanya lebih ringan
                                }
                                $cls = ($cls === 'today' ? 'today ' . $flowCls : $flowCls);
                            }
                        }
                        echo '<div class="cal-day ' . $cls . '">' . $d . '</div>';
                    }
                    ?>
                </div>

                <!-- Chart -->
                <div class="mt-4" style="border-top:0.5px solid var(--border2);padding-top:1rem">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="font-size:0.82rem;font-weight:600;color:var(--txt)">Tren Mood & Energi</span>
                        <div class="chart-legend">
                            <span><i style="background:var(--pk)"></i>Mood</span>
                            <span><i style="background:var(--pu)"></i>Energi</span>
                        </div>
                    </div>
                    <canvas id="trendChart" height="100"></canvas>
                </div>
            </div>

            <!-- Recent Logs -->
            <div class="card dash-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 style="font-weight:700;font-size:1rem;margin:0">
                        <i class="bi bi-journal-text me-2" style="color:var(--pu)"></i>Log Terbaru
                    </h5>
                    <span style="font-size:0.75rem;color:var(--muted)"><?php echo count($logs ?? []); ?> entri</span>
                </div>
                <div id="recentLogs">
                    <?php if ($logs):
                        foreach (array_slice($logs, 0, 5) as $l):
                            $moodClass = $l['mood'] === 'Sangat Baik' ? 'good' : ($l['mood'] === 'Buruk' ? 'bad' : '');
                            ?>
                            <div class="log-item">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <strong style="font-size:0.85rem"><?php echo $l['date']; ?></strong>
                                        <span
                                            class="mood-badge <?php echo $moodClass; ?>"><?php echo htmlspecialchars($l['mood']); ?></span>
                                    </div>
                                    <div style="font-size:0.78rem;color:var(--muted)">
                                        Energi: <span
                                            style="color:var(--pk);font-weight:600"><?php echo $l['energy']; ?>/5</span>
                                    </div>
                                </div>
                                <?php if (!empty($l['symptoms'])): ?>
                                    <div class="mt-1">
                                        <?php foreach ($l['symptoms'] as $s): ?>
                                            <span class="symptom-tag"><?php echo htmlspecialchars($s); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($l['notes'])): ?>
                                    <p style="font-size:0.8rem;color:var(--txt2);margin:6px 0 0;font-style:italic">
                                        <?php echo htmlspecialchars($l['notes']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; else: ?>
                        <div class="text-center py-4" style="color:var(--muted)">
                            <i class="bi bi-journal" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>
                            Belum ada catatan. Mulai log hari ini!
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ===== Right Column ===== -->
        <div class="col-lg-5">

            <!-- Cycle Stats Card -->
            <div class="card dash-card p-4 mb-4">
                <h5 style="font-weight:700;font-size:1rem;margin-bottom:1rem">
                    <i class="bi bi-activity me-2" style="color:var(--te)"></i>Statistik Siklus
                </h5>
                <?php if ($latest): ?>
                    <div class="cycle-stat-box"
                        style="background:var(--pk5);border-radius:var(--radius-sm);padding:1rem;border:0.5px solid var(--border2)">
                        <div class="d-flex justify-content-between py-2 border-bottom"
                            style="border-color:var(--border2)!important">
                            <span style="font-size:0.85rem;color:var(--muted)">Mulai Siklus</span>
                            <strong
                                style="font-size:0.85rem"><?php echo date('d M Y', strtotime($latest['start_date'])); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom"
                            style="border-color:var(--border2)!important">
                            <span style="font-size:0.85rem;color:var(--muted)">Durasi Siklus</span>
                            <strong style="font-size:0.85rem;color:var(--pu)"><?php echo $latest['cycle_length']; ?>
                                hari</strong>
                        </div>
                        <div class="d-flex justify-content-between py-2">
                            <span style="font-size:0.85rem;color:var(--muted)">Durasi Menstruasi</span>
                            <strong style="font-size:0.85rem;color:var(--pk)"><?php echo $latest['period_length']; ?>
                                hari</strong>
                        </div>
                    </div>

                    <!-- Progress visual -->
                    <?php
                    $daysSinceStart = (int) (new DateTime())->diff(new DateTime($latest['start_date']))->format('%a');
                    $progress = min(100, round(($daysSinceStart / intval($latest['cycle_length'])) * 100));
                    ?>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1" style="font-size:0.78rem;color:var(--muted)">
                            <span>Hari ke-<?php echo $daysSinceStart + 1; ?> dari
                                <?php echo $latest['cycle_length']; ?></span>
                            <span><?php echo $progress; ?>%</span>
                        </div>
                        <div style="height:8px;background:var(--pk4);border-radius:8px;overflow:hidden">
                            <div class="progress-shimmer"
                                style="width:<?php echo $progress; ?>%;height:100%;border-radius:8px;transition:width 0.3s">
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-3" style="color:var(--muted)">
                        <i class="bi bi-calendar-plus" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>
                        <p style="font-size:0.875rem;margin:0">Belum ada data siklus.</p>
                        <a href="/" class="btn btn-primary btn-sm mt-2">Tambah Siklus</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Quick Log Form -->
            <div class="card dash-card p-4">
                <h5 style="font-weight:700;font-size:1rem;margin-bottom:1.25rem">
                    <i class="bi bi-plus-circle-fill me-2" style="color:var(--pk)"></i>Tambah Log Cepat
                </h5>
                <form action="/log" method="post" class="quick-log-form">
                    <input type="hidden" name="_csrf" value="<?php echo \Helpers\Csrf::token(); ?>">
                    <input type="hidden" name="cycle_id" value="<?php echo $latest['id'] ?? 0; ?>">

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input class="form-control" type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bagaimana mood-mu hari ini?</label>
                        <div class="d-flex gap-2">
                            <?php foreach (['Buruk' => '😔', 'Biasa' => '😐', 'Sangat Baik' => '😊'] as $mood => $emoji): ?>
                                <label style="flex:1;cursor:pointer">
                                    <input type="radio" name="mood" value="<?php echo $mood; ?>" class="d-none" <?php echo $mood === 'Biasa' ? 'checked' : ''; ?>>
                                    <div class="mood-pick-option text-center p-2 rounded"
                                        style="border:1.5px solid var(--border2);font-size:1.3rem;transition:all 0.15s"
                                        onclick="this.closest('.d-flex').querySelectorAll('[style]').forEach(e=>e.style.borderColor='var(--border2)');this.style.borderColor='var(--pk)';this.style.background='var(--pk4)'">
                                        <?php echo $emoji; ?>
                                        <div style="font-size:0.65rem;color:var(--muted);margin-top:2px">
                                            <?php echo $mood; ?>
                                        </div>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tingkat Energi: <span id="energyVal"
                                style="color:var(--pk);font-weight:700">3</span>/5</label>
                        <input class="form-range" type="range" name="energy" min="1" max="5" value="3"
                            oninput="document.getElementById('energyVal').textContent=this.value">
                        <div class="energy-labels">
                            <span>😴 Sangat rendah</span><span>⚡ Sangat tinggi</span>
                        </div>
                    </div>

                    <button class="btn btn-primary submit-glow w-100 py-2" style="border-radius:var(--radius);font-size:0.95rem">
                        <i class="bi bi-check2 me-2"></i>Simpan Log
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .ms-success-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: #FFE14D;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease;
    }

    .ms-success-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }

    .ms-success-card {
        background: #5B4FE8;
        width: 260px;
        border-radius: 28px;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        transform: scale(0.85);
        transition: transform 0.25s ease;
    }

    .ms-success-overlay.show .ms-success-card {
        transform: scale(1);
    }

    .ms-success-card h3 {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0 0 24px;
    }

    .ms-success-check {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #2ECC71;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .ms-success-check i {
        color: #fff;
        font-size: 2.2rem;
    }

    .ms-success-overlay p.caption {
        margin-top: 22px;
        font-size: 1.05rem;
        font-weight: 700;
        color: #2B2B2B;
    }

    .ms-success-overlay.is-error {
        background: #FFD4D4;
    }

    .ms-success-overlay.is-error .ms-success-card {
        background: #D9362E;
    }

    .ms-success-overlay.is-error .ms-success-check {
        background: #FFFFFF;
    }

    .ms-success-overlay.is-error .ms-success-check i {
        color: #D9362E;
    }

    .ms-success-overlay.is-error p.caption {
        color: #8A1F1A;
    }
</style>

<div class="ms-success-overlay" id="msSuccessOverlay">
    <div class="ms-success-card">
        <h3 id="msSuccessTitle">Menstruasi Successful</h3>
        <div class="ms-success-check" id="msSuccessIconWrap"><i class="bi bi-check-lg" id="msSuccessIcon"></i></div>
    </div>
    <p class="caption" id="msSuccessCaption">Menstruasi Day 1 Successful</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    (function () {
        const logs = <?php echo json_encode(array_slice($logs ?? [], 0, 20)); ?>;
        const labels = logs.map(l => l.date).reverse();
        const moodMap = { 'Buruk': 1, 'Biasa': 2, 'Sangat Baik': 3 };
        const moods = logs.map(l => moodMap[l.mood] || 2).reverse();
        const energy = logs.map(l => parseInt(l.energy) || 3).reverse();
        const ctx = document.getElementById('trendChart');
        if (ctx && labels.length) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        { label: 'Mood', data: moods, borderColor: '#E8316A', backgroundColor: 'rgba(232,49,106,0.06)', tension: 0.4, fill: true, pointBackgroundColor: '#E8316A', pointRadius: 4 },
                        { label: 'Energi', data: energy, borderColor: '#7C3AED', backgroundColor: 'rgba(124,58,237,0.06)', tension: 0.4, fill: true, pointBackgroundColor: '#7C3AED', pointRadius: 4 }
                    ]
                },
                options: {
                    scales: {
                        y: { beginAtZero: false, min: 0, max: 5, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 11 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 11 }, maxRotation: 45 } }
                    },
                    plugins: { legend: { display: false } },
                    elements: { line: { borderWidth: 2 } }
                }
            });
        }
    })();
</script>
<script>
    // AJAX submit for quick log form
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.quick-log-form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const data = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: data
            }).then(r => r.json()).then(res => {
                if (res && res.status === 'ok') {
                    // show temporary success message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success';
                    alert.textContent = res.message || 'Log tersimpan.';
                    form.prepend(alert);
                    setTimeout(() => alert.remove(), 2500);

                    // prepend new log to recent list
                    const recent = document.getElementById('recentLogs');
                    if (recent) {
                        const l = res.log;
                        const div = document.createElement('div');
                        div.className = 'log-item';
                        const moodClass = l.mood === 'Sangat Baik' ? 'good' : (l.mood === 'Buruk' ? 'bad' : '');
                        let symptomsHtml = '';
                        if (Array.isArray(l.symptoms) && l.symptoms.length) {
                            symptomsHtml = '<div class="mt-1">' + l.symptoms.map(s => '<span class="symptom-tag">' + escapeHtml(s) + '</span>').join(' ') + '</div>';
                        }
                        let notesHtml = l.notes ? '<p style="font-size:0.8rem;color:var(--txt2);margin:6px 0 0;font-style:italic">' + escapeHtml(l.notes) + '</p>' : '';
                        div.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="d-flex align-items-center gap-2">
                                <strong style="font-size:0.85rem">${escapeHtml(l.date)}</strong>
                                <span class="mood-badge ${moodClass}">${escapeHtml(l.mood)}</span>
                            </div>
                            <div style="font-size:0.78rem;color:var(--muted)">Energi: <span style="color:var(--pk);font-weight:600">${escapeHtml(String(l.energy))}/5</span></div>
                        </div>
                        ${symptomsHtml}
                        ${notesHtml}
                    `;
                        recent.insertBefore(div, recent.firstChild);
                        form.reset();
                        document.getElementById('energyVal').textContent = '3';
                    }

                    // Popup sukses
                    const dayNum = res.day_number || 1;
                    showMsOverlay({
                        isError: false,
                        title: 'Menstruasi Successful',
                        caption: 'Menstruasi day ' + dayNum + ' sokses',
                        icon: 'bi-check-lg'
                    });

                } else {
                    // Cek apakah ini error karena limit 2x/hari
                    const msg = (res && res.message) || 'Terjadi kesalahan.';
                    const isLimitError = msg.toLowerCase().includes('batas') || msg.toLowerCase().includes('2 kali') || msg.toLowerCase().includes('maksimal');

                    if (isLimitError) {
                        // Popup besar khusus limit harian
                        showMsOverlay({
                            isError: true,
                            title: 'Gagal Menyimpan',
                            caption: 'Menyimpan log tidak boleh melebihi 2 kali dalam 1 hari',
                            icon: 'bi-x-lg'
                        });
                    } else {
                        // Error lain tetap pakai alert kecil biasa
                        const alertEl = document.createElement('div');
                        alertEl.className = 'alert alert-danger';
                        alertEl.textContent = msg;
                        form.prepend(alertEl);
                        setTimeout(() => alertEl.remove(), 3000);
                    }
                }
            }).catch(err => {
                console.error(err);
                alert('Gagal menyimpan log. Silakan coba lagi.');
            });
        });
    });

    function showMsOverlay({ isError, title, caption, icon }) {
        const overlay = document.getElementById('msSuccessOverlay');
        const titleEl = document.getElementById('msSuccessTitle');
        const captionEl = document.getElementById('msSuccessCaption');
        const iconEl = document.getElementById('msSuccessIcon');
        if (!overlay || !titleEl || !captionEl || !iconEl) return;

        overlay.classList.toggle('is-error', !!isError);
        titleEl.textContent = title;
        captionEl.textContent = caption;
        iconEl.className = 'bi ' + icon;

        overlay.classList.add('show');
        setTimeout(() => overlay.classList.remove('show'), isError ? 2200 : 1800);
    }

    function escapeHtml(s) {
        if (!s) return '';
        return String(s).replace(/[&<>"'`]/g, function (m) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;', "`": '&#96;' }[m]; });
    }
</script>

<?php $content = ob_get_clean();
require __DIR__ . '/layout.php'; ?>