@extends('layout.layout')
@section('title')
Profile | {{auth()->user()->name}}
@endsection
@section('content')
<profile-component></profile-component>
@endsection