@extends('layouts.master')

@section('pagetitle','Student Report')

@section('content')
  {!! Charts::assets() !!}
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><i class="fa fa-file-text-o"></i>New Student Enroll</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="#">Home</a></li>
          <li><i class="icon_document_alt"></i>Student</li>
          <li><i class="fa fa-file-text-o"></i>New Student Enroll</li>
        </ol>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <b><i class="fa fa-apple"></i>Student Information</b>
        <a href="#" class="pull-right" id="show-class-info"><i class="fa fa-plus"></i></a>
      </div>
      <div class="panel-body" style="padding-bottom: 4px;">
        <center>
          {!! $chart->render() !!}
        </center>
      </div>
    </div>
  </div>

@endsection
