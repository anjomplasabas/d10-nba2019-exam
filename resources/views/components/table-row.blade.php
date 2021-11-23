<tbody>
    @foreach ($rows as $row)
        <tr>
            @foreach ($columns as $column)
                <td>
                    {{ $row[$column] }} {{ $column == '3pt_percentage' ? '%': ''}}
                </td>
            @endforeach
        </tr>
    @endforeach
</tbody>