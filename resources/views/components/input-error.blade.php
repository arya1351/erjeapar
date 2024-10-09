@props(['messages'])

@if ($messages)
<div class="alert alert-danger" role="alert">    
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </div>
@endif
