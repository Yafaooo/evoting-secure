<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure E-Voting System v2.0</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-[#0f172a] text-slate-200 min-h-screen flex flex-col items-center justify-center p-6 font-sans">

    <div class="text-center mb-10 animate__animated animate__fadeInDown">
        <h1 class="text-4xl font-extrabold text-white tracking-tight italic">E-VOTING <span class="text-indigo-500">SECURE</span></h1>
        <p class="text-slate-400 text-sm mt-2 tracking-[0.3em] uppercase">Encrypted with SHA-256 Technology</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-5xl w-full">
        <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-8 shadow-2xl animate__animated animate__fadeInLeft">
            <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> Choose Your Leader
            </h2>
            
            <form action="{{ route('votes.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    @foreach($candidates as $candidate)
                    <label class="relative flex items-center gap-4 p-5 border border-slate-700 rounded-2xl cursor-pointer hover:bg-slate-700/50 hover:border-indigo-500/50 transition-all group overflow-hidden">
                        <input type="radio" name="candidate_id" value="{{ $candidate->id }}" class="w-6 h-6 text-indigo-600 focus:ring-indigo-500 bg-slate-900 border-slate-600" required>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold group-hover:text-indigo-400 transition-colors">{{ $candidate->name }}</span>
                            <span class="text-xs text-slate-500 italic">{{ $candidate->vision_mission }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
                <button type="submit" class="w-full mt-10 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white py-4 rounded-2xl font-black shadow-[0_0_20px_rgba(79,70,229,0.4)] transition-all active:scale-95 uppercase tracking-widest text-sm">
                    KIRIM SUARA SEKARANG
                </button>
            </form>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-8 shadow-2xl animate__animated animate__fadeInRight">
            <h2 class="text-xl font-bold mb-8 flex items-center gap-2 text-white uppercase tracking-tighter">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span> Real-Time Result
            </h2>
            
            <div class="space-y-8">
                @php $total = $results->sum('votes_count'); @endphp
                @foreach($results as $res)
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-400 uppercase font-bold tracking-wider">Candidate</span>
                            <span class="text-lg font-bold text-white">{{ $res->name }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-2xl font-black text-indigo-400">{{ $res->votes_count }}</span>
                            <span class="text-[10px] text-slate-500 block uppercase font-bold">Total Votes</span>
                        </div>
                    </div>
                    <div class="w-full bg-slate-900 h-4 rounded-full p-1 border border-slate-700">
                        @php $p = $total > 0 ? ($res->votes_count / $total) * 100 : 0; @endphp
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-400 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $p }}%"></div>
                    </div>
                    <span class="text-[10px] mt-1 block text-right text-slate-500 font-mono">{{ number_format($p, 1) }}% Influence Ratio</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-12 text-slate-500 text-[10px] flex gap-6 uppercase tracking-widest animate__animated animate__fadeIn">
        <div class="flex items-center gap-2"><span class="w-2 h-2 bg-green-500 rounded-full"></span> Database: Secured</div>
        <div class="flex items-center gap-2"><span class="w-2 h-2 bg-indigo-500 rounded-full"></span> Encryption: SHA-256</div>
        <div class="flex items-center gap-2"><span class="w-2 h-2 bg-amber-500 rounded-full"></span> Status: Live</div>
    </div>

    <script>
        @if(session('success'))
            Swal.fire({
                title: 'SUARA BERHASIL MASUK!',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#1e293b',
                color: '#fff',
                confirmButtonColor: '#4f46e5',
                showClass: { popup: 'animate__animated animate__zoomIn' }
            });
        @endif
    </script>
</body>
</html>