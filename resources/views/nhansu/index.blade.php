@extends('nhansu.layouts.master')

@section('noi_dung_chinh')

    <h2>1. Phan biet XSS (Bao mat)</h2>
    <p>In bien Hacker: {{ $ma_doc_hacker }}</p>

    <p>In bien An toan: {!! $chu_in_dam_an_toan !!}</p>


    <h2>2. Vong lap lay du lieu ngam (View Composer)</h2>
    <ul>
        @foreach($danh_sach_phong as $phong)
            <li>{{ $phong }}</li>
        @endforeach
    </ul>


    <h2>3. Bang Nhan su (Switch, For, If, Route)</h2>
    <table border="1">
        <tr>
            <th>Ten NV</th>
            <th>Trang thai (Switch)</th>
            <th>Nam sinh (For & If)</th>
            <th>Link (Route)</th>
        </tr>
        
        @foreach($ds_nhan_su as $nv)
        <tr>
            <td>{{ $nv->ten }}</td>
            
            <td>
                @switch($nv->trang_thai)
                    @case('Dang_Lam')
                        Dang lam viec
                        @break
                    @case('Thu_Viec')
                        Dang thu viec
                        @break
                    @default
                        Da nghi viec
                @endswitch
            </td>
            
            <td>
                <select>
                    @for($nam = 1990; $nam <= 2005; $nam++)
                        <option value="{{ $nam }}" @if(date('Y') - $nam == $nv->tuoi) selected @endif>
                            {{ $nam }}
                        </option>
                    @endfor
                </select>
            </td>
            
            <td>
                <a href="{{ route('nhanvien.chitiet', ['id' => $nv->ma_nv]) }}">Xem</a>
            </td>
        </tr>
        @endforeach
    </table>

@endsection