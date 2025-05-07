<!-- resources/views/layouts/admin/footer.blade.php -->

<footer class="custom-footer">
    <div class="footer-content">
        <p>&copy; 2025 <span class="company">ER-Earning-Resources</span>. All rights resexxxrved.</p>
    </div>
</footer>

<style>
    .custom-footer {
        background-color:  #424547;
        color: #d1d5db;
        padding: 20px 0;
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        bottom: 0;
        width: 100%;
        margin-top: 40px;
    }

    .footer-content p {
        margin: 0;
        font-size: 16px;
        letter-spacing: 0.5px;
    }

    .footer-content .company {
        color: #f7f4f4;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .footer-content .company:hover {
        color: #ffffff;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .footer-content p {
            font-size: 14px;
        }
    }
</style>
