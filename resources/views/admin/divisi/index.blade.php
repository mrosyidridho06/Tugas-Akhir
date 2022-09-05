@extends('admin.app')
@section('content')
    <div class="container border">
        <div class="d-grid gap-1">
            <a button type="button" class="btn btn-primary" id="liveToastBtn"
                href="{{ route('divisi.create') }}">Tambah Program kerja</a>
        </div>
        <div class="card-body px-0 pb-0">
            <div class="table-responsive border">
                <table id="example" class="table table-flush" id="products-list">

                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>kadiv</th>
                            <th>staffahli</th>
                            <th>staff</th>
                            <th>visi</th>
                            <th>misi</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($divisi as $item)
                        <tbody>
                            <tr>
                                <td class="text-sm">{{ $item->nama }}</td>
                                <td class="text-sm">{{ $item->kadiv }}</td>
                                <td class="text-sm">{{ $item->staffahli }}</td>
                                <td class="text-sm">{{ $item->staff }}</td>
                                <td class="text-sm">{{ $item->visi }}</td>                                
                                <td class="text-sm">{{ $item->misi }}</td>                                                                
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('divisi.edit',$item->id)}}"><i class="fa fa-edit"></i> Edit</a>
                                            <form action="{{route('divisi.destroy', $item->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>                                
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection