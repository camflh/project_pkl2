@extends('layouts.app')

@section('title', 'Jurusan')

@section('content')

<div class="min-h-screen bg-[#FFFDF2] px-6 py-10 ml-6">

    <div class="max-w-6xl mx-auto"> 
        <h1 class="text-3xl mb-6 text-center text-black font-bold -translate-x-20">Data Jurusan</h1>

    <div class = "flex justify-between items-center mb-4">
        <a href="{{ route('jurusan.create') }}" class="px-4 py-2 rounded-lg text-[#fffdf2] bg-black  hover:scale-105 transition-all duration-200">Tambah Data</a>
        <div class = "mr-20">
        @if(session('success'))
            <p id="alert-message" class = "text-blue-500 text-xl">{{ session('success') }}</p>
        @endif
     
        @if(session('error'))   
            <p id="alert-message" class = "text-red-500">{{ session('error') }}</p>
        @endif
    </div>

    </div>

        <div class="overflow-x-auto rounded-lg shadow-md bg-white">
            <table class="w-full  text-center border-collapse">
                <thead class="text-[#fffdf2] bg-black">
                    <tr>
                        <th class="px-6 py-2">No</th>
                        <th class="px-10 py-2">Nama Jurusan</th>
                        <th class="px-10 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $j)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $j->nama_jurusan }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('jurusan.edit', $j->id_jurusan) }}" class="bg-black px-2 py-1 rounded-lg text-[#fffdf2] inline-block hover:scale-105 transition-all duration-300 text-sm">Edit</a>
                            <form action="{{ route('jurusan.destroy', $j->id_jurusan) }}" method="POST" class="inline-block delete-form">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded-lg text-[#fffdf2] bg-red-600 hover:scale-105 transition-all duration-300 text-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $data->links('pagination.tailwind') }}
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
        }
        }, 3000);
</script>

@endsection
