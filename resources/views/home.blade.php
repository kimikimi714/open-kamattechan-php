@extends('layouts.app')

@section('content')
@verbatim
<h1>{{ type }} ranking</h1>
<list :type="type" :rankings="rankings"></list>
@endverbatim
@endsection
