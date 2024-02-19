<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use phpseclib3\Crypt\RSA;
// use Lcobucci\JWT\Builder;

class CertificateController extends Controller
{
    
    public function issueCertificate(Request $request)
    {
        dd($request->all());
        // Validate the request
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string',
            'course_name' => 'required|string',
            'completion_date' => 'required|date',
            // Add other validation rules as per your requirements
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        // if(!Storage::exists('certificates.csv')){
        //     // Write student data to CSV file
        //     $data = [
        //         'Student Name', // Header
        //         'Course Name', // Header
        //         'Completion Date', // Header
        //         'Token',
        //         // Add other necessary headers
        //     ];

        //     $line = implode(',', $data);

        //     Storage::append('certificates.csv', $line);
        // }
        

        // // Generate a key pair for the issuer
        // $rsa = RSA::createKey(2048);
        // $privateKey = $rsa->getPrivateKey(RSA::PRIVATE_FORMAT_PKCS1);
        // $publicKey = $rsa->getPublicKey(RSA::PUBLIC_FORMAT_PKCS8);

        // // Generate W3C verifiable credential
        // $credentialData = [
        //     '@context' => [
        //         'https://www.w3.org/2018/credentials/v1',
        //         'https://www.techedacademy.com/context/v1', 
        //     ],
        //     'type' => ['VerifiableCredential', 'CourseCompletionCredential'],
        //     'issuer' => 'TechEd Academy',
        //     'issuanceDate' => now()->toIso8601String(),
        //     'credentialSubject' => [
        //         'id' => $this->generateDID(),
        //         'student_name' => $request->input('student_name'),
        //         'course_name' => $request->input('course_name'),
        //         'completion_date' => $request->input('completion_date'),
        //         // Add other necessary fields
        //     ],
        // ];
        // // Create a JWT token
        // $token = (new Builder())->withClaim('vc', $credentialData)->getToken();

        // // Sign the token with the private key
        // $token->sign(new \Lcobucci\JWT\Signer\Rsa\Sha256(), $privateKey);

        // // Output the verifiable credential token
        // // $token->toString();
        // // Write certificate data to CSV file
        // $data = [
        //     $request->input('student_name'),
        //     $request->input('course_name'),
        //     $request->input('completion_date'),
        //     $token->toString()
        //     // Add other necessary fields
        // ];
        // $line = implode(',', $data);
        // Storage::append('certificates.csv', $line);

        return response()->json(['message' => 'Certificate issued successfully'], 200);
    }

    public function verifyCertificate(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string',
            'course_name' => 'required|string',
            'completion_date' => 'required|date',
            // Add other validation rules as per your requirements
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Read certificate data from CSV file
        $certificates = collect(explode(PHP_EOL, Storage::get('certificates.csv')))
            ->map(function ($line) {
                return str_getcsv($line);
            });

        // Search for the certificate
        $certificateData = [
            $request->input('student_name'),
            $request->input('course_name'),
            $request->input('completion_date'),
            // Add other necessary fields
        ];

        $certificateExists = $certificates->contains(function ($cert) use ($certificateData) {
            return $cert == $certificateData;
        });

        if ($certificateExists) {
            return response()->json(['message' => 'Certificate verified successfully'], 200);
        } else {
            return response()->json(['error' => 'Certificate not found'], 404);
        }
    }

    private function generateDID(){
        // Generate a UUID (Universally Unique Identifier)
        $uuid = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );

        // DID using the DID:UUID method
        $did = 'did:uuid:' . $uuid;

        return  $did;

    }

    public function issue(Request $request){
        dd($request->all());
    }

    public function test(Request $req){
        dd($req->all());
    }
}
