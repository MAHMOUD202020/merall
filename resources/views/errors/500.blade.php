@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@if(auth()->check() && auth()->user()->admin == 1)

    @section('message', $exception->getMessage())

@else
    @section('message', __('Server Error'))
@endif
