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
    <a href="{{route('book.create')}}">追加</a>
    <x-book-table :$books/>
</x-layouts.book-manager>