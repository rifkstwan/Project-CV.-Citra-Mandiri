<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>All Users List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #eee;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 24px;
        }

        .kop-surat hr {
            border: 1px solid #333;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <h2 style="margin:0;">CV. Citra Mandiri</h2>
        <p style="margin:0; font-size:13px;">
            Rt.02/Rw.01, Tegowanu Wetan, Kec. Tegowanu, Kab. Grobogan<br>
            Telp: +628122577686 | Email: citramandiri@gmail.com
        </p>
        <hr>
    </div>

    <h2 style="text-align:center; margin-bottom:16px;">All Users List (Admin + Customer)</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ $user->address ?? '-' }}</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>