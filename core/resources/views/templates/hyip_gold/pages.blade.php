@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @if ($sections != null)
        @foreach (json_decode($sections) as $sec)
            @if(view()->exists($activeTemplate . 'sections.' . $sec))
                @include($activeTemplate . 'sections.' . $sec)
            @endif
        @endforeach
    @endif
@endsection
