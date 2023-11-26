<table border="1">
    <tr>
        <th>category</th>
        <th>title</th>
        <th>price</th>
        <th>update</th>
        <th>delete</th>
    </tr>
    @foreach($books as $book)
        <tr @if($loop->even) style="background:#dddefd" @endif>
            <td>{{$book->category->title}}</td>
            <td>
                <a href="{{route('book.show',$book)}}">
                    {{$book->title}}
                </a>
            </td>
            <td>{{$book->price}}</td>
            <td>
                <a href="{{route('book.edit',$book)}}">
                    <button>Update</button>
                </a>
            </td>
            <td>
                <form action="{{route('book.destroy',$book)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除">
                </form>
            </td>
        </tr>
    @endforeach    
</table>