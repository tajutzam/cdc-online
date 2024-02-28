@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="h5" style="color: white"> <i class="fas fa-eye"></i> Test Form</div>
                    </div>
                    <div class="card-body">
                        <form>
                            {{-- Text Input --}}
                            <div class="form-group">
                                <label for="text-input">Text Input</label>
                                <input type="text" class="form-control" id="text-input" name="text-input">
                            </div>

                            {{-- Number Input --}}
                            <div class="form-group">
                                <label for="number-input">Number Input</label>
                                <input type="number" class="form-control" id="number-input" name="number-input">
                            </div>

                            {{-- Email Input --}}
                            <div class="form-group">
                                <label for="email-input">Email Input</label>
                                <input type="email" class="form-control" id="email-input" name="email-input">
                            </div>

                            {{-- URL Input --}}
                            <div class="form-group">
                                <label for="url-input">URL Input</label>
                                <input type="url" class="form-control" id="url-input" name="url-input">
                            </div>

                            <div class="form-group">
                                <label for="datetime-input">Date and Time Input:</label>
                                <input type="datetime-local" id="datetime-input" name="datetime_input" class="form-control">
                            </div>


                            {{-- Date Only Input --}}
                            <div class="form-group">
                                <label for="date-only-input">Date Only Input</label>
                                <input type="date" class="form-control" id="date-only-input" name="date-only-input">
                            </div>

                            {{-- Time Only Input --}}
                            <div class="form-group">
                                <label for="time-only-input">Time Only Input</label>
                                <input type="time" class="form-control" id="time-only-input" name="time-only-input">
                            </div>

                            {{-- Dropdown Input --}}
                            <div class="form-group">
                                <label for="dropdown-input">Dropdown Input</label>
                                <select class="form-control" id="dropdown-input" name="dropdown-input">
                                    <option value="option1">Option 1</option>
                                    <option value="option2">Option 2</option>
                                    <option value="option3">Option 3</option>
                                </select>
                            </div>

                            {{-- Checkbox Inputs --}}
                            <div class="form-group">
                                <label>Checkbox Inputs</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-a" name="checkbox-a">
                                    <label class="form-check-label" for="checkbox-a">Checkbox A</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-b" name="checkbox-b">
                                    <label class="form-check-label" for="checkbox-b">Checkbox B</label>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
