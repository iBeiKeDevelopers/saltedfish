@extends('layouts.app')
@section('content')
<script>
    console.log(window.Echo)
    window.Echo.private('App.admin')
        .listen('MigrateEvent', function (e) {
            alert('message: migrate!')
        })
</script>
@endsection