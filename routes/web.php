<?php

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

Route::namespace('website')->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/research', 'ResearchController@index');
    Route::get('/research/funding-opportunities', 'FundingOpportunityController@index');
    Route::get('/research/funded-projects', 'FundedProjectController@index');
    Route::get('/our-professors', 'ProfessorController@index');
    Route::get('/our-news', 'NewsController@index');
    Route::get('/our-news/{slug}/detail', 'NewsController@newsDetail');
    Route::get('/about-us', 'AboutController@index');
    Route::get('/contact', 'ContactController@index');
    Route::get('/events', 'EventController@index');
    Route::get('/events/{slug}/gallery', 'GalleryController@index');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/student', function () {
    return redirect('/login');
});

Route::namespace('Cms')->prefix('admin')->group(function () {
    Route::middleware('UnAuthentic')->group(function () {
        Route::get('/login', 'AuthenticationController@index');
        Route::post('/login', 'AuthenticationController@loginData');
        Route::get('/user-verification/{verificationToken}', 'AuthenticationController@userVerification');
        Route::post('/user-verification/{verificationToken}', 'AuthenticationController@userVerificationData');
        Route::get('/forgot-password', 'AuthenticationController@forgotPassword');
        Route::post('/forgot-password', 'AuthenticationController@forgotPasswordData');
    });

    Route::middleware(['AuthenticAdmin', 'not_student'])->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::post('/manage-profile', 'ProfileController@updateProfile');
        Route::get('/notifications', 'NotificationController@index');
        Route::get('/delete-notification/{notificationId}', 'NotificationController@deleteNotification');
        Route::get('/notification-detail/{notificationId}', 'NotificationController@detailNotification');

        Route::get('/manage-users', 'UserManagementController@index');
        Route::get('/add-user', 'UserManagementController@addUser');
        Route::post('/add-user', 'UserManagementController@addUserData');
        Route::get('/update-user/{userId}', 'UserManagementController@updateUser');
        Route::put('/update-user/{userId}', 'UserManagementController@updateUserData');
        Route::get('/user-detail/{userId}', 'UserManagementController@getUserDetail');
        Route::get('/block-user/{userId}', 'UserManagementController@blockUser');

        Route::get('/manage-roles', 'RoleController@index');
        Route::get('/add-role', 'RoleController@addRole');
        Route::post('/add-role', 'RoleController@addRoleData');
        Route::get('/update-role/{roleId}', 'RoleController@updateRole');
        Route::put('/update-role/{roleId}', 'RoleController@updateRoleData');
        Route::get('/delete-role/{roleId}', 'RoleController@deleteRole');

        Route::get('/upload-samples', 'UploadSampleController@index');
        Route::get('/delete-upload-sample/{uploadId}', 'UploadSampleController@deleteUpload');

        Route::namespace('Student')->prefix('student')->group(function () {
            Route::get('/research-projects', 'ResearchProjectController@index');
            Route::get('/add-research-project', 'ResearchProjectController@addResearch');
            Route::post('/add-research-project', 'ResearchProjectController@addResearchData');
            Route::get('/update-research-project/{researchId}', 'ResearchProjectController@updateResearch');
            Route::post('/update-research-project/{researchId}', 'ResearchProjectController@updateResearchData');
            Route::get('/research-project-detail/{researchId}', 'ResearchProjectController@researchDetail');
            Route::get('/research-project-change-status/{researchId}/{status}', 'ResearchProjectController@changeStatus');
            Route::get('/add-rp-template', 'ResearchProjectController@uploadResearchTemplate');
            Route::post('/add-rp-template', 'ResearchProjectController@uploadResearchTemplateData');
        });

        Route::namespace('FrontEnd')->prefix('website/pages')->name('website.')->group(function () {
            Route::get('/main-home', 'HomeController@index')->name('page.home');
            Route::get('/main-home/create', 'HomeController@addHome')->name('page.home.add');
            Route::post('/main-home/create', 'HomeController@addHomeData')->name('page.home.add.data');
            Route::get('/main-home/update/{cmsHomeId}', 'HomeController@updateHome')->name('page.home.update');
            Route::put('/main-home/update/{cmsHomeId}', 'HomeController@updateHomeData')->name('page.home.update.data');
            Route::get('/main-home/delete/{cmsHomeId}', 'HomeController@deleteHome');

            Route::get('/home/oric-member', 'ORICMemeberController@index')->name('page.home.oric-member');
            Route::get('/home/oric-member/create', 'ORICMemeberController@addMember')->name('page.home.oric-member.add');
            Route::post('/home/oric-member/create', 'ORICMemeberController@addMemberData')->name('page.home.oric-member.add.data');
            Route::get('/home/oric-member/update/{cmsMemberId}', 'ORICMemeberController@updateMember')->name('page.home.oric-member.update');
            Route::put('/home/oric-member/update/{cmsMemberId}', 'ORICMemeberController@updateMemberData')->name('page.home.oric-member.update.data');
            Route::get('/home/oric-member/delete/{cmsMemberId}', 'ORICMemeberController@deleteMember');

            Route::get('/home/testimonial', 'TestimonialController@index')->name('page.home.testimonial');
            Route::get('/home/testimonial/create', 'TestimonialController@addTestimonial')->name('page.home.testimonial.add');
            Route::post('/home/testimonial/create', 'TestimonialController@addTestimonialData')->name('page.home.testimonial.add.data');
            Route::get('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonial')->name('page.home.testimonial.update');
            Route::put('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonialData')->name('page.home.testimonial.update.data');
            Route::get('/home/testimonial/delete/{cmsTestimonialId}', 'TestimonialController@deleteTestimonial');

            Route::get('/home/aim-intro', 'CMSHomeIntroController@index')->name('page.home.aim-intro');
            Route::get('/home/aim-intro/create', 'CMSHomeIntroController@addIntro')->name('page.home.aim-intro.add');
            Route::post('/home/aim-intro/create', 'CMSHomeIntroController@addIntroData')->name('page.home.aim-intro.add.data');
            Route::get('/home/aim-intro/update/{cmsIntroId}', 'CMSHomeIntroController@updateIntro')->name('page.home.aim-intro.update');
            Route::put('/home/aim-intro/update/{cmsIntroId}', 'CMSHomeIntroController@updateIntroData')->name('page.home.aim-intro.update.data');
            Route::get('/home/aim-intro/delete/{cmsIntroId}', 'CMSHomeIntroController@deleteIntro');

            Route::get('/home/testimonial', 'TestimonialController@index')->name('page.home.testimonial');
            Route::get('/home/testimonial/create', 'TestimonialController@addTestimonial')->name('page.home.testimonial.add');
            Route::post('/home/testimonial/create', 'TestimonialController@addTestimonialData')->name('page.home.testimonial.add.data');
            Route::get('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonial')->name('page.home.testimonial.update');
            Route::put('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonialData')->name('page.home.testimonial.update.data');
            Route::get('/home/testimonial/delete/{cmsTestimonialId}', 'TestimonialController@deleteTestimonial');

            Route::get('/blog', 'BlogController@index')->name('page.blog');
            Route::get('/blog/create', 'BlogController@addBlog')->name('page.blog.add');
            Route::post('/blog/create', 'BlogController@addBlogData')->name('page.blog.add.data');
            Route::get('/blog/update/{blogId}', 'BlogController@updateBlog')->name('page.blog.update');
            Route::put('/blog/update/{blogId}', 'BlogController@updateBlogData')->name('page.blog.update.data');
            Route::get('/blog/delete/{blogId}', 'BlogController@deleteBlog');
            Route::get('/blog/change-status/{slug}', 'BlogController@changeBlogStatus');

            Route::get('/events', 'EventController@index')->name('page.event');
            Route::get('/event/create', 'EventController@addEvent')->name('page.event.add');
            Route::post('/event/create', 'EventController@addEventData')->name('page.event.add.data');
            Route::get('/event/update/{eventId}', 'EventController@updateEvent')->name('page.event.update');
            Route::put('/event/update/{eventId}', 'EventController@updateEventData')->name('page.event.update.data');
            Route::get('/event/delete/{eventId}', 'EventController@deleteEvent');

            Route::get('/event/gallery', 'GalleryController@index')->name('page.event.gallery');
            Route::get('/event/gallery/create', 'GalleryController@addGallery')->name('page.event.gallery.add');
            Route::post('/event/gallery/create', 'GalleryController@addGalleryData')->name('page.event.gallery.add.data');
            Route::get('/event/gallery/update/{galleryId}', 'GalleryController@updateGallery')->name('page.event.gallery.update');
            Route::put('/event/gallery/update/{galleryId}', 'GalleryController@updateGalleryData')->name('page.event.gallery.update.data');
            Route::get('/event/gallery/delete/{galleryId}', 'GalleryController@deleteGallery');

            Route::get('/news', 'NewsController@index')->name('page.news');
            Route::get('/news/create', 'NewsController@addNews')->name('page.news.add');
            Route::post('/news/create', 'NewsController@addNewsData')->name('page.news.add.data');
            Route::get('/news/update/{newsId}', 'NewsController@updateNews')->name('page.news.update');
            Route::put('/news/update/{newsId}', 'NewsController@updateNewsData')->name('page.news.update.data');
            Route::get('/news/delete/{newsId}', 'InvestorController@deleteInvestor');

            Route::get('/research', 'ResearchController@index')->name('page.research');
            Route::get('/research/create', 'ResearchController@addResearch')->name('page.research.add');
            Route::post('/research/create', 'ResearchController@addResearchData')->name('page.research.add.data');
            Route::get('/research/update/{researchId}', 'ResearchController@updateResearch')->name('page.research.update');
            Route::put('/research/update/{researchId}', 'ResearchController@updateResearchData')->name('page.research.update.data');
            Route::get('/research/delete/{researchId}', 'ResearchController@deleteResearch');

            Route::get('/res/funding-opportunity', 'FundingOpportunityController@index')->name('page.research.funding-opportunity');
            Route::get('/res/funding-opportunity/create', 'FundingOpportunityController@addFundingOpportunity')->name('page.research.funding-opportunity.add');
            Route::post('/res/funding-opportunity/create', 'FundingOpportunityController@addFundingOpportunityData')->name('page.research.funding-opportunity.add.data');
            Route::get('/res/funding-opportunity/update/{fundingOpportunityId}', 'FundingOpportunityController@updateFundingOpportunity')->name('page.research.funding-opportunity.update');
            Route::put('/res/funding-opportunity/update/{fundingOpportunityId}', 'FundingOpportunityController@updateFundingOpportunityData')->name('page.research.funding-opportunity.update.data');
            Route::get('/res/funding-opportunity/delete/{fundingOpportunityId}', 'FundingOpportunityController@deleteFundingOpportunity');

            Route::get('/res/funded-project', 'FundedProjectController@index')->name('page.research.funded-project');
            Route::get('/res/funded-project/create', 'FundedProjectController@addFundedProject')->name('page.research.funded-project.add');
            Route::post('/res/funded-project/create', 'FundedProjectController@addFundedProjectData')->name('page.research.funded-project.add.data');
            Route::get('/res/funded-project/update/{fundedProjectId}', 'FundedProjectController@updateFundedProject')->name('page.research.funded-project.update');
            Route::put('/res/funded-project/update/{fundedProjectId}', 'FundedProjectController@updateFundedProjectData')->name('page.research.funded-project.update.data');
            Route::get('/res/funded-project/delete/{fundedProjectId}', 'FundedProjectController@deleteFundedProject');

            Route::get('/res/call-for-proposal', 'CallForProposalController@index')->name('page.research.call-for-proposal');
            Route::get('/res/call-for-proposal/create', 'CallForProposalController@addCallForProposal')->name('page.research.call-for-proposal.add');
            Route::post('/res/call-for-proposal/create', 'CallForProposalController@addCallForProposalData')->name('page.research.call-for-proposal.add.data');
            Route::get('/res/call-for-proposal/update/{callForProposalId}', 'CallForProposalController@updateCallForProposal')->name('page.research.call-for-proposal.update');
            Route::put('/res/call-for-proposal/update/{callForProposalId}', 'CallForProposalController@updateCallForProposalData')->name('page.research.call-for-proposal.update.data');
            Route::get('/res/call-for-proposal/delete/{callForProposalId}', 'CallForProposalController@deleteCallForProposal');

            Route::get('/about-us', 'AboutUsController@index')->name('page.about-us');
            Route::get('/about-us/create', 'AboutUsController@addAboutUs')->name('page.about-us.add');
            Route::post('/about-us/create', 'AboutUsController@addAboutUsData')->name('page.about-us.add.data');
            Route::get('/about-us/update/{cmsAboutUsId}', 'AboutUsController@updateAboutUs')->name('page.about-us.update');
            Route::put('/about-us/update/{cmsAboutUsId}', 'AboutUsController@updateAboutUsData')->name('page.about-us.update.data');
            Route::get('/about-us/delete/{cmsAboutUsId}', 'AboutUsController@deleteAboutUs');

            Route::get('/contact-us', 'ContactUsController@index')->name('page.contact-us');
            Route::get('/contact-us/create', 'ContactUsController@addContactUs')->name('page.contact-us.add');
            Route::post('/contact-us/create', 'ContactUsController@addContactUsData')->name('page.contact-us.add.data');
            Route::get('/contact-us/update/{cmsContactUsId}', 'ContactUsController@updateContactUs')->name('page.contact-us.update');
            Route::put('/contact-us/update/{cmsContactUsId}', 'ContactUsController@updateContactUsData')->name('page.contact-us.update.data');
            Route::get('/contact-us/delete/{cmsContactUsId}', 'ContactUsController@deleteContactUs');

            Route::get('/career', 'CareerController@index')->name('page.career');
            Route::get('/career/create', 'CareerController@addCareer')->name('page.career.add');
            Route::post('/career/create', 'CareerController@addCareerData')->name('page.career.add.data');
            Route::get('/career/update/{cmsCareerId}', 'CareerController@updateCareer')->name('page.career.update');
            Route::put('/career/update/{cmsCareerId}', 'CareerController@updateCareerData')->name('page.career.update.data');
            Route::get('/career/delete/{cmsAboutUsId}', 'CareerController@deleteCareer');

            Route::get('/career/jobs', 'JobController@index')->name('page.career.jobs');
            Route::get('/career/add-job', 'JobController@addJob')->name('page.career.job.add');
            Route::post('/career/add-job', 'JobController@addJobData')->name('page.career.job.add.data');
            Route::get('/career/update-job/{cmsJobId}', 'JobController@updateJob')->name('page.career.job.update');
            Route::put('/career/update-job/{cmsJobId}', 'JobController@updateJobData')->name('page.career.job.update.data');
            Route::get('/career/active-inactive-job/{cmsJobId}', 'JobController@activeInactiveJob');
        });

    });
});

Route::namespace('FrontEnd')->group(function () {
    Route::middleware('UnAuthentic')->group(function () {
        Route::get('/login', 'AuthenticationController@index');
        Route::post('/login', 'AuthenticationController@loginData');
        Route::get('/register', 'AuthenticationController@registerUser');
        Route::post('/register', 'AuthenticationController@registerUserData');
        Route::get('/new-student-verification/{verificationToken}', 'AuthenticationController@userVerification');
        Route::get('/student-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerification');
        Route::post('/student-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerificationData');
        Route::get('/forgot-password', 'AuthenticationController@forgotPassword');
        Route::post('/forgot-password', 'AuthenticationController@forgotPasswordData');
    });

    Route::middleware(['AuthenticStudent', 'not_admin'])->prefix('student')->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::post('/manage-profile', 'ProfileController@updateProfile');
        Route::get('/notifications', 'NotificationController@index');
        Route::get('/delete-notification/{notificationId}', 'NotificationController@deleteNotification');
        Route::get('/notification-detail/{notificationId}', 'NotificationController@detailNotification');

        Route::namespace('Student')->group(function () {
            Route::get('/research-projects', 'ResearchProjectController@index');
            Route::get('/add-research-project', 'ResearchProjectController@addStudentResearch');
            Route::post('/add-research-project', 'ResearchProjectController@addStudentResearchData');
            Route::get('/research-project/detail/{researchId}', 'ResearchProjectController@detailStudentResearch');
            Route::get('/research-project-template', 'ResearchProjectController@downloadTemplate');
        });
    });
});
