<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use phpseclib3\Crypt\RSA;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;
use DateTimeImmutable;

class CertificateController extends Controller
{
    
    public function issueCertificate(Request $request)
    {
        
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText(random_bytes(32));

        $now   = new DateTimeImmutable();
        $token = $tokenBuilder
            // Configures the issuer (iss claim)
            ->issuedBy('http://example.com')
            // Configures the audience (aud claim)
            ->permittedFor('http://example.org')
            // Configures the subject of the token (sub claim)
            ->relatedTo('component1')
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
            ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
            ->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token (exp claim)
            ->expiresAt($now->modify('+1 hour'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('foo', 'bar')
            // Builds a new token
            ->getToken($algorithm, $signingKey);

        return  $token->toString()."dkjfhdsakgk";
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
        if(!Storage::exists('certificates.csv')){
            // Write student data to CSV file
            $data = [
                'Student Name', // Header
                'Course Name', // Header
                'Completion Date', // Header
                'Token',
                // Add other necessary headers
            ];

            $line = implode(',', $data);

            Storage::append('certificates.csv', $line);
        }
        

        // Generate a key pair for the issuer
        $rsa = RSA::createKey(2048);
        $privateKey = InMemory::plainText($rsa->toString("PKCS1"));
        $publicKey = $rsa->getPublicKey()->toString('PKCS8');
        dd($publicKey);
        // dd($rsa->getPublicKey()->toString('PKCS8'),$rsa->toString("PKCS1"));
        // $publicKey = $rsa->getPublicKey();
        // $privateKey = $rsa->toString();

        // Generate W3C verifiable credential
        $credentialData = [
            '@context' => [
                'https://www.w3.org/2018/credentials/v1',
                'https://www.techedacademy.com/context/v1', 
            ],
            'type' => ['VerifiableCredential', 'CourseCompletionCredential'],
            'issuer' => 'TechEd Academy',
            'issuanceDate' => now()->toIso8601String(),
            'credentialSubject' => [
                'id' => $this->generateDID(),
                'student_name' => $request->input('student_name'),
                'course_name' => $request->input('course_name'),
                'completion_date' => $request->input('completion_date'),
                // Add other necessary fields
            ],
        ];
        // Create a JWT token
        // $token = (new Builder())->withClaim('vc', $credentialData)->getToken();
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $token = $tokenBuilder->withClaim('vc', $credentialData)->getToken(new \Lcobucci\JWT\Signer\Hmac\Sha256(), $privateKey);

        // Sign the token with the private key
        // $token->sign(new \Lcobucci\JWT\Signer\Hmac\Sha256(), $privateKey);

        // Output the verifiable credential token
        // $token->toString();
        // Write certificate data to CSV file
        $data = [
            $request->input('student_name'),
            $request->input('course_name'),
            $request->input('completion_date'),
            $token->toString()
            // Add other necessary fields
        ];
        $line = implode(',', $data);
        Storage::append('certificates.csv', $line);

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
}
