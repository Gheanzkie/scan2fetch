<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'grade_section', 'parent_id', 'created_by', 'created_at', 'adviser_id'
    ];

    /**
     * Resolve the teacher id for a grade_section (first match by lowest teacher id).
     * Returns null when no teacher owns that section — student stays unassigned.
     */
    public function adviserIdForGrade(?string $gradeSection): ?int
    {
        $gradeSection = trim((string) $gradeSection);
        if ($gradeSection === '') {
            return null;
        }

        $row = \Config\Database::connect()
            ->table('teachers')
            ->select('id')
            ->where('grade_section', $gradeSection)
            ->orderBy('id', 'ASC')
            ->get()
            ->getRowArray();

        return $row ? (int) $row['id'] : null;
    }

    /** Insert with adviser_id auto-linked from grade_section when not set. */
    public function insertWithAdviser(array $data, bool $returnID = true)
    {
        if (!array_key_exists('adviser_id', $data) || $data['adviser_id'] === null || $data['adviser_id'] === '') {
            $data['adviser_id'] = $this->adviserIdForGrade($data['grade_section'] ?? null);
        }

        return $this->insert($data, $returnID);
    }

    /** Keep adviser_id in sync when grade_section changes. */
    public function updateWithAdviser($id, array $data): bool
    {
        if (array_key_exists('grade_section', $data)) {
            $data['adviser_id'] = $this->adviserIdForGrade($data['grade_section']);
        }

        return (bool) $this->update($id, $data);
    }
}