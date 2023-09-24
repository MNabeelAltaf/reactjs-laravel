<?php


namespace App\Http\Controllers;

use App\Models\Contact;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class reactjs_message extends Controller
{

    private $email;
    private $message;

    public function sendingResponse(Request $request)
    {

        $email = $this->email = $request->input("email");
        $message = $this->message = $request->input("message");

        // error_log("messgae->" . $message . " " . "email->" . $email);

        // file to store email and message comming from react js 
        // file path  => storage/app/textfiles
        $fileName = 'reactjs_data.txt';


        // for encryption of data before storing to file
        // $email = Crypt::encrypt($email);
        // $message = Crypt::encrypt($message);

        // Create the content to be written to the file
        $content = "Email: $email\nMessage: $message\n";

        // Use the Storage facade to write the content to the file
        Storage::put("textfiles/$fileName", $content);


        // sending response to react in json
        $jsonResponse = [
            'success' => true,
            'message' => 'Message received'
        ];

        // Return the JSON response
        return response()->json($jsonResponse);
    }


    function returning_view()
    {

        $filePath = 'textfiles/reactjs_data.txt';
        $fileContent = Storage::get($filePath);


        // Retrieve the encrypted values from the file content
        // $lines = explode("\n", $fileContent);
        // $emailLine = explode(": ", $lines[0]);
        // $messageLine = explode(": ", $lines[1]);

        // // Decrypt the encrypted values
        // $email = Crypt::decrypt($emailLine[1]);
        // $message = Crypt::decrypt($messageLine[1]);

        // error_log($email." - ".$message);


        // Use a regular expression to find email addresses in the content
        // for apply checks on email  

        // $pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';
        // preg_match($pattern, $fileContent, $matches);

        // if (!empty($matches)) {
        //     $email = $matches[0]; // The first match is the email address
        // } else {
        //     $email = 'Email not found';
        // }

        // if ($email == "xyz123@xyz.com") {

        //     error_log("email is ".$email);
        // }

        return view('msg', ['fileContent' => $fileContent]);
    }


    function sending_data_back()
    {
        $filePath = 'textfiles/reactjs_data.txt';
        $fileContent = Storage::get($filePath);

        return response()->json($fileContent);
    }
}
