<x-layouts.book-manager>
    <x-slot:title>
        BookDetails
    </x-slot:title>
    <h1>Book Details</h1>
    <ul>
        <li>ID:{{$book->id}}</li>
        <li>category: {{$book->category->title}}</li>
        <li>title:{{$book->title}}</li>
        <li>price:{{$book->price}}</li>
        <li>author:
            <ul>
                @foreach($book->authors as $author)
                    <li>{{$author->name}}</li>
                @endforeach
            </ul>
        </li>
    </ul>
    <a href="{{route('book.index')}}">back</a>
</x-layouts.book-manager>