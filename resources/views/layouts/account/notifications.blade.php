@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title text-muted">
                {{ __('main.notifications') }}
            </h2>
        </div>
    </div>
</div>
<!-- 
Notifications 
-->
<div class="row row-cards">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="divide-y-4">
                    @forelse(Auth::user()->all_notifications() as $notifications)
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                @if(!empty(App\Models\User::find($notifications->sender_id)->avatar))
                                <span class="avatar" style="background-image: url({{ asset('storage/app/public/images/avatar/'.App\Models\User::find($notifications->sender_id)->avatar) }})"></span>
                                @else
                                <span class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                @endif
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>{{ App\Models\User::find($notifications->sender_id)->name }}</strong> 
                                    <!-- type = comment -->
                                    @if($notifications->notification_type == "comment") 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" /><line x1="8" y1="9" x2="16" y2="9" /><line x1="8" y1="13" x2="14" y2="13" /></svg> {{ __('main.commented_on_your') }} "<a href="{{ url('view/'.$notifications->item_id.'/'.App\Models\Items::find($notifications->item_id)->slug) }}"><strong>{{ App\Models\Items::find($notifications->item_id)->title }}</strong></a>" {{ __('main.post') }} 
                                    @else 
                                    <!-- type = like -->
                                    <svg xmlns="http://www.w3.org/2000/svg" id="like-icon-8" class="icon   icon-filled text-danger  " width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path></svg> {{ __('main.liked_your') }} "<a href="{{ url('view/'.$notifications->item_id.'/'.App\Models\Items::find($notifications->item_id)->slug) }}"><strong>{{ App\Models\Items::find($notifications->item_id)->title }}</strong></a>" {{ __('main.post') }} 
                                    @endif
                                </div>
                                <div class="text-muted">
                                    {{ Carbon::parse($notifications->created_at)->diffForHumans() }}
                                </div>
                            </div>
                            
                            @if($notifications->seen == 2)
                            <div class="col-auto align-self-center">
                                <div class="badge bg-red"></div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    @empty
                    <div class="empty">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="3" x2="21" y2="21" /><path d="M17 17h-13a4 4 0 0 0 2 -3v-3a7 7 0 0 1 1.279 -3.716m2.072 -1.934c.209 -.127 .425 -.244 .649 -.35a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                        </div>
                        <p class="empty-title">
                            {{ __('main.there_are_no_notifications') }}
                        </p>
                    </div>
                    @endforelse
                </div> 
            </div>
            
            <div class="card-footer text-end">
                <div class="col-auto">
                    <a href="javascript:void(0);" onclick="markAsRead()" class="btn btn-primary">
                        {{ __('main.mark_as_read') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="row mt-2">
    <div class="col-auto">
        {{ Auth::user()->all_notifications()->links() }}
    </div>
</div>

@endsection('content')