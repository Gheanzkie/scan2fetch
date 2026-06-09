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
            <?php if(session()->getFlashdata('msg')): ?><div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div><?php endif; ?>
            
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0"><i class="fas fa-list mr-2"></i>All Students</h3>
                                <a href="<?= base_url('students-add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Add Student</a>
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

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content border-0 shadow" style="background:#1a1a2e;"><div class="modal-header border-0" style="background:#1a1a2e;"><h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Photo</span></h5><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div><div class="modal-body text-center bg-white p-2"><img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;"></div><div class="modal-footer border-0" style="background:#1a1a2e;"><a id="imageDownloadBtn" href="" download="photo.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a><button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button></div></div></div></div>

<style>.card{border-radius:10px}.table td,.table th{vertical-align:middle;border-top:none}.table tbody tr{border-bottom:1px solid #f3f4f6}.img-circle{border-radius:50%}.btn-xs{padding:4px 10px;font-size:12px;border-radius:6px}</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function(){
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
</script>
<?= $this->endSection() ?>