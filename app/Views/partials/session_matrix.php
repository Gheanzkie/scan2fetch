<?php
/**
 * SHARED SESSION MATRIX PARTIAL
 *
 * One table used by parents / staff / teachers / admin dashboards (and
 * anywhere else a per-student morning/afternoon status strip is needed).
 *
 * Expects (passed via $data to $this->include('partials/session_matrix', [...])):
 *   $matrixRows  array  each: ['student_id','student_name','grade_section',
 *                              'released_sessions' => ['morning'=>time,'afternoon'=>time]]
 *   $matrixTitle string optional card title
 *   $matrixDate  string optional date shown in title
 */
$matrixRows  = $matrixRows ?? [];
$matrixTitle = $matrixTitle ?? 'Session Status';
$matrixDate  = $matrixDate ?? date('Y-m-d');
?>
<div class="card session-strip" style="margin-bottom: 1.2rem;">
 <div class="card-header d-flex justify-content-between align-items-center">
  <h5 class="mb-0">
    <i class="fas fa-calendar-check mr-2" style="color: var(--soft-blue);"></i>
    <?= esc($matrixTitle) ?>
    <span class="badge badge-soft ml-2"><?= esc($matrixDate) ?></span>
  </h5>
  <div style="font-size:12px; color: var(--muted);">
    <i class="fas fa-check-circle" style="color: var(--soft-green);"></i> Released
    &nbsp;
    <strong style="color: var(--soft-rose);">X</strong> Not fetched
  </div>
 </div>
 <div class="card-body pt-2 pb-2">
  <div class="table-responsive">
   <table class="table table-sm table-hover mb-0">
    <thead>
     <tr>
      <th style="width:50px;">#</th>
      <th>Student</th>
      <th>Grade</th>
      <th class="text-center" style="width:90px;">MORNING</th>
      <th class="text-center" style="width:90px;">AFTERNOON</th>
     </tr>
    </thead>
    <tbody>
    <?php if (!empty($matrixRows)): $mi = 1; foreach ($matrixRows as $mr): $rs = $mr['released_sessions'] ?? []; ?>
     <tr>
      <td class="num" style="color: var(--faint); font-weight:700;"><?= $mi++ ?></td>
      <td style="font-weight:600;"><?= esc($mr['student_name'] ?? '') ?></td>
      <td><span class="badge badge-soft"><?= esc($mr['grade_section'] ?? '—') ?></span></td>
      <td class="text-center">
      <?php if (isset($rs['morning'])): ?>
        <i class="fas fa-check-circle" style="color: var(--soft-green); font-size:17px;" title="Released: <?= esc($rs['morning']) ?>"></i>
      <?php else: ?>
        <strong style="color: var(--soft-rose); font-size:17px;">X</strong>
      <?php endif; ?>
      </td>
      <td class="text-center">
      <?php if (isset($rs['afternoon'])): ?>
        <i class="fas fa-check-circle" style="color: var(--soft-green); font-size:17px;" title="Released: <?= esc($rs['afternoon']) ?>"></i>
      <?php else: ?>
        <strong style="color: var(--soft-rose); font-size:17px;">X</strong>
      <?php endif; ?>
      </td>
     </tr>
    <?php endforeach; else: ?>
     <tr>
      <td colspan="5" class="text-center py-4" style="color: var(--faint);">
        <i class="fas fa-users fa-2x mb-2 d-block" style="opacity:.3;"></i>
        No students to display.
      </td>
     </tr>
    <?php endif; ?>
    </tbody>
   </table>
  </div>
 </div>
</div>
