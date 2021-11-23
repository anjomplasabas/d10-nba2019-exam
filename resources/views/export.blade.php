@extends('components.layout')
@section('content')

    <table class="table is-striped">
        @include('components.table-heading', [
            'columns' => array_flip($data[0])  
        ])

        @include('components.table-row', [
            'columns' => array_flip($data[0]),
            'rows' => $data 
        ])
    </table>


@endsection