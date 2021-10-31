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
    Route::get('/research/funding-opportunities', 'FundingOpportunityController@index');
    Route::get('/research/fyp-projects', 'FypController@index');
    Route::get('/research/funded-projects', 'FundedProjectController@index');
    Route::get('/our-professors', 'ProfessorController@index');
    Route::get('/our-news', 'NewsController@index');
    Route::get('/our-news/{slug}/detail', 'NewsController@newsDetail');
    Route::get('/about-us', 'AboutController@index');
    Route::get('/contact', 'ContactController@index');
    Route::post('/contact/inquiry', 'InquiryController@storeInquiry');
    Route::get('/success-stories', 'SuccessStoryController@index');
    Route::get('/events', 'EventController@index');
    Route::get('/events/{slug}/gallery', 'GalleryController@index');
    Route::get('/internships', 'InternShipController@index');
    Route::get('/internships/{slug}/internship-detail', 'InternShipController@internshipDetail');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::get('/user', function () {
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

    Route::middleware(['AuthenticAdmin', 'NotUser'])->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::get('/view-profile', 'ProfileController@viewProfile');
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

        Route::namespace('Student')->group(function () {
            Route::get('/fyp-proposals', 'FypProposalController@index');
            Route::get('/fyp-proposals/add', 'FypProposalController@addProposal');
            Route::post('/fyp-proposals/add', 'FypProposalController@addProposalData');
            Route::get('/fyp-proposals/{proposalId}/update', 'FypProposalController@updateProposal');
            Route::post('/fyp-proposals/{proposalId}/update', 'FypProposalController@updateProposalData');
            Route::get('/fyp-proposals/{proposalId}/detail', 'FypProposalController@proposalDetail');
            Route::get('/fyp-proposals/{proposalId}/{status}', 'FypProposalController@proposalChangeStatus');

            Route::get('/funded-proposals', 'FundedProposalController@index');
            Route::get('/funded-proposals/add', 'FundedProposalController@addProposal');
            Route::post('/funded-proposals/add', 'FundedProposalController@addProposalData');
            Route::get('/funded-proposals/{proposalId}/update', 'FundedProposalController@updateProposal');
            Route::post('/funded-proposals/{proposalId}/update', 'FundedProposalController@updateProposalData');
            Route::get('/funded-proposals/{proposalId}/detail', 'FundedProposalController@proposalDetail');
            Route::get('/funded-proposals/{proposalId}/{status}', 'FundedProposalController@proposalChangeStatus');

            Route::get('/fyp-projects', 'FypProjectController@index');
            Route::get('/fyp-projects/add', 'FypProjectController@addProject');
            Route::post('/fyp-projects/add', 'FypProjectController@addProjectData');
            Route::get('/fyp-projects/{projectId}/update', 'FypProjectController@updateProject');
            Route::post('/fyp-projects/{projectId}/update', 'FypProjectController@updateProjectData');
            Route::get('/fyp-projects/{projectId}/detail', 'FypProjectController@projectDetail');

            Route::get('/funded-projects', 'FundedProjectController@index');
            Route::get('/funded-projects/add', 'FundedProjectController@addProject');
            Route::post('/funded-projects/add', 'FundedProjectController@addProjectData');
            Route::get('/funded-projects/{projectId}/update', 'FundedProjectController@updateProject');
            Route::post('/funded-projects/{projectId}/update', 'FundedProjectController@updateProjectData');
            Route::get('/funded-projects/{projectId}/detail', 'FundedProjectController@projectDetail');

            Route::get('/research-proposal-template', 'UploadProposalTemplate@index');
            Route::get('/research-proposal-template/add', 'UploadProposalTemplate@uploadResearchTemplate');
            Route::post('/research-proposal-template/add', 'UploadProposalTemplate@uploadResearchTemplateData');
            Route::get('/research-proposal-template/{templateId}/delete', 'UploadProposalTemplate@deleteResearchTemplate');
        });

        Route::namespace('FrontEnd')->prefix('website/pages')->name('website.page.')->group(function () {
            Route::get('/main-home', 'HomeController@index')->name('home');
            Route::get('/main-home/create', 'HomeController@addHome')->name('home.add');
            Route::post('/main-home/create', 'HomeController@addHomeData')->name('home.add.data');
            Route::get('/main-home/update/{cmsHomeId}', 'HomeController@updateHome')->name('home.update');
            Route::put('/main-home/update/{cmsHomeId}', 'HomeController@updateHomeData')->name('home.update.data');
            Route::get('/main-home/delete/{cmsHomeId}', 'HomeController@deleteHome');

            Route::get('/home/testimonial', 'TestimonialController@index')->name('home.testimonial');
            Route::get('/home/testimonial/create', 'TestimonialController@addTestimonial')->name('home.testimonial.add');
            Route::post('/home/testimonial/create', 'TestimonialController@addTestimonialData')->name('home.testimonial.add.data');
            Route::get('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonial')->name('home.testimonial.update');
            Route::put('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonialData')->name('home.testimonial.update.data');
            Route::get('/home/testimonial/delete/{cmsTestimonialId}', 'TestimonialController@deleteTestimonial');

            Route::get('/home/aim-intro', 'CMSHomeIntroController@index')->name('home.aim-intro');
            Route::get('/home/aim-intro/create', 'CMSHomeIntroController@addIntro')->name('home.aim-intro.add');
            Route::post('/home/aim-intro/create', 'CMSHomeIntroController@addIntroData')->name('home.aim-intro.add.data');
            Route::get('/home/aim-intro/update/{cmsIntroId}', 'CMSHomeIntroController@updateIntro')->name('home.aim-intro.update');
            Route::put('/home/aim-intro/update/{cmsIntroId}', 'CMSHomeIntroController@updateIntroData')->name('home.aim-intro.update.data');
            Route::get('/home/aim-intro/delete/{cmsIntroId}', 'CMSHomeIntroController@deleteIntro');

            Route::get('/home/testimonial', 'TestimonialController@index')->name('home.testimonial');
            Route::get('/home/testimonial/create', 'TestimonialController@addTestimonial')->name('home.testimonial.add');
            Route::post('/home/testimonial/create', 'TestimonialController@addTestimonialData')->name('home.testimonial.add.data');
            Route::get('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonial')->name('home.testimonial.update');
            Route::put('/home/testimonial/update/{cmsTestimonialId}', 'TestimonialController@updateTestimonialData')->name('home.testimonial.update.data');
            Route::get('/home/testimonial/delete/{cmsTestimonialId}', 'TestimonialController@deleteTestimonial');

            Route::get('/blog', 'BlogController@index')->name('blog');
            Route::get('/blog/create', 'BlogController@addBlog')->name('blog.add');
            Route::post('/blog/create', 'BlogController@addBlogData')->name('blog.add.data');
            Route::get('/blog/update/{blogId}', 'BlogController@updateBlog')->name('blog.update');
            Route::put('/blog/update/{blogId}', 'BlogController@updateBlogData')->name('blog.update.data');
            Route::get('/blog/delete/{blogId}', 'BlogController@deleteBlog');
            Route::get('/blog/change-status/{slug}', 'BlogController@changeBlogStatus');

            Route::get('/events', 'EventController@index')->name('event');
            Route::get('/events/create', 'EventController@addEvent')->name('event.add');
            Route::post('/events/create', 'EventController@addEventData')->name('event.add.data');
            Route::get('/events/update/{eventId}', 'EventController@updateEvent')->name('event.update');
            Route::put('/events/update/{eventId}', 'EventController@updateEventData')->name('event.update.data');
            Route::get('/events/delete/{eventId}', 'EventController@deleteEvent');

            Route::get('/event/gallery', 'GalleryController@index')->name('event.gallery');
            Route::get('/event/gallery/create', 'GalleryController@addGallery')->name('event.gallery.add');
            Route::post('/event/gallery/create', 'GalleryController@addGalleryData')->name('event.gallery.add.data');
            Route::get('/event/gallery/update/{galleryId}', 'GalleryController@updateGallery')->name('event.gallery.update');
            Route::put('/event/gallery/update/{galleryId}', 'GalleryController@updateGalleryData')->name('event.gallery.update.data');
            Route::get('/event/gallery/delete/{galleryId}', 'GalleryController@deleteGallery');

            Route::get('/register_event', 'RegisterEventController@index')->name('register-event');
            Route::get('/register_event/detail/{registerEventId}', 'RegisterEventController@detailEvent')->name('register-event.detail');
            Route::get('/register_event/delete/{registerEventId}', 'RegisterEventController@deleteEvent');

            Route::get('/internships', 'InternShipController@index')->name('internship');
            Route::get('/internships/create', 'InternShipController@addInternShip')->name('internship.add');
            Route::post('/internships/create', 'InternShipController@addInternShipData')->name('internship.add.data');
            Route::get('/internships/update/{internshipId}', 'InternShipController@updateInternShip')->name('internship.update');
            Route::put('/internships/update/{internshipId}', 'InternShipController@updateInternShipData')->name('internship.update.data');
            Route::get('/internships/delete/{internshipId}', 'InternShipController@deleteInternShip');

            Route::get('/register_intern', 'RegisterInternController@index')->name('register-intern');
            Route::get('/register_intern/detail/{registerInternId}', 'RegisterInternController@detailIntern')->name('register-intern.detail');
            Route::get('/register_intern/delete/{registerInternId}', 'RegisterInternController@deleteIntern');

            Route::get('/news', 'NewsController@index')->name('news');
            Route::get('/news/create', 'NewsController@addNews')->name('news.add');
            Route::post('/news/create', 'NewsController@addNewsData')->name('news.add.data');
            Route::get('/news/update/{newsId}', 'NewsController@updateNews')->name('news.update');
            Route::put('/news/update/{newsId}', 'NewsController@updateNewsData')->name('news.update.data');
            Route::get('/news/delete/{newsId}', 'NewsController@deleteNews')->name('news.delete');

            Route::get('/research', 'ResearchController@index')->name('research');
            Route::get('/research/create', 'ResearchController@addResearch')->name('research.add');
            Route::post('/research/create', 'ResearchController@addResearchData')->name('research.add.data');
            Route::get('/research/update/{researchId}', 'ResearchController@updateResearch')->name('research.update');
            Route::put('/research/update/{researchId}', 'ResearchController@updateResearchData')->name('research.update.data');
            Route::get('/research/delete/{researchId}', 'ResearchController@deleteResearch');

            Route::get('/res/funding-opportunity', 'FundingOpportunityController@index')->name('research.funding-opportunity');
            Route::get('/res/funding-opportunity/create', 'FundingOpportunityController@addFundingOpportunity')->name('research.funding-opportunity.add');
            Route::post('/res/funding-opportunity/create', 'FundingOpportunityController@addFundingOpportunityData')->name('research.funding-opportunity.add.data');
            Route::get('/res/funding-opportunity/update/{fundingOpportunityId}', 'FundingOpportunityController@updateFundingOpportunity')->name('research.funding-opportunity.update');
            Route::put('/res/funding-opportunity/update/{fundingOpportunityId}', 'FundingOpportunityController@updateFundingOpportunityData')->name('research.funding-opportunity.update.data');
            Route::get('/res/funding-opportunity/delete/{fundingOpportunityId}', 'FundingOpportunityController@deleteFundingOpportunity');

            Route::get('/res/funded-project', 'FundedProjectController@index')->name('research.funded-project');
            Route::get('/res/funded-project/create', 'FundedProjectController@addFundedProject')->name('research.funded-project.add');
            Route::post('/res/funded-project/create', 'FundedProjectController@addFundedProjectData')->name('research.funded-project.add.data');
            Route::get('/res/funded-project/update/{fundedProjectId}', 'FundedProjectController@updateFundedProject')->name('research.funded-project.update');
            Route::put('/res/funded-project/update/{fundedProjectId}', 'FundedProjectController@updateFundedProjectData')->name('research.funded-project.update.data');
            Route::get('/res/funded-project/delete/{fundedProjectId}', 'FundedProjectController@deleteFundedProject');

            Route::get('/res/call-for-proposal', 'CallForProposalController@index')->name('research.call-for-proposal');
            Route::get('/res/call-for-proposal/create', 'CallForProposalController@addCallForProposal')->name('research.call-for-proposal.add');
            Route::post('/res/call-for-proposal/create', 'CallForProposalController@addCallForProposalData')->name('research.call-for-proposal.add.data');
            Route::get('/res/call-for-proposal/update/{callForProposalId}', 'CallForProposalController@updateCallForProposal')->name('research.call-for-proposal.update');
            Route::put('/res/call-for-proposal/update/{callForProposalId}', 'CallForProposalController@updateCallForProposalData')->name('research.call-for-proposal.update.data');
            Route::get('/res/call-for-proposal/delete/{callForProposalId}', 'CallForProposalController@deleteCallForProposal');

            Route::get('/about-us', 'AboutUsController@index')->name('about-us');
            Route::get('/about-us/create', 'AboutUsController@addAboutUs')->name('about-us.add');
            Route::post('/about-us/create', 'AboutUsController@addAboutUsData')->name('about-us.add.data');
            Route::get('/about-us/update/{cmsAboutUsId}', 'AboutUsController@updateAboutUs')->name('about-us.update');
            Route::put('/about-us/update/{cmsAboutUsId}', 'AboutUsController@updateAboutUsData')->name('about-us.update.data');
            Route::get('/about-us/delete/{cmsAboutUsId}', 'AboutUsController@deleteAboutUs');

            Route::get('/contact-us', 'ContactUsController@index')->name('contact-us');
            Route::get('/contact-us/create', 'ContactUsController@addContactUs')->name('contact-us.add');
            Route::post('/contact-us/create', 'ContactUsController@addContactUsData')->name('contact-us.add.data');
            Route::get('/contact-us/update/{cmsContactUsId}', 'ContactUsController@updateContactUs')->name('contact-us.update');
            Route::put('/contact-us/update/{cmsContactUsId}', 'ContactUsController@updateContactUsData')->name('contact-us.update.data');
            Route::get('/contact-us/delete/{cmsContactUsId}', 'ContactUsController@deleteContactUs');

            Route::get('/career', 'CareerController@index')->name('career');
            Route::get('/career/create', 'CareerController@addCareer')->name('career.add');
            Route::post('/career/create', 'CareerController@addCareerData')->name('career.add.data');
            Route::get('/career/update/{cmsCareerId}', 'CareerController@updateCareer')->name('career.update');
            Route::put('/career/update/{cmsCareerId}', 'CareerController@updateCareerData')->name('career.update.data');
            Route::get('/career/delete/{cmsAboutUsId}', 'CareerController@deleteCareer');

            Route::get('/career/jobs', 'JobController@index')->name('career.jobs');
            Route::get('/career/add-job', 'JobController@addJob')->name('career.job.add');
            Route::post('/career/add-job', 'JobController@addJobData')->name('career.job.add.data');
            Route::get('/career/update-job/{cmsJobId}', 'JobController@updateJob')->name('career.job.update');
            Route::put('/career/update-job/{cmsJobId}', 'JobController@updateJobData')->name('career.job.update.data');
            Route::get('/career/active-inactive-job/{cmsJobId}', 'JobController@activeInactiveJob');

            Route::get('/inquiries','InquiryController@index')->name('inquiries');
            Route::get('/inquiries/{inquiryId}/detail','InquiryController@inquiryDetail')->name('inquiries.detail');
            Route::post('/inquiries/submit-answer','InquiryController@submitAnswer')->name('inquiries.submit-answer');
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
        Route::get('/user-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerification');
        Route::post('/user-password-verification/{verificationToken}', 'AuthenticationController@userPasswordVerificationData');
        Route::get('/forgot-password', 'AuthenticationController@forgotPassword');
        Route::post('/forgot-password', 'AuthenticationController@forgotPasswordData');

        Route::post('/guest/register-event', 'EventController@guestUserEventRegister');
        Route::post('/guest/register-intern', 'InternShipController@guestUserInternRegister');
    });

    Route::middleware(['AuthenticUser', 'NotAdmin'])->prefix('user')->group(function () {
        Route::get('/dashboard', 'HomeController@index');
        Route::get('/logout', 'AuthenticationController@logout');
        Route::get('/manage-profile', 'ProfileController@index');
        Route::get('/view-profile', 'ProfileController@viewProfile');
        Route::post('/manage-profile', 'ProfileController@updateProfile');
        Route::get('/notifications', 'NotificationController@index');
        Route::get('/delete-notification/{notificationId}', 'NotificationController@deleteNotification');
        Route::get('/notification-detail/{notificationId}', 'NotificationController@detailNotification');

        Route::get('/events', 'EventController@index');
        Route::get('/register-event/{eventId}', 'EventController@authUserEventRegister');
        Route::get('/internships', 'InternShipController@index');
        Route::get('/register-intern/{internshipId}', 'InternShipController@authUserInternRegister');

        Route::namespace('User')->group(function () {
            Route::get('/fyp-proposals', 'FypProposalController@index');
            Route::get('/fyp-proposals/add', 'FypProposalController@addProposal');
            Route::post('/fyp-proposals/add', 'FypProposalController@addProposalData');
            Route::get('/fyp-proposals/{proposalId}/update', 'FypProposalController@updateProposal');
            Route::post('/fyp-proposals/{proposalId}/update', 'FypProposalController@updateProposalData');
            Route::get('/fyp-proposals/{proposalId}/detail', 'FypProposalController@proposalDetail');
            Route::get('/fyp-proposals/{proposalId}/{status}', 'FypProposalController@changeStatus');
            Route::get('/fyp-proposals/template', 'FypProposalController@downloadTemplate');

            Route::get('/funded-proposals', 'FundedProposalController@index');
            Route::get('/funded-proposals/add', 'FundedProposalController@addProposal');
            Route::post('/funded-proposals/add', 'FundedProposalController@addProposalData');
            Route::get('/funded-proposals/{proposalId}/update', 'FundedProposalController@updateProposal');
            Route::post('/funded-proposals/{proposalId}/update', 'FundedProposalController@updateProposalData');
            Route::get('/funded-proposals/{proposalId}/detail', 'FundedProposalController@proposalDetail');
            Route::get('/funded-proposals/{proposalId}/{status}', 'FundedProposalController@proposalChangeStatus');
            Route::get('/funded-proposals/template', 'FundedProposalController@downloadTemplate');

            Route::get('/fyp-projects', 'FypProjectController@index');
            Route::get('/fyp-projects/add', 'FypProjectController@addProject');
            Route::post('/fyp-projects/add', 'FypProjectController@addProjectData');
            Route::get('/fyp-projects/{projectId}/update', 'FypProjectController@updateProject');
            Route::post('/fyp-projects/{projectId}/update', 'FypProjectController@updateProjectData');
            Route::get('/fyp-projects/{projectId}/detail', 'FypProjectController@projectDetail');
            Route::get('/fyp-projects/{projectId}/{status}', 'FypProjectController@projectChangeStatus');

            Route::get('/funded-projects', 'FundedProjectController@index');
            Route::get('/funded-projects/add', 'FundedProjectController@addProject');
            Route::post('/funded-projects/add', 'FundedProjectController@addProjectData');
            Route::get('/funded-projects/{projectId}/update', 'FundedProjectController@updateProject');
            Route::post('/funded-projects/{projectId}/update', 'FundedProjectController@updateProjectData');
            Route::get('/funded-projects/{projectId}/detail', 'FundedProjectController@projectDetail');
            Route::get('/funded-projects/{projectId}/{status}', 'FundedProjectController@projectChangeStatus');

        });
    });
});

