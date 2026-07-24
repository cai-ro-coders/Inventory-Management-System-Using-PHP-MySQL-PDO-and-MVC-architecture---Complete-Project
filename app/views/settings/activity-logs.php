<?php
$page_title = 'Activity Logs';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Activity Logs</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Date / Time</th>
                        <th>User</th>
                        <th>Module</th>
                        <th>Action</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $log): ?>
                    <tr>
                        <td><?= date('M d, Y h:i A', strtotime($log->created_at)) ?></td>
                        <td><?= $log->user_name ?? 'System' ?></td>
                        <td><span class="badge bg-secondary"><?= $log->module ?></span></td>
                        <td><?= $log->action ?></td>
                        <td><code><?= $log->ip_address ?? '-' ?></code></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
