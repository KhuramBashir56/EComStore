<table width="100%">
    <tr>
        <td style="text-align: center; padding: 20px 0;">
            <a href="{{ route('home') }}" class="footer-link" style="text-decoration: none; display: inline-block; color: #070a6e; padding: 0 10px; font-weight: bold;">Home</a>
            <a href="{{ route('products') }}" class="footer-link" style="text-decoration: none; display: inline-block; color: #070a6e; padding: 0 10px; font-weight: bold;">Products</a>
            <a href="{{ route('contact') }}" class="footer-link" style="text-decoration: none; display: inline-block; color: #070a6e; padding: 0 10px; font-weight: bold;">Contact Us</a>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; color: #9c9c9c; padding-bottom: 20px;">
            © 2023 - {{ date('y') }} {{ __(' All rights reserved ') . config('app.name') . '. v:1.0' }}
        </td>
    </tr>
</table>
