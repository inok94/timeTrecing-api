<?php

namespace App\Http\Controllers;

use App\EmployeeСlient;
use App\ProjectEmployee;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class EmployeeController
 * @package App\Http\Controllers
 */
class EmployeeController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        $data = EmployeeСlient::all();

        return $data;
    }

    /**
     * @param Request $request
     * @param $project_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function currentlyAssignedEmployee(Request $request, $project_id)
    {

        $employee = ProjectEmployee::join('users', 'project_employees.employee_id', '=', 'users.id')
                                        ->select('users.name as employee')->distinct()
                                        ->where([['project_employees.project_id','=', $project_id]]);
        //dd($employee->toArray());
        if (!$employee->exists()) {
            return abort('404');
        }
        return response()->json($employee->get(),200);
    }

    /**
     * Task: Extend the web service so that an employee can submit a CSV file containing her tracked
     * time.
     *
     * @param Request $request
     * @param $employee_id
     * @param $client_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function exportCsv(Request $request, $employee_id, $client_id)
    {
        $employeeСlient = EmployeeСlient::select('date', 'started_work', 'finished_work')
            ->where([
                ['employee_id', '=', $employee_id, 'and'],
                ['client_id', '=', $client_id]
            ]);

        if (!$employeeСlient->exists()) {
            return abort('404');
        }

        $employeeArray = $employeeСlient->get()->toArray();
        $filename = $this->generateCsv($employeeArray);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return response()->download(storage_path($filename), $filename, $headers);
    }

    /**
     * When tracking time, consider the project that an employee is currently assigned
     * @param Request $request
     * @param $project_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function currentEmployee(Request $request, $project_id)
    {
        dd($project_id);
        $employeeInProject = ProjectEmployee::select('users.name')->distinct()
            ->join('users', 'project_employees.employee_id', '=', 'users.user_id')
            ->where([
                'project_id', '=', $project_id])->get();
        dd($employeeInProject);
        return response()->json($employeeInProject, 200);
    }



    /**
     * @param array $employeeСlient
     * @return string $filename
     */
    private function generateCsv(array $employeeСlient): string
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A' . 1, 'Date');
        $sheet->setCellValue('B' . 1, 'started_work');
        $sheet->setCellValue('C' . 1, 'finished_work');

        $i = 2;
        foreach ($employeeСlient as $item) {
            $sheet->setCellValue('A' . $i, $item['date']);
            $sheet->setCellValue('B' . $i, $item['started_work']);
            $sheet->setCellValue('C' . $i, $item['finished_work']);
            $i++;
        }
        
        $filename = 'file.csv';
        $writer = IOFactory::createWriter($spreadsheet, 'Csv');

        $writer->save(storage_path($filename));

        return $filename;
    }
}