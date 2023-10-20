<?php

//ifiwere route file

include('admin.php');

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

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



Route::any('my-profile', function () {

    return view('user.my_setting');

});

Route::get("/", function(){
	return View('admin.admin_login');
 });

// Route::get('book/',[TestController::class,'index']);

// Route::get('bookadd/',[TestController::class,'create']);



// Auth::routes();





Route::any('/user-login', [App\Http\Controllers\HomeController::class, 'logincheck'])->name('logincheck');

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::any('/',[App\Http\Controllers\HomeController::class,'index'])->name('home.dashboard');

Route::any('search-news',[App\Http\Controllers\HomeController::class,'searchnews'])->name('search.news');

Route::any('report',[App\Http\Controllers\HomeController::class,'report'])->name('report');

Route::any('userip',[App\Http\Controllers\HomeController::class,'userip'])->name('userip');

Route::get('about-us',[App\Http\Controllers\AboutController::class,'index']);



// Route::any('contact-us',[App\Http\Controllers\ContactController::class,'index']);

// Route::any('enquiry',[App\Http\Controllers\ContactController::class,'enquiry'])->name('enquiry');



// Route::get('faq',[App\Http\Controllers\FaqController::class,'index']);

// Route::get('privacy-policy',[App\Http\Controllers\PrivacyPolicyController::class,'index']);

// Route::get('terms-of-use',[App\Http\Controllers\TermsController::class,'index']);

// Route::get('community',[App\Http\Controllers\PostController::class,'community']);

// Route::any('report-post',[App\Http\Controllers\PostController::class,'report_post'])->name('report.post');



// Route::middleware(['user'])->group(function(){

// Route::any('create-post',[App\Http\Controllers\PostController::class,'create_post'])->name('create.post');

// Route::any('create-poll',[App\Http\Controllers\PostController::class,'create_poll'])->name('create.poll');



// Route::any('my-post',[App\Http\Controllers\PostController::class,'user_posts'])->name('user.my.post');

// Route::any('upload',[App\Http\Controllers\PostController::class,'upload'])->name('user.post.upload');

// Route::any('user-comments',[App\Http\Controllers\PostController::class,'user_post_comments'])->name('user.comments.post');

// Route::any('edit-poll/{id}',[App\Http\Controllers\PostController::class,'editpoll'])->name('user.edit.poll');





// Route::any('request-community',[App\Http\Controllers\CommunityController::class,'add_community'])->name('user.create.community');



// Route::any('my-community',[App\Http\Controllers\CommunityController::class,'my_community'])->name('my.community');

// Route::any('invite-friends',[App\Http\Controllers\UserController::class,'invite_friends'])->name('user.invite.friends');

// Route::any('change-password/{id}',[App\Http\Controllers\UserController::class,'changepassword'])->name('user.change.password');



// Route::any('detail',[App\Http\Controllers\UserdetailController::class,'save'])->name('detail');

// Route::any('user-activity',[App\Http\Controllers\UserActivityController::class,'user_activity'])->name('user.activity');

// });

// Route::any('user-message',[App\Http\Controllers\UserController::class,'user_message'])->name('user.message');





// Route::any('all-category',[App\Http\Controllers\CategoryController::class,'all_category'])->name('all.category');

// Route::any('search-category',[App\Http\Controllers\CategoryController::class,'search_category'])->name('search.category');



// Route::any('poll-votes',[App\Http\Controllers\PostController::class,'poll_votes'])->name('poll.votes');

// Route::any('sort-comments',[App\Http\Controllers\PostController::class,'sortcomments'])->name('sort.comments');

// Route::any('user-notification',[App\Http\Controllers\PostController::class,'getnotification'])->name('user.notification');

// Route::any('poll-month-votes',[App\Http\Controllers\PostController::class,'poll_month_votes'])->name('poll.month.votes');

// Route::any('trending',[App\Http\Controllers\HomeController::class,'trending'])->name('post.trending');

// Route::any('post/{comm}',[App\Http\Controllers\HomeController::class,'community_post'])->name('post.community.post');



// Route::any('join-community',[App\Http\Controllers\CommunityController::class,'join_community'])->name('join.community');

// Route::any('all-community',[App\Http\Controllers\CommunityController::class,'all_community'])->name('all.community');

// Route::any('category/{cat}/community',[App\Http\Controllers\CommunityController::class,'communitycategory'])->name('community.category');

// Route::any('search-community',[App\Http\Controllers\CommunityController::class,'search_community'])->name('search.community');

// Route::any('my-community-search',[App\Http\Controllers\CommunityController::class,'communitysearch'])->name('community.search');



// Route::any('{comm}/comments/{id}/{slug}',[App\Http\Controllers\PostController::class,'posts_comment'])->name('user.post.comments');

// Route::any('hide-post',[App\Http\Controllers\PostController::class,'hidepost'])->name('hide.post');

// Route::any('delete-post',[App\Http\Controllers\PostController::class,'deletepost'])->name('delete.post');

// Route::any('edit-post/{id}',[App\Http\Controllers\PostController::class,'editpost'])->name('edit.post');

// Route::any('user-likes',[App\Http\Controllers\PostController::class,'user_likes'])->name('user.post.likes');

// Route::any('create-post/{comm}',[App\Http\Controllers\PostController::class,'postcreate'])->name('postcreate');

// Route::get('/roles', [App\Http\Controllers\PermissionController::class,'Permission']);



// Route::any('community/{comm}',[App\Http\Controllers\CommunityController::class,'communityinfo'])->name('community.info');

// // User Routes //

// Route::any('register',[App\Http\Controllers\UserController::class,'register'])->name('user.register');

// Route::any('forgot-password',[App\Http\Controllers\UserController::class,'forget_password'])->name('user.forgot.password');

// Route::any('forget-password/{id}',[App\Http\Controllers\UserController::class,'forgotpassword'])->name('user.forgot.change.password');

// Route::any('explore-videos',[App\Http\Controllers\VideoController::class,'video'])->name('user.video');





// Route::any('login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('user.login');

// Route::any('logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('user.logout');



// Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);

// Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);



// Route::get('/facebook/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectFacebook']);

// Route::get('/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'facebookCallback']);



// Route::any('getcategoryresult',[App\Http\Controllers\HomeController::class,'getcategoryresult']);




// Route::get('/twitter/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirect']);

// Route::get('/twitter/callback', [App\Http\Controllers\Auth\LoginController::class, 'callback']);

// Route::any('comment-report',[App\Http\Controllers\CommentController::class,'comment_report'])->name('user.comment.report');

// Route::any('comment-reply',[App\Http\Controllers\CommentController::class,'commentreply'])->name('user.comment.reply');

// Route::any('get-category-list',[App\Http\Controllers\CommunityController::class,'get_category_list'])->name('user.category.list');

// Route::any('get-category-postlist',[App\Http\Controllers\CommunityController::class,'get_category_postlist'])->name('user.category.postlist');

// Route::any('get-subcategory-list',[App\Http\Controllers\CommunityController::class,'get_subcategory_list'])->name('user.subcategory.list');

// Route::any('get-subcategory-postlist',[App\Http\Controllers\CommunityController::class,'get_subcategory_postlist'])->name('user.subcategory.postlist');

// Route::any('get-community-list',[App\Http\Controllers\CommunityController::class,'get_community_list'])->name('user.community.communitylist');

// Route::any('comment-like',[App\Http\Controllers\CommentController::class,'comment_like'])->name('user.comment.likes');

// Route::any('sub-comment-like',[App\Http\Controllers\CommentController::class,'sub_comment_like'])->name('user.sub.comment.likes');

// Route::any('sub-comment-reply',[App\Http\Controllers\CommentController::class,'sub_comment_reply'])->name('user.sub.comment.reply');

// Route::any('/comment/store',[App\Http\Controllers\CommentController::class,'store'])->name('comment.add');

// Route::any('/reply/store',[App\Http\Controllers\CommentController::class,'replyStore'])->name('reply.add');

// Route::any('/search-sub-category',[App\Http\Controllers\CategoryController::class,'search_subcategory'])->name('search.subcategory');

// Route::any('confirm-email/{id}',[App\Http\Controllers\UserController::class,'confirmmail'])->name('user.confirm.email');

// Route::any('verify-otp',[App\Http\Controllers\UserController::class,'verifyotp'])->name('user.verify.otp');

// Route::get('/{continent}/{cat}/{subcat}',[App\Http\Controllers\CommunityController::class,'subcommunities'])->name('user.subcommunity.all');

// Route::get('/{continent}/{cat}',[App\Http\Controllers\CommunityController::class,'subcategorylist'])->name('user.subcategory.all');

// Route::any('/{title}',[App\Http\Controllers\CommunityController::class,'communities'])->name('user.community.asia');















