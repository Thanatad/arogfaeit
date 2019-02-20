@foreach ($events as $item)
<div class="col-lg-6 col-xl-3 col-md-6 item-{{$item->ueid}}">
    <div class="card rounded-card myevent-card">
        <div class="card-myevent">
            <div class="text-center m-b-5">
                <h4 class="text-default text-short" data-toggle="tooltip" title="{{$item->name}}">{{$item->name}}</h4>
            </div>
            <div class="img-hover">
                <img class="img-fluid img-radius" src="{{  asset('upload/images/event/'.$item->picture)}}" alt="round-img">

                <div class="img-overlay img-radius">
                    <span>
                <a class="btn btn-sm btn-inverse" href="{{ route('e_detail', $item->ueid) }}" target="_blank" data-popup="lightbox"><i class="icofont-eye-alt"></i></a>
                    </span>
                </div>
            </div>
            <div class="event-content">
                <p class="m-b-0 text-default text-short" data-toggle="tooltip" title="{{$item->short_des}}">{{$item->short_des}}</p>
                <div class="line"></div>
                <div class="row">
                    <div class="col-md-4 text-default">{{__('event.table.day')}}</div>
                    <div class="col-md-8 text-default text-short" data-toggle="tooltip" title="{{$item->day}}"> : {{$item->day}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-default">{{__('event.index.provinc')}}</div>
                    <div class="col-md-8 text-default text-short" data-toggle="tooltip" title="{{$item->province}}"> : {{$item->province}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-default">{{__('event.detail.place')}}</div>
                    <div class="col-md-8 text-default text-short" data-toggle="tooltip" title="{{$item->place_name}}"> : {{$item->place_name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-default">{{__('event.detail.date')}} {{$item->start}} - {{$item->end}}</div>
                </div>

            </div>
        </div>
    </div>
</div>
@endforeach