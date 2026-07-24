<?php
$page_title = 'My Profile';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">My Profile</h4>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body p-4">
                <img src="<?= APP_URL ?>/assets/uploads/<?= $user->avatar ?: 'default.png' ?>" class="rounded-circle border mb-3" width="120" height="120" style="object-fit: cover;">
                <h5 class="fw-bold mb-1"><?= $user->first_name . ' ' . $user->last_name ?></h5>
                <p class="text-muted mb-0"><?= $user->role_name ?? 'User' ?></p>
                <span class="badge bg-success"><?= ucfirst($user->status) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#profileInfo">Profile Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword">Change Password</a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profileInfo">
                        <form method="POST" action="<?= APP_URL ?>/profile/update" enctype="multipart/form-data">
                            <?= Helper::csrfField() ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" value="<?= $user->first_name ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control" value="<?= $user->last_name ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" class="form-control" value="<?= $user->username ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="<?= $user->email ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="<?= $user->phone ?? '' ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="2"><?= $user->address ?? '' ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" name="avatar" class="form-control" accept="image/*">
                                    <small class="text-muted">Allowed: jpg, png, gif. Max 2MB.</small>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Update Profile</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="changePassword">
                        <form method="POST" action="<?= APP_URL ?>/profile/change-password">
                            <?= Helper::csrfField() ?>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
