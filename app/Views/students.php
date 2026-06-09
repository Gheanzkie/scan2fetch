<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-user-graduate mr-2"></i>Students</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Students</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Success Message -->
            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-1"></i> <?= session()->getFlashdata('msg') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <!-- Registration Result Modal (shows after successful registration) -->
            <?php if(session()->getFlashdata('registration_success')): ?>
            <div class="modal fade" id="registrationResultModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-success text-white border-0">
                            <h4 class="mb-0"><i class="fas fa-check-circle mr-2"></i>Registration Successful!</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body px-4 py-4">
                            
                            <!-- Student Info -->
                            <div class="text-center mb-4 p-3 bg-light rounded">
                                <i class="fas fa-user-graduate fa-2x text-success mb-2"></i>
                                <h3 class="text-success mb-1"><?= session()->getFlashdata('student_name') ?></h3>
                                <p class="text-muted mb-0">has been registered successfully!</p>
                            </div>
                            
                            <?php $parents = session()->getFlashdata('registered_parents'); ?>
                            <?php if(!empty($parents)): ?>
                            <h5 class="mb-3"><i class="fas fa-users mr-2 text-primary"></i>Registered Parents / Fetchers</h5>
                            
                            <?php foreach($parents as $index => $p): ?>
                            <div class="card border mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Parent Info -->
                                        <div class="col-md-5 border-right">
                                            <h5 class="mb-1">
                                                <span class="badge badge-primary mr-2">#<?= $index + 1 ?></span>
                                                <?= esc($p['fname']) ?> <?= esc($p['lname']) ?>
                                            </h5>
                                            <p class="text-muted mb-1"><i class="fas fa-tag mr-1"></i> Relation: <strong><?= esc($p['relation']) ?></strong></p>
                                            <p class="text-muted mb-0"><i class="fas fa-qrcode mr-1"></i> QR Code: <code class="text-success"><?= esc($p['qr_code']) ?></code></p>
                                        </div>
                                        <!-- QR Code -->
                                        <div class="col-md-7 text-center">
                                            <div style="display:inline-block;border:3px solid #28a745;border-radius:12px;padding:10px;background:#fff;">
                                                <img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                     style="width:200px;height:auto;display:block;" 
                                                     alt="QR Code">
                                                <div style="background:#28a745;color:#fff;padding:5px 10px;border-radius:0 0 8px 8px;margin-top:5px;font-weight:bold;font-size:14px;">
                                                    <?= esc($p['qr_code']) ?>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" 
                                                   download="<?= esc($p['qr_code']) ?>.png" 
                                                   class="btn btn-success btn-sm">
                                                    <i class="fas fa-download mr-1"></i> Download QR
                                                </a>
                                                <button class="btn btn-outline-success btn-sm ml-1" 
                                                        onclick="openQrModal('<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>', '<?= esc($p['fname'].' '.$p['lname']) ?>')">
                                                    <i class="fas fa-search-plus mr-1"></i> View Large
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <?php $fetchers = session()->getFlashdata('registered_fetchers'); ?>
                            <?php if(!empty($fetchers)): ?>
                            <h5 class="mb-3 mt-4"><i class="fas fa-user-friends mr-2 text-warning"></i>Sub-Fetchers</h5>
                            
                            <?php foreach($fetchers as $index => $f): ?>
                            <div class="card border-warning mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <!-- Fetcher Info -->
                                        <div class="col-md-5 border-right">
                                            <h5 class="mb-1">
                                                <span class="badge badge-warning mr-2">#<?= $index + 1 ?></span>
                                                <?= esc($f['fname']) ?> <?= esc($f['lname']) ?>
                                            </h5>
                                            <p class="text-muted mb-0"><i class="fas fa-qrcode mr-1"></i> QR Code: <code class="text-warning"><?= esc($f['qr_code']) ?></code></p>
                                        </div>
                                        <!-- QR Code -->
                                        <div class="col-md-7 text-center">
                                            <div style="display:inline-block;border:3px solid #ffc107;border-radius:12px;padding:10px;background:#fff;">
                                                <img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                                     style="width:200px;height:auto;display:block;" 
                                                     alt="QR Code">
                                                <div style="background:#ffc107;color:#333;padding:5px 10px;border-radius:0 0 8px 8px;margin-top:5px;font-weight:bold;font-size:14px;">
                                                    <?= esc($f['qr_code']) ?>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" 
                                                   download="<?= esc($f['qr_code']) ?>.png" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-download mr-1"></i> Download QR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="alert alert-info mb-0 mt-3">
                                <i class="fas fa-info-circle mr-1"></i> 
                                <strong>Important:</strong> QR codes have been generated with text labels. Parents can scan the QR code or manually type the code number for student pickup.
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-1"></i> Close
                            </button>
                            <a href="<?= base_url('students-add') ?>" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Register Another Student
                            </a>
                            <a href="<?= base_url('students') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-list mr-1"></i> View All Students
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0"><i class="fas fa-list mr-2"></i>All Students</h3>
                                
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row mb-3">
                                <div class="col-md-4"><input type="text" id="searchStudent" class="form-control form-control-sm" placeholder="Search name..."></div>
                                <div class="col-md-2"><select id="filterGrade" class="form-control form-control-sm"><option value="">All Grades</option><option value="kindergarten">Kindergarten</option><option value="grade 1">Grade 1</option><option value="grade 2">Grade 2</option><option value="grade 3">Grade 3</option><option value="grade 4">Grade 4</option><option value="grade 5">Grade 5</option><option value="grade 6">Grade 6</option></select></div>
                                <div class="col-md-2"><select id="filterSection" class="form-control form-control-sm"><option value="">All Sections</option><option value="a">Section A</option><option value="b">Section B</option></select></div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light"><tr class="small text-secondary"><th>#</th><th>Photo</th><th>Name</th><th>Grade</th><th>Created</th><th class="text-center">View</th></tr></thead>
                                    <tbody>
                                        <?php if(!empty($students)): $i=1; foreach($students as $s): $pic=!empty($s['picture'])?base_url('uploads/students/'.$s['picture']):''; ?>
                                        <tr class="student-row" data-name="<?= esc(strtolower($s['fname'].' '.$s['lname'])) ?>" data-grade="<?= esc(strtolower($s['grade_section'])) ?>">
                                            <td><?= $i++ ?></td>
                                            <td style="cursor:pointer;" onclick="openImageViewer('<?= $pic ?>','<?= esc($s['fname'].' '.$s['lname']) ?>')">
                                                <?php if(!empty($s['picture'])): ?><img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:35px;height:35px;object-fit:cover;border:2px solid #667eea;"><?php else: ?><div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:35px;height:35px;border:2px solid #667eea;"><i class="fas fa-child fa-xs text-muted"></i></div><?php endif; ?>
                                            </td>
                                            <td><a href="<?= base_url('students-view/'.$s['id']) ?>" class="text-dark font-weight-bold"><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></a></td>
                                            <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                            <td class="small"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
                                            <td class="text-center"><a href="<?= base_url('students-view/'.$s['id']) ?>" class="btn btn-outline-info btn-xs"><i class="fas fa-eye"></i> View</a></td>
                                        </tr>
                                        <?php endforeach; else: ?><tr><td colspan="6" class="text-center text-muted py-4">No students yet</td></tr><?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- QR Large View Modal -->
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;">
                <h5 class="text-white"><i class="fas fa-qrcode mr-2"></i><span id="qrModalTitle">QR Code</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center bg-white p-4">
                <img id="qrFullImage" src="" style="max-width:100%;max-height:65vh;">
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div>
            <div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div>
            <div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>

<style>
.card{border-radius:10px}
.table td,.table th{vertical-align:middle;border-top:none}
.table tbody tr{border-bottom:1px solid #f3f4f6}
.img-circle{border-radius:50%}
.btn-xs{padding:4px 10px;font-size:12px;border-radius:6px}
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    // Auto-show registration result modal
    <?php if(session()->getFlashdata('registration_success')): ?>
    $('#registrationResultModal').modal('show');
    <?php endif; ?>

    function filterTable(){
        var s = $('#searchStudent').val().toLowerCase(),
            g = $('#filterGrade').val().toLowerCase(),
            sec = $('#filterSection').val().toLowerCase();
        $('.student-row').each(function(){
            var n = $(this).data('name'),
                gr = $(this).data('grade');
            $(this).toggle(
                (s=='' || n.indexOf(s)>-1 || gr.indexOf(s)>-1) &&
                (g=='' || gr.indexOf(g)>-1) &&
                (sec=='' || gr.indexOf('- '+sec)>-1 || gr.endsWith(' '+sec))
            );
        });
    }
    $('#searchStudent').on('keyup', filterTable);
    $('#filterGrade,#filterSection').on('change', filterTable);
});

function openImageViewer(u,t){
    if(!u) return;
    $('#imageViewerFull').attr('src',u);
    $('#imageDownloadBtn').attr('href',u);
    $('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');
    $('#imageViewerTitle').text(t||'Photo');
    $('#imageViewerModal').modal('show');
}

function openQrModal(u,t){
    if(!u) return;
    $('#qrFullImage').attr('src',u);
    $('#qrDownloadBtn').attr('href',u);
    $('#qrDownloadBtn').attr('download',(t||'qr').replace(/\s+/g,'_')+'.png');
    $('#qrModalTitle').text(t||'QR Code');
    $('#qrModal').modal('show');
}
</script>
<?= $this->endSection() ?>