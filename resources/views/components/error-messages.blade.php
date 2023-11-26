<div style="color: brown">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @if ($loop->iteration >= 2)
                @break;
            @endif
        @endforeach
        @if ($hasTwoMoreErrors())
            以下略
        @endif
    </ul>
</div>