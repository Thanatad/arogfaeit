@foreach ($events as $item)
<div class="col-lg-6 col-xl-3 col-md-6 item-{{$item->ueid}}">
    <div class="card rounded-card myevent-card">
        <div class="card-myevent">
            <img id="vevent-img" class="vevent-img text-center" src="https://visualpharm.com/assets/54/Calendar%20Plus-595b40b65ba036ed117d4341.svg">
            <div class="img-hover">
                <img class="img-fluid img-radius img-event-{{$item->eid}}" src="{{ asset('upload/images/event/'.$item->picture) }}" alt="round-img">
                <div class="img-overlay img-radius">
                    <span>
                        <a class="btn btn-sm btn-inverse" href="{{ route('e_detail', $item->eid) }}" target="_blank" data-popup="lightbox"><i class="icofont-eye-alt"></i></a>
                        <button type="button" class="btn btn-inverse btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                        <div class="dropdown-menu dropdown-menu-right b-none contact-menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item edit-data first" data-info="{{$item->ueid}};{{$item->lid}};{{$item->eid}};{{$item->name}};{{$item->short_des}};{{$item->description}};{{$item->budget}};{{$item->count_day}};{{$item->start}};{{$item->end}};{{$item->timestart}};{{$item->mobile}};{{$item->email}};{{$item->highlight}};{{$item->hashtag}};{{$item->picture}};{{$item->place_name}};{{$item->place_des}};{{$item->district}};{{$item->zipcode}};{{$item->province}};{{$item->amphoe}};{{$item->road}};{{$item->more_address}};{{$item->lat}};{{$item->lon}};{{$item->day}}"><i class="icofont icofont-edit"></i>Edit</a>
                        <a class="dropdown-item delete-data" id="{{$item->ueid}}"><i class="icofont icofont-ui-delete"></i>Delete</a></div>
                    </span>
                </div>
            </div>
            <div class="event-content">
                <div class="text-center">
                    <h4 class="text-default text-short" data-toggle="tooltip" title="{{$item->name}}">ชื่องาน : {{$item->name}}</h4>
                </div>
                <p class="m-b-0 text-muted text-short" data-toggle="tooltip" title="{{$item->place_name}}">ชื่อสถาณที่ : {{$item->place_name}}</p>
                <p class="m-b-0 text-Rasp">-----------------</p>
                @if (($item->assign == 0) AND ($item->end >= date('Y-m-d')))
                <div><span class="label-status label-inverse">สถานะ :  รอการตรวจสอบ </span></div>
                @elseif(($item->assign == 1) AND ($item->end >= date('Y-m-d')))
                <div><span class="label-status label-success">สถานะ :  เผยแพร่ </span></div>
                @else
                <div><span class="label-status label-danger">สถานะ :  สิ้นสุดการดำเนินการ </span></div>
                @endif
                <p class="m-b-0 text-Rasp">-----------------</p>
                @if($item->end >= date('Y-m-d'))
                <p class="m-b-0 text-muted">กำหนดการ : {{$item->start}} - {{$item->end}}</p>
                @else
                <p class="m-b-0 text-danger">กำหนดการ : {{$item->start}} - {{$item->end}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach