<?php

namespace App\Http\Controllers;


use App\Models\Home;
use App\Models\News;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Website;
use App\Models\Disclaimer;
use App\Models\Description;
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


    public function media(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'nullable|string', // UUID adalah string
            'cari' => 'nullable|string',
        ]);

        // Ambil parameter dari request
        $kategori = $request->kategori;
        $cari = $request->cari;

        // Ambil semua kategori yang aktif
        $kategori_all = Kategori::where('status', 1)->orderBy('no_urut')->get();

        // Query Media
        $query = Media::query();
        $query->where('status', 1);

        // Filter berdasarkan pencarian
        if (!empty($cari)) {
            $query->where('title', 'like', '%' . $cari . '%');
        }

        // Filter berdasarkan kategori (UUID)
        if (!empty($kategori)) {
            $query->where('kategori_id', $kategori);
        }

        // Paginasi hasil query
        try {
            $media_all = $query->with('kategori')->latest()->paginate(15);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }

        // Tampilkan view dengan data
        return view('frontend.media', compact('media_all', 'kategori_all', 'kategori', 'cari'));
    }

    public function media_detail($slug)
    {
        $data = Media::with('kategori')->where('status', 1)->where('slug', $slug)->first();
        if (empty($data)) {
            return redirect()->back()->with('error', 'data tidak ditemukan');
        }

        $data_related = Media::with('kategori')
            ->where('status', 1)
            ->where('slug', '!=', $slug)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Tambahan: ambil artikel featured
        $featuredArticles = Media::where('status', 1)
            ->where('featured', 1)
            ->limit(5)
            ->get();

        return view('frontend.media_detail', compact('data', 'data_related', 'featuredArticles'));
    }

    public function our_member()
    {
        $founders = Testimoni::where('type', 'Founder')->get();
        $testimoni_all = Testimoni::orderBy('nama')->get();
        $testimoni_founder = Testimoni::where('type', 'founder')->orderBy('nama')->get();
        $members = User::where('type', 'member')
            ->whereNotNull('company_name')
            ->whereNotNull('company_website')
            ->get();

        return view('frontend.our_member', compact('founders', 'members', 'testimoni_all', 'testimoni_founder'));
    }





}
