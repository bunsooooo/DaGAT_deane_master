<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">File Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="file">Choose file:</label>
        <input type="file" name="file" id="file" required>
        <br>
        <label for="document_type_id">Document Type:</label>
        <select name="document_type_id" id="document_type_id" required>
            @foreach($documentTypes as $documentType)
                <option value="{{ $documentType->id }}">{{ $documentType->DT_Type }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>