<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><i class="fas fa-user mr-2"></i>Parent / Fetcher Details</h1></div>
                <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= base_url('parents') ?>">Parents</a></li><li class="breadcrumb-item active">Details</li></ol></div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if(session()->getFlashdata('msg')): ?><div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div><?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div><?php endif; ?>

            <div class="row">
                <!-- LEFT: Parent Profile + Sub-Fetchers -->
                <div class="col-md-4">
                    <!-- Parent Profile -->
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div style="width:130px;height:130px;margin:0 auto;border-radius:50%;overflow:hidden;border:4px solid #667eea;cursor:pointer;" onclick="openImageViewer('<?= !empty($parent['picture'])?base_url('uploads/parents/'.$parent['picture']):'' ?>','<?= esc($parent['fname'].' '.$parent['lname']) ?>')">
                                <?php if(!empty($parent['picture'])): ?><img src="<?= base_url('uploads/parents/'.$parent['picture']) ?>" style="width:100%;height:100%;object-fit:cover;"><?php else: ?><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;"><i class="fas fa-user fa-3x text-muted"></i></div><?php endif; ?>
                            </div>
                            <div class="btn-group btn-group-sm mt-2" role="group">
                                <button class="btn btn-outline-secondary btn-xs open-camera-btn" data-target="parent-pic"><i class="fas fa-camera"></i> Take Photo</button>
                                <label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;"><i class="fas fa-upload"></i> Upload<input type="file" class="d-none parent-pic-input" accept="image/*"></label>
                            </div>
                            <form class="picture-form" action="<?= base_url('parents-update-picture') ?>" method="post" enctype="multipart/form-data" style="display:none;"><?= csrf_field() ?><input type="hidden" name="id" value="<?= $parent['id'] ?>"><input type="hidden" name="picture_capture" class="parent-picture-capture"><input type="file" name="picture" class="d-none parent-picture-file"></form>
                            <h3 class="mt-2 mb-0"><?= esc($parent['fname']) ?> <?= esc($parent['lname']) ?></h3>
                            <p class="text-muted mb-2"><i class="fas fa-phone mr-1"></i> <?= esc($parent['phone']) ?></p>
                            <?php if(!empty($parent['qr_code'])): ?><div class="mb-2"><img src="<?= base_url('uploads/qr/'.$parent['qr_code'].'.png') ?>" style="width:100px;height:100px;border:2px solid #667eea;border-radius:8px;cursor:pointer;" onclick="openQrModal('<?= base_url('uploads/qr/'.$parent['qr_code'].'.png') ?>')"></div><?php endif; ?>
                            <div class="mt-2">
                                <a href="<?= base_url('parents-edit/'.$parent['id']) ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="<?= base_url('parents-delete/'.$parent['id']) ?>" class="btn btn-outline-danger btn-sm ml-1" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Fetchers -->
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-user-friends mr-2"></i>Sub-Fetchers (<?= count($subFetchers ?? []) ?>/2)</h6>
                            <?php if(count($subFetchers ?? []) < 2 && !empty($students)): ?>
                            <button class="btn btn-outline-secondary btn-xs" data-toggle="modal" data-target="#addSubFetcherModal"><i class="fas fa-plus"></i> Add</button>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($subFetchers)): foreach($subFetchers as $f): ?>
                            <div class="d-flex align-items-center border rounded p-2 mb-2">
                                <div class="mr-2" style="cursor:pointer;" onclick="openImageViewer('<?= !empty($f['picture'])?base_url('uploads/parents/'.$f['picture']):'' ?>','<?= esc($f['fname'].' '.$f['lname']) ?>')">
                                    <?php if(!empty($f['picture'])): ?><img src="<?= base_url('uploads/parents/'.$f['picture']) ?>" class="img-circle" style="width:40px;height:40px;object-fit:cover;border:2px solid #28a745;"><?php else: ?><div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;border:2px solid #28a745;"><i class="fas fa-user text-muted"></i></div><?php endif; ?>
                                </div>
                                <div class="flex-grow-1"><strong><?= esc($f['fname']) ?> <?= esc($f['lname']) ?></strong><br><small class="text-muted"><?= esc($f['phone']) ?></small></div>
                                <?php if(!empty($f['qr_code'])): ?><img src="<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>" style="width:35px;height:35px;border:2px solid #667eea;border-radius:4px;cursor:pointer;margin-right:4px;" onclick="openQrModal('<?= base_url('uploads/qr/'.$f['qr_code'].'.png') ?>')"><?php endif; ?>
                                <button class="btn btn-outline-secondary btn-xs mr-1 edit-subfetcher-btn" data-id="<?= $f['id'] ?>" data-fname="<?= esc($f['fname']) ?>" data-mname="<?= esc($f['mname']??'') ?>" data-lname="<?= esc($f['lname']) ?>" data-phone="<?= esc($f['phone']) ?>" data-toggle="modal" data-target="#editSubFetcherModal"><i class="fas fa-pencil-alt"></i></button>
                                <a href="<?= base_url('subfetchers-delete/'.$parent['id'].'/'.$f['id']) ?>" class="btn btn-outline-danger btn-xs" onclick="return confirm('Remove?')"><i class="fas fa-times"></i></a>
                            </div>
                            <?php endforeach; else: ?><p class="text-center text-muted small py-2 mb-0">No sub-fetchers yet</p><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Linked Students -->
                <div class="col-md-8">
                    <?php if(!empty($students)): foreach($students as $s): ?>
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-user-graduate mr-2"></i><?= esc($s['fname']) ?> <?= esc($s['lname']) ?> <small class="text-muted">(<?= esc($s['grade_section']) ?>)</small></h5>
                            <a href="<?= base_url('students-view/'.$s['student_id']) ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> View Student</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Student:</strong> <?= esc($s['fname']) ?> <?= esc($s['lname']) ?></p>
                                    <p class="mb-1"><strong>Grade:</strong> <?= esc($s['grade_section']) ?></p>
                                    <p class="mb-0"><strong>Relation:</strong> <span class="badge badge-primary"><?= esc($s['relation'] ?? 'Parent') ?></span></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <?php if(!empty($s['picture'])): ?><img src="<?= base_url('uploads/students/'.$s['picture']) ?>" class="img-circle" style="width:70px;height:70px;object-fit:cover;border:2px solid #667eea;cursor:pointer;" onclick="openImageViewer('<?= base_url('uploads/students/'.$s['picture']) ?>','<?= esc($s['fname'].' '.$s['lname']) ?>')"><?php else: ?><div class="img-circle bg-light d-inline-flex align-items-center justify-content-center" style="width:70px;height:70px;border:2px solid #667eea;"><i class="fas fa-child fa-2x text-muted"></i></div><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; else: ?><div class="card shadow-sm border-0"><div class="card-body text-center text-muted py-5"><i class="fas fa-user-graduate fa-3x mb-3 d-block"></i><h5>No students linked</h5></div></div><?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Sub-Fetcher Modal -->
<div class="modal fade" id="addSubFetcherModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow"><form action="<?= base_url('subfetchers-save') ?>" method="post" enctype="multipart/form-data"><?= csrf_field() ?><input type="hidden" name="parent_id" value="<?= $parent['id'] ?>"><div class="modal-header border-0 pb-0"><h5>Add Sub-Fetcher</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><div class="form-group"><label>Link to Student</label><select name="student_id" class="form-control" required><option value="">-- Select --</option><?php foreach($students??[] as $s): ?><option value="<?= $s['student_id'] ?>"><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></option><?php endforeach; ?></select></div><div class="row"><div class="col-4"><label class="small">First Name *</label><input type="text" name="fname" class="form-control form-control-sm" required></div><div class="col-4"><label class="small">Middle Name</label><input type="text" name="mname" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Last Name *</label><input type="text" name="lname" class="form-control form-control-sm" required></div></div><div class="form-group"><label class="small">Phone *</label><input type="text" name="phone" class="form-control form-control-sm" required></div></div><div class="modal-footer border-0 pt-0"><button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-secondary btn-sm px-4">Save</button></div></form></div></div></div>

<!-- Edit Sub-Fetcher Modal -->
<div class="modal fade" id="editSubFetcherModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow"><form action="<?= base_url('subfetchers-update') ?>" method="post" enctype="multipart/form-data"><?= csrf_field() ?><input type="hidden" name="id" id="editSubFetcherId"><input type="hidden" name="parent_id" value="<?= $parent['id'] ?>"><div class="modal-header border-0 pb-0"><h5>Edit Sub-Fetcher</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body">
    <div class="form-group text-center"><label class="small">Picture</label><div class="edit-subfetcher-photo-preview" style="width:100px;height:100px;margin:0 auto 10px;border-radius:50%;overflow:hidden;border:3px solid #667eea;background:#f3f4f6;display:flex;align-items:center;justify-content:center;"><i class="fas fa-user fa-2x text-muted"></i></div><div class="btn-group btn-group-sm"><button type="button" class="btn btn-outline-secondary btn-xs open-camera-btn"><i class="fas fa-camera"></i></button><label class="btn btn-outline-secondary btn-xs mb-0" style="cursor:pointer;"><i class="fas fa-upload"></i><input type="file" class="d-none edit-subfetcher-pic-input" accept="image/*"></label></div><input type="hidden" name="picture_capture" class="edit-subfetcher-picture-capture"><input type="file" name="picture" class="d-none edit-subfetcher-picture-file"></div>
    <div class="row"><div class="col-4"><label class="small">First Name</label><input type="text" name="fname" id="editSubFetcherFname" class="form-control form-control-sm" required></div><div class="col-4"><label class="small">Middle Name</label><input type="text" name="mname" id="editSubFetcherMname" class="form-control form-control-sm"></div><div class="col-4"><label class="small">Last Name</label><input type="text" name="lname" id="editSubFetcherLname" class="form-control form-control-sm" required></div></div>
    <div class="form-group"><label class="small">Phone</label><input type="text" name="phone" id="editSubFetcherPhone" class="form-control form-control-sm" required></div>
</div><div class="modal-footer border-0 pt-0"><button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-secondary btn-sm px-4">Update</button></div></form></div></div></div>

<!-- Camera Modal --><div class="modal fade" id="cameraModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content border-0 shadow"><div class="modal-header border-0 pb-0"><h6><i class="fas fa-camera mr-2"></i>Take Photo</h6><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body text-center p-2"><video id="cameraVideo" autoplay playsinline style="width:100%;max-height:350px;border-radius:8px;background:#000;"></video><canvas id="cameraCanvas" style="display:none;"></canvas><button type="button" class="btn btn-primary btn-sm mt-2" id="captureBtn"><i class="fas fa-camera"></i> Capture</button></div></div></div></div>
<!-- QR Modal --><div class="modal fade" id="qrModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-qrcode mr-2"></i>QR Code</h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white"><img id="qrFullImage" src="" style="max-width:100%;max-height:70vh;padding:20px;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="qrDownloadBtn" href="" download="qr.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Save</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>
<!-- Image Viewer --><div class="modal fade" id="imageViewerModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<style>.img-circle{border-radius:50%}.btn-xs{padding:4px 8px;font-size:12px;border-radius:6px}.card{border-radius:10px}</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){var s,currentTarget='';
$(document).on('change','.parent-pic-input',function(){var f=this.files[0];if(f){var form=$('.picture-form');form.find('.parent-picture-file').prop('files',this.files);form.find('.parent-picture-capture').val('');form.submit()}});
$(document).on('change','.edit-subfetcher-pic-input',function(){var f=this.files[0];if(f){var r=new FileReader();r.onload=function(e){$('.edit-subfetcher-photo-preview').html('<img src="'+e.target.result+'" style="width:100%;height:100%;object-fit:cover;">')};r.readAsDataURL(f);$('.edit-subfetcher-picture-file').prop('files',this.files);$('.edit-subfetcher-picture-capture').val('')}});
$(document).on('click','.edit-subfetcher-btn',function(){$('#editSubFetcherId').val($(this).data('id'));$('#editSubFetcherFname').val($(this).data('fname'));$('#editSubFetcherMname').val($(this).data('mname'));$('#editSubFetcherLname').val($(this).data('lname'));$('#editSubFetcherPhone').val($(this).data('phone'))});
$(document).on('click','.open-camera-btn',function(){currentTarget=$(this).data('target')||'subfetcher';$('#cameraModal').modal('show');setTimeout(function(){navigator.mediaDevices.getUserMedia({video:{facingMode:"user",width:400,height:400}}).then(function(st){s=st;$('#cameraVideo')[0].srcObject=s}).catch(function(e){alert('Camera error: '+e.message)})},500)});
$('#captureBtn').click(function(){var v=$('#cameraVideo')[0],c=$('#cameraCanvas')[0];c.width=v.videoWidth||400;c.height=v.videoHeight||400;c.getContext('2d').drawImage(v,0,0);var d=c.toDataURL('image/png');
if(currentTarget==='parent-pic'){var form=$('.picture-form');form.find('.parent-picture-capture').val(d);form.find('.parent-picture-file').val('');form.submit()}
else{$('.edit-subfetcher-photo-preview').html('<img src="'+d+'" style="width:100%;height:100%;object-fit:cover;">');$('.edit-subfetcher-picture-capture').val(d);$('.edit-subfetcher-picture-file').val('')}
if(s){s.getTracks().forEach(function(t){t.stop()})}$('#cameraModal').modal('hide')});
$('#cameraModal').on('hidden.bs.modal',function(){if(s){s.getTracks().forEach(function(t){t.stop()})}})});
function openImageViewer(u,t){if(!u)return;$('#imageViewerFull').attr('src',u);$('#imageDownloadBtn').attr('href',u);$('#imageDownloadBtn').attr('download',t.replace(/\s+/g,'_')+'.png');$('#imageViewerTitle').text(t||'Photo');$('#imageViewerModal').modal('show')}
function openQrModal(u){$('#qrFullImage').attr('src',u);$('#qrDownloadBtn').attr('href',u);$('#qrModal').modal('show')}
</script>
<?= $this->endSection() ?>