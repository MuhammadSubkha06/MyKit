<?php ob_start(); ?>

<div style="background:linear-gradient(170deg,#FFF5F8 0%,#F8F0FF 60%,var(--bg) 100%);padding:2.5rem 0 0">
<div class="container-lg">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <div style="font-size:0.78rem;color:var(--muted);font-weight:500;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:4px">
                <i class="bi bi-graph-up me-1"></i>Analitik Personal
            </div>
            <h2 style="font-size:1.6rem;font-weight:700;color:var(--txt);margin:0">Insights & Analisis</h2>
            <p style="font-size:0.875rem;color:var(--txt2);margin:4px 0 0">Temukan pola dan tren dalam siklus kesehatanmu.</p>
        </div>
        <a href="/dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-speedometer2 me-1"></i>Dashboard
        </a>
    </div>
</div>
</div>

<div class="container-lg py-4">

    <?php
    // Aggregate data
    $counts = [];
    $moodCount = ['Buruk'=>0,'Biasa'=>0,'Sangat Baik'=>0];
    $totalEnergy = 0; $energyCount = 0;
    foreach ($logs as $l) {
        foreach ($l['symptoms'] ?? [] as $s) { $counts[$s] = ($counts[$s] ?? 0) + 1; }
        if (isset($moodCount[$l['mood']])) $moodCount[$l['mood']]++;
        if (!empty($l['energy'])) { $totalEnergy += intval($l['energy']); $energyCount++; }
    }
    arsort($counts);
    $avgEnergy = $energyCount > 0 ? round($totalEnergy/$energyCount, 1) : 0;
    $totalLogs = count($logs);
    $topMood = $totalLogs > 0 ? array_search(max($moodCount), $moodCount) : '-';
    ?>

    <!-- Summary Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card text-center py-3">
                <div style="font-size:2rem;font-weight:700;color:var(--pk)"><?php echo $totalLogs; ?></div>
                <div style="font-size:0.78rem;color:var(--muted)">Total Log</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center py-3">
                <div style="font-size:2rem;font-weight:700;color:var(--pu)"><?php echo $avgEnergy; ?></div>
                <div style="font-size:0.78rem;color:var(--muted)">Energi Rata-rata</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center py-3">
                <div style="font-size:1.4rem;font-weight:700;color:var(--te)"><?php echo $topMood; ?></div>
                <div style="font-size:0.78rem;color:var(--muted)">Mood Terbanyak</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center py-3">
                <div style="font-size:2rem;font-weight:700;color:var(--am)"><?php echo count($counts); ?></div>
                <div style="font-size:0.78rem;color:var(--muted)">Jenis Gejala</div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <!-- Symptoms -->
        <div class="col-md-6">
            <div class="insight-card card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-activity" style="color:var(--pk)"></i>
                    Gejala Paling Sering
                </div>
                <div class="card-body">
                    <?php if (!$counts): ?>
                    <div class="text-center py-4" style="color:var(--muted)">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>
                        Tidak ada data gejala.
                    </div>
                    <?php else:
                        $maxCount = max($counts);
                        foreach ($counts as $sym => $c):
                        $pct = round(($c/$maxCount)*100);
                    ?>
                    <div class="symptom-bar-wrap">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:0.85rem;color:var(--txt2)"><?php echo htmlspecialchars($sym); ?></span>
                            <span style="font-size:0.8rem;font-weight:600;color:var(--pk)"><?php echo $c; ?>×</span>
                        </div>
                        <div class="symptom-bar">
                            <div class="symptom-bar-fill" style="width:<?php echo $pct; ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>

        <!-- Mood Distribution -->
        <div class="col-md-6">
            <div class="insight-card card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="bi bi-emoji-smile" style="color:var(--pu)"></i>
                    Distribusi Mood
                </div>
                <div class="card-body">
                    <?php if ($totalLogs === 0): ?>
                    <div class="text-center py-4" style="color:var(--muted)">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:0.5rem"></i>
                        Tidak ada data.
                    </div>
                    <?php else: ?>
                    <canvas id="moodChart" height="200"></canvas>
                    <div class="d-flex justify-content-center gap-4 mt-3" style="font-size:0.78rem;color:var(--txt2)">
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#DC2626;margin-right:4px"></span>Buruk (<?php echo $moodCount['Buruk']; ?>)</span>
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#D97706;margin-right:4px"></span>Biasa (<?php echo $moodCount['Biasa']; ?>)</span>
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#16A34A;margin-right:4px"></span>Baik (<?php echo $moodCount['Sangat Baik']; ?>)</span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Mood & Energy Trend Table -->
        <div class="col-12">
            <div class="insight-card card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-table" style="color:var(--te)"></i>
                        Tren Mood & Energi (10 entri terakhir)
                    </div>
                    <span style="font-size:0.75rem;color:var(--muted)"><?php echo $totalLogs; ?> total log</span>
                </div>
                <div class="card-body p-0">
                    <?php if ($logs): ?>
                    <div class="table-responsive">
                        <table class="table mb-0" style="font-size:0.875rem">
                            <thead style="background:var(--pk5)">
                                <tr>
                                    <th style="font-size:0.78rem;font-weight:600;color:var(--muted);border:none;padding:0.75rem 1.25rem">Tanggal</th>
                                    <th style="font-size:0.78rem;font-weight:600;color:var(--muted);border:none">Mood</th>
                                    <th style="font-size:0.78rem;font-weight:600;color:var(--muted);border:none">Energi</th>
                                    <th style="font-size:0.78rem;font-weight:600;color:var(--muted);border:none">Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach (array_slice($logs, 0, 10) as $l):
                                $moodC = $l['mood']==='Sangat Baik'?'good':($l['mood']==='Buruk'?'bad':'');
                            ?>
                                <tr style="border-bottom:0.5px solid var(--border2)">
                                    <td style="padding:0.75rem 1.25rem;color:var(--txt2);font-size:0.82rem"><?php echo $l['date']; ?></td>
                                    <td><span class="mood-badge <?php echo $moodC; ?>"><?php echo htmlspecialchars($l['mood']); ?></span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:60px;height:6px;background:var(--pk4);border-radius:4px;overflow:hidden">
                                                <div style="width:<?php echo (intval($l['energy'])/5)*100; ?>%;height:100%;background:var(--pk);border-radius:4px"></div>
                                            </div>
                                            <span style="font-size:0.8rem;font-weight:600;color:var(--pk)"><?php echo $l['energy']; ?>/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php foreach(array_slice($l['symptoms']??[],0,3) as $s): ?>
                                        <span class="symptom-tag"><?php echo htmlspecialchars($s); ?></span>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-5" style="color:var(--muted)">
                        <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:0.75rem"></i>
                        <p style="margin:0">Belum ada data log.</p>
                        <a href="/dashboard" class="btn btn-primary btn-sm mt-3">Mulai Mencatat</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function(){
    const ctx = document.getElementById('moodChart');
    if (!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Buruk', 'Biasa', 'Sangat Baik'],
            datasets: [{
                data: [<?php echo $moodCount['Buruk']; ?>, <?php echo $moodCount['Biasa']; ?>, <?php echo $moodCount['Sangat Baik']; ?>],
                backgroundColor: ['#FCA5A5','#FCD34D','#86EFAC'],
                borderColor: ['#DC2626','#D97706','#16A34A'],
                borderWidth: 2,
                hoverOffset: 6
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            cutout: '65%'
        }
    });
})();
</script>

<?php $content = ob_get_clean(); require __DIR__ . '/layout.php'; ?>