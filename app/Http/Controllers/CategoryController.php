<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller {
    /**
    * Display the file upload form.
    */

    public function showUploadForm() {
        return view( 'categories.upload' );
    }

    /**
    * Handle the file upload and import process.
    */

    public function handleUpload( Request $request ) {
        // Validate the uploaded file
        $request->validate( [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:2048', // Excel file validation
        ] );

        try {
            // Import the Excel file
            Excel::import( new CategoriesImport, $request->file( 'excel_file' ) );

            return back()->with( 'success', 'Excel file uploaded and categories saved successfully!' );
        } catch ( \Exception $e ) {
            return back()->withErrors( [ 'error' => 'There was an error: ' . $e->getMessage() ] );
        }
    }
}
