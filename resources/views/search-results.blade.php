@extends('layouts.app')

@section('content')

<main class="settings-container">
    
    <div class="wrap w80 center margin-down-default">
        <div class="box">
            <h2 class="text-center margin-down-small">Search Results</h2>
            
            <div class="w70 items-flex align-center center flex-wrap-device-small w100-device-small">
                @if($users->count() > 0 || $clubs->count() > 0)
                    <div class="w100 margin-down-default">
                        <h3 class="text-center">Users</h3>
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <div class="w50 w100-device-small margin-down-small-device-small text-center-device-small">
                                    <div class="bgBlackWeakIn margin-down-small w80">
                                       <h4>{{ $user->name }}</h4>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No users found matching your search.</p>
                        @endif
                    </div>
                    
                    <div class="w100 margin-down-default">
                        <h3 class="text-center">Clubs</h3>
                        @if($clubs->count() > 0)
                            @foreach($clubs as $club)
                                <div class="w50 w100-device-small margin-down-small-device-small text-center-device-small">
                                    <div class="bgBlackWeakIn margin-down-small w80">
                                        <h4>{{ $club->name_community }}</h4>
                                        <p>{{ $club->description_community }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No clubs found matching your search.</p>
                        @endif
                    </div>
                @else
                    <div class="w100 text-center">
                        <p>No results found matching your search.</p>
                    </div>
                @endif
            </div>
            
            <div class="text-center w100 margin-top-default">
                <a href="{{ route('search') }}" class="bgBlackWeakIn w80 center">New Search</a>
            </div>
        </div>
    </div>

</main>

@endsection