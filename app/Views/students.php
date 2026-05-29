<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-normal text-secondary"><i class="fas fa-user-graduate mr-2"></i>Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-3 pb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-normal text-secondary mb-0"><i class="fas fa-list mr-2"></i>All Students</h3>
                                <span class="badge badge-light text-muted"><i class="fas fa-database mr-1"></i><span id="countDisplay">0</span> students</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text bg-transparent border-right-0"><i class="fas fa-search text-muted"></i></span></div>
                                        <input type="text" id="searchStudent" class="form-control border-left-0" placeholder="Search name, grade, or parent...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <select id="filterGrade" class="form-control form-control-sm">
                                        <option value="">All Grades</option>
                                        <option value="kindergarten">Kindergarten</option>
                                        <option value="grade 1">Grade 1</option>
                                        <option value="grade 2">Grade 2</option>
                                        <option value="grade 3">Grade 3</option>
                                        <option value="grade 4">Grade 4</option>
                                        <option value="grade 5">Grade 5</option>
                                        <option value="grade 6">Grade 6</option>
                                        <option value="grade 7">Grade 7</option>
                                        <option value="grade 8">Grade 8</option>
                                        <option value="grade 9">Grade 9</option>
                                        <option value="grade 10">Grade 10</option>
                                        <option value="grade 11">Grade 11</option>
                                        <option value="grade 12">Grade 12</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="filterSection" class="form-control form-control-sm">
                                        <option value="">All Sections</option>
                                        <option value="a">Section A</option>
                                        <option value="b">Section B</option>
                                        <option value="c">Section C</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr class="small text-secondary text-uppercase">
                                            <th width="5%">#</th>
                                            <th width="8%">Photo</th>
                                            <th width="22%">Student Name</th>
                                            <th width="15%">Grade & Section</th>
                                            <th width="22%">Parent / Fetcher</th>
                                            <th width="13%">Parent Phone</th>
                                            <th width="15%">Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($students)): ?>
                                            <?php $i = 1; foreach ($students as $s): ?>
                                            <?php $studentPicUrl = !empty($s['picture']) ? base_url('uploads/students/' . $s['picture']) : ''; ?>
                                            <tr class="student-row" 
                                                data-name="<?= esc(strtolower($s['fname'] . ' ' . $s['lname'])) ?>"
                                                data-grade="<?= esc(strtolower($s['grade_section'])) ?>"
                                                data-parent="<?= esc(strtolower(($s['pfname'] ?? '') . ' ' . ($s['plname'] ?? ''))) ?>">
                                                <td><?= $i++ ?></td>
                                                <td style="cursor:pointer;" onclick="openImageViewer('<?= $studentPicUrl ?>', '<?= esc($s['fname'] . ' ' . $s['lname']) ?>')" title="Click to view full photo">
                                                    <?php if (!empty($s['picture'])): ?>
                                                        <img src="<?= base_url('uploads/students/' . $s['picture']) ?>" class="img-circle" style="width:35px;height:35px;object-fit:cover;border:2px solid #667eea;">
                                                    <?php else: ?>
                                                        <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width:35px;height:35px;border:2px solid #667eea;"><i class="fas fa-child fa-xs text-muted"></i></div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><strong><?= esc($s['fname']) ?> <?= esc($s['lname']) ?></strong></td>
                                                <td><span class="badge badge-light"><?= esc($s['grade_section']) ?></span></td>
                                                <td><?= esc($s['pfname'] ?? '—') ?> <?= esc($s['plname'] ?? '') ?></td>
                                                <td class="small"><?= esc($s['pphone'] ?? '—') ?></td>
                                                <td class="small text-muted"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="7" class="text-center text-muted py-4"><i class="fas fa-user-graduate fa-2x mb-2 d-block"></i>No students registered yet</td></tr>
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

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="background:#1a1a2e;">
            <div class="modal-header border-0" style="background:#1a1a2e;">
                <h5 class="text-white"><i class="fas fa-image mr-2"></i><span id="imageViewerTitle">Student Photo</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center bg-white p-2">
                <img id="imageViewerFull" src="" style="max-width:100%;max-height:70vh;">
            </div>
            <div class="modal-footer border-0" style="background:#1a1a2e;">
                <a id="imageDownloadBtn" href="" download="student.png" class="btn btn-primary btn-sm"><i class="fas fa-download"></i> Download</a>
                <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.card { border-radius: 10px; }
.table td, .table th { vertical-align: middle; border-top: none; }
.table tbody tr { border-bottom: 1px solid #f3f4f6; }
.table tbody tr:hover { background: #f9fafb; }
.img-circle { border-radius: 50%; }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function() {
    var total = $('.student-row').length;
    $('#countDisplay').text(total);

    function filterStudents() {
        var searchVal = $('#searchStudent').val().toLowerCase();
        var gradeVal = $('#filterGrade').val().toLowerCase();
        var sectionVal = $('#filterSection').val().toLowerCase();
        var c = 0;

        $('.student-row').each(function() {
            var name = $(this).data('name');
            var grade = $(this).data('grade');
            var parent = $(this).data('parent');

            var matchSearch = (searchVal === '' || name.indexOf(searchVal) > -1 || grade.indexOf(searchVal) > -1 || parent.indexOf(searchVal) > -1);
            var matchGrade = (gradeVal === '' || grade.indexOf(gradeVal) > -1);
            var matchSection = (sectionVal === '' || grade.indexOf(' - ' + sectionVal) > -1 || grade.endsWith(' ' + sectionVal));

            if (matchSearch && matchGrade && matchSection) {
                $(this).show();
                c++;
            } else {
                $(this).hide();
            }
        });

        $('#countDisplay').text(c);
    }

    $('#searchStudent').on('keyup', filterStudents);
    $('#filterGrade').on('change', filterStudents);
    $('#filterSection').on('change', filterStudents);
});

// Image Viewer
function openImageViewer(imageUrl, title) {
    if (!imageUrl) return;
    $('#imageViewerFull').attr('src', imageUrl);
    $('#imageDownloadBtn').attr('href', imageUrl);
    $('#imageDownloadBtn').attr('download', title.replace(/\s+/g, '_') + '.png');
    $('#imageViewerTitle').text(title || 'Student Photo');
    $('#imageViewerModal').modal('show');
}
</script>
<?= $this->endSection() ?>