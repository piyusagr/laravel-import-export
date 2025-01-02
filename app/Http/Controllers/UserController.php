<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->route('users.index')->with('success', 'Users imported successfully!');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    // Other methods...

    public function downloadText()
    {
        // Get all users
        $users = User::all();

        // Define the column widths (adjust this as needed for your data)
        $columnWidths = [
            'id' => 10,
            'name' => 30,
            'age' => 10,
            'email' => 40,
        ];

        // Initialize the text content with top border
        $textContent = "+------------+------------------------------+------------+------------------------------------------+\n";
        $textContent .= "|    ID      |            Name              |    Age     |               Email                      |\n";
        $textContent .= "+------------+------------------------------+------------+------------------------------------------+\n";

        // Loop through each user and append their data with borders
        foreach ($users as $user) {
            $textContent .= "| " . str_pad($user->id, $columnWidths['id']) . " |";
            $textContent .= str_pad($user->name, $columnWidths['name']) . "| ";
            $textContent .= str_pad($user->age, $columnWidths['age']) . " | ";
            $textContent .= str_pad($user->email, $columnWidths['email']) . " |\n";
            $textContent .= "+------------+------------------------------+------------+------------------------------------------+\n";
        }

        // Add the bottom border

        // Set the file name
        $fileName = 'users_data.txt';

        // Create the response to download the text file
        return Response::make($textContent, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ]);
    }
}
