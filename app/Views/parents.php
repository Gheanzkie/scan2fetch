<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-users mr-2"></i>Parents / Fetchers</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Parents</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('msg')): ?><div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div><?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0"><i class="fas fa-list mr-2"></i>Parent / Fetcher List</h3>
                                <a href="<?= base_url('parents-add') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-plus mr-1"></i> Add Parent</a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-4 mb-2"><input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search name or phone..."></div>
                                <div class="col-md-2 mb-2"><select id="gradeFilter" class="form-control form-control-sm"><option value="">All Grades</option><option value="kindergarten">Kindergarten</option><option value="grade 1">Grade 1</option><option value="grade 2">Grade 2</option><option value="grade 3">Grade 3</option><option value="grade 4">Grade 4</option><option value="grade 5">Grade 5</option><option value="grade 6">Grade 6</option></select></div>
                                <div class="col-md-2 mb-2"><select id="sectionFilter" class="form-control form-control-sm"><option value="">All Sections</option><option value="a">Section A</option><option value="b">Section B</option></select></div>
                                <div class="col-md-2 mb-2"><button class="btn btn-outline-secondary btn-sm" id="resetFilterBtn"><i class="fas fa-times"></i> Reset</button></div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light"><tr class="small text-secondary"><th>#</th><th>Photo</th><th>Name</th><th>Phone</th><th>Student/Grade</th><th>Relation</th><th>QR</th><th>Created</th><th class="text-center">View</th></tr></thead>
                                    <tbody>
                                        <?php if(!empty($parents)): $i=1; foreach($parents as $p): $pic=!empty($p['picture'])?base_url('uploads/parents/'.$p['picture']):''; $qrPic=!empty($p['qr_code'])?base_url('uploads/qr/'.$p['qr_code'].'.png'):''; ?>
                                        <tr class="parent-row" data-search="<?= esc(strtolower($p['fname'].' '.$p['lname'].' '.$p['phone'])) ?>" data-grade="<?= esc(strtolower($p['student_grade']??'')) ?>">
                                            <td><?= $i++ ?></td>
                                            <td style="cursor:pointer;" onclick="openImageViewer('<?= $pic ?>','<?= esc($p['fname'].' '.$p['lname']) ?>')">
                                                <?php if(!empty($p['picture'])): ?><img src="<?= base_url('uploads/parents/'.$p['picture']) ?>" class="img-circle" style="width:40px;height:40px;object-fit:cover;border:2px solid #667eea;"><?php else: ?><div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;border:2px solid #667eea;"><i class="fas fa-user text-muted"></i></div><?php endif; ?>
                                            </td>
                                            <td><strong><?= esc($p['fname']) ?> <?= esc($p['lname']) ?></strong></td>
                                            <td><?= esc($p['phone']) ?></td>
                                            <td><span class="badge badge-light"><?= esc($p['student_grade']??'—') ?> - <?= esc($p['student_fname']??'—') ?></span></td>
                                            <td><span class="badge badge-info"><?= esc($p['relation']??'—') ?></span></td>
                                            <td style="cursor:pointer;" onclick="openQrModal('<?= $qrPic ?>', '<?= esc($p['fname'].' '.$p['lname']) ?>')">
                                                <?php if(!empty($p['qr_code'])): ?><img src="<?= base_url('uploads/qr/'.$p['qr_code'].'.png') ?>" style="width:45px;height:45px;border:2px solid #667eea;border-radius:4px;" title="Click to enlarge"><?php else: ?><span class="badge badge-warning">None</span><?php endif; ?>
                                            </td>
                                            <td class="small"><?= date('M d, Y', strtotime($p['created_at'])) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('parents-view/'.$p['id']) ?>" class="btn btn-outline-info btn-xs"><i class="fas fa-eye"></i> View</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?><tr><td colspan="9" class="text-center text-muted py-4">No parents registered yet</td></tr><?php endif; ?>
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

<!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-qrcode mr-2"></i><span id="qrModalTitle">QR Code</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white"><img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<style>.card{border-radius:10px}.table td,.table th{vertical-align:middle;border-top:none}.table tbody tr{border-bottom:1px solid #f3f4f6}.img-circle{border-radius:50%}.btn-xs{padding:4px 10px;font-size:12px;border-radius:6px}.btn-secondary{background:#6b7280;border-color:#6b7280}.btn-secondary:hover{background:#4b5563}</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){function f(){var s=$('#searchFilter').val().toLowerCase(),g=$('#gradeFilter').val().toLowerCase(),sec=$('#sectionFilter').val().toLowerCase();$('.parent-row').each(function(){var t=$(this).data('search'),gr=$(this).data('grade');$(this).toggle((s==''||t.indexOf(s)>-1)&&(g==''||gr.indexOf(g)>-1)&&(sec==''||gr.indexOf('- '+sec)>-1||gr.endsWith(' '+sec)))})}$('#searchFilter').on('keyup',f);$('#gradeFilter,#sectionFilter').on('change',f);$('#resetFilterBtn').click(function(){$('#searchFilter').val('');$('#gradeFilter').val('');$('#sectionFilter').val('');$('.parent-row').show()})});
function openImageViewer(u,t){if(!u)return;$('#imageViewerFull').attr('src',u);$('#imageDownloadBtn').attr('href',u);$('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');$('#imageViewerTitle').text(t||'Photo');$('#imageViewerModal').modal('show')}
function openQrModal(u,t){if(!u)return;$('#qrFullImage').attr('src',u);$('#qrDownloadBtn').attr('href',u);$('#qrDownloadBtn').attr('download',(t||'qr').replace(/\s+/g,'_')+'.png');$('#qrModalTitle').text(t||'QR Code');$('#qrModal').modal('show')}
</script>
<?= $this->endSection() ?>