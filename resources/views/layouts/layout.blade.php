<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vanilla Bakery')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/navigation.css">
    <style>
        body {
            padding-top: 70px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        /* Custom Pagination Styles */
        .pagination {
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .pagination .page-link {
            color: #2C2C2C;
            background-color: white;
            border: 2px solid #D4AF88;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0.25rem;
            min-width: 45px;
            text-align: center;
        }
        
        .pagination .page-link:hover {
            color: white;
            background-color: #D4AF88;
            border-color: #D4AF88;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(212, 175, 136, 0.4);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #D4AF88 0%, #C19A6B 100%);
            border-color: #D4AF88;
            color: white;
            box-shadow: 0 6px 15px rgba(212, 175, 136, 0.5);
            font-weight: 600;
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .pagination .page-link:focus {
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 136, 0.25);
            z-index: 3;
        }
        
        /* First/Last/Prev/Next page buttons with icons */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            border-radius: 0.75rem;
            font-weight: 600;
        }
        
        /* Add icons spacing */
        .pagination .page-link i {
            font-size: 0.9rem;
        }
        
        /* Responsive pagination */
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 0.4rem 0.75rem;
                font-size: 0.875rem;
                min-width: 40px;
            }
            
            .pagination {
                gap: 0.25rem;
            }
            
            .pagination .page-link span {
                display: none;
            }
            
            .pagination .page-link i {
                margin: 0 !important;
            }
        }
        
        /* Pagination info text */
        .pagination-info {
            background: linear-gradient(135deg, #F5E6D3 0%, #E8D4B8 100%);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navigation Component -->
    <x-navigation />
    
    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>
    
    <!-- Footer Component -->
    <x-footer />
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>