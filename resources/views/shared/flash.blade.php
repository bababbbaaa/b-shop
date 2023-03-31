@if($message = flash()->get())
    <div class="{{$message->class()}} text-white hover:text-body p-5">
        {{$message->message()}}
    </div>
@endif
