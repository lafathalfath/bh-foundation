@extends('layout.admin')
@section('content')
    
<div class="flex flex-col gap-20">
    @foreach ($programs as $key=>$pg)
        {{-- {{ dd($pg) }} --}}
        <div>
            <div class="flex items-center justify-between">
                <button type="button" class="font-semibold text-lg" onclick="toggleSection('{{ $key }}')">
                    {{ $key }}&emsp;
                    <span id="caret-{{ $key }}">
                        <i class="fa-solid fa-caret-down"></i>
                    </span>
                </button>
                <div>
                    <a href="{{ route('manage.article.create', strtolower($key)) }}" class="btn btn-sm btn-success text-white">+ Create {{ $key }}</a>
                </div>
            </div>
            <section class="overflow-x-auto" id="section-{{ $key }}">
                <table class="table">
                    <!-- head -->
                    <thead class="text-black text-center">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pg as $item)
                            @php
                                $views = strval($item->views);
                                if (strlen($views) >= 4 && strlen($views) < 7) $views = substr($views, 0, strlen($views)-3)."K";
                                if (strlen($views) >= 7 && strlen($views) < 10) $views = substr($views, 0, strlen($views)-6)."M";
                                if (strlen($views) >= 10) $views = substr($views, 0, strlen($views)-9)."B";
                            @endphp
                            <tr class="hover:bg-gray-300">
                                <th class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $item->title }}</td>
                                <td class="flex gap-2 flex-wrap items-center justify-center">
                                    <div class="max-w-56">
                                        @foreach ($item->category as $cat)
                                            <div class="my-1 badge badge-accent">{{ $cat->name }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($item->published)
                                        <div class="badge badge-success text-white">published</div>
                                    @else
                                        <div class="badge badge-warning">drafted</div>
                                    @endif
                                </td>
                                <td class="text-center">{{ $views }}</td>
                                <td class="flex items-center justify-center gap-2">
                                    @if (!$item->published)
                                        <button type="button" class="btn btn-xs btn-success text-white" onclick="handlePublish('{{ route('manage.article.publish', Crypt::encryptString($item->id)) }}')"><i class="fa-solid fa-upload"></i> Publish</button>
                                    @endif
                                    <a href="{{ route('article', [
                                        'type' => strtolower($item->type->name),
                                        'id' => Crypt::encryptString($item->id),
                                    ]) }}" class="btn btn-xs btn-info"><i class="fa-solid fa-eye"></i> Detail</a>

                                    <a href="{{ route('manage.article.edit', [
                                        'type' => strtolower($item->type->name),
                                        'id' => Crypt::encryptString($item->id),
                                    ]) }}" class="btn btn-xs btn-warning"><i class="fa-solid fa-pencil"></i> Edit</a>
                                    <button type="button" class="btn btn-xs btn-error text-white" onclick="handleDelete('{{ route('manage.article.destroy', Crypt::encryptString($item->id)) }}')"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="6" class="text-center">Empty</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @php
                    $current = request()[str_replace(' ', '-', strtolower($key))] ?? 1;
                    $lastpage = $pg->lastPage();
                    $first = $current == 1;
                    $last = $current == $lastpage;
                    $total = $pg->total();
                    $start = ($current - 1) * $pg->perPage() + 1;
                    $end = min($current * $pg->perPage(), $total);
                @endphp
                <div class="mt-3 flex items-center justify-center">
                    <div class="flex items-center justify-center gap-2">
                        <!-- Tombol Previous -->
                        <a @if (!$first)
                            href="{{ $pg->url($current - 1) }}"
                        @endif 
                        class="px-2.5 pb-1 text-white font-bold hover:scale-125 
                        {{ $first ? 'bg-gray-400 pointer-events-none' : "rounded bg-[$settings->primary_color]" }}">
                            «
                        </a>
                                                    
                        <!-- Nomor Halaman -->
                        @for ($i = 1; $i <= $lastpage; $i++)
                            <a href="{{ $pg->url($i) }}" 
                                class="px-1 rounded {{ $current == $i ? "border-x-2 border-[$settings->primary_color]" : "hover:bg-[$settings->primary_color]/[0.5] hover:text-white" }}">
                                {{ $i }}
                            </a>
                        @endfor
                                                    
                        <!-- Tombol Next -->
                        <a @if (!$last)
                            href="{{ $pg->url($current + 1) }}"
                        @endif 
                        class="px-2.5 pb-1 text-white font-bold hover:scale-125 
                        {{ $last ? 'bg-gray-400 pointer-events-none' : "rounded bg-[$settings->primary_color]" }}">
                            »
                        </a>
                    </div>
                </div>
            </section>
        </div>
    @endforeach
</div>

{{-- modals --}}
<dialog id="publish_article_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold">Confirmation</h3>
        <div>
            Are you sure to publish this article?
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
            <form action="" id="publish_article" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success text-white">Publish</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="delete_article_modal" class="modal">
    <div class="modal-box bg-white">
        <h3 class="text-lg font-bold">Confirmation</h3>
        <div>
            Are you sure to delete this article?
        </div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
            <form action="" id="delete_article" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error text-white">Delete</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
{{-- end modals --}}

<script>
    const toggleSection = (key) => {
        const section = document.getElementById(`section-${key}`)
        const caret = document.getElementById(`caret-${key}`)
        section.style.display = section.style.display == 'none' ? 'block' : 'none'
        caret.innerHTML = section.style.display == 'none' ? '<i class="fa-solid fa-caret-right"></i>' : '<i class="fa-solid fa-caret-down"></i>'
    }

    const handlePublish = (route) => {
        const modal = document.getElementById('publish_article_modal')
        const form = document.getElementById('publish_article')
        form.action = route
        modal.showModal()
    }

    const handleDelete = (route) => {
        const modal = document.getElementById('delete_article_modal')
        const form = document.getElementById('delete_article')
        form.action = route
        modal.showModal()
    }
</script>

@endsection