@extends('layouts.profile')

@section('content')

<user-tour :t="{{ $tour->id }}"></user-tour>

@endsection