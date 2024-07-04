@extends('layouts.app')

@section('content')

<main class="container-notifications min-h65-vh">
    
    <div class="wrap w90 center items-flex flex-wrap">

        {{--
            
            
            --}}
        @if(isset($friendRequests) && $friendRequests->count() > 0)
            @foreach ($friendRequests as $friendRequest)
                @php
                    $user = App\Models\User::find($friendRequest->user_from);
                @endphp
                @if($user && $friendRequest->status != 'approved' && $friendRequest->status != 'reject')
                    <div class="box w23 text-center margin-right-default margin-down-default w95-device-small">
                        <figure class="img-user-bigger margin-down-small">
                            <img src="{{ asset("storage/{$user->image}") }}" />
                        </figure>
                        <div class="friend-request-actions" >
                            <a href="{{ route('profile', $user->id) }}"><h5>{{ $user->name }}</h5></a>
                            <form action="{{ route('friend-request') }}" method="post" class="items-flex just-space-between align-center margin-top-small">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $friendRequest->id }}" />
                                <input type="hidden" name="user_to" value="{{ Auth::id() }}" />
                                <input type="hidden" name="user_from" value="{{ $user->id }}" />
                                <input type="hidden" name="status" value="approved" />
                                <button name="status" value="approved" class="bgBlackWeakIn w80">Accept</button>
                                <button name="status" value="reject" class="bgBlackWeakIn"><i class="ri-close-line"></i></button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
                    <p>Não há solicitações Pendentes</p>
        @endif
    </div>
</main>

<style>
    .friend-request-actions {
        display: block;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .friend-request-actions form {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .friend-request-actions button {
        padding: 5px 10px;
        cursor: pointer;
    }

    .bgBlackWeakIn {
        background-color: #333;
        color: white;
        border: none;
    }

    .w80 {
        width: 80%;
    }
</style>

@endsection