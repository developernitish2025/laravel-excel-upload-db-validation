<?php
namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel, WithValidation, WithHeadingRow {
    /**
    * Map each row of the Excel file to the Category model.
    */

    public function model( array $row ) {
        return new Category( [
            'name' => $row[ 'name' ],     // 'name' header in Excel
            'email' => $row[ 'email' ],   // 'email' header in Excel
            'contact' => $row[ 'contact' ] // 'contact' header in Excel
        ] );
    }

    /**
    * Validation rules for each row.
    */

    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'contact' => 'nullable|numeric|digits:10',
        ];
    }
}
