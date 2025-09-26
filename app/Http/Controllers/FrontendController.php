<?php

namespace App\Http\Controllers;


use App\Models\Home;
use App\Models\News;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Career;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Website;
use App\Models\Category;
use App\Models\Disclaimer;
use App\Models\Description;
use Illuminate\Support\Str;
use App\Models\PracticeArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $website = Website::first();
        $sliders = Slider::where('status', 1)
            ->orderBy('queue')
            ->get();
        $homes = Home::all();
        $stats = Stat::where('status', 1)->get();
        $teams = Team::all();
        $news = News::latest('created_at')->get();
        $services = Service::where('status', 1)->take(10)->get();
        $practiceAreas = PracticeArea::where('status', 1)->take(10)->get();

        $homeServiceAndPracticeAreas = Home::find('68ad9be0-c220-49df-b2a3-3d431023d512');
        $homeStat = Home::find('ec8cf173-5d8a-4c7a-8323-5e08eefcbd78');
        $homeTeam = Home::find('8b5c8d2a-be27-43c1-a9ac-54fbdb044a98');
        $homeNews = Home::find('a0810373-cfec-4146-a853-cee47af08a2a');
        return view('frontend.welcome', compact(
            'website',
            'sliders',
            'homes',
            'stats',
            'teams',
            'news',
            'services',
            'practiceAreas',
            'homeServiceAndPracticeAreas',
            'homeStat',
            'homeTeam',
            'homeNews'
        ));
    }

    public function service()
    {
        $website = Website::first();
        $services = Service::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil semua practice areas dengan status = 1
        $practiceAreas = PracticeArea::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $descriptions = Description::all();
        $homeServiceAndPracticeAreas = Home::find('68ad9be0-c220-49df-b2a3-3d431023d512');

        return view('frontend.service', compact(
            'services',
            'practiceAreas',
            'homeServiceAndPracticeAreas',
            'descriptions',
            'website'
        ));
    }

    public function about()
    {
        $website = Website::first();
        $homeTeam = Home::find('8b5c8d2a-be27-43c1-a9ac-54fbdb044a98');
        $homeAbout = Home::find('62e82228-9a7a-11f0-81d4-cc6b1e6d7dc0');
        $teams = Team::all();
        $descriptions = Description::first();
        $disclaimer = Disclaimer::first();

        return view('frontend.about', compact(
            'website',
            'homeTeam',
            'teams',
            'descriptions',
            'homeAbout',
            'disclaimer'
        ));
    }

    public function disclaimer()
    {
        $website = Website::first();
        $descriptions = Description::first();
        $disclaimer = Disclaimer::first();

        return view('frontend.disclaimer', compact(
            'website',
            'descriptions',
            'disclaimer'
        ));
    }
    public function contact()
    {
        $website = Website::first();
        return view('frontend.contact', compact('website'));
    }

    public function send_contact(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validated->fails()) {
            Session::flash('warning', __('frontend.send_fail'));
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        $data = new Contact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->message = $request->message;
        $data->subject = $request->subject;
        $data->save();
        return redirect()->back()->with('success', __('frontend.send_success'));
    }

    public function career()
    {
        $website = Website::first();
        $description = Description::first();
        $homeCareer = Home::find('8cffeb72-9ab5-11f0-81d4-cc6b1e6d7dc0');
        return view('frontend.career', compact('website', 'homeCareer', 'description'));
    }

    public function send_career(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'aplication' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput()
                ->with('warning', __('frontend.send_fail'));
        }

        $career = new Career();
        $career->id = Str::uuid();
        $career->name = $request->name;
        $career->email = $request->email;
        $career->subject = $request->subject;
        $career->message = $request->message;

        if ($request->hasFile('aplication')) {
            $file = $request->file('aplication');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/careers', $filename);
            $career->aplication = $filename;
        }

        $career->save();

        return redirect()->back()->with([
            'success' => __('frontend.send_success'),
            'file_url' => $career->aplication_url, // gunakan accessor
            'file_name' => $career->aplication
        ]);
    }

    public function news(Request $request)
    {
        $website = Website::first();
        $description = Description::first();
        $homeNews = Home::find('a0810373-cfec-4146-a853-cee47af08a2a');

        // Get all categories for filter
        $categories = Category::where('status', 1)->get();

        // Get news with filters
        $query = News::with('category')
            ->where('status', 1)
            ->orderBy('created_at', 'desc');

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Search by title if provided
        if ($request->has('search') && $request->search != '') {
            $locale = app()->getLocale();
            $titleColumn = "title_{$locale}";
            $query->where($titleColumn, 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(12);

        return view('frontend.news', compact(
            'website',
            'description',
            'homeNews',
            'categories',
            'news'
        ));
    }

    public function newsDetail($locale, $slug)
    {
        // Set locale untuk aplikasi
        app()->setLocale($locale);

        $slugColumn = 'slug_' . $locale;

        // Ambil data website
        $website = Website::first();

        // Ambil berita sesuai slug dan locale
        $news = News::with('category')
            ->where($slugColumn, $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Breadcrumb
        $breadcrumbs = [
            ['title' => __('frontend.news'), 'url' => locale_route('frontend.news')],
            ['title' => $news->category ? ($locale == 'id' ? $news->category->title_id : $news->category->title_en) : '-', 'url' => '#'],
            ['title' => $news->{'title_' . $locale}, 'url' => '']
        ];

        return view('frontend.news-detail', compact('website', 'news', 'breadcrumbs'));
    }
}
