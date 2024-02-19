<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentifyController extends Controller
{
    public function identify(Request $request)
    {
        try {
            $data = $request->all();
            $validate = Validator::make($data,[
                'email' => 'required|email',
                'phoneNumber' => 'required',
            ]);
            if($validate->fails()){
                return response()->json($validate->messages(), 400); 
            }

            $contact = Contact::where('email', $data['email'])
                ->orWhere('phoneNumber', $data['phoneNumber'])
                ->first();

            if (!$contact) {
                $newContact = Contact::create([
                    'email' => $data['email'],
                    'phoneNumber' => $data['phoneNumber'],
                    'linkPrecedence' => 'primary',
                ]);

                $response = [
                    'primaryContactId' => $newContact->id,
                    'emails' => [$newContact->email],
                    'phoneNumbers' => [$newContact->phoneNumber],
                    'secondaryContactIds' => [],
                ];
            } else {
                $newContact = Contact::create([
                    'email' => $data['email'],
                    'phoneNumber' => $data['phoneNumber'],
                    'linkPrecedence' => 'secondary',
                    'linkedId' => $contact->id,
                ]);

                // Fetch all secondary contact IDs linked to the primary contact
                $secondaryContactIds = Contact::where('linkedId', $contact->id)
                    ->pluck('id');

                $response = [
                    'primaryContactId' => $contact->id,
                    'emails' => [$contact->email],
                    'phoneNumbers' => [$contact->phoneNumber],
                    'secondaryContactIds' => $secondaryContactIds,
                ];
            }

            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error($e->getCode());

            // Return a generic error response
            return response()->json(['error' => $e->getMessage()>0?$e->getMessage():'An error occurred.'], $e->getCode()>0 ? $e->getCode() : 500);
        }
    }
}
