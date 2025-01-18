<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Product Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
    <style>

        .pagination .page-link {
            font-size: 14px;            
            padding: 0.5rem 0.75rem;    
            border-radius: 50%;         
            color: #007bff;             
            border-color: #007bff;      
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff; 
            border-color: #007bff;      
            color: white;               
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;  
            border-color: #dee2e6;      
            color: #6c757d;             
        }

        .pagination .page-item .page-link {
            font-size: 14px;            
            padding: 0.5rem 0.75rem;    
        }

        .pagination .page-link:hover {
            background-color: #0056b3;  
            color: white;               
            border-color: #0056b3;      
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>
</html>