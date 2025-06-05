<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function sqlToExcel(){
        ini_set('memory_limit', '8G');
        ini_set('max_execution_time', '900');
        $sqlContent = file_get_contents(public_path('hr2025.sql'));

        // Parse the INSERT statements
        $data = $this->parseSqlInsertFile($sqlContent);

        // Check if data was parsed successfully
//        if (empty($data)) {
//            return response()->json(['message' => 'No valid INSERT statements found'], 400);
//        }

        $columns = $this->getColumnsFromInsertStatement($data[0]);

        // Prepare data for Excel
        $excelData = [];
        foreach ($data as $row) {
            $excelData[] = explode(',', $row);
        }

//        echo '<pre>';
//        print_r($excelData);
//        echo '</pre>';
//        die();
        // Write the data to an Excel file
        return $this->writeDataToExcel($excelData, $columns);
    }

    private function parseSqlInsertFile($sqlContent)
    {
        // Regular expression to match INSERT INTO statement with multiple rows
        preg_match_all("/INSERT INTO `?(\w+)`? \((.*?)\) VALUES\s*\((.*?);/s", $sqlContent, $matches, PREG_SET_ORDER);

        $data = [];

        // Loop through the matches and extract the values
        foreach ($matches as $match) {
            // Get the column names (from the first match)
            $columns = $match[2];

            // Extract each set of values (handle multiple rows)
            $valuesString = $match[3];
            preg_match_all('/\((.*?)\)/s', $valuesString, $valuesMatches);

            // Loop through each value set and clean up
            foreach ($valuesMatches[1] as $rowValues) {
                // Remove surrounding spaces and quotes
                $cleanedValues = preg_replace('/\s*,\s*/', ',', trim($rowValues));
                $data[] = $cleanedValues;
            }
        }

        return $data;
    }

    private function getColumnsFromInsertStatement($statement)
    {
        // Split by commas and return columns as an array
        $parts = explode(',', $statement);
        return $parts;
    }

    // Write data to Excel
    private function writeDataToExcel($data, $columns)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers (row 1)
        foreach ($columns as $index => $column) {
            // Use 1-based index for column, set headers on row 1
            $columnLetter = Coordinate::stringFromColumnIndex($index + 1);
            $sheet->setCellValue($columnLetter . '1', $column);  // Set header in row 1
        }

        // Fill data (starting from row 2)
        foreach ($data as $rowIndex => $rowData) {
            foreach ($rowData as $colIndex => $cellData) {
                // Get the column letter using stringFromColumnIndex (1-based index)
                $columnLetter = Coordinate::stringFromColumnIndex($colIndex + 1);
                $sheet->setCellValue($columnLetter . ($rowIndex + 2), $cellData);  // Start writing data from row 2
            }
        }

        // Write to Excel file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'sql_data_export_' . time() . '.xlsx';
        $path = public_path($fileName);
        $writer->save($path);

        return response()->download($path);
    }
}
