@extends('layouts.app')

@section('title', 'Dashboard | ')

@section('content')
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Hallo {{ Auth()->user()->name }}, Selamat datang di web Kasir SIPD JABAR</h1>
@endsection
