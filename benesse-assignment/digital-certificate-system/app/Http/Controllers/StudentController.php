<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    const COURSES = ['Hindi Language','Japnese Language','English Language'];

    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'course' => ['required',Rule::in(self::COURSES)]
            // Add other validation rules as per your requirements
        ],[
            'course'=>"Please select a valid course from the available options: ".implode(', ',self::COURSES)."."
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if(!Storage::exists('students.csv')){
            // Write student data to CSV file
            $data = [
                'Name', // Header
                'Email', // Header
                'Course' // Header
                // Add other necessary headers
            ];

            $line = implode(',', $data);

            Storage::append('students.csv', $line);
        }
        

        $data = [
            $request->input('name'),
            $request->input('email'),
            $request->input('course'),
            // Add other necessary fields
        ];

        $line = implode(',', $data);

        Storage::append('students.csv', $line);

        return response()->json(['message' => 'Student registered successfully'], 200);
    }
}
