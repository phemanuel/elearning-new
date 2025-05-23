<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Setting\AuthenticationController as auth;
use App\Http\Controllers\Backend\Setting\UserController as user;
use App\Http\Controllers\Backend\Setting\DashboardController as dashboard;
use App\Http\Controllers\Backend\Setting\RoleController as role;
use App\Http\Controllers\Backend\Setting\PermissionController as permission;
use App\Http\Controllers\Backend\Students\StudentController as student;
use App\Http\Controllers\Backend\Instructors\InstructorController as instructor;
use App\Http\Controllers\Backend\Courses\CourseCategoryController as courseCategory;
use App\Http\Controllers\Backend\Courses\CourseController as course;
use App\Http\Controllers\Backend\Courses\SegmentController as segment;
use App\Http\Controllers\Backend\Courses\MaterialController as material;
use App\Http\Controllers\Backend\Quizzes\QuizController as quiz;
use App\Http\Controllers\Backend\Project\ProjectController as project;
use App\Http\Controllers\Backend\Quizzes\QuestionController as question;
use App\Http\Controllers\Backend\Quizzes\OptionController as option;
use App\Http\Controllers\Backend\Quizzes\AnswerController as answer;
use App\Http\Controllers\Backend\Reviews\ReviewController as review;
use App\Http\Controllers\Backend\Communication\DiscussionController as discussion;
use App\Http\Controllers\Backend\Communication\MessageController as message;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchCourseController;
use App\Http\Controllers\SearchInstructorController;
use App\Http\Controllers\CheckoutController as checkout;
use App\Http\Controllers\CouponController as coupon;
use App\Http\Controllers\WatchCourseController as watchCourse;
use App\Http\Controllers\LessonController as lesson;
use App\Http\Controllers\EnrollmentController as enrollment;
use App\Http\Controllers\EventController as event;
use App\Http\Controllers\CustomForgotPasswordController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPlanController;

/* students */
use App\Http\Controllers\Students\AuthController as sauth;
use App\Http\Controllers\Students\DashboardController as studashboard;
use App\Http\Controllers\Students\ProfileController as stu_profile;
use App\Http\Controllers\Students\sslController as sslcz;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//------Reset Password Route
Route::get('/forgot-password', function () {
    return view('students.auth.forgot-password-instructor');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [CustomForgotPasswordController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}/{email}', function ($token,$email) {
    return view('students.auth.reset-password-instructor', ['token' => $token , 'email' => $email]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [CustomForgotPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');

//===========User/Instructor Verify email address routes================================
Route::get('user/email-verify', [MailController::class, 'emailVerifyInstructor'])
->name('email-verify-instructor');
Route::get('user/email-verify-done/{token}', [MailController::class, 'emailVerifyDoneInstructor'])
->name('email-verify-done-instructor');
Route::get('user/resend-verification-email', [MailController::class, 'resendEmailVerificationInstructor'])
->name('resend-verification-email.instructor');
Route::post('user/resend-verification', [MailController::class, 'resendVerificationInstructor'])
->name('resend-verification-instructor');
Route::post('user/email-not-verify', [MailController::class, 'emailNotVerifyInstructor'])
->name('email-not-verify-instructor');
    
//----Student reset password routes----------------
Route::get('user/forgot-password', function () {
    return view('students.auth.forgot-password');
})->middleware('guest')->name('user.password.request');
Route::post('user/forgot-password', [CustomForgotPasswordController::class, 'userForgotPassword'])
    ->middleware('guest')
    ->name('user.password.email');
Route::get('user/reset-password/{token}/{email}', function ($token,$email) {
    return view('students.auth.reset-password', ['token' => $token , 'email' => $email]);
})->middleware('guest')->name('user.password.reset');
Route::post('user/reset-password', [CustomForgotPasswordController::class, 'userResetPassword'])
    ->middleware('guest')
    ->name('user.password.update');

//===========Student Verify email address routes================================
Route::get('email-verify', [MailController::class, 'emailVerify'])
->name('email-verify');
Route::get('email-verify-done/{token}', [MailController::class, 'emailVerifyDone'])
->name('email-verify-done');
Route::get('resend-verification-email', [MailController::class, 'resendEmailVerification'])
->name('resend-verification-email');
Route::post('resend-verification', [MailController::class, 'resendVerification'])
->name('resend-verification');
Route::post('email-not-verify', [MailController::class, 'emailNotVerify'])
->name('email-not-verify');

//-----------------------
Route::get('/signup', [auth::class, 'signUpForm'])->name('register');
Route::post('/signup', [auth::class, 'signUpStore'])->name('register.store');
Route::get('/login', [auth::class, 'signInForm'])->name('login');
Route::post('/login', [auth::class, 'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class, 'signOut'])->name('logOut');


Route::middleware(['checkauth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [dashboard::class, 'index'])->name('dashboard');
    Route::get('userProfile', [auth::class, 'show'])->name('userProfile');
});

Route::middleware(['checkauth'])->prefix('admin')->group(function () {
    Route::resource('user', user::class); 
    Route::resource('role', role::class);
    Route::resource('student', student::class);
    Route::resource('instructor', instructor::class);
    Route::resource('courseCategory', courseCategory::class);
    Route::resource('course', course::class);
    Route::get('course-fee/', [course::class, 'courseFee'])->name('courseFee');
    Route::resource('certificates', CertificateController::class);
    Route::resource('segment', segment::class);
    Route::get('segment/add/{id}', [segment::class, 'createSegment'])->name('segment.createNew');
    Route::get('/courseList', [course::class, 'indexForAdmin'])->name('courseList');
    Route::patch('/courseList/{update}', [course::class, 'updateforAdmin'])->name('course.updateforAdmin');
    Route::resource('material', material::class);
    Route::get('material/add/{id}', [material::class, 'createMaterial'])->name('material.createNew');
    Route::get('editor', [material::class, 'editorShow'])->name('editor.show');
    Route::resource('lesson', lesson::class);
    Route::get('lessons/view/{id}', [lesson::class, 'show'])->name('lesson.view');
    Route::resource('event', event::class);
    Route::resource('quiz', quiz::class);
    Route::resource('project', project::class);
    Route::get('project/{id}/review', [project::class, 'review'])->name('project.review');
    Route::post('/review/update', [project::class, 'reviewUpdate'])->name('admin.review.update');
    Route::get('/review/filter', [project::class, 'filterProjects'])->name('admin.review.filter');
    Route::resource('question', question::class);
    Route::get('question/add/{id}', [question::class, 'createQuestion'])->name('question.createNew');
    Route::resource('option', option::class);
    Route::resource('answer', answer::class);
    Route::resource('review', review::class); 
    Route::resource('discussion', discussion::class);
    Route::resource('message', message::class);
    Route::resource('coupon', coupon::class);
    // -Subscription routes
    Route::resource('subscription', SubscriptionController::class);
    Route::post('/subscription/upgrade', [SubscriptionController::class, 'upgrade'])
    ->name('subscription.upgrade');
    Route::get('/subscriptionPlan/view', [SubscriptionController::class, 'subscriptionPlans'])
    ->name('subscription.view');
    Route::get('/subscribePlan/{id}', [SubscriptionController::class, 'subscribePlans'])
    ->name('subscribe.view');
    Route::post('/subscribePlan/{id}', [SubscriptionController::class, 'subscribePlansStore'])
    ->name('subscribe.store');
    Route::get('/subPlan/verifyTransaction/{ref}', [SubscriptionController::class, 'verifyTransaction'])
    ->name('sub.verify-transaction');    
    Route::get('/subPlan/cancel-transaction', [SubscriptionController::class, 'cancelTransaction'])
    ->name('sub.cancel-transaction');
    Route::get('/subPlan/error-transaction', [SubscriptionController::class, 'errorTransaction'])
    ->name('sub.error-transaction');
    Route::get('/subPlan/success-transaction', [SubscriptionController::class, 'successTransaction'])
    ->name('sub.success-transaction');
    Route::post('/subPlan/storeNoOfMonths', [SubscriptionController::class, 'storeNoOfMonths'])
    ->name('sub.storeNoOfMonths');
    Route::resource('subscriptionPlan', SubscriptionPlanController::class);
    //----------------------------------------------------------------
    Route::resource('enrollment', enrollment::class);
    Route::post('/enroll-student', [enrollment::class, 'enroll'])->name('enrollment.enroll');
    Route::get('permission/{role}', [permission::class, 'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class, 'save'])->name('permission.save'); 
    Route::get('/get-segments/{courseId}', [course::class, 'getSegments']);    
    Route::get('/customPlan', [HomeController::class, 'customPlan'])->name('customPlan');  
    Route::get('/contactReport', [HomeController::class, 'contactReport'])->name('contactReport');     

});

Route::get('/register', [HomeController::class, 'signUpForm'])->name('signup');

/* students controllers */
Route::get('/student/register', [sauth::class, 'signUpForm'])->name('studentRegister');
Route::post('/student/register', [sauth::class, 'signUpStore'])->name('studentRegister.store');

Route::get('/user/login', [sauth::class, 'signInForm'])->name('studentLogin');
Route::post('/student/login/{back_route}', [sauth::class, 'signInCheck'])->name('studentLogin.check');
Route::get('/user/logout', [sauth::class, 'signOut'])->name('studentlogOut');

Route::middleware(['checkstudent'])->prefix('students')->group(function () {
    Route::get('student/dashboard', [studashboard::class, 'index'])->name('studentdashboard');
    Route::get('/profile', [stu_profile::class, 'index'])->name('student_profile');
    Route::post('/profile/save', [stu_profile::class, 'save_profile'])->name('student_save_profile');
    Route::post('/profile/savePass', [stu_profile::class, 'change_password'])->name('change_password');
    Route::post('/change-image', [stu_profile::class, 'changeImage'])->name('change_image');

    // ssl Routes
//    Route::post('/payment/ssl/submit', [sslcz::class, 'store'])->name('payment.ssl.submit');
    Route::post('/payment/enrollee/submit', [PaymentController::class, 'getEnrollee'])
    ->name('payment.enrollee.submit');
    // ----payment routes --------------------------------
    Route::get('/payment/verify-transaction/{ref}', [PaymentController::class, 'verifyTransaction'])
    ->name('payment.verify-transaction');
    Route::get('/payment/cancel-transaction', [PaymentController::class, 'cancelTransaction'])
    ->name('payment.cancel-transaction');
    Route::get('/payment/error-transaction', [PaymentController::class, 'errorTransaction'])
    ->name('payment.error-transaction');
    Route::get('/payment/success-transaction', [PaymentController::class, 'successTransaction'])
    ->name('payment.success-transaction');
    Route::post('/update-progress', [ProgressController::class, 'updateProgress'])
    ->name('update.progress');
    Route::get('/load-lesson', [lesson::class, 'loadLesson'])->name('load.lesson');
    Route::get('watchCourse/{id}', [watchCourse::class, 'watchCourse'])->name('watchCourse');
    Route::get('/watchCourse/{id}/next', [watchCourse::class, 'watchCourseNext'])->name('watchCourseNext');
    Route::get('/project/{id}', [watchCourse::class, 'projectView'])->name('project-view');
    Route::post('/project/{id}/submission', [watchCourse::class, 'projectSubmission'])->name('project-submission');
    Route::get('courseSegment/{id}', [studashboard::class, 'courseSegment'])->name('courseSegment');
    Route::post('/review/store', [review::class, 'saveReviews'])->name('review.save');
    Route::get('/course-review/{courseId}', [review::class, 'getReviews'])->name('course-review');
    Route::post('/course-rating', [review::class, 'storeRating'])->name('course.rating.store');
    Route::get('/quiz/{quizId}/questions', [QuizController::class, 'getQuestions']);
    Route::post('/quiz/{quizId}/finish', [QuizController::class, 'finishQuiz']);
    Route::post('/quiz/save-answer', [QuizController::class, 'saveAnswer']);
    Route::post('/quiz/update-progress', [QuizController::class, 'updateProgress']);  
    Route::get('/certificate/{id}', [CertificateController::class, 'showCertificate'])
    ->name('certificate.show');    

});

//----------instructor routes --------------------------------
Route::get('/instructor/register/{id}', [sauth::class, 'instructorSignUpForm'])
->name('instructorRegister');
Route::post('/instructor/register/{back_route}', [sauth::class, 'instructorSignUpStore'])
->name('instructorRegister.store');
Route::get('/instructor/subscription', [sauth::class, 'instructorSubscription'])
->name('instructorSubscription');
Route::get('/instructor/subscription/pay/{id}', [sauth::class, 'instructorSubscriptionPay'])
->name('instructorSubscriptionPay');

 
// frontend pages
// Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('searchCourse', [SearchCourseController::class, 'index'])->name('searchCourse'); 
Route::get('searchInstructor', [SearchInstructorController::class, 'index'])->name('searchInstructor');
Route::get('course-category/{courseCategory}', [SearchCourseController::class, 'courseName'])->name('courseName'); 
Route::get('courseDetails/{id}', [course::class, 'frontShow'])->name('courseDetails');
Route::get('instructorProfile/{id}', [instructor::class, 'frontShow'])->name('instructorProfile');
Route::get('checkout', [checkout::class, 'index'])->name('checkout');
Route::post('checkout', [checkout::class, 'store'])->name('checkout.store');

// Cart
Route::get('/cart_page', [CartController::class, 'index']);
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

// Coupon
Route::post('coupon_check', [CartController::class, 'coupon_check'])->name('coupon_check');
/* ssl payment */
Route::post('/payment/ssl/notify', [sslcz::class, 'notify'])->name('payment.ssl.notify');
Route::post('/payment/ssl/cancel', [sslcz::class, 'cancel'])->name('payment.ssl.cancel');

Route::get('send-mail', [MailController::class, 'index'])
    ->name('send-mail');

Route::get('user/send-mail', [MailController::class, 'indexInstructor'])
    ->name('send-mail-instructor'); 

Route::post('mail-subscribe', [NewsletterController::class, 'subscribe'])
    ->name('mail-subscribe');

Route::get('about', [HomeController::class, 'about'])
    ->name('about'); 
Route::get('contact', [HomeController::class, 'contact'])
    ->name('contact'); 
Route::post('contact', [HomeController::class, 'contactAction'])
    ->name('contact.action');
Route::get('contact-sales', [HomeController::class, 'contactSales'])
    ->name('contact-sales');
Route::post('contact-sales', [HomeController::class, 'contactSalesAction'])
    ->name('contact-sales.action');

//---Course and Course Creators Url----
Route::get('/instructor-profile/{instructor_url}', [UrlController::class, 'instructorUrl'])
->name('instructor-url');
Route::get('/instructors/courses/{id}', [SearchInstructorController::class, 'instructorCourse']) 
->name('instructorCourse');
Route::get('/courses/{course_url}', [UrlController::class, 'courseUrl'])
->name('course-url');
Route::get('/test/dashboard', [dashboard::class, 'testDashboard'])
->name('testDashboard');

Route::get('/cert/{url}', [CertificateController::class, 'certificateUrl'])
    ->name('certificate-url');
Route::get('/cert/view/{url}', [CertificateController::class, 'certificateView'])
    ->name('certificate-view');
    Route::get('/test-video', [HomeController::class, 'testVideo'])->name('testVideo'); 

