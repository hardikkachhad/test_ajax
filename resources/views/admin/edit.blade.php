<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Form</h1>
        <form action="{{ route('update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" class="form-control" value="{{ $product->id }}" name="name" id="name" placeholder="Enter name">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control"  value="{{ $product->name }}" name="name" id="name" placeholder="Enter name">
                <p></p>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select class="form-select" name="category" id="category">
                    <option selected disabled>Select a category</option>
                    @foreach ($category as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $product->cat_id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach

                </select>
                <p></p>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="Enter name">
                <img src="{{ url('admin_assets/uploads/' . $product->image)  }}" alt="" width="50px">
                <p></p>
            </div>
            {{-- <div class="mb-3">
                <label for="name" class="form-label"> Multiple  Image:</label>
                <input type="file" class="form-control" id="name" placeholder="Enter name">
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('#form').submit(function(e) {
            e.preventDefault();

            var form = new FormData(this);

            $.ajax({
                type: 'PUT',
                url: "{{ route('update', $product->id) }}",
                data: form,
                dataType: 'json',
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == false) {
                        var errors = response.errors;
                        if (errors.name) {
                            $('#name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }
                        if (errors.category) {
                            $('#category').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.category);
                        } else {
                            $('#category').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }
                        if (errors.image) {
                            $('#image').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.image);
                        } else {
                            $('#image').removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('');
                        }
                    }else{
                        window.location.href = "{{ route('index') }}";
                    }
                }
            })
        });
    </script>

</body>

</html>
