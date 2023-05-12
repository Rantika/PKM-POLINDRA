<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposal as $p)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $p["title"] }}</td>
                <td>
                    <a href="{{ url('/coba-review/'.$p['file']) }}" target="_blank">
                        Preview
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>