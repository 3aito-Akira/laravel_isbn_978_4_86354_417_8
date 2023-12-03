<x-layouts.book-manager>
    <x-slot:title>
        BookList
    </x-slot:title>
    <h1>book list</h1>
    @if(session('message'))
        <x-alert class="info">
            {{session('message')}}
        </x-alert>
    @endif
    @can('create',App\Models\Book::class)
        <a href="{{route('book.create')}}">追加</a>
    @endcan
    <x-book-table :$books/>
</x-layouts.book-manager>