@props(['content'])
<tr>
    <td>
        <p style="text-align:justify; font-size: 16px; margin: 10px 0;">
            {{ $content ?? $slot }}
        </p>
    </td>
</tr>
