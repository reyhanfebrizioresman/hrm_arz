use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Attendance([
            'employee_id' => $row['employee_id'],
            'status' => $row['status'],
            'overtime' => $row['overtime'],
            'clock_in' => $row['clock_in'],
            'clock_out' => $row['clock_out'],
            'date' => $row['date'],
        ]);
    }
}

