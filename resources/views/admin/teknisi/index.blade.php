@extends('admin.app')
@section('content')
    <div class="container border">
        <div class="d-grid gap-1">
            <a button type="button" class="btn btn-primary" id="liveToastBtn" href="{{ route('teknisi.create') }}">Tambah Teknisi</a>
        </div>
        <div class="card-body px-0 pb-0">
            <div class="table-responsive border">
                <table class="table table-flush" id="products-list">

                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Hari</th>
                            {{-- <th>sesi</th> --}}
                            <th>No_hp</th>
                            <th>Foto</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    @foreach ($teknisi as $item)
                        <tbody>
                            <tr>
                                <td class="text-sm">{{ $item->nama }}</td>
                                <td class="text-sm">{{ $item->nim }}</td>
                                <td class="text-sm">{{ $item->hari }}</td>
                                {{-- <td class="text-sm">{{ $item->sesi }}</td> --}}
                                <td class="text-sm">{{ $item->no_hp }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div class="pic"><img src="{{ asset('images/teknisi/' . $item->foto) }}"
                                                class="img-fluid" width="80" height="80" alt="pp"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('teknisi.edit', $item->id) }}"><i
                                                    class="fa fa-edit"></i> Edit</a>
                                            <form action="{{ route('teknisi.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                        class="fa fa-trash"></i> Hapus</button>
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
