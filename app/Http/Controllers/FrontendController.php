<?php

namespace App\Http\Controllers;


use App\Models\Home;
use App\Models\News;
use App\Models\Stat;
use App\Models\Team;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Website;
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
        $services = Service::where('status', 'active')->take(10)->get();
        $practiceAreas = PracticeArea::where('status', 'active')->take(10)->get();

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


    public function about()
    {
        return view('frontend.about');
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

    public function contact()
    {
        return view('frontend.contact');
    }

    public function send_kontak(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'subjek' => 'required',
            'pesan' => 'required',
        ]);

        if ($validated->fails()) {
            Session::flash('warning', 'data gagal di simpan');
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

        $data = new Kontak();
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->pesan = $request->pesan;
        $data->subjek = $request->subjek;
        $data->save();
        return redirect()->back()->with('success', 'Pesan berhasil di kirim');
    }

}
