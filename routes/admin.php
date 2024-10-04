<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\All_user\StudentController;
use App\Http\Controllers\Backend\All_users\AdminController;
use App\Http\Controllers\Backend\All_users\StudentController as All_usersStudentController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\Home\CategoryController;
use App\Http\Controllers\Backend\Home\SubCategoryController;
use App\Http\Controllers\Backend\Home\ChildController;
use App\Http\Controllers\Backend\Home\BannerController;
use App\Http\Controllers\Backend\Home\SliderController;
use App\Http\Controllers\Backend\Home\PartnerController;
use App\Http\Controllers\Backend\Home\ClientController;
use App\Http\Controllers\Backend\ServiceTab\ServiceTabController;
use App\Http\Controllers\Backend\Notification\NotificationController;
use App\Http\Controllers\Backend\Order\CourseOrderController;

//blog
use App\Http\Controllers\Backend\Blog\BlogController;
use App\Http\Controllers\Backend\Blog\CategoryController as BlogCategoryController;
use App\Http\Controllers\Backend\Blog\ChildCategoryController;
use App\Http\Controllers\Backend\Blog\SubCategoryController as BlogSubCategoryController;
//Package
use App\Http\Controllers\Backend\Package\PackageController;

use App\Http\Controllers\Backend\Pharmacy\CategoryController as pharCategoryController;
use App\Http\Controllers\Backend\Home\HomeContentController;
use App\Http\Controllers\Backend\Package\YearPackageController;
use App\Http\Controllers\Backend\Pages\PageController;
use App\Http\Controllers\Backend\Review\ReviewController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\subscriber\SubscriberController;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Pages\LearnerController;
use App\Http\Controllers\Backend\Pages\InstructorController;
use App\Http\Controllers\Backend\Home\CountryController;
use App\Http\Controllers\Backend\Testimonial\TestimonialController;
use App\Http\Controllers\Backend\Order\EventOrderController;
use App\Http\Controllers\Backend\Order\UserSubscriptionOrderController;
use App\Http\Controllers\Backend\Home\CouponController;

use App\Http\Controllers\Backend\Appearance\ThemeOptionController;
use App\Http\Controllers\Backend\Courses\DepartmentController;
use App\Http\Controllers\Backend\Currency\CurrencyController as CurrencyCurrencyController;
use App\Http\Controllers\Backend\GetConsultation\GetConsultationController;
use App\Http\Controllers\Backend\Home\ProChildCategoryController;
use App\Http\Controllers\Backend\Landing\LandingPageController;
use App\Http\Controllers\Backend\Office\OfficeController;
use App\Http\Controllers\Backend\Role\RoleController;
use App\Http\Controllers\Backend\Student_Appliction\StudentApplictionController;
use App\Http\Controllers\Backend\WithdrawalController;
use App\Http\Controllers\EmployeeManageController;

Route::get('/login', [LoginController::class, 'adminLoginShow']);
Route::post('/login', [LoginController::class, 'adminLogin'])->name('login');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::prefix('admin')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
  //Admin Dashboard Route
  Route::get('dashboard', [BackendController::class, 'index'])->name('admin.dashboard');
  // home route start

  Route::prefix('home')->group(function () {
    //category
    Route::get('home-categories', [CategoryController::class, "index"])->name('home-category.index');
    Route::get('home-category-create', [CategoryController::class, "create"])->name('home-category.create');
    Route::post('home-category-store', [CategoryController::class, "store"])->name('home-category.store');
    Route::get('home-category-edit/{id}', [CategoryController::class, "edit"])->name('home-category.edit');
    Route::post('home-category-update/{id}', [CategoryController::class, "update"])->name('home-category.update');
    Route::post('home-category-delete', [CategoryController::class, "destroy"])->name('home-category.delete');
    Route::get('/home-category_status_toggle/{id}', [CategoryController::class, 'status_toggle'])->name('home-category.status_toggle');
    //end category

    //sub category
    // Route::resource('home-sub-category', SubCategoryController::class);
    Route::get('home-sub-categories', [SubCategoryController::class, "index"])->name('home-sub-category.index');
    Route::get('home-sub-category-create', [SubCategoryController::class, "create"])->name('home-sub-category.create');
    Route::post('home-sub-category-store', [SubCategoryController::class, "store"])->name('home-sub-category.store');
    Route::get('home-sub-category-edit/{id}', [SubCategoryController::class, "edit"])->name('home-sub-category.edit');
    Route::post('home-sub-category-update/{id}', [SubCategoryController::class, "update"])->name('home-sub-category.update');
    Route::post('home-sub-category-delete', [SubCategoryController::class, "destroy"])->name('home-sub-category.delete');
    Route::get('/home-sub-category-status-toggle/{id}', [SubCategoryController::class, 'status_toggle'])->name('home-sub-category.status_toggle');
    //end sub category

    //Chile category
    Route::resource('home-child-category', ChildController::class);
    Route::post('home-child-category-delete', [ChildController::class, "destroy"])->name('home-child-category.delete');
    Route::get('/home-child-category-status-toggle/{id}', [ChildController::class, 'status_toggle'])->name('home-child-category.status_toggle');
    //end Chile category

    //Pro Chile category
    Route::resource('home-pro-child-category', ProChildCategoryController::class);
    Route::post('home-pro-child-category-delete', [ProChildCategoryController::class, "destroy"])->name('home-pro-child-category.delete');
    Route::get('/home-pro-child-category-status-toggle/{id}', [ProChildCategoryController::class, 'status_toggle'])->name('home-pro-child-category.status_toggle');
    //end pro Chile category

    //Start slider
    Route::resource('home-slider', SliderController::class);
    Route::post('home-slider-delete', [SliderController::class, "destroy"])->name('home-slider.delete');
    Route::get('/home-slider-status-toggle/{id}', [SliderController::class, 'status_toggle'])->name('home-slider.status_toggle');
    //end  slider

    //Start partner
    Route::resource('home-partner', PartnerController::class);
    Route::post('home-partner-delete', [PartnerController::class, "destroy"])->name('home-partner.delete');
    Route::get('/home-partner-status-toggle/{id}', [PartnerController::class, 'status_toggle'])->name('home-partner.status_toggle');
    //end  slider

    //Start client
    Route::resource('home-client', ClientController::class);
    Route::post('home-client-delete', [ClientController::class, "destroy"])->name('home-client.delete');
    Route::get('/home-client-status-toggle/{id}', [ClientController::class, 'status_toggle'])->name('home-client.status_toggle');
    //end  client

    //Start client
    Route::resource('home-servicetab', ServiceTabController::class);
    Route::post('home-servicetab-delete', [ServiceTabController::class, "destroy"])->name('home-servicetab.delete');
    Route::get('/home-servicetab-status-toggle/{id}', [ServiceTabController::class, 'status_toggle'])->name('home-servicetab.status_toggle');
    //end  client

    //Country Start
    Route::get('index/country', [CountryController::class, "index"])->name('admin.country.index');
    Route::get('create/country', [CountryController::class, "create"])->name('admin.country.create');
    Route::post('store/country', [CountryController::class, "store"])->name('admin.country.store');
    Route::get('edit/country/{id}', [CountryController::class, "edit"])->name('admin.country.edit');
    Route::post('update/country/{id}', [CountryController::class, "update"])->name('admin.country.update');
    Route::post('delete/country', [CountryController::class, "destroy"])->name('admin.country.delete');
    //Country End

    //Country Start
    Route::get('index/country', [CountryController::class, "index"])->name('admin.country.index');
    Route::get('create/country', [CountryController::class, "create"])->name('admin.country.create');
    Route::post('store/country', [CountryController::class, "store"])->name('admin.country.store');
    Route::get('edit/country/{id}', [CountryController::class, "edit"])->name('admin.country.edit');
    Route::post('update/country/{id}', [CountryController::class, "update"])->name('admin.country.update');
    Route::post('delete/country', [CountryController::class, "destroy"])->name('admin.country.delete');
    //Country End

  });
  //end home route


  //withdrawal route start here
  Route::get('manage-withdrawal-request', [WithdrawalController::class, 'manageWithdrawalRequest'])->name('backend.manage_withdrawal_request');
  Route::get('edit-withdrawal-request/{id}', [WithdrawalController::class, 'editWithdrawalRequest'])->name('backend.edit_withdrawal_request');
  Route::post('update-withdrawal-request/{id}', [WithdrawalController::class, 'updateWithdrawalRequest'])->name('backend.update_withdrawal_request');


  //commission  route start here
  Route::get('commission', [WithdrawalController::class, 'manageCommission'])->name('backend.commission_manage');
  Route::post('commission-set', [WithdrawalController::class, 'setCommission'])->name('backend.commission_save');


  //Home content route start here
  Route::get('home-content', [HomeContentController::class, 'getHomeContect'])->name('backend.home_content');

  Route::post('home-content-banner-update', [HomeContentController::class, 'setBannerSection'])->name('backend.home_banner_section.update');
  Route::post('home-content-sub-banner-update', [HomeContentController::class, 'setSubBannerSection'])->name('backend.home_sub_banner_section.update');
  Route::post('home-content-university-update', [HomeContentController::class, 'setUniversitySection'])->name('backend.home_university_section.update');
  Route::post('home-content-home-location-update', [HomeContentController::class, 'setHomeLocationSection'])->name('backend.home_location_section.update');
  Route::post('home-content-course-update', [HomeContentController::class, 'setCourseSection'])->name('backend.home_course_section.update');
  Route::post('home-content-partner-update', [HomeContentController::class, 'setPartnerSection'])->name('backend.home_partner_section.update');
  Route::post('home-content-learn-update', [HomeContentController::class, 'setLearnSection'])->name('backend.home_learn_section.update');
  Route::post('home-content-media-partner-update', [HomeContentController::class, 'setMediaPartnerSection'])->name('backend.home_media_partner_section.update');
  Route::post('home-content-counting-update', [HomeContentController::class, 'setCountingSection'])->name('backend.home_counting_section.update');
  Route::post('home-content-testimonials-update', [HomeContentController::class, 'setTestimonialsSection'])->name('backend.home_testimonials_section.update');
  Route::post('home-content-package-update', [HomeContentController::class, 'setPackageSection'])->name('backend.home_package_section.update');
  Route::post('home-content-question-update', [HomeContentController::class, 'setQuestionSection'])->name('backend.home_question_section.update');
  Route::post('home-content-register-update', [HomeContentController::class, 'setRegisterSection'])->name('backend.home_register_section.update');
  Route::post('home-content-latest-updates', [HomeContentController::class, 'setLatestUpdates'])->name('backend.home_latest_updates.update');
  Route::post('home-content-footer-activity-gallery-update', [HomeContentController::class, 'footerActivityGallery'])->name('backend.home_footer_activity_gallery.update');


  //currency Route start
  Route::get('currency-list', [CurrencyCurrencyController::class, 'getCurrencyPageLoad'])->name('admin.manage_currency');
  Route::get('currency-create', [CurrencyCurrencyController::class, 'getCurrencyTableData'])->name('admin.create_currency');
  Route::post('currency-stor', [CurrencyCurrencyController::class, 'saveCurrencyData'])->name('admin.stor_currency');

  Route::get('currency-edit/{id}', [CurrencyCurrencyController::class, 'editCurrency'])->name('admin.edit_currency');
  Route::post('currency-update/{id}', [CurrencyCurrencyController::class, 'updateCurrency'])->name('admin.update_currency');
  Route::post('currency-delete', [CurrencyCurrencyController::class, 'deleteCurrency'])->name('admin.delete_currency');
  //currency Route end

  // Blog route start
  Route::get('blog/list', [BlogController::class, 'index'])->name('blog.index');
  Route::get('blog/add', [BlogController::class, 'create'])->name('blog.create');
  Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
  Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
  Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
  Route::post('blog/delete', [BlogController::class, "destroy"])->name('blog.delete');
  Route::get('/blog_status_toggle/{id}', [BlogController::class, 'status_toggle'])->name('blog.status_toggle');


  Route::get('blog/comments', [BlogController::class, 'blogComment'])->name('blog.comments');
  Route::get('blog/comments/edit/{id}', [BlogController::class, 'blogCommentEdit'])->name('blog.comment_edit');
  Route::post('blog/comments/update/{id}', [BlogController::class, 'blogCommentUpdate'])->name('blog.comment_update');
  Route::post('blog/comments/delete', [BlogController::class, 'blogCommentDelete'])->name('blog.comment_delete');


  // Blog topic route start
  Route::get('blog/topic-list', [BlogController::class, 'manageBlogTopic'])->name('blog.manage_topic');
  Route::get('blog/topic-add', [BlogController::class, 'createBlogTopic'])->name('blog.create_topic');
  Route::post('blog/topic-store', [BlogController::class, 'storeBlogTopic'])->name('blog.store_topic');
  Route::get('blog/topic-edit/{id}', [BlogController::class, 'editBlogTopic'])->name('blog.edit_topic');
  Route::post('blog/topic-update/{id}', [BlogController::class, 'updateBlogTopic'])->name('blog.update_topic');
  Route::post('blog/topic-delete', [BlogController::class, "destroyBlogTopic"])->name('blog.delete_topic');
  Route::get('/blog-topic-status-toggle/{id}', [BlogController::class, 'status_toggleBlogTopic'])->name('blog.status_toggle_topic');
  //end Blog route



  // Create Admin And manage
  Route::get('admin-user-list', [AdminController::class, 'index'])->name('backend.manage_admin');
  Route::get('admin-user-add', [AdminController::class, 'create'])->name('backend.create_admin');
  Route::post('admin-user-store', [AdminController::class, 'store'])->name('backend.store_admin');
  Route::get('admin-user-edit/{id}', [AdminController::class, 'edit'])->name('backend.edit_admin');
  Route::post('admin-user-update/{id}', [AdminController::class, 'update'])->name('backend.update_admin');
  Route::post('admin-user-delete', [AdminController::class, "destroy"])->name('backend.delete_admin');
  Route::post('change-password', [AdminController::class, "changePassword"])->name('backend.admin_change_password');
  //Create Admin And manage

  // Package route start
  //  Route::get('Package/list',[PackageController::class,'index'])->name('package.index');
  //  Route::get('Package/add',[PackageController::class,'create'])->name('package.create');
  //  Route::post('Packagestore',[PackageController::class,'store'])->name('package.store');
  //  Route::get('Package/edit/{id}',[PackageController::class,'edit'])->name('package.edit');
  //  Route::post('Package/update/{id}',[PackageController::class,'update'])->name('package.update');
  //  Route::post('Package/delete',[PackageController::class,"destroy"])->name('package.delete');
  //  Route::get('/Package_status_toggle/{id}', [PackageController::class, 'status_toggle'])->name('package.status_toggle');
  //end Package route



  Route::prefix('role')->group(function () {
    //Role
    Route::get('index', [RoleController::class, "index"])->name('admin.role.index');
    Route::get('create', [RoleController::class, "create"])->name('admin.role.create');
    Route::post('store', [RoleController::class, "store"])->name('admin.role.store');
    Route::get('edit/{id}', [RoleController::class, "edit"])->name('admin.role.edit');
    Route::patch('update/{id}', [RoleController::class, "update"])->name('admin.role.update');
    Route::post('delete', [RoleController::class, "destroy"])->name('admin.role.delete');
    Route::get('/role-status_toggle/{id}', [RoleController::class, 'statusToggle'])->name('admin.role.status_toggle');
    Route::get('/permission/{id}', [RoleController::class, 'getrolePermission'])->name('admin.role.permission');
    Route::post('/set-permission/{id}', [RoleController::class, 'setRolePermission'])->name('admin.role.set_permission');
  });


  Route::get('/footer-pages', [PageController::class, 'footerPages'])->name('backend.footer_pages');
  //page category
  Route::get('/page-category', [PageController::class, 'categoryIndex'])->name('admin.page_category.index');
  Route::get('/page-category/create', [PageController::class, 'categoryCreate'])->name('admin.page_category.create');
  Route::post('/page-category/store', [PageController::class, 'categoryStore'])->name('admin.page_category.store');
  Route::get('/page-category/edit/{id}', [PageController::class, 'categoryEdit'])->name('admin.page_category.edit');
  Route::post('/page-category/update/{id}', [PageController::class, 'categoryUpdate'])->name('admin.page_category.update');
  Route::get('/page-category/delete/{id}', [PageController::class, 'categoryDelete'])->name('admin.page_category.delete');
  Route::get('/page-category/status_toggle/{id}', [PageController::class, 'category_status_toggle'])->name('admin.page_category.status_toggle');

  Route::get('/subscribers', [SubscriberController::class, 'index'])->name('admin.subscriber.index');
  Route::post('/subscribers/delete', [SubscriberController::class, 'destroy'])->name('admin.subscriber.delete');



  //Course Order
  Route::get('course/orders/manage', [CourseOrderController::class, 'CourseOrderManage'])->name('admin.course.order.manage');
  Route::get('course/orders/details/{id}', [CourseOrderController::class, 'CourseOrderDetails'])->name('course.order.details');
  Route::get('course/status/change/{id}', [CourseOrderController::class, 'CourseStatusChange'])->name('status.change');
  Route::post('course/orders/payment/status/change/index', [CourseOrderController::class, "CourseStatusChangeIndex"])->name('status.change.index');
  Route::get('order-print/{id}', [CourseOrderController::class, 'OrderPrint'])->name('admin.order_print');


  //Subscription Course Order
  Route::get('package/orders/manage', [UserSubscriptionOrderController::class, 'PackageOrderManage'])->name('admin.package.order.manage');
  Route::get('package/orders/details/{id}', [UserSubscriptionOrderController::class, 'PackageOrderDetails'])->name('package.order.details');
  Route::get('package/status/change/{id}', [UserSubscriptionOrderController::class, 'PackageStatusChange'])->name('package.status.change');
  Route::post('package/orders/payment/status/change/index', [UserSubscriptionOrderController::class, "PackageStatusChangeIndex"])->name('package.status.change.index');
  Route::get('package/order-print/{id}', [UserSubscriptionOrderController::class, 'packageOrderPrint'])->name('admin.package.order_print');



  //Event Order
  Route::get('event/orders/manage', [EventOrderController::class, 'EventOrderManage'])->name('admin.event.order.manage');
  Route::get('event/orders/details/{id}', [EventOrderController::class, 'EventOrderDetails'])->name('event.order.details');
  Route::get('event/status/change/{id}', [EventOrderController::class, 'EventStatusChange'])->name('event.status.change');
  Route::post('event/orders/payment/status/change/index', [EventOrderController::class, "EventStatusChangeIndex"])->name('event.status.change.index');
  Route::get('event/order-print/{id}', [EventOrderController::class, 'EventOrderPrint'])->name('admin.event.order_print');

  Route::get('site-setting', [SiteSettingController::class, 'getSiteSetting'])->name('backend.setting');
  Route::post('site-setting-update', [SiteSettingController::class, 'setSiteSetting'])->name('backend.setting.update');
  //end site setting

  //page Route start
  Route::resource('all-pages', PageController::class);
  Route::post('/delete-page', [PageController::class, 'pageDelete'])->name('page.delete');
  Route::get('/all-page-status/{id}', [PageController::class, 'status_toggle'])->name('page.status_toggle');

  Route::prefix('page-control')->group(function () {
    Route::get('/', [PageController::class, 'page_control_index'])->name('admin.page_control.index');
    Route::get('create', [PageController::class, 'page_control_create'])->name('admin.page_control.create');
    Route::post('create', [PageController::class, 'page_control_store'])->name('admin.page_control.store');
    Route::get('edit/{id}', [PageController::class, 'page_control_edit'])->name('admin.page_control.edit');
    Route::post('edit/{id}', [PageController::class, 'page_control_update'])->name('admin.page_control.update');
    Route::post('delete', [PageController::class, 'page_control_delete'])->name('admin.page_control.delete');
  });
  //page Route end

  Route::prefix('appearance')->group(function () {
    //appearance /theme option
    Route::get('/theme_option', [ThemeOptionController::class, 'Theme_Option'])->name('backend.theme-options');
    Route::post('/logo-option-save', [ThemeOptionController::class, 'saveThemeLogo'])->name('backend.save-theme-logo');

    Route::get('/theme_option_home_popup', [ThemeOptionController::class, 'Theme_Option_Home_popup'])->name('backend.theme-options-home-popup');
    Route::post('/home-popup-option-save', [ThemeOptionController::class, 'saveThemeHomePopup'])->name('backend.save-theme-home-popup');

    Route::get('/theme_option_header', [ThemeOptionController::class, 'themeOptionHeader'])->name('backend.theme-options-header');
    Route::post('/header-option-save', [ThemeOptionController::class, 'saveThemeHeader'])->name('backend.save-theme-header');

    Route::get('/theme_option_footer', [ThemeOptionController::class, 'Theme_Option_Footer'])->name('backend.theme-options-footer');
    Route::post('/theme_option_footer_save', [ThemeOptionController::class, 'SaveThemeFooter'])->name('backend.theme-options-footer-save');

    Route::get('/theme_option_language-switcher', [ThemeOptionController::class, 'Theme_Language_Switcher'])->name('backend.language-switcher');

    Route::get('/theme-options-color', [ThemeOptionController::class, 'Theme_Color'])->name('backend.theme-options-color');
    Route::post('/theme_options_color_save', [ThemeOptionController::class, 'SaveThemeColor'])->name('backend.theme-options-color-save');
    //  Route::get('/logo-option', [ThemeOptionController::class, 'LogoOption'])->name('backend.theme-options');

    Route::get('/theme-social-media', [ThemeOptionController::class, 'Theme_Social_Media'])->name('backend.social-media');
    Route::post('/theme-social-media_save', [ThemeOptionController::class, 'SaveThemeSocialMedia'])->name('backend.social-media-save');

    Route::get('/theme-options-seo', [ThemeOptionController::class, 'ThemeOptionsSeo'])->name('backend.theme-options-seo');
    Route::post('/theme-options-seo-save', [ThemeOptionController::class, 'ThemeOptionsSeoSave'])->name('backend.theme-options-seo-save');

    Route::get('/theme-options-social-login', [ThemeOptionController::class, 'ThemeOptionsSocialLogin'])->name('backend.theme-options-social-login');
    Route::post('/theme-options-social-login-save', [ThemeOptionController::class, 'ThemeOptionsSocialLoginSave'])->name('backend.theme-options-social-login-save');

    Route::get('/theme-custom-css', [ThemeOptionController::class, 'ThemeCustomCss'])->name('backend.custom-css');
    Route::post('/theme-custom-css-save', [ThemeOptionController::class, 'SaveThemeCustomCss'])->name('backend.custom-css-save');

    Route::get('/theme-custom-html', [ThemeOptionController::class, 'ThemeCustomHtml'])->name('backend.custom-html');
    Route::post('/theme-custom-html-save', [ThemeOptionController::class, 'SaveThemeCustomHtml'])->name('backend.custom-html-save');

    Route::get('/theme-custom-js', [ThemeOptionController::class, 'ThemeCustomJs'])->name('backend.custom-js');
    Route::post('/theme-custom-js-save', [ThemeOptionController::class, 'SaveThemeCustomJs'])->name('backend.custom-js-save');

    Route::get('/theme-google-maps', [ThemeOptionController::class, 'ThemeGoogleMaps'])->name('backend.theme-options-google-map');
    Route::post('/theme-google-maps-save', [ThemeOptionController::class, 'ThemeGoogleMapsSave'])->name('backend.theme-options-google-map-save');

    Route::get('/theme-payment-gateway', [ThemeOptionController::class, 'ThemePaymentGateway'])->name('backend.theme-options-payment-gateway');
    Route::post('/theme-payment-gateway-save', [ThemeOptionController::class, 'ThemePaymentGatewaySave'])->name('backend.theme-options-payment-gateway-save');

    // Route::get('/theme-payment-gateway', [ThemeOptionController::class, 'ThemeFacebookPixel'])->name('backend.theme-options-facebook-pixel');
    // Route::post('/theme-payment-gateway-save', [ThemeOptionController::class, 'ThemeFacebookPixelSave'])->name('backend.theme-options-payment-gateway-save');

    // banner
    Route::resource('home-banner', BannerController::class);
    Route::post('banner/home-banner-delete', [BannerController::class, "destroy"])->name('home-banner.delete');
    Route::get('banner/home-banner-status-toggle/{id}', [BannerController::class, 'status_toggle'])->name('home-banner.status_toggle');

    Route::get('banner/image-edit/{id}', [BannerController::class, "BannerImageEdit"])->name('home-banner-image.edit');
    //end  banner

  });



  //Monthly package Business Route
  Route::get('/all-package', [PackageController::class, 'all_package'])->name('admin.all_package');
  Route::post('/add-package', [PackageController::class, 'add_package'])->name('admin.add_package');
  Route::get('/edit-package/{id}', [PackageController::class, 'edit_package'])->name('admin.edit_package');
  Route::post('/update-package/{id}', [PackageController::class, 'update_package'])->name('admin.update_package');
  Route::post('/delete-package', [PackageController::class, 'delete_package'])->name('admin.delete_package');
  Route::get('/package_status_toggle/{id}', [PackageController::class, 'package_status_toggle'])->name('admin.month_package_toggle');


  //Yearly package Business Route
  Route::get('/all-year-package', [YearPackageController::class, 'all_year_package'])->name('admin.all_year_package');
  Route::post('/add-year-package', [YearPackageController::class, 'add_year_package'])->name('admin.add_year_package');
  Route::get('/edit-year-package/{id}', [YearPackageController::class, 'edit_year_package'])->name('admin.edit_year_package');
  Route::post('/update-year-package/{id}', [YearPackageController::class, 'update_year_package'])->name('admin.update_year_package');
  Route::post('/delete-year-package', [YearPackageController::class, 'delete_year_package'])->name('admin.delete_year_package');
  Route::get('/year_status_toggle/{id}', [YearPackageController::class, 'year_status_toggle'])->name('admin.year_package_toggle');


  //Add New Review Testimonial
  Route::get('/manage-testimonial', [TestimonialController::class, 'manageTestimonial'])->name('admin.manage_testimonial');
  Route::get('/add-new-testimonial', [TestimonialController::class, 'addTestimonial'])->name('admin.add_new_testimonial');
  Route::post('/add-new-testimonial', [TestimonialController::class, 'addTestimonialStor'])->name('admin.add_new_testimonial_stor');
  Route::get('/edit-testimonial/{id}', [TestimonialController::class, 'editTestimonial'])->name('admin.edit_testimonial');
  Route::post('/update-testimonial/{id}', [TestimonialController::class, 'updateTestimonial'])->name('admin.update_testimonial');
  Route::get('/status_toggle/{id}', [TestimonialController::class, 'testimonialStatus'])->name('admin.status_testimonial');
  Route::post('/delete-testimonial', [TestimonialController::class, 'deleteTestimonial'])->name('admin.delete_testimonial');

  //Company Details Page
  Route::get('/company-details-page-setup', [PageController::class, 'companyDetailsPage'])->name('admin.companyDetails_page');
  Route::post('/company-details-page-setup', [PageController::class, 'companyDetailsPageSetup'])->name('admin.companyDetails_page_setup');

  //Founders Page
  Route::get('/founders-co-founders-page-setup', [PageController::class, 'foundersCoFoundersPage'])->name('admin.founders_co_founders_page');
  Route::post('/founders-co-founders-page-setup', [PageController::class, 'foundersCoFoundersPageSetup'])->name('admin.founders_co_founders_page_setup');

  //Gallery Page
  Route::get('/gallery-page-setup', [PageController::class, 'galleryPage'])->name('admin.gallery_page');
  Route::post('/gallery-page-setup', [PageController::class, 'galleryPageSetup'])->name('admin.gallery_page_setup');

  //Authorization Letters Page
  Route::get('/authorization-letters-page-setup', [PageController::class, 'authorizationLettersPage'])->name('admin.authorizationLetters_page');
  Route::post('/authorization-letters-page-setup', [PageController::class, 'authorizationLettersPageSetup'])->name('admin.authorizationLetters_page_setup');

  //Activities Page
  Route::get('/activities-page-setup', [PageController::class, 'activitiesPage'])->name('admin.activities_page');
  Route::get('/activities-page-add', [PageController::class, 'activitiesPageAdd'])->name('admin.activities_page_add');
  Route::post('/activities-page-setup', [PageController::class, 'activitiesPageSetup'])->name('admin.activities_page_setup');

  //Our Services Page
  Route::get('/our-services-page-setup', [PageController::class, 'ourServicesPage'])->name('admin.ourServices_page');
  Route::post('/our-services-page-setup', [PageController::class, 'ourServicesPageSetup'])->name('admin.ourServices_page_setup');

  //Why China Page
  Route::get('/why-china-page-setup', [PageController::class, 'whyChinaPage'])->name('admin.whyChina_page');
  Route::post('/why-china-page-setup', [PageController::class, 'whyChinaPageSetup'])->name('admin.whyChina_page_setup');

  //About China Page
  Route::get('/about-china-page-setup', [PageController::class, 'aboutChinaPage'])->name('admin.aboutChina_page');
  Route::post('/about-china-page-setup', [PageController::class, 'aboutChinaPageSetup'])->name('admin.aboutChina_page_setup');

  //About Page
  Route::get('/about-page-setup', [PageController::class, 'aboutPage'])->name('admin.about_page');
  Route::post('/about-page-setup', [PageController::class, 'aboutPageSetup'])->name('admin.about_page_setup');

  //LEARNER Page
  Route::get('/page-learner', [LearnerController::class, 'learnerPage'])->name('admin.learner');
  Route::post('/page-learner-setup', [LearnerController::class, 'learnerPageSetup'])->name('admin.learner_page_setup');

  //Instructor Page
  Route::get('/page-instructor', [InstructorController::class, 'instructorPage'])->name('admin.instructor');
  Route::post('/page-instructor-setup', [InstructorController::class, 'instructorPageSetup'])->name('admin.instructor_page_setup');

  //LIBRARY Page
  Route::get('/page-library', [PageController::class, 'libraryPage'])->name('admin.library');
  Route::post('/page-library-setup', [PageController::class, 'libraryPageSetup'])->name('admin.library_page_setup');

  //maestor Class Page
  Route::get('/maestor-class', [PageController::class, 'maestorClass'])->name('admin.maestor_class');
  Route::post('/maestor-class-setup', [PageController::class, 'maestorClassSetup'])->name('admin.maestor_class_setup');
  //FAQ Page
  Route::get('/manage-faq', [PageController::class, 'manageFaq'])->name('admin.manage_faq');
  Route::post('/faq-setup', [PageController::class, 'faqSetup'])->name('admin.faq_setup');
  //----------------
  //category
  Route::resource('phar-category', BlogCategoryController::class);
  Route::post('phar-category-delete', [BlogCategoryController::class, "destroy"])->name('phar-category.delete');
  //end category

  //sub category
  Route::resource('phar-sub-category', BlogSubCategoryController::class);
  Route::post('phar-sub-category-delete', [BlogSubCategoryController::class, "destroy"])->name('phar-sub-category.delete');
  //end sub category
  //sub child category
  Route::resource('phar-child-category', ChildCategoryController::class);
  Route::post('phar-child-category-delete', [ChildCategoryController::class, "destroy"])->name('phar-child-category.delete');
  Route::get('phar-child-category/status_toggle/{id}', [ChildCategoryController::class, 'status_toggle'])->name('phar-child-category.status_toggle');
  //end child category

  //Student
  Route::prefix('student')->group(function () {
    Route::get('index', [All_usersStudentController::class, "index"])->name('admin.student.index');
    Route::get('create', [All_usersStudentController::class, "create"])->name('admin.student.create');
    Route::post('store', [All_usersStudentController::class, "store"])->name('admin.student.store');
    Route::get('edit/{id}', [All_usersStudentController::class, "edit"])->name('admin.student.edit');
    Route::post('update/{id}', [All_usersStudentController::class, "update"])->name('admin.student.update');
    Route::post('delete', [All_usersStudentController::class, "destroy"])->name('admin.student.delete');
    Route::post('student-change-password', [All_usersStudentController::class, "changePassword"])->name('admin.student_change_password');
    Route::get('student-details/{id}', [All_usersStudentController::class, "studentDetails"])->name('admin.student_details');
  });
});


//ajax start Sub Category and Child Category get
Route::get('/get/subcat/{id}', [BannerController::class, 'getsubcategory']);
Route::get('/get/childcat/{id}', [BannerController::class, 'getchildcategory']);
Route::get('/get/prochildcat/{id}', [BannerController::class, 'getprochildcategory']);
Route::get('get/blog-items', [HomeContentController::class, 'getBlogItems'])->name('admin.ajax.getBlogItems');
//ajax End Sub Category and Child Category get

//add new tag
Route::post('add-new-select2-car', [BlogController::class, "addSelect2"]);

//see all notification
Route::get('backend/all/notification', [NotificationController::class, 'allNotification'])->name('backend.all.notification');
Route::get('/get-backend-notification', [NotificationController::class, 'getBackendNotification']);

// require __DIR__.'/auth.php';

Route::get('/blog-topic-show-ajax/{id}', [BlogController::class, "getBlogByTopic"]);


Route::middleware(['auth:admin', 'adminCheck:0'])->group(function () {
  Route::get('backend/all/notification/index', [NotificationController::class, 'index'])->name('admin.all.notification.index');
  Route::post('backend/notification/Delete', [NotificationController::class, 'destroy'])->name('admin.notification.delete');

  Route::prefix('coupon')->group(function () {

    //Coupon Start
    Route::get('index/coupon', [CouponController::class, "index"])->name('admin.coupon.index');
    Route::get('create/coupon', [CouponController::class, "create"])->name('admin.coupon.create');
    Route::post('store/coupon', [CouponController::class, "store"])->name('admin.coupon.store');
    Route::get('edit/coupon/{id}', [CouponController::class, "edit"])->name('admin.coupon.edit');
    Route::post('update/coupon/{id}', [CouponController::class, "update"])->name('admin.coupon.update');
    Route::post('delete/coupon', [CouponController::class, "destroy"])->name('admin.coupon.delete');
    //Coupon End
  });
});


Route::get('get_location_u/{id}', [HomeContentController::class, 'getLocationU']);

Route::prefix('admin')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {

  Route::get('student-appliction-list-partner-wise', [StudentApplictionController::class, "partnerWiseStudentsApplications"])->name('admin.student_appliction_list_partner_wise');
  Route::get('student-list-partner-wise/{partner_id}', [StudentApplictionController::class, "partnerWiseStudents"])->name('admin.student_list_partner_wise');
  Route::get('appliction-list-partner-wise/{partner_id}', [StudentApplictionController::class, "partnerWiseApplications"])->name('admin.appliction_list_partner_wise');

  Route::post('assign-student-to-partner', [StudentApplictionController::class, "assignStudentToEmployee"])->name('admin.assign_student_to_employee');
  Route::post('assign-application-to-partner', [StudentApplictionController::class, "assignApplicationToEmployee"])->name('admin.assign_application_to_employee');

  Route::get('student-appliction-list-assigned', [StudentApplictionController::class, "index"])->name('admin.student_appliction_list_assigned');
  Route::get('student-appliction-list', [StudentApplictionController::class, "index"])->name('admin.student_appliction_list');
  Route::post('student-appliction-list', [StudentApplictionController::class, "index"])->name('admin.student_appliction_list.filter');
  Route::get('student-appliction-details/{id}', [StudentApplictionController::class, "details"])->name('admin.student_appliction_details');
  Route::get('student-appliction-invoice/{id}', [StudentApplictionController::class, "applicationInvoice"])->name('admin.student_appliction_invoice');
  Route::get('student-appliction-edit/{id}', [StudentApplictionController::class, "edit"])->name('admin.student_appliction_edit');
  Route::post('student-appliction-update/{id}', [StudentApplictionController::class, "update"])->name('admin.student_appliction_update');
  Route::post('student-appliction-delete', [StudentApplictionController::class, "delete"])->name('admin.student_appliction_delete');
  Route::get('student-appliction-family-info-edit/{id}', [StudentApplictionController::class, "editFamily"])->name('admin.student_appliction_edit_family');
  Route::post('student-appliction-family-info-update/{id}', [StudentApplictionController::class, "familyUpdate"])->name('admin.student_appliction_update_family');
  Route::get('student-appliction-program-edit/{id}', [StudentApplictionController::class, "editProgramInfo"])->name('admin.student_appliction_program_edit');
  Route::post('students-appliction-program-update/{id}', [StudentApplictionController::class, "updateProgramInfo"])->name('admin.student_appliction_program_update');
  Route::get('student-appliction-document/{id}', [StudentApplictionController::class, "editDocument"])->name('admin.student_appliction_document');
  Route::post('student-appliction-document-update/{id}', [StudentApplictionController::class, "updateDocument"])->name('admin.student_appliction_document-update');
  Route::post('backend.application-status/{id}', [StudentApplictionController::class, "applicationStatus"])->name('backend.application-status');


  Route::get('/application/doc/all-download/{application_id}', [StudentApplictionController::class, 'allDocumentDownload'])->name('admin.application-all-document-download');
  Route::get('/application/doc/download/{id}', [StudentApplictionController::class, 'applicationFileDownload'])->name('admin.application-file-download');
  Route::get('/application-order-print/{id}', [StudentApplictionController::class, 'applicationOrderPrint'])->name('admin.application_order_print');

  Route::get('/application/form/download/{id}', [StudentApplictionController::class, 'applicationFormDownload'])->name('admin.application-form-download');
});

Route::post('student-appliction-list-table-modify', [StudentApplictionController::class, "applicationTableManipulate"])->name('admin.student_appliction_list.table_manipulate');
Route::post('student-appliction-list-table-filter', [StudentApplictionController::class, "applicationTableManipulateFilter"])->name('admin.student_appliction_list.table_manipulate_filter');
Route::get('delete-filter-item/{id}', [StudentApplictionController::class, "deleteFilterItem"])->name('admin.student_appliction_list.delete_filter_item');
Route::get('get-filter-items', [StudentApplictionController::class, "getFilterItems"])->name('admin.student_appliction_list.get_filter_items');

Route::get('fetch-application/{application_id}', [StudentApplictionController::class, 'fetchApplication'])->name('admin.fetch_application');
Route::get('fetch-supports/{application_id}', [StudentApplictionController::class, 'fetchApplicationSupports'])->name('admin.fetch_application_support');
Route::get('fetch-major-overview/', [DepartmentController::class, 'fetchMajorOverview'])->name('admin.fetch_major_overview');

Route::prefix('admin')->middleware(['auth:admin', 'adminCheck:0'])->group(function () {
  Route::prefix('manage-employee')->group(function () {
    Route::get('index', [EmployeeManageController::class, 'index'])->name('backend.admin.manage_employee.index');
    Route::get('create', [EmployeeManageController::class, 'create'])->name('backend.admin.manage_employee.create');
    Route::post('store', [EmployeeManageController::class, 'store'])->name('backend.admin.manage_employee.store');
    Route::get('edit/{id}', [EmployeeManageController::class, 'edit'])->name('backend.admin.manage_employee.edit');
    Route::post('update/{id}', [EmployeeManageController::class, 'update'])->name('backend.admin.manage_employee.update');
    Route::post('delete', [EmployeeManageController::class, 'delete'])->name('backend.admin.manage_employee.delete');
  });

  Route::get('get-permissions', [EmployeeManageController::class, 'get_permissions'])->name('backend.admin.manage_employee.get_permissions');
  Route::post('manage-permissions', [EmployeeManageController::class, 'manage_permissions'])->name('backend.admin.manage_employee.manage_permissions');

  Route::prefix('office')->group(function () {
    Route::get('index', [OfficeController::class, 'index'])->name('backend.admin.office.index');
    Route::get('create', [OfficeController::class, 'create'])->name('backend.admin.office.create');
    Route::post('store', [OfficeController::class, 'store'])->name('backend.admin.office.store');
    Route::get('edit/{id}', [OfficeController::class, 'edit'])->name('backend.admin.office.edit');
    Route::post('update/{id}', [OfficeController::class, 'update'])->name('backend.admin.office.update');
    Route::post('delete', [OfficeController::class, 'destroy'])->name('backend.admin.office.delete');
  });

  Route::prefix('landing')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('admin.landing_page.index');
    Route::get('create', [LandingPageController::class, 'create'])->name('admin.landing_page.create');
    Route::post('store', [LandingPageController::class, 'store'])->name('admin.landing_page.store');
    Route::get('edit/{id}', [LandingPageController::class, 'edit'])->name('admin.landing_page.edit');
    Route::post('update/{id}', [LandingPageController::class, 'update'])->name('admin.landing_page.update');
    Route::post('delete', [LandingPageController::class, 'delete'])->name('admin.landing_page.delete');
    Route::get('change-status/{id}', [LandingPageController::class, 'change_status'])->name('admin.landing_page.change_status');
  });

  Route::prefix('get-consultation')->group(function () {
    Route::get('/', [GetConsultationController::class, 'index'])->name('admin.get_consultation.index');
    Route::post('/', [GetConsultationController::class, 'index'])->name('admin.get_consultation.index.filter');
    Route::get('edit/{id}', [GetConsultationController::class, 'edit'])->name('admin.get_consultation.edit');
    Route::post('update/{id}', [GetConsultationController::class, 'get_consultation_store'])->name('admin.get_consultation.update');
    Route::get('view/{id}', [GetConsultationController::class, 'view'])->name('admin.get_consultation.view');
    Route::post('delete', [GetConsultationController::class, 'delete'])->name('admin.get_consultation.delete');
  });
});
