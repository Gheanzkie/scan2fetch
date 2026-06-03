<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-file-signature mr-2"></i>Authorization Letter</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Authorization</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>

            <div class="row">
                <!-- Send Authorization -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header"><h5><i class="fas fa-pen mr-2"></i>Send Authorization</h5></div>
                        <div class="card-body">
                            <form action="<?= base_url('authorization-send') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                
                                <div class="form-group">
                                    <label>Student</label>
                                    <select name="student_id" class="form-control" required>
                                        <option value="">Select Child</option>
                                        <?php foreach ($myChildren ?? [] as $child): ?>
                                            <option value="<?= $child['id'] ?>"><?= esc($child['fname']) ?> <?= esc($child['lname']) ?> (<?= esc($child['grade_section']) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-4"><label>First Name</label><input type="text" name="fetcher_fname" class="form-control" required></div>
                                    <div class="col-4"><label>Middle Name</label><input type="text" name="fetcher_mname" class="form-control"></div>
                                    <div class="col-4"><label>Last Name</label><input type="text" name="fetcher_lname" class="form-control" required></div>
                                </div>

                                <div class="form-group"><label>Fetcher Phone</label><input type="text" name="fetcher_phone" class="form-control"></div>

                                <!-- Fetcher Picture -->
                                <div class="form-group text-center">
                                    <label>Fetcher Picture</label>
                                    <div id="fetcherPhotoPreview" style="width:130px;height:130px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:4px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-user fa-3x text-muted"></i>
                                    </div>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-secondary open-camera-btn"><i class="fas fa-camera mr-1"></i> Take Photo</button>
                                        <label class="btn btn-outline-secondary mb-0" style="cursor:pointer;">
                                            <i class="fas fa-upload mr-1"></i> Upload
                                            <input type="file" name="fetcher_picture" id="pictureInput" class="d-none" accept="image/*">
                                        </label>
                                    </div>
                                    <input type="hidden" name="fetcher_picture_capture" id="pictureCapture">
                                </div>

                                <div class="form-group">
                                    <label>Relation</label>
                                    <select name="relation" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Aunt">Aunt</option><option value="Uncle">Uncle</option>
                                        <option value="Grandparent">Grandparent</option><option value="Sibling">Sibling</option>
                                        <option value="Guardian">Guardian</option><option value="Other">Other</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-secondary btn-sm px-4"><i class="fas fa-paper-plane mr-1"></i> Send</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- My Authorizations -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header"><h5><i class="fas fa-history mr-2"></i>My Authorizations</h5></div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-sm mb-0">
                                <thead class="bg-light"><tr class="small"><th>Student</th><th>Fetcher</th><th>Status</th><th>Date</th></tr></thead>
                                <tbody>
                                    <?php if (!empty($myAuthorizations)): ?>
                                        <?php foreach ($myAuthorizations as $a): ?>
                                        <tr>
                                            <td><?= esc($a['sfname'] ?? '—') ?> <?= esc($a['slname'] ?? '') ?></td>
                                            <td><?= esc($a['fetcher_fname']) ?> <?= esc($a['fetcher_lname']) ?></td>
                                            <td><span class="badge badge-<?= ($a['status'] ?? '') == 'approved' ? 'success' : (($a['status'] ?? '') == 'released' ? 'info' : (($a['status'] ?? '') == 'declined' ? 'danger' : 'warning')) ?>"><?= ucfirst($a['status'] ?? '—') ?></span></td>
                                            <td class="small"><?= date('M d', strtotime($a['created_at'])) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center text-muted py-3">No authorizations</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Camera Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow"><div class="modal-header border-0 pb-0"><h6><i class="fas fa-camera mr-2"></i>Take Photo</h6><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body text-center p-2"><video id="cameraVideo" autoplay playsinline style="width:100%;max-height:350px;border-radius:8px;background:#000;"></video><canvas id="cameraCanvas" style="display:none;"></canvas><button type="button" class="btn btn-primary btn-sm mt-2" id="captureBtn"><i class="fas fa-camera"></i> Capture</button></div></div></div></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){var s;
$('#pictureInput').on('change',function(){var f=this.files[0];if(f){var r=new FileReader();r.onload=function(e){$('#fetcherPhotoPreview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">')};r.readAsDataURL(f)}});
$('.open-camera-btn').click(function(){$('#cameraModal').modal('show');setTimeout(function(){navigator.mediaDevices.getUserMedia({video:{facingMode:"user",width:400,height:400}}).then(function(st){s=st;$('#cameraVideo')[0].srcObject=s}).catch(function(e){alert('Camera error: '+e.message)})},500)});
$('#captureBtn').click(function(){var v=$('#cameraVideo')[0],c=$('#cameraCanvas')[0];c.width=v.videoWidth||400;c.height=v.videoHeight||400;c.getContext('2d').drawImage(v,0,0);var d=c.toDataURL('image/png');$('#fetcherPhotoPreview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');$('#pictureCapture').val(d);if(s){s.getTracks().forEach(function(t){t.stop()})}$('#cameraModal').modal('hide')});
$('#cameraModal').on('hidden.bs.modal',function(){if(s){s.getTracks().forEach(function(t){t.stop()})}})});
</script>
<?= $this->endSection() ?>