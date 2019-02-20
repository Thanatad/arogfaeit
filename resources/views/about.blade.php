@extends('layouts.master_front') 
@section('Title', 'About') 
@section('page-style')

<style>
   .about {
      margin-top: 380px;
      margin-left: 140px;
   }
   .about .row:first-child {
      color: gray;
   }
   .about .row:nth-child(2) {
      margin-left: -70px;
   }
   @media only screen and (max-width: 680px) {
      h1{
         font-size: 1.5rem;
      }
      .about .row:nth-child(2) h1{
      margin-left: -70px;
      margin-top: -40px;
   }
   .about {
      margin-top: 300px;
   }
   }
</style>
@endsection
@section('content')
<div class=" container">
   <div class="about row text-c-pink">
      <div class="row">
      <h3>{{__('layout.lay.about.title')}}</h3>
      </div>
      <div class="row m-t-50">
         <h1 class=""> {{__('layout.lay.about.body')}} </h1>
      </div>
   </div>
</div>
@endsection
 
@section('page-script')
@endsection