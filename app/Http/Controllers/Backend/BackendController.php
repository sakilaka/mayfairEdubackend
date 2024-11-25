<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Course;
use App\Models\Ebook;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Package;
use App\Models\University;
use App\Models\Review;
use App\Models\ServiceBooking;
use App\Models\StudentApplication;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use App\Models\VisitorModel;

class BackendController extends Controller
{
  /**
   * Admin Dashboard
   */
  public function index()
  {
    $today = [];
    $week = [];
    $month = [];
    $year = [];

    $today['total_visitor'] = VisitorModel::whereDate('created_at', Carbon::today())->count();
    $today['total_application'] = StudentApplication::whereDate('created_at', Carbon::today())->where('status', '!=', 0)->count();
    $today['total_applicants'] = StudentApplication::whereDate('created_at', Carbon::today())->where('status', '!=', 0)->distinct('user_id')->count();
    $today['total_general_course'] = Course::whereDate('created_at', Carbon::today())->count();
    // $today['total_customer'] = User::whereDate('created_at', Carbon::today())->where('type', 1)->count();
    $today['total_consultant'] = User::whereDate('created_at', Carbon::today())->where('type', 7)->count();
    $today['total_event'] = Event::whereDate('created_at', Carbon::today())->count();
    $today['total_blog'] = Blog::whereDate('created_at', Carbon::today())->count();
    $today['total_subscriber'] = Subscriber::whereDate('created_at', Carbon::today())->count();
    $today['total_testimonial'] = Testimonial::whereDate('created_at', Carbon::today())->count();
    $today['total_review'] = Review::whereDate('created_at', Carbon::today())->count();
    $today['total_university'] = University::whereDate('created_at', Carbon::today())->count();
    $today['total_media_partner'] = Client::whereDate('created_at', Carbon::today())->count();

    ///week count
    $week['total_visitor'] = VisitorModel::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_application'] = StudentApplication::where('status', '!=', 0)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_applicants'] = StudentApplication::where('status', '!=', 0)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->distinct('user_id')->count();
    $week['total_general_course'] = Course::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    // $week['total_customer'] = User::where('type', 1)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_consultant'] = User::where('type', 7)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_event'] = Event::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_blog'] = Blog::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_subscriber'] = Subscriber::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_testimonial'] = Testimonial::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_review'] = Review::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_university'] = University::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $week['total_media_partner'] = Client::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

    //month count
    $month['total_visitor'] = VisitorModel::whereMonth('created_at', now()->month)->count();
    $month['total_application'] = StudentApplication::whereMonth('created_at', now()->month)->where('status', '!=', 0)->count();
    $month['total_applicants'] = StudentApplication::whereMonth('created_at', now()->month)->where('status', '!=', 0)->distinct('user_id')->count();
    $month['total_general_course'] = Course::whereMonth('created_at', now()->month)->count();
    // $month['total_customer'] = User::where('type', 1)->whereMonth('created_at', now()->month)->count();
    $month['total_consultant'] = User::where('type', 7)->whereMonth('created_at', now()->month)->count();
    $month['total_event'] = Event::whereMonth('created_at', now()->month)->count();
    $month['total_blog'] = Blog::whereMonth('created_at', now()->month)->count();
    $month['total_subscriber'] = Subscriber::whereMonth('created_at', now()->month)->count();
    $month['total_testimonial'] = Testimonial::whereMonth('created_at', now()->month)->count();
    $month['total_review'] = Review::whereMonth('created_at', now()->month)->count();
    $month['total_university'] = University::whereMonth('created_at', now()->month)->count();
    $month['total_media_partner'] = Client::whereMonth('created_at', now()->month)->count();

    //year count
    $year['total_visitor'] = VisitorModel::whereYear('created_at', now()->year)->count();
    $year['total_application'] = StudentApplication::whereYear('created_at', now()->year)->where('status', '!=', 0)->count();
    $year['total_applicants'] = StudentApplication::whereYear('created_at', now()->year)->where('status', '!=', 0)->distinct('user_id')->count();
    $year['total_general_course'] = Course::whereYear('created_at', now()->year)->count();
    // $year['total_customer'] = User::where('type', 1)->whereYear('created_at', now()->year)->count();
    $year['total_consultant'] = User::where('type', 7)->whereYear('created_at', now()->year)->count();
    $year['total_event'] = Event::whereYear('created_at', now()->year)->count();
    $year['total_blog'] = Blog::whereYear('created_at', now()->year)->count();
    $year['total_subscriber'] = Subscriber::whereYear('created_at', now()->year)->count();
    $year['total_testimonial'] = Testimonial::whereYear('created_at', now()->year)->count();
    $year['total_review'] = Review::whereYear('created_at', now()->year)->count();
    $year['total_university'] = University::whereYear('created_at', now()->year)->count();
    $year['total_media_partner'] = Client::whereYear('created_at', now()->year)->count();


    // fetch chart data of last 30 days
    $now = Carbon::now();
    $last30Days = [];

    for ($i = 0; $i < 30; $i++) {
      $day = $now->copy()->subDays($i);
      $dateFormatted = $day->format('Y-m-d');
      $shortDateFormatted = $day->format('M d');

      $totalApplicationsStatus1 = StudentApplication::whereDate('created_at', $dateFormatted)->count();
      $totalApplicationsApproved = StudentApplication::whereDate('created_at', $dateFormatted)->where('status', 2)->count();

      $last30Days[] = [
        'y' => $shortDateFormatted,
        'a' => $totalApplicationsStatus1,
        'b' => $totalApplicationsApproved,
      ];
    }
    $dataForChart = array_reverse($last30Days);

    // fetch visitors of last 30 days
    $last30DaysVisitors = [];

    for ($i = 0; $i < 30; $i++) {
      $day = $now->copy()->subDays($i);
      $dateFormatted = $day->format('Y-m-d');
      $shortDateFormatted = $day->format('M d');

      $last30DaysVisitors[] = [
        'date' => $shortDateFormatted,
        'count' => VisitorModel::whereDate('created_at', $dateFormatted)->count(),
      ];
    }

    $chart_data['daywiseVisitors'] = array_reverse($last30DaysVisitors);

    $chart_data['total_applications'] = StudentApplication::all()->count();
    $chart_data['total_students'] = User::where('type', 1)->count();
    $chart_data['total_partners'] = User::where('type', 7)->count();
    $chart_data['total_universities'] = University::all()->count();
    $chart_data['total_programs'] = Course::all()->count();

    return view('Backend.index', compact('today', 'week', 'month', 'year', 'dataForChart', 'chart_data'));
  }
}