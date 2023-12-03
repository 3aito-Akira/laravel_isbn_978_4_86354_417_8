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
                @can('example-com-user')
                    <a href="{{route('book.show',$book)}}">
                        {{$book->title}}
                    </a>
                @else
                    {{$book->title}}
                @endcan
            </td>
            <td>{{$book->price}}</td>
            <td>
                @can('update',$book)
                    <a href="{{route('book.edit',$book)}}">
                        <button>Update</button>
                    </a>
                @else
                    <button disabled>Update</button>
                @endcan
            </td>
            <td>
                @cannot('update',$book)
                    <button disabled>Delete</button>
                @else
                    <form action="{{route('book.destroy',$book)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="削除">
                    </form>
                @endcannot
            </td>
        </tr>
    @endforeach    
</table>