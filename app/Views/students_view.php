<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-user-graduate mr-2"></i>Student Details</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= base_url('students') ?>">Students</a></li><li class="breadcrumb-item active">Details</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('msg')): ?><div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div><?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>

            <div class="row">
                <!-- Student Profile -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div style="width:130px;height:130px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #667eea;cursor:pointer;" onclick="openImageViewer('<?= !empty($student['picture']) ? base_url('uploads/students/' . $student['picture']) : '' ?>', '<?= esc($student['fname'] . ' ' . $student['lname']) ?>')">
                                <?php if (!empty($student['picture'])): ?><img src="<?= base_url('uploads/students/' . $student['picture']) ?>" style="width:100%;height:100%;object-fit:cover;"><?php else: ?><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;"><i class="fas fa-child fa-3x text-muted"></i></div><?php endif; ?>
                            </div>
                            <h3 class="mt-3 mb-0"><?= esc($student['fname']) ?> <?= esc($student['lname']) ?></h3>
                            <p class="text-muted mb-0"><?= esc($student['grade_section']) ?></p>
                            <p class="text-muted small"><i class="fas fa-calendar mr-1"></i> <?= date('M d, Y', strtotime($student['created_at'])) ?></p>
                            <div class="mt-3">
                                <a href="<?= base_url('students-edit/' . $student['id']) ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="<?= base_url('students-delete/' . $student['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parents & Sub-Fetchers (View Only) -->
                <div class="col-md-8">
                    
                    <!-- Main Parent -->
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-user-check mr-2 text-primary"></i>Main Parent / Guardian</h6>
                            <a href="<?= base_url('parents') ?>" class="btn btn-outline-secondary btn-xs"><i class="fas fa-external-link-alt"></i> Manage Parents</a>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($parents)): ?>
                                <?php foreach($parents as $p): ?>
                                <div class="d-flex align-items-center border rounded p-3 mb-2">
                                    <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($p['picture']) ? base_url('uploads/parents/' . $p['picture']) : '' ?>', '<?= esc($p['fname'] . ' ' . $p['lname']) ?>')">
                                        <?php if(!empty($p['picture'])): ?><img src="<?= base_url('uploads/parents/' . $p['picture']) ?>" class="img-circle" style="width:55px;height:55px;object-fit:cover;border:3px solid #667eea;"><?php else: ?><div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:55px;height:55px;border:3px solid #667eea;"><i class="fas fa-user text-muted"></i></div><?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <strong><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong>
                                        <br><small class="text-muted"><?= esc($p['relation'] ?? 'Parent') ?> | <?= esc($p['phone']) ?></small>
                                    </div>
                                    <?php if(!empty($p['qr_code'])): ?><img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:50px;height:50px;border:2px solid #667eea;border-radius:4px;cursor:pointer;margin-right:5px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>')"><?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted small py-3 mb-0">No parent linked yet</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Sub-Fetchers -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-user-friends mr-2 text-success"></i>Sub-Fetchers (<?= count($subFetchers ?? []) ?>)</h6>
                            <a href="<?= base_url('parents') ?>" class="btn btn-outline-secondary btn-xs"><i class="fas fa-external-link-alt"></i> Manage Fetchers</a>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($subFetchers)): ?>
                                <?php foreach($subFetchers as $f): ?>
                                <div class="d-flex align-items-center border rounded p-3 mb-2" style="border-left: 3px solid #28a745;">
                                    <div class="mr-3" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($f['picture']) ? base_url('uploads/parents/' . $f['picture']) : '' ?>', '<?= esc($f['fname'] . ' ' . $f['lname']) ?>')">
                                        <?php if(!empty($f['picture'])): ?><img src="<?= base_url('uploads/parents/' . $f['picture']) ?>" class="img-circle" style="width:50px;height:50px;object-fit:cover;border:2px solid #28a745;"><?php else: ?><div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:50px;height:50px;border:2px solid #28a745;"><i class="fas fa-user text-muted"></i></div><?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <strong><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong>
                                        <br><small class="text-muted">Fetcher | <?= esc($f['phone']) ?></small>
                                    </div>
                                    <?php if(!empty($f['qr_code'])): ?><img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" style="width:45px;height:45px;border:2px solid #28a745;border-radius:4px;cursor:pointer;margin-right:5px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>')"><?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted small py-3 mb-0">No sub-fetchers assigned</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- QR Modal --><div class="modal fade" id="qrModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-qrcode mr-2"></i>QR Code</h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white"><img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>
<!-- Image Viewer --><div class="modal fade" id="imageViewerModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<style>.img-circle{border-radius:50%}.btn-xs{padding:4px 8px;font-size:12px;border-radius:6px}.card{border-radius:10px}</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openImageViewer(u,t){if(!u)return;$('#imageViewerFull').attr('src',u);$('#imageDownloadBtn').attr('href',u);$('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');$('#imageViewerTitle').text(t||'Photo');$('#imageViewerModal').modal('show')}
function openQrModal(u){$('#qrFullImage').attr('src',u);$('#qrDownloadBtn').attr('href',u);$('#qrModal').modal('show')}
</script>
<?= $this->endSection() ?>