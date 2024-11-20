<?php

namespace App\Http\Controllers;
//use PDF; 
use TCPDF;
use App\Models\Student; 
use App\Models\Course; 
use App\Models\Instructor;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Models\Certificate;
use Carbon\Carbon;

class CertificateController extends Controller
{
    //----Begin Backend----
    public function index()
    {   $userRoleId = auth()->user()->role_id;
        
        if ($userRoleId == 1){
            $data = Certificate::with(['instructor', 'course'])->get();
        return view('backend.certificate.index', compact('data'));
        }
        elseif ($userRoleId == 3) {
            $instructorId = auth()->user()->instructor_id;
            $data = Certificate::where('instructor_id', $instructorId)->with(['instructor', 'course'])->get();
        return view('backend.certificate.index', compact('data'));
        }
    }

    public function create()
    {
        $userRoleId = auth()->user()->role_id;
        
        if ($userRoleId == 1){
            $instructor = Instructor::all();
            $course = Course::all();
        }
        elseif ($userRoleId == 3) {
            $instructorId = auth()->user()->instructor_id;
            $instructor = Instructor::where('id', $instructorId)->first();
            $course = Course::where('instructor_id', $instructorId)->get();
        }

        return view('backend.certificate.create', compact('instructor','course'));
       
    }

    public function store(Request $request)
    {
        try {
            // Check if a certificate already exists for the given course_id
            $existingCertificate = Certificate::where('course_id', $request->courseId)->first();

            if ($existingCertificate) {
                // If a certificate exists, return a message indicating it can be edited
                return redirect()->back()->with('error', 'A certificate has already been added for this course. You can edit it instead.');
            }

            // Create a new Certificate instance
            $certificate = new Certificate();
            $certificate->course_id = $request->courseId;

            // Get the instructor for the course
            $course = Course::find($request->courseId);
            $certificate->instructor_id = $course->instructor_id;
            $certificate->certificate_type = $request->certificateType;

            // Assign certificate_id based on certificateType
            switch ($request->certificateType) {
                case 'Default':
                    $certificate->certificate_id = 2;
                    break;
                case 'Nova':
                    $certificate->certificate_id = 3;
                    break;
                case 'Inspire':
                    $certificate->certificate_id = 4;
                    break;
                case 'Eclipse':
                    $certificate->certificate_id = 5;
                    break;
                case 'Kings Digi Hub':
                    $certificate->certificate_id = 1;
                    break;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/signatures'), $imageName);
                $certificate->image = $imageName;
            }

            // Save the new certificate
            if ($certificate->save()) {
                return redirect()->route('certificates.index')->with('success', 'Data Saved');
            } else {
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }

    public function edit($id)
    {   
        $decryptedId = encryptor('decrypt', $id);
        $certificate = Certificate::with(['instructor', 'course'])
        ->where('id', $decryptedId)
        ->firstOrFail();
        
        return view('backend.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {           
            // Find the student by ID
            $certificate = Certificate::findOrFail(encryptor('decrypt', $id));
            
            // Update student fields            
                $certificate->certificate_type = $request->certificateType;
                switch ($request->certificateType) {
                    case 'Default':
                        $certificate->certificate_id = 2;
                        break;
                    case 'Nova':
                        $certificate->certificate_id = 3;
                        break;
                    case 'Inspire':
                        $certificate->certificate_id = 4;
                        break;
                    case 'Eclipse':
                        $certificate->certificate_id = 5;
                        break;
                    case 'Kings Digi Hub':
                        $certificate->certificate_id = 1;
                        break;
                } 
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/signatures'), $imageName);
                $certificate->image = $imageName;
            }

            // Save the student record
            if ($certificate->save()) {
                return redirect()->route('certificates.index')->with('success', 'Data Saved');
            } else {
                return redirect()->back()->withInput()->with('error', 'Please try again');
            }
        } catch (Exception $e) {
            // Debug the exception
            //dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    } 
    //-----End Backend-----
    //----Begin Frontend-----

    public function showCertificate($id)
    {
        $studentId = currentUserId();
        $courseId = encryptor('decrypt', $id);
        $course = Course::where('id', $courseId)->first();
        $student = Student::where('id', $studentId)->first();
        $recipientName = $student->name_en;
        $enrollment = Enrollment::where('student_id', $studentId)
        ->where('course_id', $courseId)->first();
        $courseName = $course->title_en;
        $instructor = Certificate::where('instructor_id', $course->instructor_id)->first();
        $instructorSign = $instructor->image;
        $instructorNew = Instructor::where('id', $course->instructor_id)->first();
        $instructorName = $instructorNew->name_en;
        //$completionDate = Carbon::parse($enrollment->completion_date)->format('jS F, Y'); //8th November, 2024
        $completionDate = date('F j, Y', strtotime($enrollment->completion_date)); // November 8, 2024
        $certificateUrl = $enrollment->certificate_link; // Fetches certificate URL

        // Fetch the certificate based on course_id
        $certificate = Certificate::where('course_id', $courseId)->first();

        // Check if the certificate exists before proceeding
        if (!$certificate) {
            return redirect()->back()->with('error', 'Certificate not found for this course.');
        }

        // Switch based on certificate type and call corresponding function
        switch ($certificate->certificate_type) {
            case 'Default':
                return $this->generateDefaultCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Nova':
                return $this->generateNovaCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Inspire':
                return $this->generateInspireCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Eclipse':
                return $this->generateEclipseCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Kings Digi Hub':
                return $this->generateKingsDigiHubCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            default:
                return redirect()->back()->with('error', 'Certificate type not recognized.');
        }
    }

    protected function generateDefaultCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName)
    {
        // Logic for generating the Default certificate
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information        
        $pdf->SetAuthor('Kings Digital Literacy Hub');
        $pdf->SetTitle($courseName . ' Course Certificate');
        $pdf->SetSubject('PDF Subject');   

        // Set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Add a page
        $pdf->AddPage();

        // Define the path to the background image
        $imagePath = public_path('uploads/certificates/cert1_empty.png');
        $logoPath = public_path('images/kdh_logo_small.png');
        $kdhSignaturePath = public_path('uploads/certificates/femi_sign.png');
        $instrSignaturePath = public_path('uploads/signatures/'. $instructorSign);

        // Get the page width and height after applying margins
        $pageWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
        $pageHeight = $pdf->getPageHeight() - $pdf->getMargins()['top'] - $pdf->getMargins()['bottom'];

        // Get the original width and height of the image
        list($imgWidth, $imgHeight) = getimagesize($imagePath);

        // Calculate aspect ratio of the image
        $imgAspectRatio = $imgWidth / $imgHeight;

        // Calculate new dimensions to fit within page bounds without stretching
        if ($pageWidth / $pageHeight > $imgAspectRatio) {
            // If page is wider than image, fit by height
            $newHeight = $pageHeight;
            $newWidth = $pageHeight * $imgAspectRatio;
        } else {
            // If page is taller than image, fit by width
            $newWidth = $pageWidth;
            $newHeight = $pageWidth / $imgAspectRatio;
        }

        // Center the image on the page
        $x = ($pageWidth - $newWidth) / 2 + $pdf->getMargins()['left'];
        $y = ($pageHeight - $newHeight) / 2 + $pdf->getMargins()['top'];

        // Add the background image with the adjusted dimensions
        $pdf->Image($imagePath, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Set the position to add content (above the background)
        $pdf->SetXY(10, 30); // Adjust as needed        
 
         // Define the HTML content
         $html = <<<EOD
           <table width="100%" border="0" >  
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td width="10">&nbsp;</td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
              <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4" style="font-family: 'Courier New', monospace; font-size: 28px; font-weight: bold;"><span class="style3">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 $recipientName</span></td>
                 <td>&nbsp;</td>
             </tr> 
             <br>
              <tr>
                <td align="center" style="font-family: 'Times New Roman', sans-serif; font-size: 13px; color:black">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td colspan="3" align="center" style="font-family: 'Times New Roman', sans-serif; font-size: 13px; color:black">
                For successfully completing the <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#b8860b;"><strong>$courseName</strong></span><br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course offered by Kings Digital Literacy Hub</td>
            </tr>                             
                       
             
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>             
             <br>             
             <tr>
                 <td width="104">&nbsp;</td>
                 <td width="218">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;<img src="$instrSignaturePath" width="110" height="15"/></td>
               <td>
                 &nbsp;&nbsp;&nbsp;&nbsp;</td>
                 <td width="453">&nbsp;</td>
               <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;</td>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 14px; ">&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;$instructorName<br />
                 <span style="font-family: 'Time New Roman', sans-serif; font-size: 10px; font-weight: bold;">&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course Trainer</span></td>
                 <td width="175" align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">               </td>
                 <td align="left" style="font-family: 'Time New Roman', sans-serif; font-size: 10px; font-weight: bold;">
                 <strong><span style="font-family: 'Arial', sans-serif; font-size: 10px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 $completionDate</span><br />
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KINGS DIGITAL LITERACY HUB</strong></td>
                 <td align="left" style="font-family: 'Time New Romans', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
             </tr>
             <tr>
               <td height="21" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
               <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="center"></div></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td height="21" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
               <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="center"></div></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
                 <td height="21" colspan="5" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="left">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm program completion at <span style="color:blue;">https://kingsdigihub.org/cert/$certificateUrl</span></div></td>
             </tr>
             </table>   
         EOD;
 
         // Write the HTML content
         $pdf->writeHTML($html, true, false, true, false, '');

         if ($pdf->getPage() > 1) {
            $pdf->deletePage(2); // Remove the second page if created unintentionally
        }
 
         // Close and output PDF document
         return $pdf->Output($recipientName. '-' . $courseName . '-'.'certificate.pdf', 'I');
    
    }

    protected function generateNovaCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName)
    {
        // Logic for generating the Nova certificate
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information        
        $pdf->SetAuthor('Kings Digital Literacy Hub');
        $pdf->SetTitle($courseName . ' Course Certificate');
        $pdf->SetSubject('PDF Subject');   

        // Set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Add a page
        $pdf->AddPage();

        // Define the path to the background image
        $imagePath = public_path('uploads/certificates/cert2_empty.png');
        $logoPath = public_path('images/kdh_logo_small.png');
        $kdhSignaturePath = public_path('uploads/certificates/femi_sign.png');
        $instrSignaturePath = public_path('uploads/signatures/'. $instructorSign);

        // Get the page width and height after applying margins
        $pageWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
        $pageHeight = $pdf->getPageHeight() - $pdf->getMargins()['top'] - $pdf->getMargins()['bottom'];

        // Get the original width and height of the image
        list($imgWidth, $imgHeight) = getimagesize($imagePath);

        // Calculate aspect ratio of the image
        $imgAspectRatio = $imgWidth / $imgHeight;

        // Calculate new dimensions to fit within page bounds without stretching
        if ($pageWidth / $pageHeight > $imgAspectRatio) {
            // If page is wider than image, fit by height
            $newHeight = $pageHeight;
            $newWidth = $pageHeight * $imgAspectRatio;
        } else {
            // If page is taller than image, fit by width
            $newWidth = $pageWidth;
            $newHeight = $pageWidth / $imgAspectRatio;
        }

        // Center the image on the page
        $x = ($pageWidth - $newWidth) / 2 + $pdf->getMargins()['left'];
        $y = ($pageHeight - $newHeight) / 2 + $pdf->getMargins()['top'];

        // Add the background image with the adjusted dimensions
        $pdf->Image($imagePath, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Set the position to add content (above the background)
        $pdf->SetXY(10, 30); // Adjust as needed        
 
         // Define the HTML content
         $html = <<<EOD
           <table width="100%" border="0" >  
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td width="128">&nbsp;</td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
              <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
            <tr>
                 <td>&nbsp;</td>
                 <td width="50">&nbsp;</td>
                 <td width="369" style="font-family: 'Courier New', monospace; font-size: 25px; font-weight: bold; color:#b8860b;"><div align="center"><span class="style3">
                 $recipientName</span></div></td>
                 <td width="368">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;For the successful completion of the <strong>$courseName</strong> Certification program
                 on <strong>$completionDate</strong></div></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
             <br>
             <tr>
                 <td width="45">&nbsp;</td>
                 <td colspan="3">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <img src="$instrSignaturePath" width="110" height="15"/> &nbsp;&nbsp;&nbsp;&nbsp;</td>
               <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;</td>
                 <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 14px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 $instructorName<br />
                 <span style="font-family: 'Time New Roman', sans-serif; font-size: 10px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Course Trainer</span>               </td>
                 <td align="left" style="font-family: 'Time New Romans', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
             </tr>
                <br>        
             <tr>
                 <td height="21" colspan="5" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="left">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm program completion at <span style="color:blue;">https://kingsdigihub.org/cert/$certificateUrl</span></div></td>
             </tr>
             </table>            
         EOD;
 
         // Write the HTML content
         $pdf->writeHTML($html, true, false, true, false, '');

         if ($pdf->getPage() > 1) {
            $pdf->deletePage(2); // Remove the second page if created unintentionally
        }
 
         // Close and output PDF document
         return $pdf->Output($recipientName. '-' . $courseName . '-'.'certificate.pdf', 'I');
    }

    protected function generateInspireCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName)
    {
        // Logic for generating the Inspire certificate
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information        
        $pdf->SetAuthor('Kings Digital Literacy Hub');
        $pdf->SetTitle($courseName . ' Course Certificate');
        $pdf->SetSubject('PDF Subject');   

        // Set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Add a page
        $pdf->AddPage();

        // Define the path to the background image
        $imagePath = public_path('uploads/certificates/cert3_empty.png');
        $logoPath = public_path('images/kdh_logo_small.png');
        $kdhSignaturePath = public_path('uploads/certificates/femi_sign.png');
        $instrSignaturePath = public_path('uploads/signatures/'. $instructorSign);

        // Get the page width and height after applying margins
        $pageWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
        $pageHeight = $pdf->getPageHeight() - $pdf->getMargins()['top'] - $pdf->getMargins()['bottom'];

        // Get the original width and height of the image
        list($imgWidth, $imgHeight) = getimagesize($imagePath);

        // Calculate aspect ratio of the image
        $imgAspectRatio = $imgWidth / $imgHeight;

        // Calculate new dimensions to fit within page bounds without stretching
        if ($pageWidth / $pageHeight > $imgAspectRatio) {
            // If page is wider than image, fit by height
            $newHeight = $pageHeight;
            $newWidth = $pageHeight * $imgAspectRatio;
        } else {
            // If page is taller than image, fit by width
            $newWidth = $pageWidth;
            $newHeight = $pageWidth / $imgAspectRatio;
        }

        // Center the image on the page
        $x = ($pageWidth - $newWidth) / 2 + $pdf->getMargins()['left'];
        $y = ($pageHeight - $newHeight) / 2 + $pdf->getMargins()['top'];

        // Add the background image with the adjusted dimensions
        $pdf->Image($imagePath, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Set the position to add content (above the background)
        $pdf->SetXY(10, 30); // Adjust as needed        
 
         // Define the HTML content
         $html = <<<EOD
           <table width="100%" border="0" >  
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td width="128">&nbsp;</td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
              <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             
            <tr>
                 <td>&nbsp;</td>
                 <td width="51">&nbsp;</td>
                 <td width="368" style="font-family: 'Courier New', monospace; font-size: 25px; font-weight: bold; color:#b8860b;"><div align="center"><span class="style3">
              $recipientName</span></div></td>
              <td width="368">&nbsp;</td>
                 <td>&nbsp;</td>
                </tr>
             <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;For completing the <strong>$courseName</strong> Certification program
                 on <strong>$completionDate</strong></div></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
            <br>
             <tr>
                 <td width="45">&nbsp;</td>
                 <td colspan="3">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <img src="$instrSignaturePath" width="110" height="15"/> &nbsp;&nbsp;&nbsp;&nbsp;</td>
               <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;</td>
                 <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 14px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 $instructorName<br />
                 <span style="font-family: 'Time New Roman', sans-serif; font-size: 10px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lead Instructor</span>               </td>
                 <td align="left" style="font-family: 'Time New Romans', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
             </tr>
                <br>        
             <tr>
                 <td height="21" colspan="5" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="left">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Confirm program completion at <span style="color:blue;">https://kingsdigihub.org/cert/$certificateUrl</span></div></td>
             </tr>
             </table>      
         EOD;
 
         // Write the HTML content
         $pdf->writeHTML($html, true, false, true, false, '');

         if ($pdf->getPage() > 1) {
            $pdf->deletePage(2); // Remove the second page if created unintentionally
        }
 
         // Close and output PDF document
         return $pdf->Output($recipientName. '-' . $courseName . '-'.'certificate.pdf', 'I');
    }

    protected function generateEclipseCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName)
    {
        // Logic for generating the Eclipse certificate
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information        
        $pdf->SetAuthor('Kings Digital Literacy Hub');
        $pdf->SetTitle($courseName . ' Course Certificate');
        $pdf->SetSubject('PDF Subject');   

        // Set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Add a page
        $pdf->AddPage();

        // Define the path to the background image
        $imagePath = public_path('uploads/certificates/cert4_empty.png');
        $logoPath = public_path('images/kdh_logo_small.png');
        $kdhSignaturePath = public_path('uploads/certificates/femi_sign.png');
        $instrSignaturePath = public_path('uploads/signatures/'. $instructorSign);

        // Get the page width and height after applying margins
        $pageWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
        $pageHeight = $pdf->getPageHeight() - $pdf->getMargins()['top'] - $pdf->getMargins()['bottom'];

        // Get the original width and height of the image
        list($imgWidth, $imgHeight) = getimagesize($imagePath);

        // Calculate aspect ratio of the image
        $imgAspectRatio = $imgWidth / $imgHeight;

        // Calculate new dimensions to fit within page bounds without stretching
        if ($pageWidth / $pageHeight > $imgAspectRatio) {
            // If page is wider than image, fit by height
            $newHeight = $pageHeight;
            $newWidth = $pageHeight * $imgAspectRatio;
        } else {
            // If page is taller than image, fit by width
            $newWidth = $pageWidth;
            $newHeight = $pageWidth / $imgAspectRatio;
        }

        // Center the image on the page
        $x = ($pageWidth - $newWidth) / 2 + $pdf->getMargins()['left'];
        $y = ($pageHeight - $newHeight) / 2 + $pdf->getMargins()['top'];

        // Add the background image with the adjusted dimensions
        $pdf->Image($imagePath, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Set the position to add content (above the background)
        $pdf->SetXY(10, 30); // Adjust as needed        
 
         // Define the HTML content
         $html = <<<EOD
           <table width="100%" border="0" >               
            <tr>
                            <td colspan="4">&nbsp;</td>
                            <td width="128">&nbsp;</td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
              <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>                          
            <tr>
                            <td>&nbsp;</td>
                            <td width="24">&nbsp;</td>
            <td width="395" style="font-family: 'Courier New', monospace; font-size: 25px; font-weight: bold; color:#b8860b;"><div align="center"><span class="style3">
                        $recipientName</span></div></td>
                <td width="368">&nbsp;</td>
                            <td>&nbsp;</td>
                </tr>
                
             <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;in recognition of his/her hard work and dedication in completing the <strong>$courseName</strong> 
                  online course on <strong>$completionDate</strong></div></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr> 
            <br>
             <tr>
                 <td width="45">&nbsp;</td>
                 <td colspan="3">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <img src="$instrSignaturePath" width="110" height="15"/> &nbsp;&nbsp;&nbsp;&nbsp;</td>
               <td>&nbsp;</td>
             </tr>             
             <tr>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;</td>
                 <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 14px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 $instructorName<br />
                 <span style="font-family: 'Time New Roman', sans-serif; font-size: 11px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Instructor</span>               </td>
                 <td align="left" style="font-family: 'Time New Romans', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
             </tr>
                <br>        
             <tr>
                 <td height="21" colspan="5" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="left">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                 
                Confirm program completion at <span style="color:blue;">https://kingsdigihub.org/cert/$certificateUrl</span></div></td>
             </tr>
             </table>  
         EOD;
 
         // Write the HTML content
         $pdf->writeHTML($html, true, false, true, false, '');

         if ($pdf->getPage() > 1) {
            $pdf->deletePage(2); // Remove the second page if created unintentionally
        }
 
         // Close and output PDF document
         return $pdf->Output($recipientName. '-' . $courseName . '-'.'certificate.pdf', 'I');
    }

    protected function generateKingsDigiHubCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName)
    {
        // Logic for generating the Kings Digi Hub certificate
         // Create new PDF document in landscape orientation
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information        
        $pdf->SetAuthor('Kings Digital Literacy Hub');
        $pdf->SetTitle($courseName .' Course Certificate');
        $pdf->SetSubject('PDF Subject');   

        // Set header and footer fonts
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);

        // Set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // Add a page
        $pdf->AddPage();

        // Define the path to the background image
         $imagePath = public_path('uploads/certificates/kdh_empty.png');
         $logoPath = public_path('images/kdh_logo_small.png');
         $kdhSignaturePath = public_path('uploads/certificates/femi_sign.png');
         $instrSignaturePath = public_path('uploads/signatures/'. $instructorSign);

        // Get the page width and height after applying margins
        $pageWidth = $pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];
        $pageHeight = $pdf->getPageHeight() - $pdf->getMargins()['top'] - $pdf->getMargins()['bottom'];

        // Get the original width and height of the image
        list($imgWidth, $imgHeight) = getimagesize($imagePath);

        // Calculate aspect ratio of the image
        $imgAspectRatio = $imgWidth / $imgHeight;

        // Calculate new dimensions to fit within page bounds without stretching
        if ($pageWidth / $pageHeight > $imgAspectRatio) {
            // If page is wider than image, fit by height
            $newHeight = $pageHeight;
            $newWidth = $pageHeight * $imgAspectRatio;
        } else {
            // If page is taller than image, fit by width
            $newWidth = $pageWidth;
            $newHeight = $pageWidth / $imgAspectRatio;
        }

        // Center the image on the page
        $x = ($pageWidth - $newWidth) / 2 + $pdf->getMargins()['left'];
        $y = ($pageHeight - $newHeight) / 2 + $pdf->getMargins()['top'];

        // Add the background image with the adjusted dimensions
        $pdf->Image($imagePath, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Set the position to add content (above the background)
        $pdf->SetXY(10, 30); // Adjust as needed        
 
         // Define the HTML content
         $html = <<<EOD
             <table width="100%" border="0" >  
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td width="10">&nbsp;</td>
            </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4" style="font-family: 'Courier New', monospace; font-size: 28px; font-weight: bold;"><span class="style3">
                 &nbsp;&nbsp;&nbsp;&nbsp;$recipientName</span></td>
                 <td>&nbsp;</td>
             </tr>
                  <br>     
             <tr>
                <td colspan="4" style="font-family: 'Times New Roman', sans-serif; font-size: 18px; color:black">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;has successfully completed:</td>
                <td>&nbsp;</td>
            </tr>
             <br>
             <tr>
                <td colspan="4" style="font-family: 'Times New Roman', sans-serif; font-size: 30px; font-weight: bold; color:#c18500;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$courseName</td>
                <td>&nbsp;</td>
            </tr>
            <br>
            <tr>
                 <td colspan="4">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An Intensive <strong>Blueprint program</strong> offered by
                 <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kings Digital Literacy Hub</strong>                 </td>
                 <td>&nbsp;</td>
             </tr>
             
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td colspan="4">&nbsp;</td>
                 <td>&nbsp;</td>
             </tr>             
             <br>
             <br>
             <tr>
                 <td width="104">&nbsp;</td>
                 <td width="218">
                 <img src="$instrSignaturePath" width="110" height="15"/></td>
               <td>
                 &nbsp;&nbsp;&nbsp;&nbsp;<img src="$kdhSignaturePath" width="110" height="15"/></td>
                 <td colspan="2"><span style="font-family: 'Arial', sans-serif; font-size: 10px; font-weight: bold;">
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;$completionDate</span></td>
             </tr>             
             <tr>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;</td>
                 <td align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;$instructorName<br />
                 <span style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;">Lead Instructor, SMM&nbsp;Blueprint</span></td>
                 <td width="223" align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;">
               &nbsp;&nbsp;&nbsp;&nbsp;Femi Akinyooye<br />
               <span style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;&nbsp;&nbsp;
               &nbsp;Project Manager, SMM&nbsp;Blueprint</span></td>
                 <td colspan="2" align="left" style="font-family: 'Arial', sans-serif; font-size: 12px; font-weight: bold;"><span style="font-family: 'Arial', sans-serif; font-size: 8px;"><span class="style5">KBC has confirmed the participation<br />
               of this individual in this program</span></span></td>
             </tr>
             <tr>
               <td height="21" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;">&nbsp;</td>
               <td colspan="3" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="center"></div></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
                 <td height="21" colspan="5" align="left" style="font-family: 'Arial', sans-serif; font-size: 8px; font-weight: bold;"><div align="center">
                 Confirm program completion at <span style="color:blue;">https://kingsdigihub.org/cert/$certificateUrl</span></div></td>
             </tr>
             </table>
         EOD;
 
         // Write the HTML content
         $pdf->writeHTML($html, true, false, true, false, '');

         if ($pdf->getPage() > 1) {
            $pdf->deletePage(2); // Remove the second page if created unintentionally
        }
 
         // Close and output PDF document
         return $pdf->Output($recipientName. '-' . $courseName . '-'.'certificate.pdf', 'I');
    }
    
    public function certificateUrl($url)
    {
        //----get the record that relates to the url
        $data = Enrollment::where('certificate_link', $url)->first();

        if (!$data) {
            return view('frontend.certificate-not-verify');
        }
        $studentId = $data->student_id;
        $studentInfo = Student::where('id', $studentId)->first();
        $course = Course::where('id', $data->course_id)->first();

        return view('frontend.certificate-verify', compact('data', 'studentInfo','course'));
       

    }

    public function certificateView($url)
    {
        //----get the record that relates to the url
        $data = Enrollment::where('certificate_link', $url)->first();

        $studentId = $data->student_id;
        $courseId = $data->course_id;
        $course = Course::where('id', $courseId)->first();
        $student = Student::where('id', $studentId)->first();
        $recipientName = $student->name_en;
        // $enrollment = Enrollment::where('student_id', $studentId)
        // ->where('course_id', $courseId)->first();
        $courseName = $course->title_en;
        $instructor = Certificate::where('instructor_id', $course->instructor_id)->first();
        $instructorSign = $instructor->image;
        $instructorNew = Instructor::where('id', $course->instructor_id)->first();
        $instructorName = $instructorNew->name_en;
        //$completionDate = Carbon::parse($enrollment->completion_date)->format('jS F, Y'); //8th November, 2024
        $completionDate = date('F j, Y', strtotime($data->completion_date)); // November 8, 2024
        $certificateUrl = $data->certificate_link; // Fetches certificate URL

        // Fetch the certificate based on course_id
        $certificate = Certificate::where('course_id', $courseId)->first();

        // Check if the certificate exists before proceeding
        if (!$certificate) {
            return redirect()->route('home')->with('error', 'Certificate not found for this course.');
        }

        // Switch based on certificate type and call corresponding function
        switch ($certificate->certificate_type) {
            case 'Default':
                return $this->generateDefaultCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Nova':
                return $this->generateNovaCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Inspire':
                return $this->generateInspireCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Eclipse':
                return $this->generateEclipseCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            case 'Kings Digi Hub':
                return $this->generateKingsDigiHubCertificate($recipientName, $courseName, $completionDate,$certificateUrl,$instructorSign,$instructorName);
            default:
                return redirect()->back()->with('error', 'Certificate type not recognized.');
        }

    }

}
