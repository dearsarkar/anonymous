@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <span class="avatar avatar-md avatar-rounded" @if(!empty($user->avatar)) style="background-image: url({{ asset('storage/app/public/images/avatar/'.$user->avatar) }})" @endif>
                @if(empty($user->avatar))
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                @endif

                @if(Cache::has('user-is-online-' . $user->id))
                <span class="badge bg-green" title="{{ __('main.card_online') }}"></span>
                @else
                <span class="badge bg-x" title="{{ __('main_card_offline') }}"></span>
                @endif
            </span>
        </div>
        <div class="col">
            <h2 class="page-title text-white">
                {{ $user->name }}
            </h2>
            
            <div class="page-subtitle">
                <div class="row">
                    <div class="col-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20l10 -10m0 -5v5h5m-9 -1v5h5m-9 -1v5h5m-5 -5l4 -4l4 -4" /><path d="M19 10c.638 -.636 1 -1.515 1 -2.486a3.515 3.515 0 0 0 -3.517 -3.514c-.97 0 -1.847 .367 -2.483 1m-3 13l4 -4l4 -4" /></svg>
                        {{ __('main.profile_count_post', ['count' => $user->all_posts_user->count()]) }}
                    </div>
                
                    <div class="col-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                        <a href="{{ route('user_comments', ['username'=>$user->name])}}" class="text-muted active">
                            {{ __('main.profile_count_comments', ['count' => $user->comments->count()]) }}
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-2">
        @if(!empty($setting_adv_top))
        @if($adv_top->status == 1)
        <div class="mb-3">
            {!! $adv_top->value !!}
        </div>
        @endif
        @endif
    </div>
    
    <div class="col-lg-8">        
        <div class="card mb-3 shadow">
            <div class="card-body">
                
                <p class="card-title">
                    @if(empty($user->bio))
                    {{ __('main.no_bio') }}
                    @else
                    {{ $user->bio}}
                    @endif
                </p>
                
                @if(!empty($user->website))
                <div class="mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /><line x1="16" y1="21" x2="16" y2="19" /><line x1="19" y1="16" x2="21" y2="16" /><line x1="3" y1="8" x2="5" y2="8" /><line x1="8" y1="3" x2="8" y2="5" /></svg>
                    <a href="{{ $user->website }}" target="_blank">
                        {{ $user->website }}
                    </a>
                </div>
                @endif
                
                @if(!empty($user->twitter))
                <div class="mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                    <a href="https://twitter.com/{{$user->twitter}}" target="_blank">
                        https://twitter.com/{{$user->twitter}}
                    </a>
                </div>
                @endif
                
                @if(!empty($user->instagram))
                <div class="mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-red" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="4" /><circle cx="12" cy="12" r="3" /><line x1="16.5" y1="7.5" x2="16.5" y2="7.501" /></svg>
                    <a href="https://www.instagram.com/{{$user->instagram}}" target="_blank">
                        https://www.instagram.com/{{$user->instagram}}
                    </a>
                </div>
                @endif
                
                @if(!empty($user->tiktok))
                <div class="mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12a4 4 0 1 0 4 4v-12a5 5 0 0 0 5 5" /></svg>
                    <a href="{{ 'https://www.tiktok.com/@'.$user->tiktok }}" target="_blank">
                        {{ 'https://www.tiktok.com/@'.$user->tiktok }}
                    </a>
                </div>
                @endif
                
                @if(!empty($user->telegram))
                <div class="mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
                    {{$user->telegram}}
                </div>
                @endif
            </div>
        </div>

        <div class="card mb-3 shadow">
            <div class="card-body">
                <p class="text-muted">
                    Member since {{ Carbon::parse($user->created_at)->diffForHumans() }}
                </p>
            </div>
        </div>
    
    </div>
    
    <div class="col-lg-2">
        @if(!empty($setting_adv_bottom))
        @if($adv_bottom->status == 1)
        <div class="mb-3">
            {!! $adv_bottom->value !!}
        </div>
        @endif
        @endif
    </div>
    
</div>
@endsection('content')