@extends('layouts.master_back') 
@section('Title', 'Help') 
@section('page-style')
<style>
    body .home {
        background: #222;
        color: #f0f0f0;
    }

    #oxide {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: monospace;
        font-size: 20px;
        white-space: nowrap;
        text-shadow: 0 2px 2px rgba(#000, 0.9);
    }
</style>
@endsection
 
@section('content')

<div class="content-inner home">
    <header class="page-header">
        <div class="container-fluid">
        <div class="title-page no-margin-bottom">{{__('layout.lay.help.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="m-t-50">
                        <div id="oxide"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
 
@section('page-script')
<script>

var locale = '{{ config('app.locale') }}';
if(locale == 'th'){
    var rawmessage =['ที่คุณผู้ใช้กดเข้ามา','มีปัญหาใช่ไหม?','ถ้าใช่รอดูข้อความต่อไป','มีปัญหาติดต่อมาได้ 24 ชม.','admin@admin.com','ขอบคุณครับ'];
}else{
    var rawmessage =['Knock Knock.','Have a problem, right?','If not, please go out.',"Have problems contacting for 24 hours.",'admin@admin.com','kobkunkab'];
}
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('7 x=b(e){"z F";7 t=K;t.v=b(){t.f="&#*+%?£@§$",t.3=0,t.5=0,t.6=!1,t.8=L,9(t.g,H)},t.q=b(e){i(7 a="";a.4<e;)a+=t.f.k(d.o(d.j()*t.f.4));I a},t.g=b(){p(t.5<t.8[t.3].4){t.5=t.5+2,t.5>t.8[t.3].4&&(t.5=t.8[t.3].4);7 a=t.q(t.5);$(e).h(a),9(t.g,w)}y 9(t.m,w)},t.m=b(){p(!1===t.6){t.6=[];i(7 a=0;a<t.8[t.3].4;a++)t.6.C({c:d.o(B*d.j())+1,l:t.8[t.3].k(a)})}7 s=!1,n="";i(a=0;a<t.6.4;a++){7 r=t.6[a];r.c>0?(s=!0,r.c--,n+=t.f.k(d.o(d.j()*t.f.4))):n+=r.l}$(e).h(n),!0===s?9(t.m,M):9(t.u,J)},t.u=b(){t.3=t.3+1,t.3>=t.8.4&&(t.3=0),t.5=0,t.6=!1,$(e).h(""),9(t.g,D)},t.v()},A=E x($("#G"));',49,49,'|||message|length|current_length|fadeBuffer|var|messages|setTimeout||function||Math||codeletters|animateIn|html|for|random|charAt||animateFadeBuffer||floor|if|generateRandomString||||cycleText|init|20|Messenger|else|use|messenger|12|push|200|new|strict|oxide|100|return|2e3|this|rawmessage|50'.split('|'),0,{}))
</script>
@endsection