@if ($errors->any())
    <ul class="p-0 h5 text-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif