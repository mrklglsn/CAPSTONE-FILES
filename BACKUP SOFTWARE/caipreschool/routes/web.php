<?php

use App\Http\Controllers\ActivityRecordController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ParentSideController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentSideController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AssessmentRecordController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {  
    
    if(session()->has('LoggedUser')){
        $user = User::where('id', '=', session('LoggedUser'))->first();
        if($user->is_admin == 0){
            return redirect('parent/home');
        }
        else{
            return redirect('admin/dashboard');
        }
        
    }
    
    return view('index');
})->name('index');

Route::post('/save', [MainController::class, 'save'] )->name('auth.save');

Route::post('/check', [LoginController::class, 'login'] )->name('auth.check');

Route::group(['middleware' => ['AuthCheck']],function(){

    //LOGIN, LOGOUT AND REGISTER CONTROLLERS
    Route::get('/login', [MainController::class, 'login'] )->name('login');

    Route::get('/logout', [LoginController::class, 'logout'] )->name('logout');

    Route::get('/register', [MainController::class, 'register'] )->name('register');

    
    //DASHBOARD CONTROLLERS
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin/dashboard/manage-students', [AdminController::class, 'manageStudents'])->name('dashboard.managestudents');

    Route::get('/admin/dashboard/manage-subjects', [AdminController::class, 'manageSubjects'])->name('dashboard.managesubjects');

    Route::get('/admin/dashboard/manage-announcements', [AdminController::class, 'manageAnnouncements'])->name('dashboard.manageannouncements');

    Route::get('/admin/dashboard/manage-assessments/{id?}', [AdminController::class, 'manageAssessments'])->name('dashboard.manageassessments');

    Route::get('/admin/dashboard/manage-topics', [AdminController::class, 'manageTopics'])->name('dashboard.managetopics');

    Route::get('/admin/dashboard/manage-faqs', [AdminController::class, 'manageFaqs'])->name('dashboard.managefaqs');

    Route::get('/admin/dashboard/manage-videos', [AdminController::class, 'manageVideos'])->name('dashboard.managevideos');

    Route::get('/admin/dashboard/manage-video-category', [AdminController::class, 'manageCategories'])->name('dashboard.managecategories');

    //MANAGE PARENT CONTROLLERS
    Route::get('/admin/dashboard/manage-parents', [ParentController::class, 'index'])->name('dashboard.manageparents');
 
    Route::get('/admin/dashboard/manage-parents/restoreAll', [ParentController::class, 'restore_all'])->name('users.restore_all');
    
    Route::get('/admin/dashboard/manage-parents/recover/{id?}', [ParentController::class, 'restore'] )->name('users.recover');

    Route::resource('users', ParentController::class);

    //MANAGE STUDENT CONTROLLERS

    Route::resource('students', StudentController::class);

    //MANAGE SUBJECT CONTROLLERS

    Route::resource('subjects', SubjectController::class);

    Route::get('/admin/dashboard/manage-subjects/recover/{id?}', [SubjectController::class, 'restore'] )->name('subjects.recover');

     //MANAGE ASSESSMENTS CONTROLLERS

    Route::resource('assessments', AssessmentController::class);

    Route::get('/admin/dashboard/manage-assessments/recover/{id?}', [AssessmentController::class, 'restore'] )->name('assessments.recover');

    Route::get('/admin/dashboard/manage-assessments/questions/{id?}', [AssessmentController::class, 'manageQuestions'] )->name('assessments.manage');
    

    //MANAGE QUESTIONS CONTROLLERS
    Route::resource('questions', QuestionController::class);

    //MANAGE FAQS CONTROLLERS

    Route::resource('faqs', FaqsController::class);

    Route::get('/admin/dashboard/manage-faqs/recover/{id?}', [FaqsController::class, 'restore'] )->name('faqs.recover');

    //MANAGE ANNOUNCEMENTS CONTROLLERS

    Route::resource('announcement', AnnouncementController::class);

    Route::get('/admin/dashboard/manage-announcements/recover/{id?}', [AnnouncementController::class, 'restore'] )->name('announcement.recover');

    //PROFILE CONTROLLERS

    Route::get('/admin/dashboard/profile', [ProfileController::class, 'adminProfile'])->name('dashboard.profile');

    Route::resource('profile', ProfileController::class);

    //PHOTO CONTROLLER

    Route::resource('photo', PhotoController::class);

    //VIDEO CONTROLLER

    Route::resource('videos', VideoController::class);


    //PARENT SIDE CONTROLLER
   
    Route::get('/parent/home', [ParentSideController::class, 'home'])->name('parent/home');

    Route::get('/parent/profile/{LoggedUser?}', [ParentSideController::class, 'profile'])->name('parent/profile');

    Route::get('/parent/profile/add/student/', [ParentSideController::class, 'addStudent'])->name('parent/profile/add');
    
    Route::get('/parent/profile/edit/{LoggedUser?}', [ParentSideController::class, 'editProfile'])->name('parent/profile_edit');

    Route::get('/parent/profile/view/student/{student_id?}', [ParentSideController::class, 'viewStudent'])->name('parent/profile/view');

    Route::get('/parent/profile/view/student/edit/{student_id?}', [ParentSideController::class, 'editStudent'])->name('parent/profile/edit');

    Route::post('/parent/profile/add/student/submit', [ParentSideController::class, 'addNewStudent'])->name('parent/profile/add/submit');


    //STUDENT SIDE CONTROLLER

    Route::get('/student/home/{id?}', [StudentSideController::class, 'home'])->name('student/home');

    Route::get('/student/english_area', [StudentSideController::class, 'viewEnglishArea'])->name('student/english_area');

    Route::get('/student/math_area', [StudentSideController::class, 'viewMathArea'])->name('student/math_area');

    Route::get('/student/science_area', [StudentSideController::class, 'viewScienceArea'])->name('student/science_area');

    //ENGLISH GAMES
    Route::get('/student/english_area/assessment/{id?}', [GameController::class, 'openAssessment'])->name('student/english_area/assessment');

    Route::get('/student/english_area/activity/1', [GameController::class, 'game1'])->name('student/english_area/activity1');
    
    Route::get('/student/english_area/activity/3', [GameController::class, 'game3'])->name('student/english_area/activity2');

    Route::get('/student/science_area/activity/4', [GameController::class, 'openChoosingLetter'])->name('student/english_area/activity3');

    //MATH GAMES
    Route::get('/student/math_area/assessment/{id?}', [GameController::class, 'openAssessment'])->name('student/math_area/assessment');

    Route::get('/student/math_area/activity/1', [GameController::class, 'openTriangleTracing'])->name('student/math_area/activity1');

    Route::get('/student/math_area/activity/2', [GameController::class, 'openCountingObject'])->name('student/math_area/activity2');

    Route::get('/student/math_area/activity/3', [GameController::class, 'openMatchingShapes'])->name('student/math_area/activity3');
    
    //SCIENCE GAMES
    Route::get('/student/science_area/assessment/{id?}', [GameController::class, 'openAssessment'])->name('student/science_area/assessment');

    Route::get('/student/science_area/activity/1', [GameController::class, 'openChoosingAnimalNames'])->name('student/science_area/activity1');
    
    Route::get('/student/science_area/activity/2', [GameController::class, 'openMatchingAnimalSounds'])->name('student/science_area/activity2');
    
    //ASSESSMENT RECORD CONTROLLER
    Route::resource('assessment_record', AssessmentRecordController::class);

    //ACTIVITY RECORD CONTROLLER
    Route::resource('activity_record', ActivityRecordController::class);
});



