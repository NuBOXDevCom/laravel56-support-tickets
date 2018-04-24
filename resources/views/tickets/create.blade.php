@extends('layouts.app')
@section('title', 'Open a new support ticket')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">Open a new support ticket</div>
                <div class="card-body">
                    @include('includes.flash')
                    <form role="form" method="POST" action="{{ route('ticket.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                                       value="{{ old('title') }}" required>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="col-md-4 col-form-label">Category</label>
                            <div class="col-md-6">
                                <select id="category" type="category"
                                        class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                        name="category" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if(old('category') === $category) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="priority" class="col-md-4 control-label">Priorité</label>
                            <div class="col-md-6">
                                <select id="priority" type=""
                                        class="form-control{{ $errors->has('priority') ? ' is-invalid' : '' }}"
                                        name="priority" required>
                                    <option value="">Select priority</option>
                                    <option value="low" @if(old('priority') === 'low') selected @endif>Low</option>
                                    <option value="medium" @if(old('priority') === 'medium') selected @endif>Medium
                                    </option>
                                    <option value="high" @if(old('priority') === 'high') selected @endif>High</option>
                                </select>
                                @if ($errors->has('priority'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-md-4 col-form-label">Your Message</label>
                            <div class="col-md-6">
                                <textarea rows="10" id="message"
                                          class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                          name="message" required>{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Send ticket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection