@extends('layouts.app')


@section('content')
    <div class="container">
        <h1 class="text-center mt-3">Kuesioner</h1>
        <form>
            <div class="form-group">
                <label for="question1">Pertanyaan 1: Apakah Anda suka memasak?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="yes" value="Ya">
                    <label class="form-check-label" for="yes">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="question1" id="no" value="Tidak">
                    <label class="form-check-label" for="no">Tidak</label>
                </div>
            </div>
            <div class="form-group">
                <label for="question2">Pertanyaan 2: Berapa kali Anda memasak dalam seminggu?</label>
                <input type="number" class="form-control" name="question2" min="0">
            </div>
            <div class="form-group">
                <label for="question3">Pertanyaan 3: Saran untuk meningkatkan pengalaman memasak?</label>
                <textarea class="form-control" name="question3" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
@endsection
