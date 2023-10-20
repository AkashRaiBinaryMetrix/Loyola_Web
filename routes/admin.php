<?php

use Illuminate\Support\Facades\Route;


Route::get("/admin", function(){
	return View('admin.admin_login');
 });

 

Route::prefix('admin')->group(function()

{

Route::any('/login', [App\Http\Controllers\admin\AdminController::class, 'login'])->name('admin.login');

Route::any('/forgot-password', [App\Http\Controllers\admin\AdminController::class, 'forget_password'])->name('admin.forgot.password');

Route::any('/change-password/{id}', [App\Http\Controllers\admin\AdminController::class, 'change_password'])->name('admin.change.password');

Route::any('/check-otp', [App\Http\Controllers\admin\AdminController::class, 'checkotp'])->name('admin.checkotp');

Route::any('/signup', [App\Http\Controllers\admin\AdminController::class, 'signup'])->name('admin.signup');

});



Route::middleware(['admin'])->group(function(){

	Route::prefix('admin')->group(function()

	{

	  	Route::get('home', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.home');

		Route::any('/logout', [App\Http\Controllers\admin\AdminController::class, 'logout'])->name('admin.logout');

		Route::any('/profile', [App\Http\Controllers\admin\AdminController::class, 'admin_profile'])->name('admin.profile');

		Route::any('/profile-password', [App\Http\Controllers\admin\AdminController::class, 'changepassword'])->name('admin.profile_password');

		Route::any('/edit-profile-image', [App\Http\Controllers\admin\AdminController::class, 'edit_profile_image'])->name('admin.edit.profile.image');

        //survey 

		Route::get('/user/lists', [App\Http\Controllers\admin\UsersController::class, 'index']);
		Route::get('/user/feedbacks', [App\Http\Controllers\admin\UsersController::class, 'feedbackLists']);
        Route::get('/user/notifications', [App\Http\Controllers\admin\UsersController::class, 'notifications']);

		Route::get('/user/send-email', [App\Http\Controllers\admin\UsersController::class, 'sendMail']);
        Route::post('/user/send-mail', [App\Http\Controllers\admin\UsersController::class, 'sendMessage']);

		Route::get('/user/send-email-user', [App\Http\Controllers\admin\UsersController::class, 'sendMailUser']);
        Route::post('/user/send-mail-user', [App\Http\Controllers\admin\UsersController::class, 'sendMessageUser']);


		Route::controller(App\Http\Controllers\admin\SurveyCategoryController::class)->prefix('category')->group(function(){
            Route::get('/', 'index');
            Route::get('/create', 'create');
			Route::post('/create', 'store');
            Route::get('/edit/{id}', 'edit');
			Route::put('/edit/{id}', 'update');
        });
        
		Route::controller(App\Http\Controllers\admin\SurveyController::class)->prefix('survey')->group(function(){
            Route::get('/', 'index')->name('survey.index');
            Route::get('/create', 'create');
			Route::post('/create', 'store');
            Route::get('/edit/{id}', 'edit');
			Route::put('/edit/{id}', 'update');
			Route::get('/published/{id}', 'published');
			Route::get('/questions/{id}', 'surveyQuestions');
			Route::post('/save_question', 'saveSurveyQuestions');
			Route::get('/questions', 'surveyQuestionLists');
			Route::get('/options', 'surveyQuestionOptionsLists');
        });
    


		/*...................... Community routes......... */

		Route::any('/add-community', [App\Http\Controllers\admin\CommunityController::class, 'add_community'])->name('admin.add.community');

		Route::any('/manage-community', [App\Http\Controllers\admin\CommunityController::class, 'manage_community'])->name('admin.manage.community');

		Route::any('/manage-counselor', [App\Http\Controllers\admin\CommunityController::class, 'manage_counselor'])->name('admin.manage.counselor');

		Route::any('/requested-appointment', [App\Http\Controllers\admin\CommunityController::class, 'requested_appointment'])->name('admin.manage.appointment');

		Route::any('/edit-counselor/{id}', [App\Http\Controllers\admin\CommunityController::class, 'edit_counselor'])->name('admin.edit.counselor');

		Route::any('/add-counselor', [App\Http\Controllers\admin\CommunityController::class, 'add_counselor'])->name('admin.add.counselor');

		Route::any('/insert-counselor', [App\Http\Controllers\admin\CommunityController::class, 'insert_counselor'])->name('admin.insert.counselor');

		Route::any('/edit-patient-listing/{id}', [App\Http\Controllers\admin\CommunityController::class, 'edit_listing'])->name('admin.edit.patient');

		Route::any('/edit-patient-process', [App\Http\Controllers\admin\CommunityController::class, 'edit_patient_process'])->name('admin.patient.process');

		Route::any('/update-patient/{id}', [App\Http\Controllers\admin\CommunityController::class, 'update_patient'])->name('admin.update.patient');

		Route::any('/update-counselor/{id}', [App\Http\Controllers\admin\CommunityController::class, 'update_counselor'])->name('admin.update.counselor');

		Route::any('/edit-counselor-process', [App\Http\Controllers\admin\CommunityController::class, 'edit_counselor_process'])->name('admin.counselor.process');

		Route::any('/patient-listing', [App\Http\Controllers\admin\CommunityController::class, 'patient_listing'])->name('admin.patient.listing');

		Route::any('/edit-community/{id}', [App\Http\Controllers\admin\CommunityController::class, 'edit'])->name('admin.edit.community');

		Route::any('/myactivate', [App\Http\Controllers\admin\CommunityController::class, 'myactivate'])->name('admin.myactivate');

		Route::any('/deactivate', [App\Http\Controllers\admin\CommunityController::class, 'deactivate'])->name('admin.deactivate');

		Route::any('/delete-community/{id}', [App\Http\Controllers\admin\CommunityController::class, 'delete'])->name('admin.delete.community');

		Route::any('/upload-image', [App\Http\Controllers\admin\CommunityController::class, 'uploadimg'])->name('admin.upload.image');

		Route::any('/community-request', [App\Http\Controllers\admin\CommunityController::class, 'community_request'])->name('admin.community.request');

		Route::any('/subcat-list', [App\Http\Controllers\admin\CommunityController::class, 'subcatlist'])->name('admin.subcat.list');



		/*....................end.........................*/



		/*...................... User Backend routes......... */



		Route::any('manage-users', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('admin.manage.users');

		Route::any('add-users', [App\Http\Controllers\admin\UsersController::class, 'add'])->name('admin.add.users');

		Route::any('edit-users/{id}', [App\Http\Controllers\admin\UsersController::class, 'edit'])->name('admin.edit.users');

		Route::any('delete-users/{id}', [App\Http\Controllers\admin\UsersController::class, 'delete'])->name('admin.delete.users');

		Route::any('user-status', [App\Http\Controllers\admin\UsersController::class, 'user_status'])->name('admin.user.status');



		/*....................end.........................*/



		/*...................... Post routes......... */

		Route::any('/add-post', [App\Http\Controllers\admin\PostController::class, 'add'])->name('admin.add.post');

		Route::any('/manage-post', [App\Http\Controllers\admin\PostController::class, 'manage'])->name('admin.manage.post');

		Route::any('/edit-post/{id}', [App\Http\Controllers\admin\PostController::class, 'edit'])->name('admin.edit.post');

		Route::any('/delete-post/{id}', [App\Http\Controllers\admin\PostController::class, 'delete'])->name('admin.delete.post');

		Route::any('/post-report', [App\Http\Controllers\admin\PostController::class, 'posts_report'])->name('admin.post.report');

		Route::any('/delete-user-post/{id}', [App\Http\Controllers\admin\PostController::class, 'deleteuserpost'])->name('admin.post.delete');

		Route::any('/user-post-details/{id}', [App\Http\Controllers\admin\PostController::class, 'user_post_details'])->name('admin.user.post.details');

		Route::any('comment-report', [App\Http\Controllers\admin\PostController::class, 'comments_report'])->name('admin.comments.report');

		Route::any('comment-delete/{id}', [App\Http\Controllers\admin\PostController::class, 'comment_delete'])->name('admin.comment.delete');



		/*....................end.........................*/



		/*...................... Content routes......... */

		Route::any('/about-us', [App\Http\Controllers\admin\ContentController::class, 'aboutus'])->name('admin.content.about');

		Route::any('/terms-conditions', [App\Http\Controllers\admin\ContentController::class, 'terms_conditions'])->name('admin.content.terms');

		Route::any('/privacy-policy', [App\Http\Controllers\admin\ContentController::class, 'privacy_policy'])->name('admin.content.privacy_policy');

		Route::any('/faq', [App\Http\Controllers\admin\ContentController::class, 'faq'])->name('admin.content.faq');

		Route::any('/edit-faq/{id}', [App\Http\Controllers\admin\ContentController::class, 'editfaq'])->name('admin.content.editfaq');

		Route::any('/manage-faq', [App\Http\Controllers\admin\ContentController::class, 'managefaq'])->name('admin.content.managefaq');

		Route::any('/delete-faq/{id}', [App\Http\Controllers\admin\ContentController::class, 'deletefaq'])->name('admin.content.delete.faq');

		Route::any('/manage-enquiry', [App\Http\Controllers\admin\ContentController::class, 'manage_enquiry'])->name('admin.content.manage.enquiry');

		Route::any('/delete-enquiry/{id}', [App\Http\Controllers\admin\ContentController::class, 'delete_enquiry'])->name('admin.content.delete.enquiry');

		Route::any('/contact-us', [App\Http\Controllers\admin\ContentController::class, 'contact_us'])->name('admin.content.contactus');

		/*....................end.........................*/



		/*...................... Email template routes......... */

		Route::any('/notification-template', [App\Http\Controllers\admin\EmailTemplateController::class, 'notification'])->name('admin.email.template.notification');

		Route::any('/welcome-template', [App\Http\Controllers\admin\EmailTemplateController::class, 'welcome_note'])->name('admin.email.template.welcome');

		Route::any('/forget-password', [App\Http\Controllers\admin\EmailTemplateController::class, 'forget_password'])->name('admin.email.template.forget_password');



		/*....................end.........................*/



		/*...................... User Role routes......... */

		Route::any('/add-user-role', [App\Http\Controllers\admin\UsersController::class, 'addrole'])->name('admin.users.role.add');

		Route::any('/manage-user-role', [App\Http\Controllers\admin\UsersController::class, 'manage_roles'])->name('admin.users.role.manage');

		Route::any('/edit-user-role/{id}', [App\Http\Controllers\admin\UsersController::class, 'editrole'])->name('admin.users.role.edit');

		Route::any('/delete-user-role/{id}', [App\Http\Controllers\admin\UsersController::class, 'deleterole'])->name('admin.users.role.delete');

		Route::any('/user-permission', [App\Http\Controllers\admin\UsersController::class, 'user_permission'])->name('admin.users.permission');

		Route::any('/manage-permission/{id}', [App\Http\Controllers\admin\UsersController::class, 'manage_user_permission'])->name('admin.manage.user.perssion');

		Route::any('/user-messages', [App\Http\Controllers\admin\UsersController::class, 'usermessages'])->name('admin.user.message');



		/*....................end.........................*/





		/*...................... Category Backend routes......... */



		Route::any('add-category', [App\Http\Controllers\admin\CategoryController::class, 'add_category'])->name('admin.add.category');

		Route::any('manage-category', [App\Http\Controllers\admin\CategoryController::class, 'manage_category'])->name('admin.manage.category');

		Route::any('edit-category/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit_category'])->name('admin.edit.category');

		Route::any('delete-category/{id}', [App\Http\Controllers\admin\CategoryController::class, 'delete_category'])->name('admin.delete.category');

		



		/*....................end.........................*/



		/*...................... SubCategory Backend routes......... */



		Route::any('add-sub-category', [App\Http\Controllers\admin\SubCategoryController::class, 'add_subcategory'])->name('admin.add.subcategory');

		Route::any('manage-sub-category', [App\Http\Controllers\admin\SubCategoryController::class, 'manage_subcategory'])->name('admin.manage.subcategory');

		Route::any('edit-sub-category/{id}', [App\Http\Controllers\admin\SubCategoryController::class, 'edit_subcategory'])->name('admin.edit.subcategory');

		Route::any('delete-sub-category/{id}', [App\Http\Controllers\admin\SubCategoryController::class, 'delete_subcategory'])->name('admin.delete.subcategory');

		



		/*....................end.........................*/



		/*...................... Admin Poll routes......... */

			Route::resource('poll', App\Http\Controllers\admin\PollController::class,[

		    'names' => [

		        'index' => 'admin.add.poll',

		        'store' => 'admin.store.poll'

		        

		    ]

		]);

		Route::any('poll/create', [App\Http\Controllers\admin\PollController::class, 'create'])->name('admin.create.poll');

		Route::any('poll/manage', [App\Http\Controllers\admin\PollController::class, 'show'])->name('admin.manage.poll');

		Route::any('poll/delete/{id}', [App\Http\Controllers\admin\PollController::class, 'destroy'])->name('admin.delete.poll');

		Route::any('poll/edit/{id}', [App\Http\Controllers\admin\PollController::class, 'edit'])->name('admin.edit.poll');

		Route::any('poll/update', [App\Http\Controllers\admin\PollController::class, 'update'])->name('admin.update.poll');

		Route::any('poll/details/{id}', [App\Http\Controllers\admin\PollController::class, 'view_poll_details'])->name('admin.poll.details');

		Route::any('poll/{id}/{status}', [App\Http\Controllers\admin\PollController::class, 'status'])->name('admin.status.poll');

		

		/*....................end.........................*/



		/*...................... Video routes......... */

		Route::any('add-video', [App\Http\Controllers\admin\VideoController::class, 'add'])->name('admin.video.add');

		Route::any('manage-video', [App\Http\Controllers\admin\VideoController::class, 'manage'])->name('admin.video.manage');

		Route::any('edit-video/{id}', [App\Http\Controllers\admin\VideoController::class, 'edit'])->name('admin.video.edit');

		Route::any('delete-video/{id}', [App\Http\Controllers\admin\VideoController::class, 'delete'])->name('admin.video.delete');

		

		/*....................end.........................*/







	});

});

