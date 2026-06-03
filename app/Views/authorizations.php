<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-file-signature mr-2"></i>Authorization Letters</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item active">Authorizations</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if (session()->getFlashdata('msg')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0"><h5 class="mb-0"><i class="fas fa-list mr-2"></i>All Authorization Letters</h5></div>
                        <div class="card-body pt-2">
                            
                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-3 mb-2"><input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search student, parent, fetcher..."></div>
                                <div class="col-md-2 mb-2"><select id="statusFilter" class="form-control form-control-sm"><option value="">All Status</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="released">Released</option><option value="declined">Declined</option></select></div>
                                <div class="col-md-2 mb-2"><input type="date" id="dateFilter" class="form-control form-control-sm"></div>
                                <div class="col-md-2 mb-2"><button class="btn btn-outline-secondary btn-sm" id="resetFilterBtn"><i class="fas fa-times"></i> Reset</button></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-sm mb-0">
                                    <thead class="bg-light">
                                        <tr class="small"><th>#</th><th>Student</th><th>Parent</th><th>Fetcher</th><th>Relation</th><th>Status</th><th>Date</th><th class="text-center">Action</th></tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($authorizations)): $i=1; foreach ($authorizations as $a): ?>
                                        <?php $status = $a['status'] ?? ''; ?>
                                        <tr class="auth-row" 
                                            data-search="<?= esc(strtolower(($a['sfname']??'').' '.($a['slname']??'').' '.($a['pfname']??'').' '.($a['plname']??'').' '.($a['fetcher_fname']??'').' '.($a['fetcher_lname']??''))) ?>"
                                            data-status="<?= $status ?>"
                                            data-date="<?= date('Y-m-d', strtotime($a['created_at'])) ?>">
                                            <td><?= $i++ ?></td>
                                            <td><strong><?= esc($a['sfname'] ?? '') ?> <?= esc($a['slname'] ?? '') ?></strong></td>
                                            <td><?= esc($a['pfname'] ?? '') ?> <?= esc($a['plname'] ?? '') ?></td>
                                            <td>
                                                <?php if (!empty($a['fetcher_picture'])): ?>
                                                    <img src="<?= base_url('uploads/fetchers/'.$a['fetcher_picture']) ?>" class="img-circle mr-1" style="width:35px;height:35px;object-fit:cover;cursor:pointer;border:2px solid #667eea;" onclick="openImageViewer('<?= base_url('uploads/fetchers/'.$a['fetcher_picture']) ?>', '<?= esc($a['fetcher_fname'].' '.$a['fetcher_lname']) ?>')" title="Click to view full photo">
                                                <?php else: ?>
                                                    <div class="img-circle bg-light d-inline-flex align-items-center justify-content-center mr-1" style="width:35px;height:35px;border:2px solid #667eea;"><i class="fas fa-user text-muted fa-xs"></i></div>
                                                <?php endif; ?>
                                                <?= esc($a['fetcher_fname']) ?> <?= esc($a['fetcher_lname']) ?>
                                            </td>
                                            <td><?= esc($a['relation']) ?></td>
                                            <td><span class="badge badge-<?= $status=='approved'?'success':($status=='released'?'info':($status=='declined'?'danger':'warning')) ?>"><?= ucfirst($status?:'—') ?></span></td>
                                            <td class="small"><?= date('M d', strtotime($a['created_at'])) ?></td>
                                            <td class="text-center">
                                                <?php if ($status == 'pending'): ?>
                                                    <button class="btn btn-outline-secondary btn-xs action-btn" data-id="<?= $a['id'] ?>" data-action="pending" data-name="<?= esc($a['fetcher_fname'].' '.$a['fetcher_lname']) ?>"><i class="fas fa-ellipsis-h"></i> Action</button>
                                                <?php elseif ($status == 'approved'): ?>
                                                    <button class="btn btn-outline-secondary btn-xs action-btn" data-id="<?= $a['id'] ?>" data-action="approved" data-name="<?= esc($a['fetcher_fname'].' '.$a['fetcher_lname']) ?>"><i class="fas fa-ellipsis-h"></i> Action</button>
                                                <?php else: ?>
                                                    <span class="badge badge-<?= $status=='released'?'success':'danger' ?>"><?= ucfirst($status) ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; else: ?>
                                        <tr><td colspan="8" class="text-center text-muted py-4">No authorization letters</td></tr>
                                        <?php endif; ?>
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

<!-- Confirm Action Modal -->
<div class="modal fade" id="confirmActionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content border-0 shadow">
        <div class="modal-header border-0 pb-0"><h6><i class="fas fa-question-circle text-warning mr-2"></i>Confirm Action</h6><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body text-center"><p class="mb-1">What would you like to do?</p><p class="text-muted small mb-0"><strong id="confirmAuthName"></strong></p></div>
        <div class="modal-footer border-0 pt-0 justify-content-center" id="actionButtons"></div>
    </div></div>
</div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Fetcher Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="fetcher.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<style>.img-circle{border-radius:50%}.btn-xs{padding:4px 10px;font-size:12px;border-radius:6px}.card{border-radius:10px}.table td,.table th{vertical-align:middle;border-top:none}.table tbody tr{border-bottom:1px solid #f3f4f6}</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
    var pendingAuthId=null,pendingAction=null;

    function filterTable(){var s=$('#searchFilter').val().toLowerCase(),st=$('#statusFilter').val(),d=$('#dateFilter').val();$('.auth-row').each(function(){var t=$(this).data('search'),ts=$(this).data('status'),td=$(this).data('date');$(this).toggle((s==''||t.indexOf(s)>-1)&&(st==''||ts==st)&&(d==''||td==d))})}
    $('#searchFilter').on('keyup',filterTable);$('#statusFilter,#dateFilter').on('change',filterTable);$('#resetFilterBtn').click(function(){$('#searchFilter').val('');$('#statusFilter').val('');$('#dateFilter').val('');$('.auth-row').show()});

    $(document).on('click','.action-btn',function(){pendingAuthId=$(this).data('id');pendingAction=$(this).data('action');$('#confirmAuthName').text($(this).data('name'));var b='';if(pendingAction==='pending')b='<button type="button" class="btn btn-danger btn-sm" id="confirmDecline"><i class="fas fa-times mr-1"></i> Decline</button><button type="button" class="btn btn-success btn-sm" id="confirmApprove"><i class="fas fa-check mr-1"></i> Approve</button>';else if(pendingAction==='approved')b='<button type="button" class="btn btn-danger btn-sm" id="confirmDecline"><i class="fas fa-times mr-1"></i> Decline</button><button type="button" class="btn btn-info btn-sm" id="confirmRelease"><i class="fas fa-door-open mr-1"></i> Release</button>';$('#actionButtons').html(b);$('#confirmActionModal').modal('show')});
    $(document).on('click','#confirmApprove',function(){if(!pendingAuthId)return;window.location.href='<?= base_url('authorization-approve/') ?>'+pendingAuthId});
    $(document).on('click','#confirmRelease',function(){if(!pendingAuthId)return;if(confirm('Release? SMS will be sent.'))window.location.href='<?= base_url('authorization-release/') ?>'+pendingAuthId});
    $(document).on('click','#confirmDecline',function(){if(!pendingAuthId)return;if(confirm('Decline? SMS will be sent.'))window.location.href='<?= base_url('authorization-decline/') ?>'+pendingAuthId});
});
function openImageViewer(u,t){if(!u)return;$('#imageViewerFull').attr('src',u);$('#imageDownloadBtn').attr('href',u);$('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');$('#imageViewerTitle').text(t||'Fetcher Photo');$('#imageViewerModal').modal('show')}
</script>
<?= $this->endSection() ?>