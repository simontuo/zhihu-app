@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">消息通知</div>
                <div class="panel-body">
                    @foreach($messages as $key => $messageGroup)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                @if(Auth::id() == $key)
                                    <img width="45" src="{{ $messageGroup->first()->fromUser->avatar }}" alt="">
                                @else
                                    <img width="45" src="{{ $messageGroup->first()->toUser->avatar }}" alt="">
                                @endif
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                @if(Auth::id() == $key)
                                    <a href="#">{{ $messageGroup->first()->fromUser->name }}</a>
                                @else
                                    <a href="#">{{ $messageGroup->first()->toUser->name }}</a>
                                @endif
                            </h4>
                            <p>
                                <a href="/inbox/{{ $messageGroup->last()->dialog_id }}">
                                    {{ $messageGroup->last()->body }}
                                </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
