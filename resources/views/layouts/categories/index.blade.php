@extends('layouts.app')
@section('content')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title text-white">
                {{ $getCategory->name }}
            </h1>
        </div>
    </div>
</div>

<!-- latest Items Section -->
<div class="row" data-masonry='{"percentPosition": true }'>

    @foreach($items as $item)

    @if(!empty($setting_adv_top))
    @if($adv_top->status == 1)
    @if($loop->first)
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <p>{!! $adv_top->value !!}</p>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endif

    @if(!empty($setting_adv_bottom))
    @if($adv_bottom->status == 1)
    @if($loop->last)
    <div class="col-3">
        <div class="card">
            <div class="card-body text-center">
                <p>{!! $adv_bottom->value !!}</p>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endif

    @include('layouts.item')

    @endforeach
    
    @if($items->isEmpty())
    @include('layouts.blank')
    @endif
        
</div>

<div class="row">
    <div class="col-lg-12">
        {{ $items->links() }}
    </div>
</div>

@endsection('content')