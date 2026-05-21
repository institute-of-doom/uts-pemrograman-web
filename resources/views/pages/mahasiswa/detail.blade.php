<x-app-layout>
    <x-slot:title>
        Detail Mahasiswa - {{ $mahasiswa->nama }}
    </x-slot:title>

    <div class="max-w-4xl mx-auto bg-white rounded-xl border border-gray-100 shadow-md overflow-hidden p-6">
        <div class="flex items-center justify-between mb-6 pb-4 border-b">
            <h2 class="text-2xl font-bold text-gray-900">Profil Detail Mahasiswa</h2>
            <a href="{{ route('mahasiswa.list') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
            <div><strong>NIM:</strong> {{ $mahasiswa->nim }}</div>
            <div><strong>Nama Lengkap:</strong> {{ $mahasiswa->nama }}</div>
            <div><strong>Email:</strong> {{ $mahasiswa->email }}</div>
            <div><strong>Jurusan:</strong> {{ $mahasiswa->jurusan }}</div>
            <div><strong>Nomor Kartu:</strong> {{ $mahasiswa->kartuMahasiswa->no_kartu ?? 'Belum Ada Kartu' }}</div>
            <div><strong>Jenis Kelamin:</strong> {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
        </div>
    </div>
</x-app-layout>
