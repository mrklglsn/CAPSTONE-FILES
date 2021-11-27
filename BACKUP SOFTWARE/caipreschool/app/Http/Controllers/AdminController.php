<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Faqs;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;

/*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller redirects admin to their page. The controller uses a trait
    | to conveniently provide its functionality to admin functions.
    |
    */
class AdminController extends Controller
{
    //FUNCTION THAT RETURNS ADMIN TO THE DASHBOARD VIEW
    function dashboard(){
        $parents = User::withTrashed()->where('is_admin', 0)->get();
        $subjects = Subject::withTrashed()->where('deleted_at', null)->get();
        $videos = Video::withTrashed()->where('deleted_at', null)->get();
        $faqs = Faqs::withTrashed()->where('deleted_at', null)->get();
        $announcements = Announcement::withTrashed()->where('deleted_at', null)->get();
        
        return view('admin.dashboard', compact('parents','subjects','videos','faqs','announcements'));
    }
    //FUNCTION THAT RETURNS ADMIN TO THE PARENT MANAGE VIEW
    function manageParents(){
        return view('admin.parentmanage');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE STUDENT MANAGE VIEW
    function manageStudents(){
        return view('admin.studentmanage');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE SUBJECT MANAGE VIEW
    function manageSubjects(){
        return view('admin.subjectmanage');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE ANNOUNCEMENT MANAGE VIEW
    function manageAnnouncements(){
        return view('admin.announcemanagement');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE FAQS MANAGE VIEW
    function manageFaqs(){
        return view('admin.faqmanage');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE TOPICS MANAGE VIEW
    function manageTopics(){
        return view('admin.topicmanage');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE VIDEO MANAGE VIEW
    function manageVideos(){
        return view('admin.videolist');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE CATEGORY MANAGE VIEW
    function manageCategories(){
        return view('admin.videocategory');
    }
    //FUNCTION THAT RETURNS ADMIN TO THE ASSESSMENT MANAGE VIEW
    function manageAssessments(){
        return view('admin.assessment_manage');
    }

}

