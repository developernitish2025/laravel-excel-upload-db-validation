<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller {
    public function handleUpload( Request $request ) {
        // Validate the file
        $request->validate( [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:2048',
        ] );

        try {
            // Import data from the Excel file into the categories table
            Excel::import( new CategoriesImport, $request->file( 'excel_file' ) );

            return back()->with( 'success', 'Excel file uploaded and categories saved successfully!' );
        } catch ( \Exception $e ) {
            return back()->withErrors( [ 'error' => 'There was an error: ' . $e->getMessage() ] );
        }
    }
}
