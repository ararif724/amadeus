<table border="1" style="width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>PNR ID</th>
            <th>Origin System</th>
            <th>Creation Date & Time</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $resp->data->id }}</td>
            <td>{{ $resp->data->associatedRecords[0]->reference }}</td>
            <td>{{ $resp->data->associatedRecords[0]->originSystemCode }}</td>
            <td>{{ date('Y-m-d H:i:s', strtotime($resp->data->associatedRecords[0]->creationDate)) }}</td>
        </tr>
    </tbody>
</table>
