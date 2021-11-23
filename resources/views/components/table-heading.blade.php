<thead>
    @foreach ($columns as $column)
        <th>
            {{ ucfirst(str_replace('_', ' ', $column)) }}
        </th>
    @endforeach
</thead>