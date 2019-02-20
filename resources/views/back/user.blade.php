@extends('layouts.master_back')
@section('Title', 'User')
@section('content')

<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
        <div class="title-page no-margin-bottom">{{__('user.manage.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{__('user.manage.config')}}</h5>
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
                            <table class="table table-striped table-bordered dt-responsive  dtr-inline collapsed" role="grid" id="users_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('user.manage.name')}}</th>
                                        <th>{{__('user.manage.email')}}</th>
                                        <th>{{__('user.manage.role')}}</th>
                                        <th>{{__('user.manage.account')}}</th>
                                        <th>{{__('user.manage.province')}}</th>
                                        <th>{{__('user.manage.location')}}</th>
                                        <th>{{__('user.manage.tel')}}</th>
                                        <th>{{__('user.manage.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $item)
                                    <tr class="item-{{$item->id}}">
                                        <td class="text-center">{{$item->id}}</td>
                                        <td>{{$item->full_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>@if($item->role == 1) User @elseif($item->role == 2) Approver @elseif($item->role ==
                                            3) Admin @endif</td>
                                        <td>{{$item->acc_type}}</td>
                                        <td>{{$item->province}}</td>
                                        <td width="20%">{{$item->address}}</td>
                                        <td>{{$item->mobile}}</td>
                                        <td class="text-center dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                            <div class="dropdown-menu dropdown-menu-right b-none contact-menu" x-placement="bottom-end">
                                                <a class="dropdown-item edit-data" data-info="{{$item->id}},{{$item->full_name}},{{$item->email}},{{$item->role}},{{$item->acc_type}},{{$item->province}},{{$item->address}},{{$item->mobile}}"><i class="icofont icofont-edit"></i>{{__('user.manage.edit')}}</a>
                                                <a class="dropdown-item delete-data" id="{{$item->id}}"><i class="icofont icofont-ui-delete"></i>{{__('user.manage.delete')}}</a></div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- start modal -->
                    <div id="edit_data_Modal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('user.manage.useraccount')}}</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="users_form" method="POST" action="{{ route('u_update') }}" role="form">
                                        <div class="input-group input-group-primary">
                                            <span class="input-group-addon"><i class="icofont-user-alt-1"></i></span>
                                            <input type="text" name="m_name" id="m_name" class="form-control" placeholder="ชื่อนามสกุล" required></div>
                                        <input type="hidden" name="m_id" id="m_id" />
                                        <br/>
                                        <div class="input-group input-group-primary">
                                            <span class="input-group-addon"><i class="icofont-email"></i></span>
                                            <input type="text" name="m_email" id="m_email" class="form-control" placeholder="อีเมล"></div>
                                        <br/>
                                        <div class="input-group input-group-primary">
                                            <span class="input-group-addon"><i class="icofont-crown"></i></span>
                                            <select name="m_role" id="m_role" class="form-control">
                                                                    <option value="3">Admin</option>
                                                                    <option value="2">Approver</option>
                                                                    <option value="1">User</option>
                                                                </select></div>
                                        <br/>
                                        <div class="input-group">

                                            <input type="hidden" name="m_acc_type" id="m_acc_type" class="form-control" placeholder="ประเภทบัญชี" disabled></div>

                                        <div class="input-group">

                                            <input type="hidden" name="m_province" id="m_province" class="form-control" placeholder="จังหวัด" disabled></div>

                                        <div class="input-group">

                                            <input type="hidden" name="m_address" id="m_address" class="form-control" placeholder="ที่อยู่" disabled></div>

                                        <div class="input-group">

                                            <input type="hidden" name="m_mobile" id="m_mobile" class="form-control" placeholder="เบอร์ติดต่อ" disabled></div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" name="m_edit" id="m_edit" class="m_edit btn btn-success" data-dismiss="modal">{{__('user.manage.save')}}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-script')
<!-- user.js -->
<script type="text/javascript" src="{{asset('js/user.js')}}"></script>
<script>
    var locale = '{{ config('app.locale') }}';
    var langswal =[];
        if(locale == 'th'){
         $('#users_table').DataTable( {"language": { "url": "{{asset('components/datatables/lang/TH.json')}}"},responsive: true} );
         langswal = [["คุณแน่ใจไหม?","เมื่อลบแล้วคุณจะไม่สามารถกู้คืนได้!","ผู้ใช้ถูกลบแล้ว!","ตกลง","ยกเลิก"],["แก้ไขข้อมูลผู้ใช้สำเร็จ!!","ข้อมูลมีการเปลี่ยนแปลงคลิกที่ปุ่ม!","ตกลง"]];
        }else{
         $('#users_table').DataTable( {"language": { "url": "{{asset('components/datatables/lang/EN.json')}}"},responsive: true} );
         langswal = [["Are you sure? Once deleted", "you will not be able to recover this!","User has been deleted!","OK","Cancel"],["Updated Successfully!!","Data has changed. Click the button!","OK"]];
        }

</script>
@endsection
