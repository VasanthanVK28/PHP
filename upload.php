<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Spreadsheet</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Upload Spreadsheet</h1>
        
        <form action="read.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="spreadsheet" class="block text-sm font-medium text-gray-700 mb-1">
                    Select file (CSV or XLSX):
                </label>
                <input 
                    type="file" 
                    name="spreadsheet" 
                    id="spreadsheet" 
                    accept=".csv, .xlsx" 
                    required
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                           file:rounded file:border-0 file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100 transition"
                >
            </div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
            >
                Upload & Read
            </button>
        </form>
    </div>

</body>
</html>
