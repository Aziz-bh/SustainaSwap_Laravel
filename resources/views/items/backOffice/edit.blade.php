@extends('layouts.admin')
@section('content')

    <h1>Item management</h1>
    <div class="container mt-5 ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 mt-3">

                <form method="POST" action="{{ route('itemsAdmin.update', ['id' => $item->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-3">
                        <label for="title">Title :</label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description :</label>
                        <input name="description" class="form-control" value="{{ $item->description }}" >
                    </div>
                    <div class="form-group mt-3">
                        <label for="category">Category :</label>
                        <select name="category" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="state">State :</label>
                        <select name="state" class="form-control" required>
                            <option value="Good" {{ $item->state === 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Bad" {{ $item->state === 'Bad' ? 'selected' : '' }}>Bad</option>
                            <option value="Medium" {{ $item->state === 'Medium' ? 'selected' : '' }}>Medium</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="picture">Image actuelle :</label>
                        <img src="{{ asset('uploads/' . $item->picture) }}" alt="Current Image" class="img-thumbnail" width="250" height="250">
                    </div>
                    <div class="form-group mt-3">
                        <label for="picture">Nouvelle image :</label>
                        <input type="file" name="picture" class="form-control">
                    </div>

                    <div >
                        <button type="submit" class="btn btn-primary mt-5">Update Item</button>
                    </div>
                </form>
            </div>
            <div class=" mt-3"></div>
            <div class=" mt-3"></div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <form id="delete-post-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@endsection
