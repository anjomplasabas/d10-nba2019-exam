@extends('components.layout')
@section('content')

    <h1 class="is-size-1">Example Query</h1>

    <table class="table is-striped">
        @include('components.table-heading', [
            'columns' => array_flip($teams[0])  
        ])
        
        @include('components.table-row', [
            'columns' => array_flip($teams[0]),
            'rows' => $teams 
        ])
    </table>

    <h1 class="is-size-1">Report 1 - Best 3pt Shooters</h1>

    <table class="table is-striped">
        @include('components.table-heading', [
            'columns' => array_flip($threePtShooters[0])  
        ])
        
        @include('components.table-row', [
            'columns' => array_flip($threePtShooters[0]),
            'rows' => $threePtShooters 
        ])
            
    </table>

    <h1 class="is-size-1">Report 2 - Best 3pt Shooting Teams</h1>

    <table class="table is-striped">
        @include('components.table-heading', [
            'columns' => array_flip($threePtTeams[0])  
        ])

        @include('components.table-row', [
            'columns' => array_flip($threePtTeams[0]),
            'rows' => $threePtTeams 
        ])
    </table>


@endsection