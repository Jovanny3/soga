<!-- resources/views/clubs/index.blade.php -->
{{--@extends('layouts.app')



@section('content')
    <main class="container-users">
        <div class="wrap items-flex flex-wrap w90 center">
            @foreach ($users as $user)
                @if($user->id != Auth::id())
                    <div class="box text-center">
                        <figure class="img-user-bigger margin-down-small text-center">
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-avatar.png') }}" alt="{{ $user->name }}'s avatar" />
                        </figure>
                        <div>
                            <h5>{{ $user->name }}</h5>
                            <form method="post" action="{{ route('friend-store') }}" class="items-flex just-space-between align-center margin-top-small">
                                @csrf
                                <input type="hidden" name="user_to" value="{{ $user->id }}" />
                                <input type="hidden" name="user_from" value="{{ Auth::id() }}" />
                                <input type="hidden" name="status" value="pending" />
                                <button class="bgBlackWeakIn w80">Add Friend</button>
                                <a href="{{ route('profile', $user->id) }}" class="button bgBlackWeakIn"><i class="ri-eye-line"></i></a>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </main>
@endsection--}}

@extends('layouts.app')

@section('content')
    <main class="container-users">
        <div class="wrap items-flex flex-wrap w90 center">
            @foreach ($users as $user)
                <div class="box text-center">
                    <figure class="img-user-bigger margin-down-small text-center">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-avatar.png') }}" alt="{{ $user->name }}'s avatar" />
                    </figure>
                    <div>
                        <h5>{{ $user->name }}</h5>
                        @php
                            $friendRequest = $friendRequests->where('user_from', Auth::id())->where('user_to', $user->id)->first();
                        @endphp
                        @if(!$friendRequest)
                            <form method="post" action="{{ route('friend-store') }}" class="items-flex just-space-between align-center margin-top-small">
                                @csrf
                                <input type="hidden" name="user_to" value="{{ $user->id }}" />
                                <input type="hidden" name="user_from" value="{{ Auth::id() }}" />
                                <button class="bgBlackWeakIn w80">Add Friend</button>
                            </form>
                        @else
                            <p>Friend request sent</p>
                        @endif
                        <a href="{{ route('profile', $user->id) }}" class="button bgBlackWeakIn"><i class="ri-eye-line"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection