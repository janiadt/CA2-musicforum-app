@extends('layouts.myapp')
{{-- Thread details. WIll change the look of this page in future commits. --}}
@section('content')
    <h3 class="text-center">{{$announce->title}}</h3>
    {{-- Displaying the data of the thread table --}}
    <table class="table table-primary table-striped">
        <tr>
            <td class="text-left">
                {{ $announce->body }}
            </td>
        </tr>
        <tr>
            <td class="text-left">
                <h5>Submitted By:</h5>
                {{ $announce->user->name }} 
            </td>
        </tr>    
    </table>
@endsection