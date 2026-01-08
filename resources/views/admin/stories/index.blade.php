@extends('layouts.admin')

@section('title', 'Kelola Cerita')
@section('page-title', 'Kelola Cerita')

@section('content')
<div class="admin-header-section">
    <a href="{{ route('admin.stories.create') }}" class="btn-primary">
        Tambah Cerita Baru
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Region</th>
                <th>Views</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stories as $story)
            <tr>
                <td>{{ $story->title }}</td>
                <td>{{ $story->region->name ?? 'N/A' }}</td>
                <td>{{ number_format($story->views_count) }}</td>
                <td>{{ $story->created_at->format('d M Y') }}</td>
                <td>
                    <div class="admin-actions">
                        <a href="{{ route('admin.stories.edit', $story) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus cerita ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-state">
                    Belum ada cerita. <a href="{{ route('admin.stories.create') }}" style="color: #6e4130; font-weight: 600;">Tambah cerita baru</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="table-pagination">
        {{ $stories->links() }}
    </div>
</div>
@endsection
