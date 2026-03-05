<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure E-Voting System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-slate-800 p-8 rounded-2xl shadow-2xl border border-slate-700">
        <h1 class="text-2xl font-bold text-center mb-2">E-VOTING SYSTEM</h1>
        <p class="text-slate-400 text-center text-sm mb-8">Secure SHA-256 Hashing Implementation</p>

        <form action="/vote" method="POST" class="space-y-4">
            @csrf
            <label class="block p-4 border border-slate-600 rounded-xl cursor-pointer hover:bg-slate-700 transition">
                <input type="radio" name="candidate_id" value="1" class="mr-2">
                <span class="font-bold">Kandidat 01 - Budi Santoso</span>
            </label>

            <label class="block p-4 border border-slate-600 rounded-xl cursor-pointer hover:bg-slate-700 transition">
                <input type="radio" name="candidate_id" value="2" class="mr-2">
                <span class="font-bold">Kandidat 02 - Siti Aminah</span>
            </label>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 py-3 rounded-xl font-bold mt-6">
                SUBMIT VOTE
            </button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#4f46e5'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Opss!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</body>
</html>