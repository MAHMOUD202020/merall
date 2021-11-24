@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', (bool)$exception->getMessage() ? $exception->getMessage() : 'لا تمتلك صلاحية الدخول لهاذا القسم في الموقع')
