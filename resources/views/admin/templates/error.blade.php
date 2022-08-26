@if ($errors->any())
    <div class="alert alert-danger">
        <h5><i class="icon fas fa-exclamation-triangle"></i>Warning!</h5>

        @foreach ($errors->all() as $error)
            <span style="font-size: 14px">{{ $error }}</span><br>
        @endforeach

        

        {{-- display only first error --}}
        {{-- @if (isset($task) && $task == 'first-error')
            <p style="font-size: 14px">{{ $errors->first() }}</p>
        @else
            @foreach ($errors->all() as $error)
                <p style="font-size: 14px">{{ $error }}</p>
            @endforeach
        @endif --}}
    </div>
@endif
