@extends('layouts.master_back')
@section('Title', 'Favorite')
@section('content')

<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
        <div class="title-page no-margin-bottom">{{__('event.favorites.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{__('event.favorites.list')}}</h5>
                            <span></span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i></li>
                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                    <li><i class="feather icon-trash-2 close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <table class="table table-striped table-bordered dt-responsive  dtr-inline collapsed" role="grid" id="events_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>{{__('event.favorites.name')}}</th>
                                        <th>{{__('event.favorites.day')}}</th>
                                        <th>{{__('event.favorites.imday')}}</th>
                                        <th>{{__('event.favorites.startday')}}</th>
                                        <th>{{__('event.favorites.join')}}</th>
                                        <th>{{__('event.favorites.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($favorite as $item)
                                    <tr class="item-{{$item->fid}}">
                                    <td class="text-center"><img class="img-60 img-radius" src="{{ asset('upload/images/event/'.$item->picture)}}" alt=""> </td>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center">{{$item->count_day}}</td>
                                        <td>{{$item->day}}</td>
                                        <td>{{$item->start}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td class="text-center dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right b-none contact-menu" x-placement="bottom-end">
                                                <a class="dropdown-item view-event" href="{{ route('e_detail', $item->ueid) }}" target="_blank"><i class="far fa-eye"></i>{{__('event.favorites.view')}}</a>
                                                <a class="dropdown-item delete-favorite" id="{{$item->fid}}"><i class="icofont icofont-ui-delete"></i>{{__('event.favorites.delete')}}</a></div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-script')
<!-- user.js -->
<script type="text/javascript" src="{{asset('js/event.js')}}"></script>
<script>
    var locale = '{{ config('app.locale') }}';
    var langswal =[];
        if(locale == 'th'){

         $('#events_table').DataTable( {"language": { "url": "{{asset('components/datatables/lang/TH.json')}}"},responsive: true} );
         langswal = [["คุณแน่ใจไหม?","เมื่อลบแล้วคุณจะไม่สามารถกู้คืนได้!","งานกิจกรรมที่สนใจลบแล้ว!","ตกลง","ยกเลิก"],["แก้ไขข้อมูลสำเร็จ!!","ข้อมูลมีการเปลี่ยนแปลงคลิกที่ปุ่ม!","ตกลง"]];
        }else{
         $('#events_table').DataTable( {"language": { "url": "{{asset('components/datatables/lang/EN.json')}}"},responsive: true} );
         langswal = [["Are you sure? Once deleted", "you will not be able to recover this!","Data has been deleted!","OK","Cancel"],["Updated Successfully!!","Data has changed. Click the button!","OK"]];
        }

</script>
@endsection
