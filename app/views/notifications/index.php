<?php
$page_title = 'Notifications';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Notifications</h4>
    <form method="POST" action="<?= APP_URL ?>/notifications/mark-all-read" class="d-inline">
        <?= Helper::csrfField() ?>
        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-check-all me-1"></i> Mark All as Read</button>
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($notifications)): ?>
        <div class="text-center py-5">
            <i class="bi bi-bell-slash text-muted" style="font-size: 3rem;"></i>
            <p class="text-muted mt-2 mb-0">No notifications</p>
        </div>
        <?php else: ?>
        <div class="list-group list-group-flush">
            <?php foreach ($notifications as $notif): ?>
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 <?= !$notif->is_read ? 'fw-bold bg-light' : '' ?>">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <?php if (!$notif->is_read): ?>
                        <span class="badge bg-primary rounded-pill" style="width: 10px; height: 10px; display: inline-block;">&nbsp;</span>
                        <?php else: ?>
                        <span class="badge bg-light rounded-pill" style="width: 10px; height: 10px; display: inline-block;">&nbsp;</span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="mb-0"><?= $notif->title ?></p>
                        <small class="text-muted"><?= $notif->message ?></small>
                        <br>
                        <small class="text-muted"><i class="bi bi-clock me-1"></i><?= Helper::timeAgo($notif->created_at) ?></small>
                    </div>
                </div>
                <div>
                    <?php if (!$notif->is_read): ?>
                    <form method="POST" action="<?= APP_URL ?>/notifications/read/<?= $notif->id ?>" class="d-inline">
                        <?= Helper::csrfField() ?>
                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-check"></i></button>
                    </form>
                    <?php endif; ?>
                    <form method="POST" action="<?= APP_URL ?>/notifications/delete/<?= $notif->id ?>" class="d-inline">
                        <?= Helper::csrfField() ?>
                        <button type="submit" class="btn btn-sm btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
