<?php

use App\Http\Controllers\Admin\{
    AdminDashboard,
    AuthController,
    ProfileController,
    UserController,
    CmsController,
    GalleryController,
    BannerController,
    SeoController,
    SliderController,
    SettingsController,
    TestimonialsController,
    SocialLinkController,
    BoardController,
    BoardClassController,
    SubjectController,
    ChapterController,
    QuestionSetController,
    WeeklyQuestionSetController,
    WithdrawalController,
    ExamController as AdminExamController,
    ChatController as AdminChatController,
};
use App\Http\Controllers\Frontend\{
    ChatController,
    HomeController,
    LoginController,
    ExamController,
    WithdrawController,
    UserProfileController,
    CmsController as FrontendCmsController,
};
use App\Http\Controllers\ResetPasswordController;

use Illuminate\Support\Facades\Route;
 

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
//Route::redirect('/','admin/login');
Route::redirect('admin','admin/login');
//Route::post('admin/login',[AuthController::class,'login'])->name('admin.login');
/*Admin Part*/
Route::group(['prefix' => 'admin', 'middleware'=> ['auth:sanctum','isAdmin']], function(){
    Route::get('profile',[ProfileController::class,'getProfile'])->name('admin.profile');
    Route::post('logout',[AuthController::class,'signout'])->name('admin.logout');
    Route::get('dashboard',[AdminDashboard::class,'getDashboard'])->name('admin.dashboard');
    Route::get('cms',[CmsController::class,'index'])->name('cms.index');
    Route::get('cms/{slug}',[CmsController::class,'edit'])->name('cms.edit');
    Route::get('seos',[SeoController::class,'index'])->name('seos.index');
    Route::get('exams',[AdminExamController::class,'index'])->name('exams.index');
    Route::get('exams/{id}',[AdminExamController::class,'show'])->name('exams.show');
    Route::get('seos/{slug}',[SeoController::class,'edit'])->name('seos.edit');
    Route::get('settings',[SettingsController::class,'edit'])->name('settings.edit');
    Route::get('change-password',[SettingsController::class,'changePassword'])->name('change.password');
    Route::resources([
        'users' => UserController::class,
        'social-links' => SocialLinkController::class,
        'galleries' => GalleryController::class,
        'banners' => BannerController::class,
        'sliders' => SliderController::class,
        'testimonials' => TestimonialsController::class,
        'boards' => BoardController::class,
        'board-class' => BoardClassController::class,
        'subject' => SubjectController::class,
        'chapter' => ChapterController::class,
        'chats' => AdminChatController::class,
        
    ]);
    Route::get('/withdrawal-request',[WithdrawalController::class,'index'])->name('withdrawal.request');
    Route::get('chapter/{chapter_id}/question-sets',[QuestionSetController::class,'index'])->name('question-sets.index');
    Route::get('chapter/{chapter_id}/question-sets/create',[QuestionSetController::class,'create'])->name('question-sets.create');
    Route::get('chapter/{chapter_id}/question-sets/{id}/edit',[QuestionSetController::class,'edit'])->name('question-sets.edit');
    Route::get('board-class/{board_class_id}/question-sets',[WeeklyQuestionSetController::class,'index'])->name('weekly-question-sets.index');
    Route::get('board-class/{board_class_id}/question-sets/create',[WeeklyQuestionSetController::class,'create'])->name('weekly-question-sets.create');
    Route::get('board-class/{board_class_id}/question-sets/{id}/edit',[WeeklyQuestionSetController::class,'edit'])->name('weekly-question-sets.edit');


     Route::post('ckeditor/image_upload',[CmsController::class,'upload'])->name('upload');
});

Route::get('emails',[HomeController::class,'emails']);
Route::post('forgot-password',[ResetPasswordController::class,'forgotPassword'])->name('user.forgot.password');
Route::post('admin/forgot-password',[ResetPasswordController::class,'adminForgotPassword'])->name('admin.forgot.password');
Route::get('reset-password',[ResetPasswordController::class,'resetPassword'])->name('reset_password');
Route::post('reset-password',[ResetPasswordController::class,'resetPasswordSave'])->name('reset_password_save');

/*Frontend Part*/
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('about-us',[FrontendCmsController::class,'aboutUs'])->name('aboutUs'); 

Route::get('vision-statement',[FrontendCmsController::class,'visionStatement'])->name('visionStatement');
Route::get('sustainability-development-goal',[FrontendCmsController::class,'sustainabilityDevelopmentGoal'])->name('sustainabilityDevelopmentGoal');
Route::get('values-education',[FrontendCmsController::class,'valuesEducation'])->name('valuesEducation');
Route::get('our-staff',[FrontendCmsController::class,'ourStaff'])->name('ourStaff');
Route::get('commitment',[FrontendCmsController::class,'commitment'])->name('commitment');
Route::get('policies',[FrontendCmsController::class,'policies'])->name('policies');
Route::get('unrivalled-support',[FrontendCmsController::class,'unrivalledSupport'])->name('unrivalledSupport');
Route::get('time-to-think',[FrontendCmsController::class,'timeToThink'])->name('timeToThink');
Route::get('resources-and-features',[FrontendCmsController::class,'resourcesAndFeatures'])->name('resourcesAndFeatures');
Route::get('why-choose-us',[FrontendCmsController::class,'whyChooseUs'])->name('whyChooseUs');
Route::get('conclusion',[FrontendCmsController::class,'conclusion'])->name('conclusion');
Route::get('how-it-works',[FrontendCmsController::class,'howItWorks'])->name('howItWorks');
Route::get('contact-us',[FrontendCmsController::class,'contactUs'])->name('contactUs'); 
Route::get('term-and-conditions',[FrontendCmsController::class,'termAndConditions'])->name('term.and.conditions'); 
Route::get('privacy-policy',[FrontendCmsController::class,'privacyPolicy'])->name('privacy.policy'); 

Route::get('login',[LoginController::class,'login'])->name('user.login');
Route::post('login',[LoginController::class,'loginSubmit'])->name('user.login.submit');

Route::get('register',[LoginController::class,'register'])->name('user.register');
 Route::post('register',[RegisterController::class,'registerSubmit'])->name('user.register.submit');
 Route::post('login',[LoginController::class,'loginSubmit'])->name('user.login.submit');
Route::post('contact-us/submit',[HomeController::class,'contactForm'])->name('contact.us.form.submit'); 
 Route::get('forgot-password',[ResetPasswordController::class,'forgotPasswordView'])->name('user.forgot.password');
  Route::group(['middleware'=> 'auth'], function(){  
    Route::group(['middleware'=> 'isClient'], function(){
        Route::get('subscriptions',[FrontendCmsController::class,'subscriptions'])->name('subscriptions'); 
        Route::post('user-subscriptions-submit',[FrontendCmsController::class,'subscriptionSave'])->name('user.subscriptions.submit'); 
        Route::get('super-chat',[ChatController::class,'index'])->name('super.chat');
        Route::post('payment',[LoginController::class,'payment'])->name('payment');
        Route::post('logout',[LoginController::class,'logout'])->name('user.logout');
        Route::get('profile',[UserProfileController::class,'myAccount'])->name('user.account');
         Route::get('change-password',[UserProfileController::class,'changePassword'])->name('user.change.password');
         Route::post('change-password',[UserProfileController::class,'updatePassword'])->name('user.change.password.save');
         Route::post('my-account/update',[UserProfileController::class,'profileUpdate'])->name('user.profile.save');
        Route::get('withdraw',[WithdrawController::class,'withdraw'])->name('user.withdraw');
        Route::get('my-group',[UserProfileController::class,'myGroup'])->name('user.myGroup');
        Route::group(['middleware'=> 'isPlanActive'], function(){
            Route::get('dashboard',[UserProfileController::class,'profile'])->name('user.profile');
            Route::get('exam/{id}/{slug}/{chapter_id}/{chapter_slug}',[ExamController::class,'index'])->name('user.exam');
            Route::post('answer-submit',[ExamController::class,'answerSubmit'])->name('answer.submit');
            Route::get('weekly-exam',[ExamController::class,'weeklyExam'])->name('user.weekly.exam');
            Route::get('weekly-group-exam',[ExamController::class,'weeklyGroupExam'])->name('user.weeklyGroupExam.exam');
            Route::get('{slug}/group-exam/{test_type}',[ExamController::class,'GroupExam'])->name('user.GroupExam.exam');
            Route::post('upcoming-exams/get-previous-question',[ExamController::class,'getPreviousQuestion'])->name('get.previous.question');
            Route::post('upcoming-exams/final-answer-submit',[ExamController::class,'finalAnswerSubmit'])->name('exam.final.answer.submit');
            Route::post('group-answer-submit',[ExamController::class,'weeklyAnswerSubmit'])->name('weekly.group.answer.submit');
        });
    });
});
/*Frontend Part*/

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return 'Cleared.';
});