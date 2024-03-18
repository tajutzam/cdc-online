@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="h5" style="color: white"> <i class="fas fa-eye"></i> Test Form | {{ $data[0]->judul }}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paket_kuesioner_detail.create') }}" method="POST">
                            @csrf
                            @method('POST')
                            {{-- <input type="hidden" name="user_id" value="{{ Auth::guard('admin')->user()->id }}"> --}}
                            <input type="hidden" name="user_id" value="f217f260-b91f-463b-a6f8-0b96e45bcedf">
                            <input type="hidden" name="id_paket_kuesioner" value="{{ $data[0]->id }}">
                            <input type="hidden" name="id_paket_quesioner_detail"
                                value="{{ $data[0]->id_quis_identitas_prodi }}">
                            @foreach ($data[0]->detail as $d)
                                @switch($d->tipe->value)
                                    @case('select_jurusan')
                                        <div class="form-group">
                                            <label for="{{ $d->kode_pertanyaan }}">{{ $d->pertanyaan }}</label>
                                            <select class="form-control" id="{{ $d->kode_pertanyaan }}"
                                                name="{{ $d->kode_pertanyaan }}">
                                                <option value="" selected disabled> Pilih Jurusan..</option>
                                                @foreach ($jurusan as $j)
                                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                    @break

                                    @case('select_prodi')
                                        <div class="form-group">
                                            <label for="{{ $d->kode_pertanyaan }}">{{ $d->pertanyaan }}</label>
                                            <select class="form-control" id="{{ $d->kode_pertanyaan }}"
                                                name="{{ $d->kode_pertanyaan }}">
                                                <option value="" selected disabled> Pilih Program Studi..</option>
                                                @foreach ($prodi as $p)
                                                    <option value="{{ $p->nama_prodi }}">{{ $p->nama_prodi }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                    @break

                                    @case('select_epsbed')
                                        <div class="form-group">
                                            <label for="{{ $d->kode_pertanyaan }}">{{ $d->pertanyaan }}</label>
                                            <select class="form-control" id="{{ $d->kode_pertanyaan }}"
                                                name="{{ $d->kode_pertanyaan }}">
                                                <option value="" selected disabled> Pilih Kode Prodi..</option>
                                                @foreach ($prodi as $p)
                                                    <option value="{{ $p->id }}">{{ $p->id }}-{{ $p->nama_prodi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                    @break

                                    @case('select')
                                        <div class="form-group">
                                            <label for="{{ $d->kode_pertanyaan }}">{{ $d->pertanyaan }}</label>
                                            <select class="form-control" id="{{ $d->kode_pertanyaan }}"
                                                name="{{ $d->kode_pertanyaan }}">
                                                <option value="" selected disabled> Pilih Jawaban..</option>
                                                @foreach (json_decode($d->options) as $o)
                                                    <option value="{{ $o }}">{{ $o }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                    @break

                                    @case('checkbox')
                                        <div class="form-group">
                                            <label>{{ $d->pertanyaan }}</label>
                                            @foreach (json_decode($d->options) as $o)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="{{ $d->kode_pertanyaan }}"
                                                        name="{{ $d->kode_pertanyaan }}[]" value="{{ $o }}">
                                                    <label class="form-check-label" for="checkbox-a">{{ $o }}</label>
                                                </div>
                                            @endforeach
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                    @break

                                    @default
                                        <div class="form-group">
                                            <label for="{{ $d->kode_pertanyaan }}">{{ $d->pertanyaan }}</label>
                                            <input type="{{ $d->tipe->value }}" class="form-control"
                                                id="{{ $d->kode_pertanyaan }}" name="{{ $d->kode_pertanyaan }}">
                                            @if ($errors->has($d->kode_pertanyaan))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first($d->kode_pertanyaan) }}</span>
                                            @endif
                                        </div>
                                @endswitch
                            @endforeach
                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
